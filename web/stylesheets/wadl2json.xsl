<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
	xmlns="http://www.w3.org/1999/xhtml"
	xmlns:wadl="http://wadl.dev.java.net/2009/02"
	xmlns:html="http://www.w3.org/1999/xhtml"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	
	<xsl:output method="html" indent="no" />

	<xsl:template match="/">
		<xsl:text>[</xsl:text>
		<xsl:for-each select="//wadl:resource">
			<xsl:text>{ href: '</xsl:text>
			<xsl:for-each select="ancestor-or-self::wadl:resource">
				<xsl:value-of select="@path" />
				<xsl:if test="position()!=last()">/</xsl:if>
			</xsl:for-each>
			<xsl:text>', title: '</xsl:text>
			<xsl:value-of select="wadl:doc/@title" />
			<xsl:text>', method: '</xsl:text>
			<xsl:value-of select="wadl:method/@name" />
			<xsl:text>', content: '</xsl:text>
			<xsl:value-of select="wadl:method/wadl:response/wadl:representation/@mediaType" />
			<xsl:text>' }</xsl:text>
			<xsl:if test="position()!=last()">,</xsl:if>
		</xsl:for-each>
		<xsl:text>];</xsl:text>
	</xsl:template>

</xsl:stylesheet>