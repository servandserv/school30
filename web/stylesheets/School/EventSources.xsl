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
	xmlns:dig="urn:ru:battleship:School:Digests"
	xmlns:ev="urn:ru:battleship:School:Events"
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

<xsl:variable name="SOURCES" select="/res:Resources" />
<!--xsl:variable name="SOURCES" select="document(concat('../../api/persons/',$DESTINATIONS/pers:Persons/pers:Person/pers:ID,'/sources'))/res:Resources" /-->
<xsl:variable name="DIGESTS" select="document('../../api/digests')/dig:Digests" />
<xsl:variable name="ROOT" select="'../../../'" />

<xsl:template match="res:Resources">
    <html lang="ru" xml:lang="ru">
        <head>
            <title><xsl:value-of select="ev:Events/ev:Event/ev:name" /> | Школа 30 | Ижевск</title>
            <xsl:call-template name="common-header" />
            <link href="{$ROOT}css/person.min.css" rel="stylesheet" type="text/css" />
            <xsl:call-template name="theme">
                <xsl:with-param name="ref" select="$SOURCES/dig:Digests/dig:Digest" />
            </xsl:call-template>
            <!--script src='http://www.google-analytics.com/ga.js' type='text/javascript'>;</script-->
            <script type="text/javascript">
                <![CDATA[
                    window.onload = function() {
                        document.getElementById("loader").style.display = "none";
                        document.addEventListener("touchstart", function() {},false);
                        window.addEventListener("resize", function() {
                            resize_docs_container(document.getElementById('docs_container'),columns());
                        });
                        resize_docs_container(document.getElementById('docs_container'),columns());
                        /*
                        try{
                            var pageTracker = _gat._getTracker("UA-60861342-1");
                            pageTracker._trackPageview();
                        } catch(err) {}
                        */
                    }
                 ]]>
            </script>
        </head>
        <body>
            <xsl:call-template name="loader" />
            <div id="nav">
                <ul>
                    <li><a href="#digests">Дайджесты</a></li>
                    <li><a href="#menu"><i class="fa fa-bars fa-2x">&#173;</i></a></li>
                </ul>
            </div>
            <div id="main">
                <div id="header" class="html">
                    <h6>Фотоархив Ижевского ественно-гуманитарного лицея «Школа № 30»</h6>
                    <!--h1>Документ</h1-->
                    <!--h1><xsl:value-of select="doc:Documents/doc:Document/doc:year" /></h1-->
                    <h1>
                        <xsl:value-of select="ev:Events/ev:Event/ev:name" />
                    </h1>
                    <h4><xsl:value-of select="ev:Events/ev:Event/ev:dt" /></h4>
                    <xsl:if test="ev:Events/ev:Event/ev:comments">
                        <xsl:value-of select="ev:Events/ev:Event/ev:comments"  disable-output-escaping="yes"/>
                    </xsl:if>
                    <div class="menu">
                        <xsl:call-template name="menu">
                            <xsl:with-param name="social-href" select="concat('http://www.school-30.com/api/events/',ev:Events/ev:Event/ev:ID,'/sources')" />
                        </xsl:call-template>
                    </div>
                </div>
                <div id="docs">
                     <div id="docs_container">
                        <xsl:attribute name="class">count-<xsl:value-of select="count(doc:Documents/doc:Document[doc:published = '1'])" /></xsl:attribute>
                        <xsl:apply-templates select="doc:Documents/doc:Document[doc:published = '1' and doc:type= '2']" mode="tape" />
                        <xsl:apply-templates select="doc:Documents/doc:Document[doc:published = '1' and not(doc:type= '2')]" mode="tape">
                            <xsl:sort select="concat(doc:type,doc:year)" />
                        </xsl:apply-templates>
                    </div>
                </div>
                <div id="menu" class="menu">
                    <xsl:call-template name="menu">
                        <xsl:with-param name="social-href" select="concat('http://www.school-30.com/api/events/',ev:Events/ev:Event/ev:ID,'/sources')" />
                    </xsl:call-template>
                </div>
                <div id="copy">
                    <p><small>© 2015, фотоархив ИЕГЛ Школа № 30</small></p>
                </div>
            </div>
            <xsl:call-template name="counters" />
        </body>
    </html>
</xsl:template>

<xsl:template match="doc:Documents">
    <xsl:if test="doc:Document[doc:published = '1']">
        <div id="documents">
            <h2>Документы</h2>
            <table>
                <xsl:for-each select="doc:Document[doc:published = '1']">
                    <tr>
                        <td><img src="{$CDN}{doc:File[1]/doc:Obverse/doc:Thumb/doc:src}" /></td>
                        <td>
                            <p>
                                <xsl:apply-templates select="." mode="link" />
                                &#160;<xsl:value-of select="doc:comments" />
                            </p>
                        </td>
                    </tr>
                </xsl:for-each>
            </table>
            <!--ul>
                <xsl:for-each select="doc:Document[doc:published = '1']">
                    <xsl:sort select="doc:year" />
                    <li>
                        
                        <p>
                            <xsl:apply-templates select="." mode="link" />
                            &#160;<xsl:value-of select="doc:comments" />
                        </p>
                    </li>
                </xsl:for-each>
            </ul-->
        </div>
    </xsl:if>
</xsl:template>

</xsl:stylesheet>
