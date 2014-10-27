<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
	xmlns="http://www.w3.org/1999/xhtml"
	xmlns:html="http://www.w3.org/1999/xhtml"
	xmlns:xlink="http://www.w3.org/1999/xlink"
	xmlns:wadl="http://wadl.dev.java.net/2009/02"
	xmlns:svg="http://www.w3.org/2000/svg"
	xmlns:glo="urn:ru:battleship:meta:glossary:glossary"
	xmlns:uc="urn:ru:battleship:meta:glossary:ucpackage"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:exsl="http://exslt.org/common"
	extension-element-prefixes="exsl"
    exclude-result-prefixes="xlink glo uc xsl wadl">
	
    <xsl:output
        media-type="application/xhtml+xml"
        method="xml"
        encoding="UTF-8"
        indent="yes"
        omit-xml-declaration="no"
        doctype-public="-//W3C//DTD XHTML 1.1//EN"
        doctype-system="http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd" />
	
	<xsl:include href="header.xsl" />
	
	<xsl:template match="uc:ucpackage">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
				<meta name="keywords" content="crm glossary"/>
				<link rel="stylesheet" type="text/css" href="styles/documentation.css" />
				<title><xsl:value-of select="@xlink:title" /></title>
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
	
	<xsl:template match="uc:ucpackage" mode="content">
		<xsl:variable name="level" select="count(ancestor-or-self::uc:ucpackage)" />
		<xsl:element name="h{$level}" namespace="http://www.w3.org/1999/xhtml">
			<xsl:attribute name="id">
				<xsl:value-of select="substring-after(@URN,'ucpackage:')" />
			</xsl:attribute>
			<xsl:value-of select="@xlink:title" />
		</xsl:element>
		<xsl:if test="$level = 1"><hr/></xsl:if>
		<xsl:if test="uc:ucpackage">
			<xsl:element name="h{$level+1}" namespace="http://www.w3.org/1999/xhtml">
				Пакеты прецедентов
			</xsl:element>
			<ul>
				<xsl:apply-templates select="uc:ucpackage" mode="ToC" />
			</ul>
		</xsl:if>
		<xsl:element name="h{$level + 1}" namespace="http://www.w3.org/1999/xhtml">
				Диаграмма прецедентов
		</xsl:element>
		<p>
			<xsl:variable name="graph" select="document(concat('images/generated/',translate(substring-after(@URN,'ucpackage:'),':','/'),'/ucpackage.svg'),/)/svg:svg" />
			<xsl:apply-templates select="$graph" />
		</p>
		<xsl:if test="uc:actor">
			<xsl:element name="h{$level+1}" namespace="http://www.w3.org/1999/xhtml">
				Пользователи
			</xsl:element>
			<ul>
				<xsl:for-each select="uc:actor">
					<xsl:variable name="link">
						<xsl:call-template name="get-link">
							<xsl:with-param name="urn" select="@xlink:label" />
							<xsl:with-param name="node" select="." />
						</xsl:call-template>
					</xsl:variable>
					<li><a href="{$link}" ><xsl:value-of select="@xlink:title" /></a></li>
				</xsl:for-each>
			</ul>
		</xsl:if>
		<xsl:if test="uc:usecase">
			<xsl:element name="h{$level+1}" namespace="http://www.w3.org/1999/xhtml">
				Прецеденты пакета
			</xsl:element>
			<ul>
				<xsl:apply-templates select="uc:usecase" mode="ToC" />
			</ul>
		</xsl:if>
		<xsl:apply-templates select="uc:usecase" mode="content"  />
		<xsl:apply-templates select="uc:ucpackage" mode="content"  />
	</xsl:template>
	
	<xsl:template match="uc:ucpackage" mode="ToC">
		<li>
			<a href="#{substring-after(@URN,'ucpackage:')}"><xsl:value-of select="@xlink:title" /></a>
			<xsl:if test="uc:ucpackage">
				<ul>
					<xsl:apply-templates select="uc:ucpackage" mode="ToC" />
				</ul>
			</xsl:if>
		</li>
	</xsl:template>
	
	<xsl:template match="uc:usecase" mode="ToC">
		<li>
			<a href="#{substring-after(@URN,'ucpackage:')}"><xsl:value-of select="@xlink:title" /></a>
		</li>
	</xsl:template>
	
	<xsl:template match="uc:usecase" mode="content">
		<xsl:element name="h{count(ancestor::uc:ucpackage)+2}" namespace="http://www.w3.org/1999/xhtml">
			<xsl:attribute name="id">
				<xsl:value-of select="substring-after(@URN,'ucpackage:')" />
			</xsl:attribute>
			<xsl:value-of select="@xlink:title" />
		</xsl:element>
		<p><small>URN: <xsl:value-of select="@URN" /></small></p>
		<p style="font-size:90%;padding-left:20px;">
			<xsl:apply-templates  select="."/>
		</p>
	</xsl:template>
	
	<xsl:template match="*[@xlink:href]">
		<xsl:variable name="urn">
			<xsl:choose>
				<xsl:when test="substring-after(@xlink:href,'#')">
					<xsl:value-of select="concat(ancestor::uc:ucpackage[1]/@ID,':',substring-after(@xlink:href,'#'))" />
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
				<xsl:attribute name="{local-name()}"><xsl:value-of select="."/></xsl:attribute>
			</xsl:for-each>
			<xsl:apply-templates select="node()" />
		</xsl:element>
	</xsl:template>
	
	<!-- copy SVG for display -->
	<xsl:template match="svg:*">
		<xsl:element name="{local-name()}" namespace="http://www.w3.org/2000/svg">
			<xsl:for-each select="@*">
				<xsl:attribute name="{local-name()}"><xsl:value-of select="."/></xsl:attribute>
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
			<xsl:apply-templates select="node()" />
		</xsl:element>
	</xsl:template>
	
	<xsl:template match="svg:a[@xlink:href]">
		<xsl:element name="a" namespace="http://www.w3.org/2000/svg">
			<xsl:for-each select="@*">
				<xsl:choose>
					<xsl:when test="local-name() = 'href'">
						<xsl:attribute name="href" namespace="http://www.w3.org/1999/xlink">
							<xsl:call-template name="get-link">
								<xsl:with-param name="urn" select="." />
							</xsl:call-template>
						</xsl:attribute>
					</xsl:when>
					<xsl:otherwise>
						<xsl:attribute name="{local-name()}"><xsl:value-of select="."/></xsl:attribute>
					</xsl:otherwise>
				</xsl:choose>>
			</xsl:for-each>
			<xsl:apply-templates select="node()" />
		</xsl:element>
	</xsl:template>
	
	<xsl:template match="svg:text[parent::svg:a/@xlink:href]">
		<xsl:variable name="term_id" select="." />
		<xsl:element name="{local-name()}" namespace="http://www.w3.org/2000/svg">
			<xsl:for-each select="@*">
				<xsl:attribute name="{local-name()}"><xsl:value-of select="."/></xsl:attribute>
			</xsl:for-each>
			<xsl:attribute name="fill">blue</xsl:attribute>
			<xsl:attribute name="style">text-decoration:underline;</xsl:attribute>
			<xsl:apply-templates select="node()" />
		</xsl:element>
	</xsl:template>
	
	<xsl:template name="get-link">
		<xsl:param name="urn" />
		<xsl:choose>
			<xsl:when test="starts-with($urn,'glossary:')"><xsl:value-of select="concat('glossary.xml#',substring-after($urn,'glossary:'))" /></xsl:when>
			<xsl:when test="starts-with($urn,'ucpackage:')"><xsl:value-of select="concat('ucpackage.xml#',substring-after($urn,'ucpackage:'))" /></xsl:when>
		</xsl:choose>
	</xsl:template>
	
</xsl:stylesheet>
