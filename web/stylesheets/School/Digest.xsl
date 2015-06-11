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
	
<xsl:strip-space elements="*"/>

<xsl:include href="Common.xsl" xml:base="." />

<xsl:variable name="SOURCES" select="/res:Resources" />
<xsl:variable name="DIGESTS" select="document('../../api/digests')/dig:Digests" />

<xsl:template match="res:Resources" mode="digest">
    <html lang="ru" xml:lang="ru">
        <head>
            <title>Дайджест | Школа 30 | Ижевск</title>
            <xsl:call-template name="common-header" />
            <link href="{$ROOT}css/digests.css" rel="stylesheet" type="text/css" />
            <xsl:call-template name="theme">
                <xsl:with-param name="ref" select="$SOURCES/dig:Digests/dig:Digest" />
            </xsl:call-template>
            <script src='http://www.google-analytics.com/ga.js' type='text/javascript'>;</script>
            <!--script src="https://mc.yandex.ru/metrika/watch.js" type="text/javascript">;</script-->
            <script type="text/javascript">
                <![CDATA[
                    window.onload = function() {
                        console.log(window.innerWidth);
                        document.addEventListener("touchstart", function() {},false);
                        window.addEventListener("resize", function() {
                            resize_docs_container(document.getElementById('docs_container'),columns());
                        });
                        resize_docs_container(document.getElementById('docs_container'),columns());
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
                    <li><a href="#menu"><i class="fa fa-bars fa-2x"></i></a></li>
                </ul>
            </div>
            <div id="main">
                <div id="header" class="html">
                    <h6>Фотоархив Ижевского ественно-гуманитарного лицея «Школа № 30»</h6>
                    <h1>История в фотографиях и документах</h1>
                    <p><small><xsl:value-of select="dig:Digests/dig:Digest/dig:published" /></small></p>
                    <h2><xsl:value-of select="dig:Digests/dig:Digest/dig:title" /></h2>
                    <xsl:value-of select="dig:Digests/dig:Digest/dig:comments" disable-output-escaping="yes"  />
                    <div class="menu">
                        <xsl:call-template name="menu">
                            <xsl:with-param name="social-href" select="concat('http://www.school-30.com/api/digests/',dig:Digests/dig:Digest/dig:ID,'/sources')" />
                        </xsl:call-template>
                    </div>
                </div>
                <div id="docs">
                    <xsl:apply-templates select="doc:Documents" mode="tape" />
                </div>
                <div id="menu" class="menu">
                    <xsl:call-template name="menu">
                        <xsl:with-param name="social-href" select="concat('http://www.school-30.com/api/digests/',dig:Digests/dig:Digest/dig:ID,'/sources')" />
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


<xsl:template match="doc:Documents" mode="tape">
    <div id="docs_container">
        <xsl:for-each select="doc:Document">
            <xsl:sort select="concat(link:Link/link:type,link:Link/link:dtStart,doc:year)" />
            <xsl:variable name="file" select="doc:File[1]" />
            <xsl:variable name="width" select="$file/doc:Obverse/doc:Thumb/doc:width" />
            <xsl:variable name="height" select="$file/doc:Obverse/doc:Thumb/doc:height" />
            <div id="doc_{doc:ID}">
                <div>
                    <xsl:choose>
                        <xsl:when test="$file/doc:Reverse/doc:Thumb/doc:src">
                            <xsl:attribute name="class">flipper</xsl:attribute>
                            <xsl:attribute name="style">
                                background: url(http://www.school-30.com/images<xsl:value-of select="substring-before($file/doc:Reverse/doc:Thumb/doc:src,'.gif')" />.640xl.jpg) no-repeat center center;
                                background-size: cover;
                            </xsl:attribute>
                            <input type="checkbox" name="slider__check-{doc:ID}" class="slider__check" id="slider__check-{doc:ID}-1" checked="checked" />
                            <label for="slider__check-{doc:ID}-1" class="slider__label" title="Посмотреть оборотную сторону">1</label>
                        </xsl:when>
                        <xsl:otherwise>
                            <xsl:attribute name="style">position:relative</xsl:attribute>
                        </xsl:otherwise>
                    </xsl:choose>
                    <img src="http://www.school-30.com/images{substring-before($file/doc:Obverse/doc:Thumb/doc:src,'.gif')}.640xl.jpg" />
                </div>
                <div class="image-control-panel">
                    <ul>
                        <!--li>
                            <a href="#"><i class="fa fa-arrow-up fa-2x"></i></a>
                        </li-->
                        <xsl:if test="$file/doc:Reverse/doc:Thumb/doc:src">
                            <li>
                                <a href="#"><i class="fa fa-refresh fa-2x"></i></a>
                            </li>
                        </xsl:if>
                        <li>
                            <a href="{$ROOT}api/documents/{doc:ID}/sources" title="Подробная информация"><i class="fa fa-arrow-right fa-2x"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="slider">
                    <p><small><xsl:value-of select="doc:year" /></small></p>
                    <h3><xsl:value-of select="doc:comments" /></h3>
                    <xsl:if test="string-length(link:Link/link:comments) &gt; 3 ">
                        <p class="html">
                            <xsl:value-of select="link:Link/link:comments" disable-output-escaping="yes" />
                        </p>
                    </xsl:if>
                    <!--p><a href="{$ROOT}api/documents/{doc:ID}/sources">Подробнее...</a></p-->
                </div>
            </div>
    </xsl:for-each>
    </div>
</xsl:template>

</xsl:stylesheet>
