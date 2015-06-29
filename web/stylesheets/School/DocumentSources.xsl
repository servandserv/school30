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
<xsl:variable name="DESTINATIONS" select="document(concat('../../api/documents/',$SOURCES/doc:Documents/doc:Document/doc:ID,'/destinations'))/res:Resources" />
<xsl:variable name="DIGESTS" select="document('../../api/digests')/dig:Digests" />
<xsl:variable name="ROOT" select="'../../../'" />

<xsl:template match="res:Resources">
    <html lang="ru" xml:lang="ru">
        <head>
            <title><xsl:value-of select="doc:Documents/doc:Document/doc:comments" /> | Школа 30 | Ижевск</title>
            <xsl:call-template name="common-header" />
            <link href="{$ROOT}css/document.css" rel="stylesheet" type="text/css" />
            <xsl:call-template name="theme">
                <xsl:with-param name="ref" select="$DESTINATIONS/dig:Digests/dig:Digest" />
            </xsl:call-template>
            <script src='http://www.google-analytics.com/ga.js' type='text/javascript'>;</script>
            <script type="text/javascript">
                <![CDATA[
                    window.onload = function() {
                        document.addEventListener("touchstart", function() {},false);
                        try{
                            var pageTracker = _gat._getTracker("UA-60861342-1");
                            pageTracker._trackPageview();
                        } catch(err) {}
                    }
                ]]>
            </script>
        </head>
        <body>
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
                    <h1><xsl:value-of select="doc:Documents/doc:Document/doc:year" /></h1>
                    <h4><xsl:value-of select="doc:Documents/doc:Document/doc:comments" /></h4>
                    <div class="menu">
                        <xsl:call-template name="menu">
                            <xsl:with-param name="social-href" select="concat('http://www.school-30.com/api/documents/',doc:Documents/doc:Document/doc:ID,'/sources')" />
                        </xsl:call-template>
                    </div>
                </div>
                <div>
                    <xsl:variable name="width" select="doc:Documents/doc:Document/doc:File[1]/doc:Obverse/doc:Large/doc:width" />
                    <xsl:variable name="height" select="doc:Documents/doc:Document/doc:File[1]/doc:Obverse/doc:Large/doc:height" />
                    <xsl:attribute name="class">
                        <xsl:choose>
                            <xsl:when test="$width &gt; $height">landscape</xsl:when>
                            <xsl:otherwise>portrait</xsl:otherwise>
                        </xsl:choose>
                    </xsl:attribute>
                    <div id="files">
                        <xsl:apply-templates select="doc:Documents/doc:Document" mode="tape" />
                    </div>
                    <div id="links">
                        <!--h4>К документу имеют отношение:</h4-->
                        <xsl:choose>
                            <xsl:when test="count(pers:Persons/pers:Person) &gt; count(pers:Staff/pers:Person) ">
                                <div>
                                    <xsl:apply-templates select="pers:Staff" />
                                    <xsl:apply-templates select="un:Forms" />
                                    <xsl:apply-templates select="un:Unions" />
                                    <xsl:apply-templates select="$DESTINATIONS/ev:Events" />
                                    <xsl:apply-templates select="$DESTINATIONS/dig:Digests" />
                                </div>
                                <xsl:apply-templates select="pers:Persons" />
                            </xsl:when>
                            <xsl:otherwise>
                                <div>
                                    <xsl:apply-templates select="pers:Persons" />
                                    <xsl:apply-templates select="un:Forms" />
                                    <xsl:apply-templates select="un:Unions" />
                                    <xsl:apply-templates select="$DESTINATIONS/ev:Events" />
                                    <xsl:apply-templates select="$DESTINATIONS/dig:Digests" />
                                </div>
                                <xsl:apply-templates select="pers:Staff" />
                                <!--xsl:call-template name="share-buttons">
                                    <xsl:with-param name="href" select="concat('http://www.school-30.com/api/documents/',doc:ID,'/sources')" />
                                </xsl:call-template-->
                            </xsl:otherwise>
                        </xsl:choose>
                        
                    </div>
                </div>
                <div id="menu" class="menu">
                    <xsl:call-template name="menu">
                        <xsl:with-param name="social-href" select="concat('http://www.school-30.com/api/documents/',doc:Documents/doc:Document/doc:ID,'/sources')" />
                    </xsl:call-template>
                </div>
                <div id="copy">
                    <p><small>© 2015, фотоархив ИЕГЛ Школа № 30</small></p>
                </div>
            </div>
            <script type="text/javascript">
                <![CDATA[
                    if( typeof document.getElementsByClassName === "function" ) {
                        var ns = document.getElementsByClassName("html");
                        for(var i=0;i<ns.length;i++) {
                            ns[i].innerHTML = ns[i].innerHTML.replace(/&lt;/g, "<").replace(/&gt;/g, ">");
                        }
                    }
                ]]>
            </script>
        </body>
    </html>
</xsl:template>

<xsl:template match="doc:Document" mode="tape">
    <div>
        <xsl:for-each select="doc:File">
            <xsl:sort select="concat(link:Link/link:type,link:Link/link:dtStart)" />
            <xsl:variable name="width" select="doc:Obverse/doc:Large/doc:width" />
            <xsl:variable name="height" select="doc:Obverse/doc:Large/doc:height" />
            <xsl:variable name="obv" select="doc:Obverse/doc:Large/doc:src" />
            <xsl:variable name="rev" select="doc:Reverse/doc:Large/doc:src" />
            
            <div>
                <div>
                    <xsl:choose>
                        <xsl:when test="$rev">
                            <xsl:attribute name="class">flipper</xsl:attribute>
                            <!--xsl:attribute name="style">
                                background: url(<xsl:value-of select="$CDN" /><xsl:value-of select="$TRANS" /><xsl:value-of select="$rev" />) no-repeat center center;
                                background-size: cover;
                                max-width: <xsl:value-of select="$width" />px;
                            </xsl:attribute-->
                            <xsl:attribute name="style">
                                background: url(<xsl:value-of select="$CDN" /><xsl:value-of select="$TRANS" /><xsl:value-of select="$rev" />) no-repeat center center;
                                background-size: cover;
                            </xsl:attribute>
                            <input type="checkbox" name="slider__check-{parent::*/doc:ID}" class="slider__check" id="slider__check-{parent::*/doc:ID}-1" checked="checked" />
                            <label for="slider__check-{parent::*/doc:ID}-1" class="slider__label">1</label>
                        </xsl:when>
                        <xsl:otherwise>
                            <xsl:attribute name="style">position:relative</xsl:attribute>
                        </xsl:otherwise>
                    </xsl:choose>
                    <img src="{$CDN}{$TRANS}{$obv}" />
                    <xsl:for-each select="doc:Obverse/doc:Large/doc:Area">
                        <xsl:variable name="ref" select="res:Ref/res:href" />
                        <div class="face"
                            style="position:absolute;top:{doc:y div $height * 100}%;left:{doc:x div $width * 100}%;width:{doc:width div $width *100}%;height:{doc:height div $height * 100}%;">
                            <div>
                                <xsl:variable name="k" select="160 div doc:width div 1.8" />
                                <div>
                                <div style="width:{doc:width * $k * 1.8}px;height:{doc:height * $k * 1.8}px;">
                                    <img src="{$CDN}{$TRANS}{$obv}" 
                                        style="position:absolute;left:{ doc:width * $k * 0.4 - doc:x * $k}px;top:{doc:height * $k * 0.4 - doc:y * $k }px;width:{$width * $k}px;height:{$height * $k}px;"/>
                                </div>
                                <h6>
                                    <span>
                                        <xsl:value-of select="$SOURCES//pers:Person[pers:ID = $ref]/pers:lastName" /><br/>
                                        <xsl:value-of select="$SOURCES//pers:Person[pers:ID = $ref]/pers:firstName" /><br/>
                                        <xsl:value-of select="$SOURCES//pers:Person[pers:ID = $ref]/pers:middleName" />
                                    </span>
                                </h6>
                                </div>
                            </div>
                        </div>
                    </xsl:for-each>
                </div>
                <div class="image-control-panel">
                    <ul>
                        <xsl:if test="$rev">
                            <li>
                                <a href="#"><i class="fa fa-refresh fa-2x">&#173;</i></a>
                            </li>
                        </xsl:if>
                    </ul>
                </div>
            </div>
        </xsl:for-each>
    </div>
</xsl:template>

<xsl:template match="pers:Persons">
    <xsl:if test="pers:Person">
        <div id="persons">
            <h2>Выпускники</h2>
            <ul>
                <xsl:for-each select="pers:Person">
                    <xsl:sort select="pers:fullName" />
                    <li>
                        <p><a href="{$ROOT}api/persons/{pers:ID}/destinations"><xsl:value-of select="pers:fullName" /></a></p>
                    </li>
                </xsl:for-each>
            </ul>
        </div>
    </xsl:if>
</xsl:template>

<xsl:template match="pers:Staff">
    <xsl:if test="pers:Person">
        <div id="staff">
            <h2>Преподаватели</h2>
            <ul>
                <xsl:for-each select="pers:Person">
                    <xsl:sort select="pers:fullName" />
                    <li>
                        <p><a href="{$ROOT}api/persons/{pers:ID}/destinations"><xsl:value-of select="pers:fullName" /></a></p>
                    </li>
                </xsl:for-each>
            </ul>
        </div>
   </xsl:if>
</xsl:template>

<xsl:template match="un:Forms">
    <xsl:if test="un:Form">
        <div id="forms">
            <h2>Классы</h2>
            <ul>
                <xsl:for-each select="un:Form">
                    <li>
                       <p><xsl:value-of select="concat(un:year,un:league,', выпуск ',un:cohort)" /></p>
                    </li>
                </xsl:for-each>
            </ul>
        </div>
    </xsl:if>
</xsl:template>

<xsl:template match="un:Unions">
    <xsl:if test="un:Union">
        <div id="unions">
            <h2>Группы</h2>
        </div>
    </xsl:if>
</xsl:template>

<xsl:template match="dig:Digests">
    <xsl:if test="dig:Digest">
    <div id="digest-dests">
        <h2>Опубликован</h2>
        <ul>
            <xsl:for-each select="dig:Digest">
                <li>
                    <p><a href="{$ROOT}api/digests/{dig:ID}/sources"><xsl:value-of select="dig:title" /></a></p>
                </li>
            </xsl:for-each>
        </ul>
    </div>
    </xsl:if>
</xsl:template>

<xsl:template match="ev:Events">
    <xsl:if test="ev:Event">
    <div id="events-dests">
        <h2>Связан с событиями</h2>
        <ul>
            <xsl:for-each select="ev:Event">
                <li>
                    <p><a href="{$ROOT}api/events/{ev:ID}/sources"><xsl:value-of select="concat(ev:dt,', ',ev:name)" /></a></p>
                </li>
            </xsl:for-each>
        </ul>
    </div>
    </xsl:if>
</xsl:template>

</xsl:stylesheet>
