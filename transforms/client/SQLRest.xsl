<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    
    <xsl:template match="/">
        <div>
            <table style="width:95%">
              <tr>
		<th><strong>CUSTOMERList</strong></th>
		<th><strong>INVOICEList</strong></th>
		<th><strong>ITEMList</strong></th>
		<th><strong>PRODUCTList</strong></th>

              </tr>                
              <xsl:apply-templates select="//results"/>
            </table>
        </div>
    </xsl:template>
    
    <xsl:template match="//resource">
      <tr>
		<td><xsl:value-of select="CUSTOMERList"/></td>
		<td><xsl:value-of select="INVOICEList"/></td>
		<td><xsl:value-of select="ITEMList"/></td>
		<td><xsl:value-of select="PRODUCTList"/></td>

      </tr>
    </xsl:template>          
</xsl:stylesheet>