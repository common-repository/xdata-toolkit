<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    
    <xsl:template match="/">
        <div>
               <h2><xsl:value-of select="PLAY/TITLE" /></h2><br/>
               <h3><xsl:value-of select="PLAY/PLAYSUBT" /></h3><br/>
               <h4><strong><xsl:text>Acts:</xsl:text></strong></h4><br/>         
               <ul>
               <xsl:for-each select="PLAY/ACT">
                 <xsl:variable name="actHref">
                    <xsl:value-of select="TITLE" />
                 </xsl:variable>
                 <li><a href="#{$actHref}"><xsl:value-of select="TITLE" /></a></li>
               </xsl:for-each>
               </ul>
               <h4><strong><xsl:text>Scene Description:  </xsl:text></strong><xsl:value-of select="SCNDESCR" /></h4><br/>
              <ul><p align="justify">
                 <xsl:for-each select="PLAY/FM">
                       <xsl:for-each select="P">
                          <xsl:value-of select="." /><xsl:text>  </xsl:text>
                       </xsl:for-each>
                 </xsl:for-each>
               </p></ul><br/>
               <h3><xsl:text>Actors:</xsl:text></h3>
              <ul>
                 <xsl:for-each select="PLAY/PERSONAE">
                       <xsl:for-each select="PERSONA">
                          <li><xsl:value-of select="." /></li>
                       </xsl:for-each>
                       <xsl:for-each select="PGROUP/PERSONA">
                          <li><xsl:value-of select="." /></li>
                       </xsl:for-each>
                 </xsl:for-each>
               </ul><br/>
               <xsl:for-each select="PLAY/ACT">
<xsl:variable name="actLink">
              <xsl:value-of select="TITLE" />
</xsl:variable>

                 <h4><a name="{$actLink}"><xsl:value-of select="TITLE" /></a></h4><br/>
                    <xsl:for-each select="SCENE">
                         <h5><strong><xsl:value-of select="TITLE" /></strong></h5><br/>
                         <h5><strong><xsl:text>Stage Directions:  </xsl:text></strong><xsl:value-of select="STAGEDIR" /></h5><br/>
                         <xsl:for-each select="SPEECH">
                        <h6><ul><strong><xsl:value-of select="SPEAKER" /></strong></ul></h6><br/>
                         <ul><code><p align="justify">
                         <xsl:for-each select="LINE">
                              <xsl:value-of select="." /><xsl:text>  </xsl:text>
                         </xsl:for-each>
                         </p></code></ul><br/>
                         </xsl:for-each>
                    </xsl:for-each>
               </xsl:for-each><br/><br/>
        </div>
    </xsl:template>
    
</xsl:stylesheet>