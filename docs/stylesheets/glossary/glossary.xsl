<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
				xmlns="http://www.w3.org/1999/xhtml"
				xmlns:html="http://www.w3.org/1999/xhtml"
				xmlns:xlink="http://www.w3.org/1999/xlink"
				xmlns:toc="urn:ru:battleship:meta:glossary:toc"
				xmlns:glo="urn:ru:battleship:meta:glossary:glossary"
				xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
				xmlns:exsl="http://exslt.org/common"
				xmlns:svg="http://www.w3.org/2000/svg"
				xmlns:xsd="http://www.w3.org/2001/XMLSchema"
	
				extension-element-prefixes="exsl"
				exclude-result-prefixes="html xlink glo xsl xsd">
	
	<xsl:output
		media-type="application/xhtml+xml"
		method="xml"
		encoding="UTF-8"
		indent="yes"
		omit-xml-declaration="no"
		doctype-public="-//W3C//DTD XHTML 1.1//EN"
		doctype-system="http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd" />
	
	<xsl:include href="header.xsl" />
	
	<xsl:variable name="TERMS" select="//glo:term" />
	
	<xsl:template match="/">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
				<meta name="keywords" content="crm glossary"/>
				<link rel="stylesheet" type="text/css" href="styles/documentation.css" />
				<title>Термины и определения</title>
				<script type="text/javascript">
					function init() {
					if (document.location.hash) {
					document.location = document.location;
					}
					}
				</script>
			</head>
			<body onload="init();">
				<xsl:call-template name="header" />
				<xsl:apply-templates select="." mode="content" />
			</body>
		</html>
	</xsl:template>
	
	<xsl:template match="glo:glossary" mode="content">
		<xsl:variable name="level" select="count(ancestor-or-self::glo:glossary)" />
		<xsl:variable name="id" select="@ID" />
		<xsl:element name="h{$level}" namespace="http://www.w3.org/1999/xhtml">
			<xsl:attribute name="id">
				<xsl:value-of select="substring-after(@ID,'glossary:')" />
			</xsl:attribute>
			<xsl:value-of select="@xlink:title" />
		</xsl:element>
		<xsl:choose>
			<xsl:when test="$level = 1">
				<hr/>
				<xsl:element name="h{$level + 1}" namespace="http://www.w3.org/1999/xhtml">
					<xsl:element name="a" namespace="http://www.w3.org/1999/xhtml">
						<xsl:attribute name="href">
							<xsl:value-of select="concat('images/generated/',translate(substring-after(@ID,'glossary:'),':','/'),'/domain.svg')" />
						</xsl:attribute>
						Сводная диаграмма предметной области
					</xsl:element>
				</xsl:element>
			</xsl:when>
			<xsl:otherwise>
				<xsl:element name="h{$level + 1}" namespace="http://www.w3.org/1999/xhtml">Диаграмма предметной области</xsl:element>
					<p>
						<xsl:variable name="domain" select="document(concat('images/generated/',translate(substring-after(@ID,'glossary:'),':','/'),'/domain.svg'),/)/svg:svg" />
						<xsl:apply-templates select="$domain" />
					</p>
			</xsl:otherwise>
		</xsl:choose>
		<!--xsl:element name="h{$level + 1}" namespace="http://www.w3.org/1999/xhtml">
			<xsl:element name="a"  namespace="http://www.w3.org/1999/xhtml">
				<xsl:attribute name="href">
					schemas/<xsl:value-of select="translate(substring-after(@ID,'glossary:'),':','/')" />/types.xsd
				</xsl:attribute>
				Типы данных
			</xsl:element>
		</xsl:element-->
		<xsl:if test="glo:glossary">
			<xsl:element name="h{$level + 1}" namespace="http://www.w3.org/1999/xhtml">Разделы</xsl:element>
			<ul>
				<xsl:apply-templates select="glo:glossary" mode="ToC" />
			</ul>
		</xsl:if>
		<xsl:if test="glo:term">
			<xsl:element name="h{$level + 1}" namespace="http://www.w3.org/1999/xhtml">Термины и определения</xsl:element>
			<ul>
				<xsl:apply-templates select="glo:term" mode="ToC" />
			</ul>
		</xsl:if>
		<dl>
			<xsl:apply-templates select="glo:term" mode="content" />
		</dl>
		<xsl:apply-templates select="glo:glossary" mode="content">
			<xsl:with-param name="level" select="$level + 1" />
		</xsl:apply-templates>
	</xsl:template>
	
	<xsl:template match="glo:glossary" mode="ToC">
		<li>
			<a href="#{substring-after(@ID,'glossary:')}">
				<xsl:value-of select="@xlink:title" />
			</a>
			<xsl:if test="glo:glossary">
				<ul>
					<xsl:apply-templates select="glo:glossary" mode="ToC" />
				</ul>
			</xsl:if>
		</li>
	</xsl:template>
	
	<xsl:template match="glo:term" mode="ToC">
		<li>
			<a href="#{substring-after(@URN,'glossary:')}">
				<xsl:value-of select="@xlink:title" />
			</a>
		</li>
	</xsl:template>
	
	<xsl:template match="glo:term" mode="content">
		<dt id="{substring-after(@URN,'glossary:')}">
			<xsl:value-of select="@xlink:title" />
		</dt>
		<dd>
			<p>
				<small>URN: <xsl:value-of select="@URN" /></small>
			</p>
			<p>
				<xsl:apply-templates select="glo:definition" />
			</p>
			<xsl:if test="glo:type">
				<p>
					<xsl:apply-templates select="glo:type" />
				</p>
			</xsl:if>			
			<xsl:if test="glo:sample">
				<p>
					<i>Пример: <xsl:apply-templates select="glo:sample" /></i>
				</p>
			</xsl:if>
		</dd>
	</xsl:template>
	
	<xsl:template match="glo:term" mode="embed">
		<p id="{@URN}" class="term">
			<strong>
				<xsl:value-of select="@xlink:title" />
			</strong>
		</p>
		<p>
			<xsl:value-of select="glo:definition" />
		</p>
		<xsl:if test="glo:sample">
			<p>
				<i>Пример: <xsl:apply-templates select="glo:sample" /></i>
			</p>
		</xsl:if>
	</xsl:template>
	
	<xsl:template match="*[@xlink:href]">
		<xsl:variable name="urn">
			<xsl:choose>
				<xsl:when test="substring-after(@xlink:href,'#')">
					<xsl:value-of select="concat(ancestor::glo:glossary[1]/@ID,':',substring-after(@xlink:href,'#'))" />
				</xsl:when>
				<xsl:otherwise>
					<xsl:value-of select="@xlink:href" />
				</xsl:otherwise>
			</xsl:choose>
		</xsl:variable>
		<xsl:variable name="link">
			<xsl:call-template name="get-link">
				<xsl:with-param name="urn" select="$urn" />
			</xsl:call-template>
		</xsl:variable>	
		
		<a href="{$link}" title="{@xlink:title}">
			<xsl:value-of select="text()" />
		</a>
	</xsl:template>
	
	<!-- copy HTML for display -->
	<xsl:template match="html:*">
		<!-- remove the prefix on HTML elements -->
		<xsl:element name="{local-name()}">
			<xsl:for-each select="@*">
				<xsl:attribute name="{local-name()}">
					<xsl:value-of select="."/>
				</xsl:attribute>
			</xsl:for-each>
			<xsl:apply-templates select="node()" />
		</xsl:element>
	</xsl:template>
	
	<!-- copy SVG for display -->
	<xsl:template match="svg:*">
		<xsl:element name="{local-name()}" namespace="http://www.w3.org/2000/svg">
			<xsl:for-each select="@*">
				<xsl:attribute name="{local-name()}">
					<xsl:value-of select="."/>
				</xsl:attribute>
			</xsl:for-each>
			<xsl:apply-templates select="node()" />
		</xsl:element>
	</xsl:template>
	
	<xsl:template match="svg:svg">
		<xsl:element name="{local-name()}" namespace="http://www.w3.org/2000/svg">
			<xsl:for-each select="@*">
				<xsl:choose>
					<xsl:when test="local-name()='width'">
						<xsl:variable name="width" select="substring-before(.,'pt')" />
						<xsl:if test="$width &lt; 1000">
							<xsl:attribute name="{local-name()}">
								<xsl:value-of select="."/>
							</xsl:attribute>
						</xsl:if>
					</xsl:when>
					<xsl:when test="local-name()='height'"></xsl:when>
					<xsl:otherwise>
						<xsl:attribute name="{local-name()}">
							<xsl:value-of select="."/>
						</xsl:attribute>
					</xsl:otherwise>
				</xsl:choose>
			</xsl:for-each>
			<xsl:copy-of select="svg:*" />
			<!--xsl:apply-templates select="node()" /-->
		</xsl:element>
	</xsl:template>
	
	<xsl:template match="svg:a[@xlink:href]">
		<xsl:apply-templates select="svg:*" />
	</xsl:template>
	
	<xsl:template match="svg:text[parent::svg:a/@xlink:href]">
		<xsl:variable name="term_id" select="." />
		<xsl:variable name="font-size" select="@font-size" />
		<xsl:element name="{local-name()}" namespace="http://www.w3.org/2000/svg">
			<xsl:for-each select="@*">
				<xsl:if test="not(local-name()='font-size')">
					<xsl:attribute name="{local-name()}">
						<xsl:value-of select="."/>
					</xsl:attribute>
				</xsl:if>
			</xsl:for-each>
			<xsl:attribute name="fill">blue</xsl:attribute>
			<xsl:variable name="link">
				<xsl:call-template name="get-link">
					<xsl:with-param name="urn" select="$term_id"/>
				</xsl:call-template>
			</xsl:variable>
			<xsl:variable name="title">
				<xsl:choose>
					<xsl:when test="$TERMS[@URN=$term_id]">
						<xsl:value-of select="$TERMS[@URN=$term_id]/@xlink:title" />
					</xsl:when>
					<xsl:otherwise>
						<xsl:value-of select="$term_id" />
					</xsl:otherwise>
				</xsl:choose>
			</xsl:variable>
			<xsl:variable name="scaled-font-size">
				<xsl:choose>
					<xsl:when test="string-length($term_id) &lt; string-length($title)">
						<xsl:value-of select="$font-size * 0.9 * string-length($term_id) div string-length($title)" />
					</xsl:when>
					<xsl:otherwise>
						<xsl:value-of select="$font-size" />
					</xsl:otherwise>
				</xsl:choose>
			</xsl:variable>
			<xsl:attribute name="font-size">
				<xsl:value-of select="$scaled-font-size"/>
			</xsl:attribute>
			<xsl:element name="a" namespace="http://www.w3.org/2000/svg">
				<xsl:attribute name="href" namespace="http://www.w3.org/1999/xlink">
					<xsl:value-of select="$link" />
				</xsl:attribute>
				<xsl:attribute name="title" namespace="http://www.w3.org/1999/xlink">
					<xsl:value-of select="$term_id" />
				</xsl:attribute>
				<xsl:attribute name="style">text-decoration:underline;</xsl:attribute>
				<xsl:value-of select="$title" />
			</xsl:element>
		</xsl:element>
	</xsl:template>
	
	<xsl:template name="get-link">
		<xsl:param name="urn" />
		<xsl:choose>
			<xsl:when test="starts-with($urn,'glossary:')">
				<xsl:value-of select="concat('glossary.xml#',substring-after($urn,'glossary:'))" />
			</xsl:when>
			<xsl:when test="starts-with(urn,'ucpackage:')">
				<xsl:value-of select="concat('ucpackage.xml#',substring-after($urn,'ucpackage:'))" />
			</xsl:when>
		</xsl:choose>
	</xsl:template>
	
</xsl:stylesheet>
