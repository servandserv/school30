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
	
<xsl:variable name="CDN" select="'http://www.school-30.com/images'" />
<xsl:variable name="TRANS" select="''" />
<xsl:variable name="LARGE" select="'.large.jpg'" />
<xsl:variable name="W640XL" select="'.thumb.640x.jpg'" />
<xsl:variable name="TMP_IMG" select="concat($ROOT,'tmp.image.php')" />
<!--xsl:variable name="CDN" select="'http://res.cloudinary.com/school-30/image/upload'" />
<xsl:variable name="TRANS" select="'/w_600,c_limit'" />
<xsl:variable name="W640XL" select="''" /-->


<xsl:template name="common-header">
    <meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <meta name="keywords" content="Ижевский естественно гуманитарный лицей Школа 30, МБОУ, ИЕГЛ, Школа-30, лицей, архив, фотографии, история, Школа № 30, школы, тридцатка, Ижевск, Удмуртия, Россия" />
    <meta name="description" content="Фотоархив документов посвященных истории Школы №30 города Ижевска" />
    
    <link href='{$ROOT}/assets/favicon.png' rel='shortcut icon' type='image/png' />
    <link href="../{$ROOT}/bower_components/fontawesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="{$ROOT}components/semanticss/dist/css/semanticss.min.css" rel="stylesheet" type="text/css" />
    <link href="{$ROOT}css/common.min.css" rel="stylesheet" type="text/css" />
    <link href="{$ROOT}css/print.min.css" rel="stylesheet" type="text/css" media="print" />
    <style type="text/css">
        @media only screen and (min-width : 640px) {
            html {
                font-size: 78.125%;
            }
        }
    </style>
    <!--link href="{$ROOT}css/common.medium.css" rel="stylesheet" type="text/css" /-->
    <link href="{$ROOT}css/common.large.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        @media only screen and (min-width : 1200px) {
            #nav {
                display: none;
            }
    
            #main {
                width: 100%;
            }
        }
    </style>
    <!--link href="{$ROOT}css/common.xlarge.css" rel="stylesheet" type="text/css" /-->
    <!--link rel="stylesheet" href="http://basehold.it/20/255/0/0/0.5" media="(max-width: 639px)" /-->
    <!--link rel="stylesheet" href="http://basehold.it/25/255/0/0/0.5" media="(min-width: 640px)" /-->
    <!--link rel="stylesheet" href="http://basehold.it/20/255/0/0/0.5" media="(min-width: 1024px)" /-->
    <script type="text/javascript" src="{$ROOT}/js/school30.min.js" >;</script>
</xsl:template>


<xsl:template name="theme">
    <xsl:param name="ref" />
    <xsl:choose>
        <xsl:when test="$ref/dig:ID = 'Zr0zz9Yu'">
            <xsl:call-template name="modern-theme">
                <xsl:with-param name="ref" select="$ref" />
            </xsl:call-template>
        </xsl:when>
        <xsl:when test="$ref/dig:ID = 'K40PSoje'">
            <xsl:call-template name="modern-theme">
                <xsl:with-param name="ref" select="$ref" />
            </xsl:call-template>
        </xsl:when>
        <xsl:otherwise>
            <xsl:call-template name="legacy-theme">
                <xsl:with-param name="ref" select="$ref" />
            </xsl:call-template>
        </xsl:otherwise>
    </xsl:choose>
</xsl:template>

<xsl:template name="modern-theme">
    <link href="{$ROOT}css/modern.light.min.css" rel="stylesheet" type="text/css" />
</xsl:template>

<xsl:template name="legacy-theme">
    <link href="{$ROOT}css/legacy.light.min.css" rel="stylesheet" type="text/css" />
</xsl:template>

<xsl:template name="body-background-img">
    <xsl:param name="ref" />
    <xsl:choose>
        <xsl:when test="$ref/dig:ID = 'Zr0zz9Yu'">
            <xsl:text>background: url(../</xsl:text><xsl:value-of select="$ROOT" /><xsl:text>school/images/school/0000071/img009.large.jpg) no-repeat center center fixed;</xsl:text>
            <!--xsl:text>background: url(../../../../school/images/school/0100003/img_new.large.jpg) no-repeat center center fixed;</xsl:text-->
        </xsl:when>
        <xsl:when test="$ref/dig:ID = 'K40PSoje'">
            <xsl:text>background: url(../</xsl:text><xsl:value-of select="$ROOT" /><xsl:text>school/images/school/0000071/img009.large.jpg) no-repeat center center fixed;</xsl:text>
            <!--xsl:text>background: url(../../../../school/images/school/0013381/img483.large.jpg) no-repeat center center fixed;</xsl:text-->
        </xsl:when>
        <xsl:otherwise>
            <xsl:text>background: url(</xsl:text><xsl:value-of select="$ROOT" /><xsl:text>/system/static/main.jpg) no-repeat center center fixed;</xsl:text>
        </xsl:otherwise>
    </xsl:choose>
</xsl:template>

<xsl:template name="album-background-img">
    <xsl:param name="ref" />
    <xsl:choose>
        <xsl:when test="$ref/dig:ID = 'Zr0zz9Yu'">
            <!--xsl:text>background: url(http://www.unsigneddesign.com/Seamless_background_textures/thumbs/seamlesstexture1_1200.jpg) center center fixed;</xsl:text-->
            <xsl:text>background: url(</xsl:text>
            <xsl:value-of select="$ROOT" />
            <xsl:text>system/static/modern_bg.100x100.jpg) center center fixed;</xsl:text>
        </xsl:when>
        <xsl:when test="$ref/dig:ID = 'K40PSoje'">
            <xsl:text>background: url(</xsl:text>
            <xsl:value-of select="$ROOT" />
            <xsl:text>system/static/modern_bg.100x100.jpg) center center fixed;</xsl:text>
            <!--xsl:text>background: url(http://www.unsigneddesign.com/Seamless_background_textures/thumbs/seamlesstexture1_1200.jpg) center center fixed;</xsl:text-->
        </xsl:when>
        <xsl:otherwise>
            <xsl:text>background: url(</xsl:text>
            <xsl:value-of select="$ROOT" />
            <xsl:text>system/static/old_bg.100x100.jpg) center center fixed;</xsl:text>
            <!--xsl:text>background: url(http://www.unsigneddesign.com/Seamless_background_textures/thumbs/seamlesstexture15_1200.jpg) center center fixed;</xsl:text-->
        </xsl:otherwise>
    </xsl:choose>
</xsl:template>

<xsl:template name="header-background">
    <xsl:param name="ref" />
    <xsl:choose>
        <xsl:when test="$ref/dig:ID = 'Zr0zz9Yu'">
            <xsl:text>background-color: rgba(64,0,0,.8);</xsl:text>
        </xsl:when>
        <xsl:when test="$ref/dig:ID = 'K40PSoje'">
            <xsl:text>background-color: rgba(64,0,0,.8);</xsl:text>
        </xsl:when>
        <xsl:otherwise>
            <xsl:text>background-color: rgba(0,0,0,.7);</xsl:text>
        </xsl:otherwise>
    </xsl:choose>
</xsl:template>

<xsl:template name="share-buttons">
    <xsl:param name="href" select="'http://www.school-30.com'" />
    <ul class="share-buttons">
        <li>
            <a href="https://www.facebook.com/sharer/sharer.php?u={$href}" title="Facebook"><span>Facebook</span></a>
        </li>
        <li>
            <a href="https://twitter.com/home?status={$href}" title="Twitter"><span>Twitter</span></a>
        </li>
        <li>
            <a href="http://vkontakte.ru/share.php?url={$href}" title="ВКонтакте"><span>ВКонтакте</span></a>
        </li>
        <li>
            <a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&amp;st.s=1&amp;url={$href}" title="Одноклассники"><span>Одноклассники</span></a>
        </li>
        <li>
            <a href="https://plus.google.com/share?url={$href}" title="Google+"><span>Google+</span></a>
        </li>
        <!--li>
            <a href="http://connect.mail.ru/share?status={$href}" target="_blank" title="Мой Мир@mail.ru"><span>Мой Мир</span></a>
        </li-->
    </ul>
</xsl:template>

<xsl:template name="menu">
    <xsl:param name="social-href" select="'http://www.school-30.com/api/digests'" />
    <h2><a href="{$ROOT}api/persons">Поиск</a></h2>
    <h2><a href="{$ROOT}api/cohorts">Поколения</a></h2>
    <h2><a href="{$ROOT}api/events">События</a></h2>
    <h2>Дайджесты</h2>
    <xsl:apply-templates select="$DIGESTS" mode="digests-card-container" />
    <h2><a href="{$ROOT}api/stat">О проекте</a></h2>
    <ul><li><a href="{$ROOT}index.html">Предыдущая версия</a></li></ul>
    <xsl:call-template name="share-buttons">
        <xsl:with-param name="href" select="$social-href" />
    </xsl:call-template>
</xsl:template>

<xsl:template match="dig:Digests" mode="digests-card-container">
    <ul class="digests-card-container">
        <xsl:apply-templates select="dig:Digest" mode="digest-card" />
    </ul>
</xsl:template>

<xsl:template match="dig:Digest" mode="digest-card">
    <xsl:variable name="id" select="dig:ID" />
    <li>
        <xsl:if test="$DIGESTS/dig:Digest/dig:ID = $id">
            <xsl:attribute name="class">selected</xsl:attribute>
        </xsl:if>
        <div>
            <p>
                <a href="{$ROOT}api/digests/{dig:ID}/sources"><xsl:value-of select="dig:title" /></a>
            </p>
        </div>
    </li>
</xsl:template>

<xsl:template match="pers:Person" mode="link">
    <a href="{$ROOT}api/persons/{pers:ID}/destinations"><xsl:value-of select="pers:fullName" /></a>
</xsl:template>

<xsl:template match="doc:Document" mode="link">
    <a href="{$ROOT}api/documents/{doc:ID}/sources" title="{doc:comments}"><xsl:value-of select="doc:year" /></a>
</xsl:template>

<xsl:template match="dig:Digest" mode="link">
    <a href="{$ROOT}api/digests/{dig:ID}/sources"><xsl:value-of select="dig:title" /></a>
</xsl:template>


<xsl:template match="doc:Documents" mode="tape">
    <div id="docs_container">
        <xsl:apply-templates select="doc:Document" mode="tape">
             <xsl:sort select="concat(link:Link/link:type,link:Link/link:dtStart,doc:year)" />
        </xsl:apply-templates>
    </div>
</xsl:template>

<xsl:template match="doc:Document" mode="tape">
    <xsl:variable name="file" select="doc:File[1]" />
    <xsl:variable name="width" select="$file/doc:Obverse/doc:Large/doc:width" />
    <xsl:variable name="height" select="$file/doc:Obverse/doc:Large/doc:height" />
    <div id="doc_{doc:ID}">
        <div id="rev_{doc:ID}">
            <xsl:choose>
                <xsl:when test="$file/doc:Reverse/doc:Thumb/doc:src">
                    <xsl:variable name="rev_style">
                        <xsl:text>background: url(</xsl:text>
                        <xsl:value-of select="$CDN" />
                        <xsl:value-of select="$TRANS" />
                        <xsl:value-of select="substring-before($file/doc:Reverse/doc:Thumb/doc:src,'.thumb')" />
                        <xsl:value-of select="$W640XL" />
                        <xsl:text>) no-repeat center center;background-size: cover;</xsl:text>
                    </xsl:variable>
                    <xsl:attribute name="class">flipper</xsl:attribute>
                    <!--xsl:attribute name="style">
                        background: url(<xsl:value-of select="$CDN" /><xsl:value-of select="$TRANS" /><xsl:value-of select="substring-before($file/doc:Reverse/doc:Thumb/doc:src,'.thumb')" /><xsl:value-of select="$W640XL" />) no-repeat center center;
                        background-size: cover;
                    </xsl:attribute-->
                    <!--xsl:attribute name="style">
                        background: url(<xsl:value-of select="$TMP_IMG"/>?width=<xsl:value-of select="$width"/>&amp;height=<xsl:value-of select="$height"/>&amp;max-width=640) no-repeat center center;
                        background-size: cover;
                    </xsl:attribute-->
                    <script type="text/javascript">
                        window.addEventListener('load', function() {
                            document.getElementById('rev_<xsl:value-of select="doc:ID" />').setAttribute('style','<xsl:value-of select="$rev_style" />');
                        });
                    </script>
                    <input type="checkbox" name="slider__check-{doc:ID}" class="slider__check" id="slider__check-{doc:ID}-1" checked="checked" />
                    <label for="slider__check-{doc:ID}-1" class="slider__label" title="Посмотреть оборотную сторону">1</label>
                </xsl:when>
                <xsl:otherwise>
                    <xsl:attribute name="style">position:relative</xsl:attribute>
                </xsl:otherwise>
            </xsl:choose>
            <xsl:variable name="obv_src">
                <xsl:value-of select="$CDN" />
                <xsl:value-of select="$TRANS" />
                <xsl:value-of select="substring-before($file/doc:Obverse/doc:Thumb/doc:src,'.thumb')" />
                <xsl:value-of select="$W640XL" />
            </xsl:variable>
            <!--img src="{$CDN}{$TRANS}{substring-before($file/doc:Obverse/doc:Thumb/doc:src,'.thumb')}{$W640XL}" /-->
            <!--img id="obv_{doc:ID}" src="{$TMP_IMG}?width={$width}&amp;height={$height}&amp;max-width=640" alt="фотография" /-->
            <img id="obv_{doc:ID}" src="{$ROOT}tmpimg/{$width}/{$height}/640" alt="фотография" />
            <script type="text/javascript">
                window.addEventListener('load', function() {
                    document.getElementById('obv_<xsl:value-of select="doc:ID" />').setAttribute('src','<xsl:value-of select="$obv_src" />');
                    //document.getElementById('loader_<xsl:value-of select="doc:ID" />').setAttribute('style','display:none');
                });
            </script>
        </div>
        <div class="image-control-panel">
            <ul>
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
        </div>
    </div>
</xsl:template>

<xsl:template match="*" mode="calendar-month">
    <xsl:choose>
        <xsl:when test="substring(.,6,2) = '01'">ЯНВАРЯ</xsl:when>
        <xsl:when test="substring(.,6,2) = '02'">ФЕВРАЛЯ</xsl:when>
        <xsl:when test="substring(.,6,2) = '03'">МАРТА</xsl:when>
        <xsl:when test="substring(.,6,2) = '04'">АПРЕЛЯ</xsl:when>
        <xsl:when test="substring(.,6,2) = '05'">МАЯ</xsl:when>
        <xsl:when test="substring(.,6,2) = '06'">ИЮНЯ</xsl:when>
        <xsl:when test="substring(.,6,2) = '07'">ИЮЛЯ</xsl:when>
        <xsl:when test="substring(.,6,2) = '08'">АВГУСТА</xsl:when>
        <xsl:when test="substring(.,6,2) = '09'">СЕНТЯБРЯ</xsl:when>
        <xsl:when test="substring(.,6,2) = '10'">ОКТЯБРЯ</xsl:when>
        <xsl:when test="substring(.,6,2) = '01'">НОЯБРЯ</xsl:when>
        <xsl:otherwise>ДЕКАБРЯ</xsl:otherwise>
    </xsl:choose>
</xsl:template>

<xsl:template name="loader">
    <div id="loader">
        <div>
            <i class="fa fa-spinner fa-spin">&#173;</i>
        </div>
    </div>
</xsl:template>

<xsl:template name="counters">
    <!-- Вставьте счётчики здесь -->
	<script type="text/javascript">
	    <xsl:text disable-output-escaping="yes">
        <![CDATA[
		    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		    ga('create', 'UA-60861342-1', 'auto');
		    ga('send', 'pageview');
		]]>
		</xsl:text>
	</script>
	<!-- Yandex.Metrika counter -->
    <script type="text/javascript">
    <xsl:text disable-output-escaping="yes">
    <![CDATA[
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter29098730 = new Ya.Metrika({
                    id:29098730,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
    ]]>
    </xsl:text>
    </script>
    <!-- /Yandex.Metrika counter -->
</xsl:template>

</xsl:stylesheet>
