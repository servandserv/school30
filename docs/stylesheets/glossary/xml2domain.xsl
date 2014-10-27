<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
	xmlns="http://www.w3.org/1999/xhtml"
	xmlns:html="http://www.w3.org/1999/xhtml"
	xmlns:xlink="http://www.w3.org/1999/xlink"
	xmlns:glo="urn:ru:battleship:meta:glossary:glossary"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:exsl="http://exslt.org/common"
	extension-element-prefixes="exsl"
    exclude-result-prefixes="html xlink glo xsl">
	
    <xsl:output method="text" omit-xml-declaration="yes" indent="no"/>
	
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
	
	<xsl:variable name="GLOSSARIES-SET" select="document(concat($PROJECT-BASE,'glossary.xml'),/)" />
	<xsl:variable name="GLOSSARY-TERMS" select="$GLOSSARIES-SET//glo:glossary[@ID = $GLOSSARY-ID]//glo:term" />
	<xsl:variable name="TERMS-SET" select="$GLOSSARIES-SET//glo:term" />
	
	<xsl:variable name="NODES">
		<!--  выбираем термины для рисования диаграмм -->
		<xsl:for-each select="$GLOSSARY-TERMS">
			<!-- Из всех терминов текущего глоссария выберем те в тексте которых определены связи типа обобщения и агрегации -->
			<xsl:choose>
				<xsl:when test=".//glo:has-a">
					<xsl:element name="node">
						<xsl:value-of select="@URN" />
					</xsl:element>
				</xsl:when>
				<xsl:when test=".//glo:has-many"><xsl:element name="node"><xsl:value-of select="@URN" /></xsl:element></xsl:when>
				<xsl:when test=".//glo:is-a"><xsl:element name="node"><xsl:value-of select="@URN" /></xsl:element></xsl:when>
			</xsl:choose>
		</xsl:for-each>
		<xsl:for-each select="$GLOSSARY-TERMS//glo:is-a">
			<!-- далее переберем термины  упоминавшиеся в отношениях типа обобшения (is-a) терминов текущего глоссария -->
			<xsl:variable name="tail_urn" select="ancestor::glo:term/@URN" />
			<xsl:variable name="head_urn">
				<xsl:apply-templates select="." mode="urn" />
			</xsl:variable>
			<xsl:for-each select="$TERMS-SET[@URN=$head_urn]">
				<!-- среди всех терминов всех глоссариев которые упоминались в текущем -->
				<xsl:if test="not(.//glo:has-a) and not(.//glo:has-many) and not(.//glo:is-a)">
					<!-- Выберем те которые не имеют в описании отношений с другими терминами -->
					<xsl:element name="node">
						<xsl:value-of select="@URN" />
					</xsl:element>
				</xsl:if>
				<xsl:if test="not($GLOSSARY-TERMS[@URN=$head_urn])">
					<!-- Выберем те, которые находятся за пределами текущего глоссария -->
					<xsl:element name="node">
						<xsl:value-of select="@URN" />
					</xsl:element>
				</xsl:if>
			</xsl:for-each>
		</xsl:for-each>
		<xsl:for-each select="$GLOSSARY-TERMS//glo:has-many">
			<!-- Среди терминов текущего глоссария которые содержат отношения типа has-many найдем жти связанные термины-->
			<xsl:variable name="urn">
				<!-- определим их urn -->
				<xsl:apply-templates select="." mode="urn" />
			</xsl:variable>
			<xsl:for-each select="$TERMS-SET[@URN=$urn]">
				<!-- Среди всех терминов всех глоссариев найдем соврадение по urn -->
				<xsl:if test="not(.//glo:has-a) and not(.//glo:has-many) and not(.//glo:is-a)">
					<!-- Выберем те которые не имеют в описании отношений с другими терминами -->
					<xsl:element name="node">
						<xsl:value-of select="$urn" />
					</xsl:element>
				</xsl:if>
			</xsl:for-each>
		</xsl:for-each>
	</xsl:variable>
	
	<xsl:variable name="NODES-SET" select="exsl:node-set($NODES)" />
	
	<xsl:template match="/">
		<xsl:call-template name="domain" />
	</xsl:template>
	
	<!-- dot -->
	<xsl:template name="domain">
		digraph domain_<xsl:value-of select="translate($GLOSSARY-ID,':','_')" /> {
			label="<xsl:value-of select="$GLOSSARY-TITLE" />";
			URL="images/generated/<xsl:value-of select="translate(substring-after($GLOSSARY-ID,'glossary:'),':','/')" />/domain.svg";
			labelloc=b;
			labeljust=r;
			fontsize=18;
			fontcolor="#0000cc";
			rankdir=LR;
			compound=true;
			node [shape=none, margin=0];
			<!--xsl:apply-templates select="$GLOSSARY-TERMS[.//glo:has-a]" mode="node" />
			<xsl:apply-templates select="$GLOSSARY-TERMS[.//glo:has-many]" mode="node" />
			<xsl:apply-templates select="$GLOSSARY-TERMS[.//glo:is-a]" mode="node" /-->
			<!--xsl:apply-templates select="$GLOSSARY-TERMS[concat('#',@ID) = $GLOSSARY-TERMS//glo:is-a/@xlink:href]" mode="node" /-->
			<!-- нарисуем все отобранные узлы -->
			<xsl:apply-templates select="$TERMS-SET[@URN=$NODES-SET/*]" mode="node" />
			
			
			edge [dir="back",arrowtail="odiamond"];
			<xsl:apply-templates select="$GLOSSARY-TERMS//glo:has-a" mode="edge" />
			edge [dir="back",arrowtail="odiamond",headlabel="*"];
			<xsl:apply-templates select="$GLOSSARY-TERMS//glo:has-many" mode="edge" />
			
			edge [dir="forward",arrowhead="onormal",headlabel=""];
			<xsl:apply-templates select="$GLOSSARY-TERMS//glo:is-a" mode="edge" />
			<!--xsl:for-each select="$GLOSSARY-TERMS/glo:definition//glo:is-a">
				<xsl:variable name="tail_urn" select="ancestor::glo:term/@ID" />
				<xsl:variable name="urn" select="substring-after(@xlink:href,'#')" />
				<xsl:value-of select="translate($urn,':','_')" />
				<xsl:text> -&gt; </xsl:text>
				<xsl:value-of select="translate($tail_urn,':','_')" />;
			</xsl:for-each-->
		}
	</xsl:template>
	
	<xsl:template match="glo:term" mode="node">
		<xsl:variable name="term_id" select="@ID" />
		<xsl:value-of select="translate(@URN,':','_')" />
		<xsl:text> [</xsl:text>
		<xsl:text>label=&lt;&lt;TABLE BORDER="1" CELLPADDING="3" CELLSPACING="0"&gt;</xsl:text>
		<xsl:call-template name="make-field">
			<xsl:with-param name="urn" select="@URN" />
			<xsl:with-param name="id" select="@URN" />
			<xsl:with-param name="type" select="'domainname'" />
		</xsl:call-template>
		<xsl:if test="glo:definition//glo:*[local-name()='has-a' or local-name()='has-many']">
			<xsl:for-each select="glo:definition//glo:*[local-name()='has-a' or local-name()='has-many']">
				<!--xsl:if test="position()=1">
					<xsl:text>&lt;tr&gt;&lt;td border="1"&gt;&lt;/td&gt;&lt;/tr&gt;</xsl:text>
				</xsl:if-->
				<xsl:variable name="field_urn">
					<xsl:apply-templates select="." mode="urn" />
				</xsl:variable>
				<xsl:if test="not($NODES-SET/* = $field_urn)">
					<xsl:call-template name="make-field">
						<xsl:with-param name="urn" select="$field_urn" />
						<xsl:with-param name="id" select="$field_urn" />
						<xsl:with-param name="type" select="'property'" />
					</xsl:call-template>
				</xsl:if>
			</xsl:for-each>
		</xsl:if>
		<xsl:text>&lt;/TABLE&gt;&gt;</xsl:text>];
	</xsl:template>
	
	<xsl:template match="glo:has-a | glo:has-many" mode="edge">
		<xsl:variable name="tail_urn" select="ancestor::glo:term/@URN" />
		<xsl:variable name="head_urn">
			<xsl:apply-templates select="." mode="urn" />
		</xsl:variable>
		<xsl:variable name="port" select="translate($head_urn,':','_')" />
				
		<xsl:if test="$NODES-SET[child::*=$head_urn]">
			<xsl:value-of select="translate($tail_urn,':','_')" />
			<!--xsl:text>:</xsl:text-->
			<!--xsl:value-of select="$port" /-->
			<!--xsl:value-of select="translate($tail_urn,':','_')" /-->
			<xsl:text> -&gt; </xsl:text>
			<xsl:value-of select="translate($head_urn,':','_')" />;
		</xsl:if>
	</xsl:template>
	
	<xsl:template match="glo:is-a" mode="edge">
		<xsl:variable name="tail_urn" select="translate(ancestor::glo:term/@URN,':','_')" />
		<xsl:variable name="head_urn">
			<xsl:apply-templates select="." mode="urn" />
		</xsl:variable>
		<xsl:value-of select="$tail_urn" />:<xsl:value-of select="$tail_urn" />
		<xsl:text> -&gt; </xsl:text>
		<xsl:value-of select="translate($head_urn,':','_')" />;
		
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
	
	<xsl:template name="make-field">
		<xsl:param name="urn" />
		<xsl:param name="id" />
		<xsl:param name="type" />
		<xsl:variable name="term_node" select="$TERMS-SET[@URN=$urn]" />
		<xsl:variable name="title" select="$term_node/@xlink:title" />
		<xsl:text>&lt;TR&gt;&lt;TD ALIGN="CENTER" HREF="#</xsl:text>
		<xsl:value-of select="substring-after($urn,'glossary:')" />
		<xsl:text>" TITLE="</xsl:text>
		<xsl:value-of select="$term_node/@ID" />
		<xsl:text>" PORT="</xsl:text>
		<xsl:value-of select="translate($id,':','_')" />
		<xsl:choose>
			<xsl:when test="$type='domainname'">
				<xsl:text>" BGCOLOR="#dddddd"&gt;</xsl:text>
			</xsl:when>
			<xsl:otherwise>
				<xsl:text>" BGCOLOR="#ffffff"&gt;</xsl:text>
			</xsl:otherwise>
		</xsl:choose>
		<xsl:text>&lt;FONT</xsl:text>
		<xsl:choose>
			<xsl:when test="$title">
				<xsl:text> COLOR="#0000cc"&gt;</xsl:text>
			</xsl:when>
			<xsl:otherwise>
				<xsl:text> COLOR="#3c3c3c"&gt;</xsl:text>
			</xsl:otherwise>
		</xsl:choose>
		<xsl:choose>
			<xsl:when test="$title"><xsl:value-of select="translate($title,' ','&#160;')" /></xsl:when>
			<xsl:otherwise><xsl:value-of select="$urn" /></xsl:otherwise>
		</xsl:choose>
		<xsl:text>&lt;/FONT&gt;&lt;/TD&gt;&lt;/TR&gt;</xsl:text>
	</xsl:template>
	
	<xsl:template match="*[@xlink:href]" mode="urn">
		<xsl:choose>
			<xsl:when test="substring-after(@xlink:href,'#')">
				<xsl:value-of select="concat(ancestor::glo:glossary[1]/@ID,':',substring-after(@xlink:href,'#'))" />
			</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="@xlink:href" />
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	
</xsl:stylesheet>
