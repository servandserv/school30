<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
	xmlns:html="http://www.w3.org/1999/xhtml"
	xmlns:xlink="http://www.w3.org/1999/xlink"
	xmlns:wadl="http://wadl.dev.java.net/2009/02"
	xmlns:glo="urn:ru:battleship:meta:glossary:glossary"
	xmlns:uc="urn:ru:battleship:meta:glossary:ucpackage"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:exsl="http://exslt.org/common"
	extension-element-prefixes="exsl"
    exclude-result-prefixes="html xlink glo uc xsl">
	
    <xsl:output method="text" omit-xml-declaration="yes" indent="no"/>
	
	<!-- глобальные переменные сделаем UPPERCASE  чтобы отличать их в коде  -->
	<xsl:variable name="ROOT" select="/" />
	<xsl:variable name="UCPACKAGE-ID" select="/uc:ucpackage/@ID" />
	<xsl:variable name="UCPACKAGE-TITLE" select="/uc:ucpackage/@xlink:title" />
	<!-- путь от файла пакета до корня проекта  -->
	<xsl:variable name="PROJECT-BASE">
		<xsl:call-template name="get-base">
			<xsl:with-param name="path" select="$UCPACKAGE-ID"/>
		</xsl:call-template>
	</xsl:variable>
	
	<xsl:variable name="UCPACKAGES-SET" select="document(concat($PROJECT-BASE,'ucpackage.xml'),/)" />
	<xsl:variable name="UCPACKAGE" select="$UCPACKAGES-SET//uc:ucpackage[@ID = $UCPACKAGE-ID]" />
	<xsl:variable name="USECASES" select="$UCPACKAGES-SET//uc:usecase" />
	
	<!-- dot -->
	<xsl:template match="uc:ucpackage">
		digraph usecase_<xsl:value-of select="translate($UCPACKAGE-ID,':','_')" /> {
			label="<xsl:value-of select="$UCPACKAGE-TITLE" />";
			URL="<xsl:value-of select="$UCPACKAGE-ID" />";
			labelloc=t;
			rankdir=LR;
			compound=true;
			
			node [shape=record,style="bold",height=.5];
			{
			rank=same;
			<xsl:for-each select="$UCPACKAGE/uc:actor">
				<xsl:variable name="urn">
					<xsl:call-template name="get-urn">
						<xsl:with-param name="id" select="@xlink:label" />
						<xsl:with-param name="node" select="." />
					</xsl:call-template>
				</xsl:variable>
				<xsl:value-of select="translate($urn,':','_')" />
				<xsl:text> [label="</xsl:text>
				<xsl:call-template name="split-spaces">
					<xsl:with-param name="str" select="@xlink:title" />
					<xsl:with-param name="splitter" select="' '" />
				</xsl:call-template>
				<xsl:text> | &#171;actor&#187;", tooltip="</xsl:text>
				<xsl:value-of select="$urn" />
				<xsl:text>",URL="</xsl:text>
				<xsl:value-of select="@xlink:label" />
				<xsl:text>"];</xsl:text>
			</xsl:for-each>
			}
			
			subgraph cluster_package {
				style="dashed,bold";
				label="<xsl:value-of select="$UCPACKAGE-ID" />";
				node [shape=ellipse,style="bold",height=.5];
				
				<xsl:for-each select="$UCPACKAGE/uc:usecase">
					<xsl:apply-templates select="." mode="node" />
				</xsl:for-each>
			
			}
			
			// use
			edge [arrowhead="none"];
			<xsl:for-each select="uc:use">
				<xsl:variable name="tail_urn">
					<xsl:call-template name="get-urn">
						<xsl:with-param name="id" select="@xlink:from" />
						<xsl:with-param name="node" select="." />
					</xsl:call-template>
				</xsl:variable>
				<xsl:variable name="head_urn">
					<xsl:call-template name="get-urn">
						<xsl:with-param name="id" select="@xlink:to" />
						<xsl:with-param name="node" select="." />
					</xsl:call-template>
				</xsl:variable>
				<xsl:value-of select="translate($tail_urn,':','_')" />
				<xsl:text> -&gt; </xsl:text>
				<xsl:value-of select="translate($head_urn,':','_')" />
				<xsl:if test="@xlink:label">[label="<xsl:value-of select="@xlink:label" />"]</xsl:if>
				<xsl:text>;</xsl:text>
			</xsl:for-each>
			
			// proceed
			node [shape=ellipse,style="bold,filled",height=.5,fillcolor=yellow];
			edge [arrowhead="vee",style="dashed",label="&#171;proceed&#187;"];
			
			<xsl:for-each select="uc:proceed">
				<xsl:apply-templates select="." mode="edge" />
			</xsl:for-each>
			
			// invoke
			edge [arrowhead="vee",style="dotted",label="&#171;invoke&#187;"];
			<xsl:for-each select="uc:invoke">
				<xsl:apply-templates select="." mode="edge" />
			</xsl:for-each>

		}
	</xsl:template>

	<xsl:template name="split-spaces">
		<xsl:param name="str" />
		<xsl:param name="splitter" />
		<xsl:choose>
			<xsl:when test="contains($str,$splitter)">
				<xsl:variable name="before" select="substring-before($str,$splitter)" />
				<xsl:value-of select="$before" />
				<xsl:text>\n</xsl:text>
				<xsl:call-template name="split-spaces">
					<xsl:with-param name="str" select="substring-after($str,$splitter)" />
					<xsl:with-param name="splitter" select="$splitter" />
				</xsl:call-template>
			</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="$str" />
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	
	<xsl:template match="uc:usecase" mode="node">
		<xsl:variable name="urn">
			<xsl:call-template name="get-urn">
				<xsl:with-param name="id" select="@URN" />
				<xsl:with-param name="node" select="." />
			</xsl:call-template>
		</xsl:variable>
		<xsl:value-of select="translate($urn,':','_')" />
		<xsl:text> [label="</xsl:text>
		<xsl:call-template name="split-spaces">
			<xsl:with-param name="str" select="@xlink:title" />
			<xsl:with-param name="splitter" select="' '" />
		</xsl:call-template>
		<xsl:text>",tooltip="</xsl:text>
		<xsl:value-of select="$urn" />
		<xsl:text>",URL="</xsl:text>
		<xsl:value-of select="$urn" />
		<xsl:text>"];</xsl:text>
	</xsl:template>
	
	<xsl:template match="uc:proceed | uc:invoke" mode="edge">
		<xsl:variable name="tail_urn">
			<xsl:call-template name="get-urn">
				<xsl:with-param name="id" select="@xlink:from" />
				<xsl:with-param name="node" select="." />
			</xsl:call-template>
		</xsl:variable>
		<xsl:variable name="head_urn">
			<xsl:call-template name="get-urn">
				<xsl:with-param name="id" select="@xlink:to" />
				<xsl:with-param name="node" select="." />
			</xsl:call-template>
		</xsl:variable>
		
		<!--  добавим узлы прецедентов из других пакетов  -->
		<xsl:if test="not($UCPACKAGE/uc:usecase[@URN=$tail_urn])">
			<xsl:apply-templates select="$UCPACKAGES-SET//uc:usecase[@URN=$tail_urn]" mode="node" />
		</xsl:if>
		
		<xsl:if test="not($UCPACKAGE/uc:usecase[@URN=$head_urn])">
			<xsl:apply-templates select="$UCPACKAGES-SET//uc:usecase[@URN=$head_urn]" mode="node" />
		</xsl:if>
		
		<xsl:value-of select="translate($tail_urn,':','_')" />
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
	
	<xsl:template name="get-urn">
		<xsl:param name="id" />
		<xsl:param name="node" />
		<xsl:choose>
			<xsl:when test="substring-after($id,'#')">
				<xsl:value-of select="concat($node/ancestor::uc:ucpackage[1]/@ID,':',substring-after($id,'#'))" />
			</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="$id" />
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	
</xsl:stylesheet>
