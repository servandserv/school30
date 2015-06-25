<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet
	xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:html="http://www.w3.org/1999/xhtml"
	xmlns:res="urn:ru:battleship:School:Resources"
	xmlns:pers="urn:ru:battleship:School:Persons"
	xmlns:un="urn:ru:battleship:School:Unions"
	xmlns:doc="urn:ru:battleship:School:Documents"
	xmlns:dig="urn:ru:battleship:School:Digests"
	xmlns:link="urn:ru:battleship:School:Links"
	xmlns:exsl="http://exslt.org/common"
	xmlns:wadlext="urn:wadlext"
	xmlns:ns="urn:namespace"
	extension-element-prefixes="exsl"
	exclude-result-prefixes="xsl html res pers un doc link dig wadlext ns"
	version="1.0">

<xsl:output
	media-type="application/xhtml+xml"
	method="xml"
	encoding="UTF-8"
	indent="yes"
	omit-xml-declaration="no"
	doctype-public="-//W3C//DTD XHTML 1.1//EN"
	doctype-system="http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd" />

<xsl:template match="dig:Digests">
    <xsl:for-each select="dig:Digest">
        <xsl:variable name="id" select="dig:ID" />
        <li>
            <xsl:attribute name="id"><xsl:value-of select="dig:ID" /></xsl:attribute>
            <div>
                <p>
                    <a href="api/digests/{dig:ID}/sources"><xsl:value-of select="dig:title" /></a>
                </p>
            </div>
        </li>
    </xsl:for-each>
</xsl:template>

</xsl:stylesheet>