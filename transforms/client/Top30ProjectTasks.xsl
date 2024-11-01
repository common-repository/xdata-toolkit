<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    
    <xsl:template match="/">
        <div>
            <h2>Top 30 Next Tasks</h2><br/>
              <ul>
                 <xsl:apply-templates select="//results"/>
              </ul>
        </div>
    </xsl:template>
    
    <xsl:template match="//results/result">
		<li><h5><xsl:value-of select="text"/></h5></li>
    </xsl:template>          
</xsl:stylesheet>