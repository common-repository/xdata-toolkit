<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    
    <xsl:template match="/">
        <div>
            <table style="width:95%">
              <tr>
		<td><h4>name</h4></td>
		<td><h4>description</h4></td>

              </tr>                
              <xsl:apply-templates select="//results"/>
            </table>
        </div>
    </xsl:template>
    
    <xsl:template match="//results/result">
      <tr>
		<td><h5><xsl:value-of select="name"/></h5></td>
		<td><h5><xsl:value-of select="description"/></h5></td>

      </tr>
    </xsl:template>          
</xsl:stylesheet>