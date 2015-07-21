<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet
	xmlns="http://www.w3.org/1999/xhtml"
	xmlns:svg="http://www.w3.org/2000/svg"
	xmlns:wadl="http://wadl.dev.java.net/2009/02"
	xmlns:xsd="http://www.w3.org/2001/XMLSchema"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:html="http://www.w3.org/1999/xhtml"
	xmlns:xlink="http://www.w3.org/1999/xlink"
	xmlns:exsl="http://exslt.org/common"
	xmlns:wadlext="urn:wadlext"
	xmlns:ns="urn:namespace"
	extension-element-prefixes="exsl"
	exclude-result-prefixes="xsd wadl html xsl"
	version="1.0">

<xsl:output
	media-type="application/xhtml+xml"
	method="xml"
	encoding="UTF-8"
	indent="yes"
	omit-xml-declaration="no"
	doctype-public="-//W3C//DTD XHTML 1.1//EN"
	doctype-system="http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd" />


	<!-- Processing of elements -->
	<xsl:template match="*" mode="xml2html">
		<div class="element xml2html">
			<xsl:if test="@name">
				<xsl:attribute name="id"><xsl:value-of select="@name" /></xsl:attribute>
			</xsl:if>
			<xsl:choose>
				<!--xsl:when test="@xlink:show='embed'">
					<span class="starttag xml2html">
						&lt;<xsl:value-of select="name()"/>
						<xsl:apply-templates select="." mode="process-ns-declarations"/>
						<xsl:apply-templates select="@*" mode="xml2html"/>&gt;
					</span>
					<xsl:if test="*|comment()|processing-instruction()|text()">
						<div class="elementcontent xml2html">
							<xsl:apply-templates select="*|comment()|processing-instruction()|text()" mode="xml2html"/>
						</div>
					</xsl:if>
					<span class="endtag xml2html">&lt;/<xsl:value-of select="name()"/>&gt;</span>
				</xsl:when-->
				<xsl:when test="not(node())">
					<span class="starttag xml2html">
						&lt;<xsl:value-of select="name()"/>
						<xsl:apply-templates select="." mode="process-ns-declarations"/>
						<xsl:apply-templates select="@*" mode="xml2html" />&#160;/&gt;
					</span>
				</xsl:when>
				<xsl:otherwise>
					<span class="starttag xml2html">
						<xsl:text>&lt;</xsl:text>
						<xsl:value-of select="name()"/>
						<xsl:apply-templates select="." mode="process-ns-declarations"/>
						<xsl:apply-templates select="@*" mode="xml2html"/>
						<xsl:text>&gt;</xsl:text>
					</span>
					<xsl:if test="*|comment()|processing-instruction()">
						<div class="elementcontent xml2html">
							<xsl:apply-templates select="*|comment()|processing-instruction()" mode="xml2html" />
						</div>
					</xsl:if>
					<xsl:if test="text()">
						<xsl:value-of select="text()" />
					</xsl:if>
					<span class="endtag xml2html">&lt;/<xsl:value-of select="name()"/>&gt;</span>
				</xsl:otherwise>
			</xsl:choose>
		</div>
    </xsl:template>

	<!-- Processing of attributes -->
    <xsl:template match="@*" mode="xml2html">
		<!--xsl:choose>
			<xsl:when test="local-name()='schemaLocation'">
				<xsl:text> </xsl:text><span class="attributename xml2html"><xsl:value-of select="name()"/></span><xsl:text>="</xsl:text>
					<a href="{.}">
						<xsl:value-of select="." />
					</a><xsl:text>"</xsl:text>
			</xsl:when>
			<xsl:when test="namespace-uri()='http://www.w3.org/1999/xlink' and local-name()='href'">
					<xsl:text> </xsl:text><span class="attributename xml2html"><xsl:value-of select="name()"/></span><xsl:text>="</xsl:text>
					<xsl:value-of select="." />
					<xsl:text>"</xsl:text>
			</xsl:when>
			<xsl:otherwise-->
				<xsl:text> </xsl:text><span class="attributename xml2html"><xsl:value-of select="name()"/></span><xsl:text>="</xsl:text><span class="attributevalue xml2html"><xsl:value-of select="."/></span><xsl:text>"</xsl:text>
			<!--/xsl:otherwise>
		</xsl:choose-->
    </xsl:template>

	<!-- Processing of PIs -->
    <xsl:template match="processing-instruction()" mode="xml2html">
        <div class="pi xml2html">&lt;?<xsl:value-of select="local-name()"/><xsl:text> </xsl:text><xsl:value-of select="."/>?&gt;</div>
	</xsl:template>
	
	<!-- Processing of comments -->
	<xsl:template match="comment()" mode="xml2html">
		<div class="comment xml2html">&lt;!-- <xsl:value-of select="."/> --&gt;</div>
	</xsl:template>

	<!-- Processing of namespace declarations -->
	<xsl:template match="*|@*" mode="process-ns-declarations">
		<xsl:if test="namespace-uri() != ''">
			<xsl:variable name="ns-prefix">
				<xsl:value-of select="substring-before(substring-before(name(),local-name()),':')"/>
			</xsl:variable>
			<xsl:variable name="ns-prefix-withcolon">
				<xsl:choose>
					<xsl:when test="$ns-prefix = ''"/>
					<xsl:otherwise>
						<xsl:text>:</xsl:text>
						<xsl:value-of select="$ns-prefix"/>
					</xsl:otherwise>
				</xsl:choose>
			</xsl:variable>
			<xsl:if test="not(ancestor::*[(namespace-uri() = namespace-uri(current())) and (substring-before(name(),local-name()) = substring-before(name(current()),local-name(current())))])">
        		<xsl:text> </xsl:text><span class="attributename xml2html">xmlns<xsl:value-of select="$ns-prefix-withcolon"/></span><xsl:text>="</xsl:text><span class="attributevalue xml2html"><xsl:value-of select="namespace-uri()"/></span><xsl:text>"</xsl:text>
			</xsl:if>
		</xsl:if>
		<xsl:for-each select="./@*">
			<xsl:apply-templates select="." mode="process-ns-declarations"/>
		</xsl:for-each>
	</xsl:template>
	
</xsl:stylesheet>