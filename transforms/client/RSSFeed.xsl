<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<xsl:stylesheet xmlns:xsl=\"http://www.w3.org/1999/XSL/Transform\" version=\"1.0\">
    
    <xsl:template match=\"/rss/channel\">
        <div>
              <xsl:apply-templates select=\"//rss/channel/item\"/>
        </div>
    </xsl:template>
    
    <xsl:template match=\"//rss/channel/item\">
                  <xsl:variable name=\"aLink\">
                    <xsl:value-of select=\"link\"/>
                  </xsl:variable>

	<xsl:choose>
		<xsl:when test=\"position() &lt;= 5\">

                  <h3><a href=\"{$aLink}\" target=\"newWin\"><xsl:value-of select=\"title\"/></a></h3><br/>
                  <ul>
                     <font size=\"-3\"><xsl:value-of select=\"pubDate\"/></font><br/>
                     <xsl:value-of select=\"description\" disable-output-escaping=\"yes\"/><br/>
                  </ul>
                  <br/><br/>
                </xsl:when>
	</xsl:choose>

    </xsl:template>          
</xsl:stylesheet>
