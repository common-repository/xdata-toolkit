<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    version="1.0">
    
    <xsl:template match="/">
        <div>
                <h2>Vacancies</h2><br/>
                <table border="1" bordercolor="silver" width="100%">
                    <xsl:apply-templates select="//results"/>
                </table>
        </div>
    </xsl:template>
    
    <xsl:template match="//results/result">
        <tr>            
            <td align="left" valign="top">
                <h3><xsl:value-of select="name"/></h3><br/>
                <font size="-2"><xsl:value-of select="description"/></font><br/><br/>    
            </td>        
        </tr>    
        
    </xsl:template>   
       
</xsl:stylesheet>