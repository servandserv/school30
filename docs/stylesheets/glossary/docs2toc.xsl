<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
	xmlns="urn:ru:battleship:meta:glossary:toc"
	xmlns:toc="urn:ru:battleship:meta:glossary:toc"
	xmlns:glo="urn:ru:battleship:meta:glossary:glossary"
	xmlns:uc="urn:ru:battleship:meta:glossary:ucpackage"
	xmlns:ui="urn:ru:battleship:meta:glossary:interface"
	xmlns:html="http://www.w3.org/1999/xhtml"
	xmlns:xlink="http://www.w3.org/1999/xlink"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:exsl="http://exslt.org/common"
	xmlns:svg="http://www.w3.org/2000/svg"
	xmlns:xsd="http://www.w3.org/2001/XMLSchema"
	
	extension-element-prefixes="exsl"
	exclude-result-prefixes="uc glo ui xlink html svg toc xsd">
	
    <xsl:output
        media-type="application/xml"
        method="xml"
        encoding="UTF-8"
        indent="yes"
        omit-xml-declaration="no" />
	
	
	<xsl:variable name="GLOSSARIES" select="document('glossary.xml', /)/glo:glossary" />
	<xsl:variable name="UCPACKAGES" select="document('ucpackage.xml', /)/uc:ucpackage" />
	<xsl:variable name="INTERFACES" select="document('interface.xml', /)/ui:interface" />
	
	<xsl:template match="/">
		<xsl:processing-instruction name="xml-stylesheet">
			<xsl:text>href="stylesheets/glossary/toc.xsl" type="text/xsl"</xsl:text>
		</xsl:processing-instruction>
		<toc>
			<xsl:apply-templates select="$GLOSSARIES" />
			<xsl:apply-templates select="$UCPACKAGES" />
			<xsl:apply-templates select="$INTERFACES" />
		</toc>
	</xsl:template>
	
	<xsl:template match="glo:glossary">
		<chapter href="glossary.xml#{substring-after(@ID,'glossary:')}" title="{@xlink:title}">
			<xsl:apply-templates select="glo:glossary" />
		</chapter>
	</xsl:template>
	
	<xsl:template match="uc:ucpackage">
		<chapter href="ucpackage.xml#{substring-after(@ID,'ucpackage:')}" title="{@xlink:title}">
			<xsl:apply-templates select="uc:ucpackage" />
		</chapter>
	</xsl:template>
	
	<xsl:template match="ui:interface">
		<chapter href="interface.xml#{substring-after(@ID,'interface:')}" title="{@xlink:title}">
			<xsl:apply-templates select="ui:interface" />
		</chapter>
	</xsl:template>
	
</xsl:stylesheet>
