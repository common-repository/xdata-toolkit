<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    
    <xsl:template match="/">
        <div style="width: 100%">
            <table style="border: 1px solid #000000" cellpadding="5" cellspacing="5">
              <tr style="border: 1px solid #000000;border-bottom: 1px solid #000000">
		<th style="border-right: 1px solid #000000"><strong>Food</strong></th>
		<th style="border-right: 1px solid #000000"><strong>MFR</strong></th>
		<th style="border-right: 1px solid #000000"><strong>Total Fat</strong></th>
		<th style="border-right: 1px solid #000000"><strong>Sat Fat</strong></th>
		<th style="border-right: 1px solid #000000"><strong>Carb</strong></th>
		<th style="border-right: 1px solid #000000"><strong>Fiber</strong></th>
		<th><strong>Protein</strong></th>

              </tr>                
              <xsl:apply-templates select="//nutrition"/>
            </table>
        </div>
    </xsl:template>
    
    <xsl:template match="//nutrition/food">
              <tr style="border: 1px solid #000000;border-bottom: 1px solid #000000">
		<td style="border-right: 1px solid #000000"><xsl:value-of select="name"/></td>
		<td style="border-right: 1px solid #000000"><xsl:value-of select="mfr"/></td>
		<td style="border-right: 1px solid #000000" align="right"><xsl:value-of select="total-fat"/></td>
		<td style="border-right: 1px solid #000000" align="right"><xsl:value-of select="saturated-fat"/></td>
		<td style="border-right: 1px solid #000000" align="right"><xsl:value-of select="carb"/></td>
		<td style="border-right: 1px solid #000000" align="right"><xsl:value-of select="fiber"/></td>
		<td align="right"><xsl:value-of select="protein"/></td>

      </tr>
    </xsl:template>          
</xsl:stylesheet>