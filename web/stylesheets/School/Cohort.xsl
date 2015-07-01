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

<xsl:variable name="COHORT" select="un:Cohort" />
<xsl:variable name="PERSONS" select="document(concat('../../api/cohorts/',$COHORT/un:year,'/persons'))/pers:Persons" />
<xsl:variable name="DOCS" select="document(concat('../../api/cohorts/',$COHORT/un:year,'/documents'))/doc:Documents" />
<xsl:variable name="DIGESTS" select="document('../../api/digests')/dig:Digests" />
<xsl:variable name="ROOT" select="'../../'" />

<xsl:template match="un:Cohort">
    <html lang="ru" xml:lang="ru">
        <head>
            <title>Поколение <xsl:value-of select="un:year" /> | Школа 30 | Ижевск</title>
            <xsl:call-template name="common-header" />
            <link href="{$ROOT}css/cohort.css" rel="stylesheet" type="text/css" />
            <xsl:call-template name="theme">
                <xsl:with-param name="ref" select="$COHORT" />
            </xsl:call-template>
            <script src='http://www.google-analytics.com/ga.js' type='text/javascript'>;</script>
            <script type="text/javascript">
                <![CDATA[
                    window.onload = function() {
                        document.getElementById("loader").style.display = "none";
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
                        Выпуск <xsl:value-of select="un:year" /> года
                        <xsl:variable name="c" select="un:year" />
                    </h1>
                    <!--h4>Классы</h4-->
                    <h4>
                        <xsl:for-each select="un:league[not(. = '' or .='?')]">
                            <xsl:variable name="league" select="translate(.,'АБВГДЕ','abcdef')" />
                            <a href="../../api/cohorts/{$COHORT/un:year}/leagues/{$league}">
                                <xsl:value-of select="." />
                            </a>&#160;&#160;&#160;
                        </xsl:for-each>
                    </h4>
                    <h4 class="persons_list">Список выпускников</h4>
                    <ul class="persons_list">
                        <xsl:for-each select="$PERSONS/pers:Person">
                            <xsl:sort select="pers:fullName" />
                            <li>
                                <p>
                                    <a href="{$ROOT}api/persons/{pers:ID}/destinations">
                                        <xsl:value-of select="pers:fullName" />
                                    </a>
                                </p>
                            </li>
                        </xsl:for-each>
                    </ul>
                    <div class="menu">
                        <xsl:call-template name="menu">
                            <xsl:with-param name="social-href" select="concat('http://www.school-30.com/api/events/',ev:Events/ev:Event/ev:ID,'/sources')" />
                        </xsl:call-template>
                    </div>
                </div>
                <div id="docs">
                     <div id="docs_container">
                        <xsl:apply-templates select="$DOCS" mode="tape">
                            <xsl:sort select="concat($DOCS/doc:type,$DOCS/doc:year)" />
                        </xsl:apply-templates>
                    </div>
                </div>
                <div id="menu" class="menu">
                    <h2 class="persons_list">Список выпускников</h2>
                    <ul class="persons_list">
                        <xsl:for-each select="$PERSONS/pers:Person">
                            <xsl:sort select="pers:fullName" />
                            <li>
                                <p>
                                    <a href="{$ROOT}api/persons/{pers:ID}/destinations">
                                        <xsl:value-of select="pers:fullName" />
                                    </a>
                                </p>
                            </li>
                        </xsl:for-each>
                    </ul>
                    <xsl:call-template name="menu">
                        <xsl:with-param name="social-href" select="concat('http://www.school-30.com/api/events/',ev:Events/ev:Event/ev:ID,'/sources')" />
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
            <xsl:variable name="file" select="doc:File[1]" />
            <xsl:variable name="width" select="$file/doc:Obverse/doc:Thumb/doc:width" />
            <xsl:variable name="height" select="$file/doc:Obverse/doc:Thumb/doc:height" />
            <div id="doc_{doc:ID}">
                <div>
                    <xsl:choose>
                        <xsl:when test="$file/doc:Reverse/doc:Thumb/doc:src">
                            <xsl:attribute name="class">flipper</xsl:attribute>
                            <xsl:attribute name="style">
                                background: url(<xsl:value-of select="$CDN" /><xsl:value-of select="$TRANS" /><xsl:value-of select="substring-before($file/doc:Reverse/doc:Thumb/doc:src,'.thumb')" /><xsl:value-of select="$W640XL" />) no-repeat center center;
                                background-size: cover;
                            </xsl:attribute>
                            <input type="checkbox" name="slider__check-{doc:ID}" class="slider__check" id="slider__check-{doc:ID}-1" checked="checked" />
                            <label for="slider__check-{doc:ID}-1" class="slider__label" title="Посмотреть оборотную сторону">1</label>
                        </xsl:when>
                        <xsl:otherwise>
                            <xsl:attribute name="style">position:relative</xsl:attribute>
                        </xsl:otherwise>
                    </xsl:choose>
                    <img src="{$CDN}{$TRANS}{substring-before($file/doc:Obverse/doc:Thumb/doc:src,'.thumb')}{$W640XL}" />
                </div>
                <div class="image-control-panel">
                    <ul>
                        <!--li>
                            <a href="#"><i class="fa fa-arrow-up fa-2x">&#173;</i></a>
                        </li-->
                        <xsl:if test="$file/doc:Reverse/doc:Thumb/doc:src">
                            <li>
                                <a href="#"><i class="fa fa-refresh fa-2x">&#173;</i></a>
                            </li>
                        </xsl:if>
                        <li>
                            <a href="{$ROOT}api/documents/{doc:ID}/sources" title="Подробная информация"><i class="fa fa-arrow-right fa-2x">&#173;</i></a>
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

<xsl:template match="un:Forms">
    <xsl:if test="un:Form">
        <div id="forms">
            <h2>Учился(лась)</h2>
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
    <xsl:if test="un:Union[not(link:Link/link:type = 'teacher')]">
        <div id="unions">
            <h2>Объединения и клубы</h2>
        </div>
    </xsl:if>
</xsl:template>

<xsl:template match="un:Union[link:Link/link:type = 'teacher']">
    <h3>Преподаватель, <xsl:value-of select="link:Link/link:dtStart" /> - <xsl:value-of select="link:Link/link:dtEnd" /></h3>
    <!--xsl:if test="link:Link/link:comments">
        <p><xsl:value-of select="link:Link/link:comments" /></p>
    </xsl:if-->
</xsl:template>

</xsl:stylesheet>
