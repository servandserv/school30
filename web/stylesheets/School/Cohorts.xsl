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

<!--xsl:variable name="DESTINATIONS" select="/res:Resources" /-->
<xsl:variable name="FORMS" select="document('../../api/forms')/un:Forms" />
<xsl:variable name="DIGESTS" select="document('../../api/digests')/dig:Digests" />
<xsl:variable name="ROOT" select="'../'" />

<xsl:template match="un:Cohorts">
    <html lang="ru" xml:lang="ru">
        <head>
            <title>Выпуски | Школа 30 | Ижевск</title>
            <xsl:call-template name="common-header" />
            <link href="{$ROOT}css/cohorts.min.css" rel="stylesheet" type="text/css" />
            <xsl:call-template name="theme">
                <xsl:with-param name="ref" select="." />
            </xsl:call-template>
            <!--script src='http://www.google-analytics.com/ga.js' type='text/javascript'>;</script>
            <script type="text/javascript">
                <![CDATA[
                    window.onload = function() {
                        try{
                            var pageTracker = _gat._getTracker("UA-60861342-1");
                            pageTracker._trackPageview();
                        } catch(err) {}
                    }
                 ]]>
            </script-->
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
                    <!--h1><xsl:value-of select="doc:Documents/doc:Document/doc:year" /></h1-->
                    <h1>Поколения учеников</h1>
                    <p class="help">Для просмотра документов архива по конкретному поколению и классу следует перейти по ссылке</p>
                    <div class="menu">
                        <xsl:call-template name="menu">
                            <xsl:with-param name="social-href" select="'http://www.school-30.com/api/cohorts'" />
                        </xsl:call-template>
                    </div>
                </div>
                <div id="docs">
                    <!--h4>найдена <xsl:value-of select="count(pers:Person)" /> запись(ей).</h4-->
                    <ul>
                        <xsl:for-each select="un:Cohort[not(un:year = '')]">
                            <li>
                                <h4><a href="{$ROOT}api/cohorts/{un:year}"><xsl:value-of select="un:year" /> год выпуска</a></h4>
                                <xsl:variable name="year" select="un:year" />
                                <xsl:if test="un:league[not(.='?' or .='')]">
                                    <ul>
                                        <xsl:for-each select="un:league[not(.='?' or .='')]">
                                            <li>
                                                <p>
                                                    <a href="{$ROOT}api/cohorts/{$year}/leagues/{translate(.,'АБВГДЕ','abcdef')}"><xsl:value-of select="." /> класс</a>
                                                </p>
                                            </li>
                                        </xsl:for-each>
                                    </ul>
                                </xsl:if>
                            </li>
                        </xsl:for-each>
                    </ul>
                </div>
                <div id="menu" class="menu">
                    <xsl:call-template name="menu">
                        <xsl:with-param name="social-href" select="'http://www.school-30.com/api/cohorts'" />
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

</xsl:stylesheet>
