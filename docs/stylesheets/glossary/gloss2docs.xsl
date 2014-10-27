<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
	xmlns="urn:ru:battleship:meta:glossary:glossary"
	xmlns:glo="urn:ru:battleship:meta:glossary:glossary"
	xmlns:html="http://www.w3.org/1999/xhtml"
	xmlns:xlink="http://www.w3.org/1999/xlink"
	xmlns:toc="urn:ru:battleship:meta:glossary:toc"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:exsl="http://exslt.org/common"
	xmlns:svg="http://www.w3.org/2000/svg"
	xmlns:xsd="http://www.w3.org/2001/XMLSchema"
	
	extension-element-prefixes="exsl"
	exclude-result-prefixes="">
	
    <xsl:output
        media-type="application/xml"
        method="xml"
        encoding="UTF-8"
        indent="yes"
        omit-xml-declaration="no" />
	
	
	<!-- глобальные переменные сделаем UPPERCASE  чтобы отличать их в коде  -->
	<xsl:variable name="ROOT" select="/" />
	<xsl:variable name="GLOSSARY-ID" select="/glo:glossary/@ID" />
	<xsl:variable name="GLOSSARY-TITLE" select="/glo:glossary/@xlink:title" />
	<xsl:variable name="GLOSSARY-HREF" select="/glo:glossary/@xlink:href" />
	<!-- путь от файла пакета до корня проекта  -->
	<xsl:variable name="PROJECT-BASE">
		<xsl:call-template name="get-base">
			<xsl:with-param name="path" select="$GLOSSARY-ID"/>
		</xsl:call-template>
	</xsl:variable>
	
	<!-- контейнер для терминов проекта, собираем все термины проекта в контейнер -->
	<xsl:variable name="GLOSSARIES">
		<!-- достаем корневой  пакет  glossary и начиная с него собираем все термины проекта  -->
		<xsl:variable name="glossary" select="document(concat($PROJECT-BASE,'temp.xml'), /)/glo:glossary"></xsl:variable>
		<xsl:element name="glo:glossary">
			<xsl:attribute name="xlink:title" namespace="http://www.w3.org/1999/xlink">
				<xsl:value-of select="$glossary/@xlink:title"/>
			</xsl:attribute>
			<xsl:attribute name="ID">
				<xsl:value-of select="$glossary/@ID"/>
			</xsl:attribute>
			<xsl:apply-templates select="$glossary/glo:term" mode="include-term">
				<xsl:with-param name="package" select="$glossary/@ID" />
				<xsl:with-param name="package-path" select="concat($PROJECT-BASE,glossary.xml)" />
			</xsl:apply-templates>
			<xsl:apply-templates select="$glossary/glo:glossary[@xlink:type='locator']" mode="include-glossaries" />
		</xsl:element>
	</xsl:variable>
	
	<xsl:template match="glo:glossary" mode="include-glossaries">
		<xsl:variable name="package-path" select="@xlink:href" />
		<xsl:variable name="included" select="document($package-path,/)/glo:glossary"></xsl:variable>
		<xsl:element name="glo:glossary">
			<xsl:attribute name="xlink:title" namespace="http://www.w3.org/1999/xlink">
				<xsl:value-of select="$included/@xlink:title"/>
			</xsl:attribute>
			<xsl:attribute name="ID">
				<xsl:value-of select="$included/@ID"/>
			</xsl:attribute>
			<xsl:apply-templates select="$included/glo:term" mode="include-term">
				<xsl:with-param name="package" select="$included/@ID" />
				<xsl:with-param name="package-path" select="$package-path" />
			</xsl:apply-templates>
			<xsl:apply-templates select="$included/glo:glossary[@xlink:type='locator']" mode="include-glossaries" />
		</xsl:element>
	</xsl:template>
	
	<xsl:template match="glo:term" mode="include-term">
		<xsl:param name="package" />
		<xsl:param name="package-path" />
		<xsl:element name="glo:term">
			<xsl:attribute name="ID"><xsl:value-of select="@ID"/></xsl:attribute>
			<xsl:attribute name="package"><xsl:value-of select="$package"/></xsl:attribute>
			<xsl:attribute name="URN"><xsl:value-of select="concat($package,':',@ID)"/></xsl:attribute>
			<xsl:attribute name="xlink:title" namespace="http://www.w3.org/1999/xlink">
				<xsl:value-of select="@xlink:title"/>
			</xsl:attribute>
			<xsl:attribute name="package-path"><xsl:value-of select="$PROJECT-BASE" /><xsl:value-of select="$package-path"/></xsl:attribute>
			<xsl:copy-of select="glo:*" />
		</xsl:element>
	</xsl:template>
	
	<xsl:variable name="GLOSSARIES-SET" select="exsl:node-set($GLOSSARIES)" />
	<xsl:variable name="TERMS-SET" select="$GLOSSARIES-SET//glo:term" />
	
	<xsl:template match="glo:glossary">
		<!-- проверяем связи по ссылкам  -->
		<xsl:for-each select="$TERMS-SET//glo:is-a">
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
			<xsl:if test="not($TERMS-SET[@URN = $urn])">
				<xsl:message terminate="yes">Не определен термин <xsl:value-of select="$urn" /></xsl:message>
			</xsl:if>
		</xsl:for-each>
		<xsl:processing-instruction name="xml-stylesheet">
			<xsl:text>href="stylesheets/glossary/glossary.xsl" type="text/xsl"</xsl:text>
		</xsl:processing-instruction>
		<xsl:copy-of select="$GLOSSARIES-SET" />
	</xsl:template>
	
	<!-- utils -->
	<xsl:template name="get-base">
		<xsl:param name="path" />
		<xsl:if test="contains($path, ':')">
			<xsl:text>../</xsl:text>
			<xsl:call-template name="get-base">
				<xsl:with-param name="path" select="substring-after($path,':')" />
			</xsl:call-template>
		</xsl:if>
	</xsl:template>
	
</xsl:stylesheet>
