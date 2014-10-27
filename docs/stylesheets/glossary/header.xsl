<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
	xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xhtml="http://www.w3.org/1999/xhtml"
	xmlns:xlink="http://www.w3.org/1999/xlink"
	xmlns:glo="urn:ru:battleship:meta:glossary:glossary"
	xmlns:toc="urn:ru:battleship:meta:glossary:toc"
	xmlns:uc="urn:ru:battleship:meta:glossary:ucpackage"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:exsl="http://exslt.org/common"
	extension-element-prefixes="exsl"
    exclude-result-prefixes="xhtml xlink glo xsl">
	
    <xsl:output
        media-type="application/xhtml+xml"
        method="xml"
        encoding="UTF-8"
        indent="yes"
        omit-xml-declaration="no"
        doctype-public="-//W3C//DTD XHTML 1.0 Frameset//EN"
        doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd" />
	
	<xsl:template match="toc:chapter">
		<xsl:param name="path" select="''" />
		<li>
			<a href="{$path}{@href}"><xsl:value-of select="@title" /></a>
			<xsl:if test="toc:chapter">
				<ul>
					<xsl:apply-templates select="toc:chapter">
						<xsl:with-param name="path" select="$path" />
					</xsl:apply-templates>
				</ul>
			</xsl:if>
		</li>
	</xsl:template>
	
	<xsl:template name="header">
		<xsl:param name="path" select="''" />
		<xsl:variable name="menu" select="document(concat($path,'TOC.xml'),/)/toc:toc" />
		<div id="header">
			<img src="{$path}images/Battleship.svg" alt="Меню" />
			<div>
				<p>Документация</p>
				<ul>
					<xsl:apply-templates select="$menu/toc:chapter">
						<xsl:with-param name="path" select="$path" />
					</xsl:apply-templates>
				</ul>
			</div>
		</div>
	</xsl:template>
	
	<xsl:template name="table-of-content">
		<xsl:variable name="menu" select="document('TOC.xml',/)/toc:toc" />
		<div id="toc">
			<h1>Документация</h1>
			<hr/>
			<ul>
				<xsl:apply-templates select="$menu/toc:chapter" />
			</ul>
		</div>
	</xsl:template>
	
</xsl:stylesheet>