<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    
    <xsl:template match="/">
        <div>
            <table style="width:95%">
              <tr>
                <td><h4>Country:</h4></td>
                <td><h4>Country Code:</h4></td>
                <td><h4>Number Code:</h4></td>
              </tr>                
              <xsl:apply-templates select="//results"/>
            </table>
        </div>
    </xsl:template>
    
    <xsl:template match="//results/result">
        <xsl:variable name="rowColor">
          <xsl:choose>
            <xsl:when test="position() mod 2 = 0">#FFFFFF</xsl:when>
            <xsl:otherwise>#99FFFF</xsl:otherwise>
          </xsl:choose>
        </xsl:variable>        
        
        <tr style="background-color: {$rowColor}">
         <td><h5><xsl:value-of select="cou_name"/></h5></td>
         <td><h5><xsl:value-of select="cou_code"/></h5></td>
         <td><h5><xsl:value-of select="numcode"/></h5></td>
        </tr>
    </xsl:template>   
       
</xsl:stylesheet>

