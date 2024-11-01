<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    version="1.0">
    
    <xsl:template match="/">
        <div>
              <xsl:apply-templates select="//results"/>
        </div>
    </xsl:template>
    
    <xsl:template match="//results/result">
        <xsl:variable name="baseURL">xdatatest/projects/?element=id%5E</xsl:variable>
                <xsl:variable name="id"><xsl:value-of select="id"/></xsl:variable>        
                <font size="-2">
                    <a href="{$baseURL}{id}">
                        <xsl:value-of select="name"/>
                    </a>
                </font>
                <br/>    
    </xsl:template>   
       
</xsl:stylesheet>