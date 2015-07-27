<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet
	xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:html="http://www.w3.org/1999/xhtml"
	xmlns:res="urn:ru:battleship:School:Resources"
	xmlns:pers="urn:ru:battleship:School:Persons"
	xmlns:un="urn:ru:battleship:School:Unions"
	xmlns:doc="urn:ru:battleship:School:Documents"
	xmlns:link="urn:ru:battleship:School:Links"
	xmlns:ev="urn:ru:battleship:School:Events"
	xmlns:dig="urn:ru:battleship:School:Digests"
	xmlns:exsl="http://exslt.org/common"
	xmlns:wadlext="urn:wadlext"
	xmlns:ns="urn:namespace"
	extension-element-prefixes="exsl"
	exclude-result-prefixes="xsl html res pers un doc link dig ev wadlext ns"
	version="1.0">

<xsl:output
	media-type="application/xhtml+xml"
	method="xml"
	encoding="UTF-8"
	indent="yes"
	omit-xml-declaration="no"
	doctype-public="-//W3C//DTD XHTML 1.1//EN"
	doctype-system="http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd" />
	
<xsl:strip-space elements="*"/>

<xsl:include href="Common.xsl" xml:base="." />

<xsl:variable name="DIGESTS" select="document('../../api/digests')/dig:Digests" />
<xsl:variable name="STAT" select="document('../../api/stat')/res:Resources" />

<xsl:variable name="ROOT" select="'/'" />

<xsl:template match="doc:Documents">
    <html lang="ru" xml:lang="ru">
        <head>
            <title>События в жизни школы | Школа 30 | Ижевск</title>
            <xsl:call-template name="common-header" />
            <!--link href="{$ROOT}css/persons.css" rel="stylesheet" type="text/css" />
            <xsl:call-template name="theme">
                <xsl:with-param name="ref" select="." />
            </xsl:call-template-->
            <style type="text/css">
                table {
                    margin: auto;
                    max-width:98%;
                    min-width: 90%;
                }
                table,td {
                    font-size: 10px;
                    border: solid 1px #000;
                }
                td {
                    padding: 3px;
                }
                img {
                    max-width: 100px;
                    max-height: 50px;
                }
            </style>
        </head>
        <body>
            <xsl:value-of select="count($DIGESTS/dig:Digest)" />
            <table cellspacing="0" cellpadding="0">
                <tr>
                    <th>ID</th>
                    <th>YEAR</th>
                    <th>COMMENTS</th>
                    <th>READINESS</th>
                    <th>FILES</th>
                </tr>
                <xsl:for-each select="doc:Document">
                    <tr>
                        <td><xsl:value-of select="doc:ID" /></td>
                        <td><xsl:value-of select="doc:year" /></td>
                        <td><xsl:value-of select="doc:comments" /></td>
                        <td><xsl:value-of select="doc:readiness" /></td>
                        <td><xsl:value-of select="count(doc:File)" /></td>
                        <td><img src="{$ROOT}images{doc:File/doc:Obverse/doc:Thumb/doc:src}"/></td>
                    </tr>
                </xsl:for-each>
            </table>
            <br/>
            <a href="{res:Ref[res:rel='prev']/res:href}">Prev</a>&#160;
            <a href="{res:Ref[res:rel='next']/res:href}">Next</a>
        </body>
    </html>
</xsl:template>

</xsl:stylesheet>
