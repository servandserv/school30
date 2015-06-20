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

<xsl:variable name="DIGESTS" select="document('../../api/digests')/dig:Digests" />
<xsl:variable name="ROOT" select="'../'" />

<xsl:template match="res:Statistics">
    <html lang="ru" xml:lang="ru">
        <head>
            <title>О проекте | Школа 30 | Ижевск</title>
            <xsl:call-template name="common-header" />
            <link href="{$ROOT}css/statistics.css" rel="stylesheet" type="text/css" />
            <xsl:call-template name="theme">
                <xsl:with-param name="ref" select="." />
            </xsl:call-template>
            <script src='http://www.google-analytics.com/ga.js' type='text/javascript'>;</script>
            <script type="text/javascript">
                <![CDATA[
                    window.onload = function() {
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
                    <h6>Фотоархив Ижевского естественно-гуманитарного лицея «Школа №30»</h6>
                    <h1>О проекте</h1>
                    <p>Представляем вашему вниманию электронный архив фотодокументов, отражающий более чем 80-ти летнюю
                    историю развития Школы №30 города Ижевска.</p>
                    <p>На сегодняшний день архив содержит <strong><xsl:value-of select="format-number(res:Total/res:documents,'#,##0')" /></strong> документов,
                    которые последовательно открываются для публичного доступа. Публикация документов производится по мере их обработки, распознавания и привязки
                    к событиям и людям, имеющим непосредственное отношение к истории школы.</p>
                    <p>Основным источником документов 
                    является архив музея школы, который
                    к настоящему времени полностью оцифрован. Не менее важен вклад отдельных преподавателей и выпускников школы, предоставивших свои коллекции
                    фотодокументов для публикации.</p>
                    <p>
                        Сайт проекта содержит три основных блока информации:
                    </p>
                    <p>
                        а) <a href="{$ROOT}api/digests">Дайджесты документов</a>, в которых прбликуются подборки 
                        документов, посвященных какой-то определенной теме. Всего опубликовано
                        <strong><xsl:value-of select="format-number(count($DIGESTS/dig:Digest),'#,##0')" /></strong> дайджестов.
                    </p>
                    <p>
                        б) Страницы отдельных документов, на которых собирается вся имеющаяся в наличии информация о документе (год документа, события которые он отражает
                        персоналии, связанные с документом и т.п.).
                    </p>
                    <p>
                        в) <a href="{$ROOT}api/persons" title="Поиск">Персональные страницы</a> преподавателей и выпускников школы. В архиве зарегистрировано более чем 
                        <strong><xsl:value-of select="format-number(res:Total/res:persons,'#,##0')" /></strong> записей о выпускниках школы и ее преподавателях.
                    </p>
                    <p>
                        К сожалению, многие документы содержат недостаточно информации для того, чтобы достоверно распознать их.
                         Организаторы проекта с удовольствием и благодарностью примут помощь неравнодушных к истории школы людей
                        в поиске и публикации недостающих документов и сведений о них.</p>
                    <p> 
                        Для обмена информацией открыта группа в 
                        <a href="https://www.facebook.com/groups/school.30.izhevsk/">Facebook</a>. Также для общения можно использовать электронную почту
                        <a href="mailto:school.30.izhevsk@gmail.com">school.30.izhevsk@gmail.com</a>.
                    </p>
                    <div class="menu">
                        <xsl:call-template name="menu">
                            <xsl:with-param name="social-href" select="'http://www.school-30.com/api/stat'" />
                        </xsl:call-template>
                    </div>
                </div>
                <div id="docs">
                    <h2>Благодарности</h2>
                    <p>
                        Организаторы проекта искренне благодарят коллектив Школы №30 за участие в создании фотоархива
                        и возможность публикации материалов о школе.
                        На протяжении всего периода совместной работы с архивом мы ощущали поддержку, внимание
                        и заинтересованность в реализации этой идеи всех вовлеченных людей.
                    </p>
                    <p>
                        <img src="{$CDN}/school/0100015/img100{$W640XL}" style="float:left;margin-right:3rem;" />
                        <!--img src="http://res.cloudinary.com/school-30/image/upload/0100015/img100.jpg" style="float:left;margin-right:3rem;" /-->
                        Выражаем особую благодарность Директору ИЕГЛ "Школа №30", почетному работнику общего образования РФ, заслуженному
                        работнику народного образования республики <a href="{$ROOT}api/persons/vyw74w4z/destinations" title="Персональная страница">
                        Марине Ивановне Рудольской</a> за предоставленную возможность осуществления проекта.
                    </p>
                    <p>
                        <img src="{$CDN}/school/0100016/img100{$W640XL}" style="float:right;margin-left:3rem;" />
                        <!--img src="http://res.cloudinary.com/school-30/image/upload/0100016/img100.jpg" style="float:right;margin-left: 3rem;" /-->
                        Проведенная работа была бы не возможной без активного участия <a href="{$ROOT}api/persons/mEi69VYr/destinations" title="Персональная страница">
                        Марины Федоровны Крысовой</a>. 
                        Заместитель директора школы по воспитательной работе, заслуженный работник народного
                        образования республики, Марина Федоровна оказала неоценимую помощь в организации
                        оперативного доступа к архивным материалам школы и музея.
                    </p>
                    <p>
                        <img src="{$CDN}/school/0100017/img100{$W640XL}" style="float:left;margin-right:3rem;" />
                        <!--img src="http://res.cloudinary.com/school-30/image/upload/0100017/img100.jpg" style="float:left;margin-right:3rem;" /-->
                        Отдельные слова благодарности выражаем создателю и руководителю школьного музея, 
                        заслуженному учителю Удмуртской Республики <a href="{$ROOT}/api/persons/eZiDt8sF/destinations" title="Персональная страница">
                        Лилии Федоровне Богатыревой</a>. 
                        Более 50 лет Лилия Федоровна, в недавнем прошлом школьный учитель биологии, 
                        вкладывает душу и сердце в создание школьного музея, собирает и бережно хранит многочисленные 
                        уникальные документы и фотоматериалы. Благодаря личному ежедневному участию Лилии Федоровны в 
                        подготовке и передаче материалов для данного проекта, мы имеем возможность увидеть историю школы и 
                        выпускников с самого ее основания. Желаем бессменному хранителю школьной истории крепкого 
                        здоровья на долгие годы!
                    </p>
                    <p>
                        В дополнение, хотелось бы отметить, что реализация проекта стала также возможной благодаря участию
                        многих и многих выпускников школы и их родственников, предоставивших бесценные документы из своих личных коллекций.
                    </p>
                    
                </div>
                <div id="menu" class="menu">
                    <xsl:call-template name="menu">
                        <xsl:with-param name="social-href" select="'http://www.school-30.com/api/stat'" />
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

</xsl:stylesheet>