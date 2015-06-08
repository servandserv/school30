<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet
	xmlns="http://www.w3.org/1999/xhtml"
	xmlns:svg="http://www.w3.org/2000/svg"
	xmlns:wadl="http://wadl.dev.java.net/2009/02"
	xmlns:xsd="http://www.w3.org/2001/XMLSchema"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:html="http://www.w3.org/1999/xhtml"
	xmlns:xlink="http://www.w3.org/1999/xlink"
	xmlns:exsl="http://exslt.org/common"
	xmlns:wadlext="urn:wadlext"
	xmlns:ns="urn:namespace"
	extension-element-prefixes="exsl"
	exclude-result-prefixes="xsd wadl html xsl"
	version="1.0">

<xsl:output
	media-type="application/xhtml+xml"
	method="xml"
	encoding="UTF-8"
	indent="yes"
	omit-xml-declaration="no"
	doctype-public="-//W3C//DTD XHTML 1.1//EN"
	doctype-system="http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd" />

<xsl:variable name="PROJECT-BASE">
	<xsl:text></xsl:text>
	<xsl:call-template name="get-base">
		<xsl:with-param name="path" select="/wadl:application/wadl:resources/@base"/>
	</xsl:call-template>
</xsl:variable>

<!-- контейнер для инклудов -->
<xsl:variable name="grammars">
	<xsl:apply-templates select="/wadl:application/wadl:grammars/wadl:include[@href]" mode="include-grammar" />
</xsl:variable>

<xsl:template match="wadl:include[@href]" mode="include-grammar">
	<xsl:variable name="included" select="document(@href, /)/*"></xsl:variable>
	<xsl:element name="wadl:include">
		<xsl:attribute name="href"><xsl:value-of select="@href"/></xsl:attribute>
		<xsl:copy-of select="$included"/> <!-- FIXME: xml-schema includes, etc -->
	</xsl:element>
</xsl:template>

<!-- Шаблон страницы  -->
<xsl:template match="wadl:application">
	<div>
		<h2>
			<xsl:choose>
				<xsl:when test="wadl:doc[@title]">
					<xsl:value-of select="wadl:doc[@title][1]/@title"/>
				</xsl:when>
				<xsl:otherwise>Undefined Application</xsl:otherwise>
			</xsl:choose>
		</h2><hr/>
		<xsl:apply-templates select="wadl:doc"/>
		<h3 id="summary">Содержание</h3>
		<ul>
			<li>
				<a href="#resources">Ресурсы</a>
				<xsl:apply-templates select="wadl:resources" mode="toc"/>
			</li>
			<li>
				<a href="#grammars">Справочники</a>
			</li>
		</ul>
		<h3 id="resources">Ресурсы</h3>
		<xsl:apply-templates select="wadl:resources" mode="list"/>
		<h3 id="grammars">Справочники</h3>
		<ul>
			<xsl:apply-templates select="wadl:grammars" mode="toc"/>
		</ul>
	</div>
</xsl:template>

<!-- Table of Contents -->
<xsl:template match="wadl:resources | wadl:grammars" mode="toc">
	<xsl:variable name="base">
		<xsl:choose>
			<xsl:when test="substring(@base, string-length(@base), 1) = '/'">
				<xsl:value-of select="substring(@base, 1, string-length(@base) - 1)"/>
			</xsl:when>
			<xsl:otherwise><xsl:value-of select="@base"/></xsl:otherwise>
		</xsl:choose>
	</xsl:variable>
	<ul>
		<xsl:apply-templates select="wadl:*" mode="toc">
			<xsl:with-param name="context"><xsl:value-of select="$base"/></xsl:with-param>
		</xsl:apply-templates>
	</ul>
</xsl:template>

<xsl:template match="wadl:include" mode="toc">
	<xsl:param name="context" />
	<xsl:variable name="id"><xsl:call-template name="get-id"/></xsl:variable>
	<xsl:variable name="href" select="@href" />
	<xsl:variable name="representations" select="//wadl:representation[@element]" />
	<xsl:variable name="types" select="//wadl:param[@type]" />
	<li>
		<a href="{$href}">
			<xsl:value-of select="$href"/>
		</a>
		<xsl:variable name="definition" select="exsl:node-set($grammars)/wadl:include[@href = $href]" />
		<xsl:for-each select="$definition/descendant::*[@name]">
			<xsl:variable name="localname" select="@name" />
			<!-- representations's mediaTypes -->
			<xsl:if test="$representations[substring-after(@element,':') = $localname]">
				<p>
					<em><xsl:value-of select="$localname" /></em><br/>
					<code>
						<xsl:apply-templates select="descendant::xsd:documentation[1]" />
					</code>
				</p>
			</xsl:if>
			<!-- param's types -->
			<xsl:if test="$types[substring-after(@type,':') = $localname]">
				<p>
					<em><xsl:value-of select="$localname" /></em><br/>
					<code>
						<xsl:apply-templates select="descendant::xsd:documentation[1]" />
					</code>
				</p>
			</xsl:if>
		</xsl:for-each>
	</li>
</xsl:template>

<xsl:template match="wadl:resource" mode="toc">
	<xsl:param name="context"/>
	<xsl:variable name="id"><xsl:call-template name="get-id"/></xsl:variable>
	<xsl:variable name="name"><xsl:value-of select="$context"/>/<xsl:value-of select="@path"/></xsl:variable>
	<li>
		<xsl:choose>
			<xsl:when test="wadl:doc[@title]">
				<a href="#{$id}">
					<xsl:value-of select="wadl:doc[@title][1]/@title" />
				</a>
			</xsl:when>
			<xsl:otherwise>
				<a href="#{$id}">
					<xsl:value-of select="$name"/>
				</a>
			</xsl:otherwise>
		</xsl:choose>
		<xsl:if test="wadl:resource">
			<ul>
				<xsl:apply-templates select="wadl:resource" mode="toc">
					<xsl:with-param name="context" select="$name"/>
				</xsl:apply-templates>
			</ul>
		</xsl:if>
	</li>
</xsl:template>

<!-- Listings -->
<xsl:template match="wadl:resources" mode="list">
	<xsl:variable name="base">
		<xsl:choose>
			<xsl:when test="substring(@base, string-length(@base), 1) = '/'">
				<xsl:value-of select="substring(@base, 1, string-length(@base) - 1)"/>
			</xsl:when>
			<xsl:otherwise><xsl:value-of select="@base"/></xsl:otherwise>
		</xsl:choose>
	</xsl:variable>
	<p>
		<xsl:apply-templates select="wadl:resource" mode="list">
			<xsl:with-param name="context" select="$base" />
		</xsl:apply-templates>
	</p>
</xsl:template>

<xsl:template match="wadl:resource" mode="list">
	<xsl:param name="context"/>
	<xsl:variable name="href" select="@id"/>
	<xsl:variable name="id"><xsl:call-template name="get-id"/></xsl:variable>
	<xsl:variable name="name">
		<xsl:value-of select="$context"/>/<xsl:value-of select="@path"/>
	</xsl:variable>
	<h4 id="{$id}">
		<xsl:choose>
			<xsl:when test="wadl:doc[@title]">
				<!--  если указан title  в документации корня ресурса, то указываем его в качестве заголовка  -->
				<xsl:value-of select="wadl:doc[@title][1]/@title"/>
			</xsl:when>
			<xsl:otherwise>
				<!--  иначе собираем запрос из имени ресурса  -->
				<xsl:copy-of select="$name"/>
				<!--xsl:apply-templates select="wadl:method[1]/wadl:request/wadl:param[@style='query']" mode="query" /-->
			</xsl:otherwise>
		</xsl:choose>
	</h4>
	<p>
		<xsl:apply-templates select="wadl:doc"/>
		<xsl:apply-templates select="wadl:method">
			<xsl:with-param name="url" select="$name" />
		</xsl:apply-templates>
		<xsl:apply-templates select="wadl:resource" mode="list">
			<xsl:with-param name="context" select="$name" />
		</xsl:apply-templates>
	</p>
</xsl:template>

<xsl:template match="wadl:method">
	<xsl:param name="url" />
	<xsl:variable name="id"><xsl:call-template name="get-id"/></xsl:variable>
	<h6 id="{$id}" title="{@name}">
		<xsl:value-of select="@name"/>
		<xsl:text>&#160;</xsl:text>
		<span>
		<!--xsl:call-template name="url-replace">
			<xsl:with-param name="url" select="$url" />
			<xsl:with-param name="request" select="wadl:request" />
		</xsl:call-template-->
		<xsl:value-of select="$url" />
		<xsl:apply-templates select="wadl:request/wadl:param[@style='query']" mode="query" />
		</span>
	</h6>
	<p>
		<xsl:apply-templates select="wadl:doc"/>
		<xsl:apply-templates select="wadl:request"/>
		<xsl:apply-templates select="wadl:response"/>
	</p>
</xsl:template>

<xsl:template match="wadl:request">
	<!-- в корне request допускаются параметры только типа 
		header при условии что нет узла representation 
		template
	-->
	<xsl:if test="wadl:param[@style='header'] and not(wadl:representation)">
		<p>
			<code>
				<xsl:value-of select="ancestor::wadl:method/@name"/>&#160;
				<xsl:value-of select="ancestor::wadl:resource/@path" />
				<xsl:text> HTTP/1.1</xsl:text><br/>
				<xsl:apply-templates select="." mode="param-group">
					<xsl:with-param name="prefix">request</xsl:with-param>
					<xsl:with-param name="style">header</xsl:with-param>
				</xsl:apply-templates>
			</code>
		</p>
	</xsl:if>
	
	<!--xsl:if test="wadl:param[@style='template' or @style='query']"-->
		<p>
			<code>
				<xsl:apply-templates select="." mode="param-group">
					<xsl:with-param name="prefix">request</xsl:with-param>
					<xsl:with-param name="style">template</xsl:with-param>
				</xsl:apply-templates>
			</code>
		</p>
		
		<p>
			<code>
				<xsl:apply-templates select="." mode="param-group">
					<xsl:with-param name="prefix">request</xsl:with-param>
					<xsl:with-param name="style">query</xsl:with-param>
				</xsl:apply-templates>
			</code>
		</p>
	<!--/xsl:if-->
	

	<xsl:apply-templates select="wadl:doc"/>
	<xsl:if test="wadl:representation">
		<p>
			<xsl:apply-templates select="wadl:representation" />
		</p>
	</xsl:if>
</xsl:template>

<xsl:template match="wadl:response">
	<h5 title="{substring(@status,1,1)}xx {@status}">
		<!-- Подставляем общие статусы, тк под одним кодом может идти несколько вариантов сообщений об ошибках -->
		<xsl:value-of select="@status" />
		<xsl:call-template name="status-name">
			<xsl:with-param name="status" select="@status" />
		</xsl:call-template>
	</h5>

	<xsl:choose>
		<xsl:when test="wadl:param">
			<p>
				<code>
					<span style="position:absolute;margin-left:-25px;">(1)</span>
					<xsl:text> HTTP/1.1</xsl:text>
					<xsl:value-of select="@status" />&#160;
					<xsl:value-of select="wadl:doc/@title" /><br/>
					<xsl:apply-templates select="." mode="param-group">
						<xsl:with-param name="prefix">response</xsl:with-param>
						<xsl:with-param name="style">header</xsl:with-param>
					</xsl:apply-templates>
					<xsl:apply-templates select="wadl:doc"/>
				</code>
			</p>
		</xsl:when>
		<xsl:otherwise>
			<xsl:apply-templates select="wadl:doc"/>
			<xsl:if test="wadl:representation">
				<xsl:apply-templates select="wadl:representation" />
			</xsl:if>
		</xsl:otherwise>
	</xsl:choose>
</xsl:template>

<xsl:template match="wadl:representation">
	<xsl:variable name="id"><xsl:call-template name="get-id"/></xsl:variable>
	<p>
		<code>
			<span style="position:absolute;margin-left:-25px;">(<xsl:value-of select="position()" />)</span>
			<xsl:choose>
				<xsl:when test="ancestor::wadl:request">
					<xsl:value-of select="ancestor::wadl:method/@name"/>&#160;
					<xsl:for-each select="ancestor::wadl:resource">
						<xsl:value-of select="@path" />
					</xsl:for-each>
					<xsl:text> HTTP/1.1</xsl:text><br/>
				</xsl:when>
				<xsl:otherwise>
					<xsl:text>HTTP/1.1 </xsl:text>
					<xsl:value-of select="ancestor::wadl:response/@status" />&#160;
					<xsl:value-of select="wadl:doc/@title" /><br/>
				</xsl:otherwise>
			</xsl:choose>
			<xsl:text>Content-Type: </xsl:text>
			<xsl:value-of select="@mediaType" />
			<br/>
			<!-- другие заголовки -->
			<xsl:apply-templates select="." mode="param-group">
				<xsl:with-param name="prefix">request</xsl:with-param>
				<xsl:with-param name="style">header</xsl:with-param>
			</xsl:apply-templates>
			<xsl:if test="@element">
				<p>
					<xsl:call-template name="link-qname">
						<xsl:with-param name="qname" select="@element" />
					</xsl:call-template>
				</p>
			</xsl:if>
			<xsl:apply-templates select="wadl:doc" />
		</code>
		<xsl:choose>
			<xsl:when test="@wadlext:autodoc='true'">
				<p>
					<xsl:call-template name="xsd-auto-doc">
						<xsl:with-param name="qname" select="@element" />
					</xsl:call-template>
				</p>
			</xsl:when>
			<xsl:otherwise>
				<p>
					<!-- параметры запроса типа query  -->
					<xsl:apply-templates select="." mode="param-group">
						<xsl:with-param name="prefix">request</xsl:with-param>
						<xsl:with-param name="style">query</xsl:with-param>
					</xsl:apply-templates>
				</p>
			</xsl:otherwise>
		</xsl:choose>
	</p>
</xsl:template>

<!-- params templates -->
<xsl:template match="wadl:*" mode="param-group">
	<xsl:param name="style"/>
	<xsl:param name="prefix" />
	<xsl:if test="ancestor-or-self::wadl:*/wadl:param[@style=$style]">
		<xsl:choose>
			<xsl:when test="$style='header'">
				<xsl:for-each select="ancestor-or-self::wadl:*/wadl:param[@style=$style]">
					<xsl:value-of select="@name" />:&#160;<xsl:value-of select="wadl:doc/text()" /><br/>
				</xsl:for-each>
			</xsl:when>
			<xsl:otherwise>
				<table class="striped bordered" title="params">
					<xsl:apply-templates select="ancestor-or-self::wadl:*/wadl:param[@style=$style]" />
				</table>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:if>
</xsl:template>

<xsl:template match="wadl:param" mode="query">
	<xsl:choose>
		<xsl:when test="@required='true'">
			<xsl:choose>
				<xsl:when test="preceding-sibling::wadl:param[@style='query']">&amp;</xsl:when>
				<xsl:otherwise>?</xsl:otherwise>
			</xsl:choose>
			<xsl:value-of select="@name"/>
			<xsl:text>={</xsl:text>
			<xsl:call-template name="link-qname">
				<xsl:with-param name="qname" select="@type" />
			</xsl:call-template>
			<xsl:text>}</xsl:text>
		</xsl:when>
		<xsl:otherwise>
			<span class="optional">
				<xsl:choose>
					<xsl:when test="preceding-sibling::wadl:param[@style='query']">&amp;</xsl:when>
						<xsl:otherwise>?</xsl:otherwise>
				</xsl:choose>
				<xsl:value-of select="@name"/>
				<xsl:text>={</xsl:text>
				<xsl:call-template name="link-qname">
					<xsl:with-param name="qname" select="@type" />
				</xsl:call-template>
				<xsl:text>}</xsl:text>
			</span>
		</xsl:otherwise>
	</xsl:choose>
</xsl:template>

<xsl:template match="wadl:param">
	<tr>
		<td>
			<strong>
				<xsl:value-of select="@name"/>
			</strong><br/>
			<small>
				<xsl:choose>
					<xsl:when test="@required='true'">(required)</xsl:when>
					<xsl:otherwise>(optional)</xsl:otherwise>
				</xsl:choose>
			</small>
		</td>
		<td>
			<em>
				<xsl:call-template name="link-qname">
					<xsl:with-param name="qname"><xsl:value-of select="@type" /></xsl:with-param>
				</xsl:call-template>
			</em>
			<br/>
			<xsl:if test="@default"><p>Default: <tt><xsl:value-of select="@default"/></tt></p></xsl:if>
			<xsl:if test="@fixed"><p>Fixed: <tt><xsl:value-of select="@fixed"/></tt></p></xsl:if>
			<br/>
			<xsl:apply-templates select="wadl:doc"/>
		</td>
	</tr>
</xsl:template>

<xsl:template match="wadl:doc">
	<xsl:param name="inline">0</xsl:param>
	<!-- skip WADL elements -->
	<xsl:choose>
		<xsl:when test="node()[1]=text() and $inline=0">
			<p>
				<xsl:apply-templates select="node()" mode="copy"/>
			</p>
		</xsl:when>
		<xsl:otherwise>
			<xsl:apply-templates select="node()" mode="copy"/>
		</xsl:otherwise>
	</xsl:choose>
</xsl:template>

<!-- utilities -->
<xsl:template name="get-id">
	<xsl:choose>
		<xsl:when test="@id"><xsl:value-of select="@id"/></xsl:when>
		<xsl:otherwise><xsl:value-of select="generate-id()"/></xsl:otherwise>
	</xsl:choose>
</xsl:template>

<xsl:template name="get-namespace-uri">
	<xsl:param name="context" select="."/>
	<xsl:param name="qname"/>
	<xsl:variable name="prefix" select="substring-before($qname,':')"/>
	<xsl:variable name="qname-ns-uri" select="local-name($context)"/>
	<xsl:value-of select="$qname-ns-uri"/>
</xsl:template>

<xsl:template name="link-qname">
	<xsl:param name="qname" />
	<xsl:variable name="prefix" select="substring-before($qname,':')"/>
	<xsl:variable name="localname" select="substring-after($qname,':')" />
	<xsl:choose>
		<xsl:when test="$prefix='xsd'">
			<a href="http://www.w3.org/TR/xmlschema-2/#{$localname}"><xsl:value-of select="$qname"/></a>
		</xsl:when>
		<xsl:otherwise>
			<xsl:variable name="definition" select="exsl:node-set($grammars)/wadl:include/descendant::*[@name = $localname]" />
			<xsl:choose>
				<xsl:when test="$definition">
					<a href="{$definition/ancestor::*/@href}#{$localname}" title="{$definition/descendant::xsd:documentation/text()}">
						<xsl:value-of select="$qname" />
					</a>
				</xsl:when>
				<xsl:otherwise>
					<xsl:value-of select="$qname" />
				</xsl:otherwise>
			</xsl:choose>
		</xsl:otherwise>
	</xsl:choose>
</xsl:template>

<!-- авто документация по схеме -->
<xsl:template name="xsd-auto-doc">
	<xsl:param name="qname" />
	<xsl:variable name="prefix" select="substring-before($qname,':')"/>
	<xsl:variable name="localname" select="substring-after($qname,':')" />
	<xsl:variable name="definition" select="exsl:node-set($grammars)/wadl:include/descendant::*[@name = $localname]" />
	<xsl:if test="$definition">
		<xsl:variable name="wadlparams" >
			<xsl:apply-templates select="$definition/descendant::xsd:*[local-name()='element' or local-name()='group']" mode="towadl"/>
		</xsl:variable>
		<table title="params">
			<xsl:apply-templates select="exsl:node-set($wadlparams)/wadl:*"/>
		</table>
	</xsl:if>
</xsl:template>

<xsl:template match="xsd:element[@name]" mode="towadl">
	<wadl:param name="{@name}" style="query" type="{@type}">
		<xsl:if test="@required">
			<xsl:attribute name="required">
				<xsl:value-of select="@required"/>
			</xsl:attribute>
		</xsl:if>
		<xsl:if test="@default">
			<xsl:attribute name="default">
				<xsl:value-of select="@default"/>
			</xsl:attribute>
		</xsl:if>
		<wadl:doc>
			<!-- добавим  атрибуты xlink:*, чтобы корректно перенести ссылки на документацию -->
			<xsl:if test="xsd:annotation/xsd:documentation/@xlink:href">
				<xsl:attribute name="href" namespace="http://www.w3.org/1999/xlink">
					<xsl:value-of select="xsd:annotation/xsd:documentation/@xlink:href" />
				</xsl:attribute>
			</xsl:if>
			<xsl:if test="xsd:annotation/xsd:documentation/@xlink:show">
				<xsl:attribute name="show" namespace="http://www.w3.org/1999/xlink">
					<xsl:value-of select="xsd:annotation/xsd:documentation/@xlink:show" />
				</xsl:attribute>
			</xsl:if>
			<xsl:value-of select="xsd:annotation/xsd:documentation"/>
		</wadl:doc>
	</wadl:param>
</xsl:template>

<xsl:template match="xsd:element[@ref]" mode="towadl">
	<xsl:variable name="prefix" select="substring-before(@ref,':')"/>
	<xsl:variable name="localname" select="substring-after(@ref,':')" />
	<xsl:variable name="ref">
		<xsl:choose>
			<xsl:when test="$localname"><xsl:value-of select="$localname" /></xsl:when>
			<xsl:otherwise><xsl:value-of select="@ref" /></xsl:otherwise>
		</xsl:choose>
	</xsl:variable>
	<xsl:variable name="definition" select="exsl:node-set($grammars)/wadl:include/descendant::xsd:element[@name = $ref]" />
	<xsl:if test="$definition">
		<xsl:apply-templates select="$definition" mode="towadl"/>
	</xsl:if>
</xsl:template>

<xsl:template match="xsd:group[@ref]" mode="towadl">
	<xsl:variable name="prefix" select="substring-before(@ref,':')"/>
	<xsl:variable name="localname" select="substring-after(@ref,':')" />
	<xsl:variable name="ref">
		<xsl:choose>
			<xsl:when test="$localname"><xsl:value-of select="$localname" /></xsl:when>
			<xsl:otherwise><xsl:value-of select="@ref" /></xsl:otherwise>
		</xsl:choose>
	</xsl:variable>
	<xsl:variable name="definition" select="exsl:node-set($grammars)/wadl:include/descendant::xsd:group[@name = $ref]" />
	<xsl:if test="$definition">
		<xsl:apply-templates select="$definition/descendant::*[local-name()='element' or local-name()='group']" mode="towadl"/>
	</xsl:if>
</xsl:template>

<xsl:template name="status-name">
	<xsl:param name="status" />
	<xsl:choose>
			<xsl:when test="$status = 200"> OK</xsl:when>
			<xsl:when test="$status = 201"> Created</xsl:when>
			<xsl:when test="$status = 202"> Accepted</xsl:when>
			<xsl:when test="$status = 302"> Moved Temporarily</xsl:when>
			<xsl:when test="$status = 304"> Not Modified</xsl:when>
			<xsl:when test="$status = 450"> Bad Request</xsl:when>
			<xsl:when test="$status = 451"> Unauthorized</xsl:when>
			<xsl:when test="$status = 453"> Forbidden</xsl:when>
			<xsl:when test="$status = 454"> Not found</xsl:when>
			<xsl:when test="$status = 550"> Internal Server Error</xsl:when>
		</xsl:choose>
</xsl:template>

<!-- entity-encode markup for display если надо будет вдруг отобразить xml узел-->
<xsl:template match="*" mode="encode">
	<xsl:text>&lt;</xsl:text>
	<xsl:value-of select="name()"/><xsl:apply-templates select="attribute::*" mode="encode"/>
	<xsl:choose>
		<xsl:when test="*|text()">
			<xsl:text>&gt;</xsl:text>
			<xsl:apply-templates select="*|text()" mode="encode" xml:space="preserve"/>
			<xsl:text>&lt;/</xsl:text><xsl:value-of select="name()"/><xsl:text>&gt;</xsl:text>
		</xsl:when>
		<xsl:otherwise>
			<xsl:text>/&gt;</xsl:text>
		</xsl:otherwise>
	</xsl:choose>
</xsl:template>

<xsl:template match="@*" mode="encode">
	<xsl:text> </xsl:text>
	<xsl:value-of select="name()"/>
	<xsl:text>="</xsl:text>
	<xsl:value-of select="."/>
	<xsl:text>"</xsl:text>
</xsl:template>

<xsl:template match="text()" mode="encode">
	<xsl:value-of select="." xml:space="preserve"/>
</xsl:template>

<!-- copy HTML for display -->
<xsl:template match="html:*" mode="copy">
	<!-- remove the prefix on HTML elements -->
	<xsl:element name="{local-name()}">
		<xsl:for-each select="@*">
			<xsl:attribute name="{local-name()}"><xsl:value-of select="."/></xsl:attribute>
		</xsl:for-each>
		<xsl:apply-templates select="node()" mode="copy"/>
	</xsl:element>
</xsl:template>

<xsl:template match="@*|node()[namespace-uri()!='http://www.w3.org/1999/xhtml']" mode="copy">
	<!-- everything else goes straight through -->
	<xsl:choose>
		<xsl:when test="@xlink:*">
			<xsl:apply-templates select="." />
		</xsl:when>
		<xsl:otherwise>
			<xsl:copy>
				<xsl:apply-templates select="@*|node()" mode="copy"/>
			</xsl:copy>
		</xsl:otherwise>
	</xsl:choose>
</xsl:template>

<xsl:template name="get-base">
	<xsl:param name="path" />
	<xsl:if test="contains($path, '/')">
		<xsl:text></xsl:text>
		<xsl:call-template name="get-base">
			<xsl:with-param name="path" select="substring-after($path,'/')" />
		</xsl:call-template>
	</xsl:if>
</xsl:template>

<xsl:template name="string-replace-all">
	<xsl:param name="text" />
	<xsl:param name="replace" />
	<xsl:param name="by" />
	<xsl:choose>
		<xsl:when test="contains($text, $replace)">
			<xsl:value-of select="substring-before($text,$replace)" />
			<xsl:value-of select="$by" />
			<xsl:call-template name="string-replace-all">
				<xsl:with-param name="text" select="substring-after($text,$replace)" />
				<xsl:with-param name="replace" select="$replace" />
				<xsl:with-param name="by" select="$by" />
			</xsl:call-template>
		</xsl:when>
		<xsl:otherwise>
			<xsl:value-of select="$text" />
		</xsl:otherwise>
	</xsl:choose>
</xsl:template>

</xsl:stylesheet>
