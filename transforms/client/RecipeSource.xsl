<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0"  xmlns:rec="http://recipes.org">
    
    <xsl:template match="/">
        <div>
               <h2><strong><xsl:text>Recipes from XML Source</xsl:text></strong></h2><br/>
              <xsl:apply-templates select="//rec:collection"/>
        </div>
    </xsl:template>

    <xsl:template match="//rec:collection/rec:recipe">
              <br/>
               <xsl:for-each select=".">
                  <h3><xsl:value-of select="rec:title" /></h3><br/>

                     <h4><strong><xsl:text>Ingredients:</xsl:text></strong></h4><br/>
                  
                  <ul>
                  <xsl:for-each select="rec:ingredient">
                     <li><strong><xsl:value-of select="./@name" /></strong><xsl:text> ( </xsl:text><xsl:value-of select="./@amount" /><xsl:value-of select="./@unit" /><xsl:text> ) </xsl:text></li>
                  </xsl:for-each>
                  </ul>

                  <h4><strong><xsl:text>Preparation:</xsl:text></strong></h4>

                  <ol>
                     <xsl:for-each select="rec:preparation/rec:step">
                        <li><xsl:value-of select="." /></li>
                     </xsl:for-each>
                  </ol>

                  <h4><strong><xsl:text>Notes:</xsl:text></strong></h4>               

                  <ul><ul>
                     <xsl:value-of select="rec:comment"/>
                  </ul></ul>

                  <h4><strong><xsl:text>Nutrition:</xsl:text></strong></h4>                              

                  <ul><ul>
                      <strong><xsl:text>Calories: </xsl:text></strong><xsl:value-of select="rec:nutrition/@calories"/>
                      <strong><xsl:text>  Carbohydrates: </xsl:text></strong><xsl:value-of select="rec:nutrition/@carbohydrates"/>
                      <strong><xsl:text>  Protein: </xsl:text></strong><xsl:value-of select="rec:nutrition/@protein"/>
                  </ul></ul>
                  <hr/>
               </xsl:for-each>

    </xsl:template>
    
</xsl:stylesheet>