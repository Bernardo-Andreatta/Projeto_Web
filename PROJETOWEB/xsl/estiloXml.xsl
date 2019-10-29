<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">


<xsl:template match="/mail">
  <html>
  <body>
  <div>
  <table>
    <tr>
      <td>De: </td>
      <td><xsl:value-of select="Remetente"/></td>
      
    </tr>
    <tr>
      <td>Para: </td>
      <td><xsl:value-of select="Destinatario"/></td>
    </tr>
    <tr>
      <td>Titulo: </td>
      <td><xsl:value-of select="Titulo"/></td>
    </tr>
    <tr>
      <td>Texto: </td>
      <td><xsl:value-of select="Texto"/></td>
    </tr>
  </table>
  </div>
  </body>
  </html>
</xsl:template>

</xsl:stylesheet>