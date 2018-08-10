<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : people.xsl.xsl
    Created on : 18 Julai 2018, 3:11
    Author     : taruc
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="/">
        <html>
            <head>
                <title>Show All Product</title>
            </head>
            <body>
                <h1>Show All Product</h1>
                <hr />
                <table border="1">
                    <tr bgcolor="#9acd32"> <!--this is header-->
                        <th>ID</th>
                        <th>Type</th>
                        <th>name</th>
                        <th>desc</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>SeasonPromotion</th>       
                    </tr>
                    <xsl:for-each select="catalog/product">
                        <xsl:sort select="type"/> 
                        <tr>
                            <td><xsl:value-of select="id"/></td>
                            <td><xsl:value-of select="type"/></td>
                            <td><xsl:value-of select="name"/></td>
                            <td><xsl:value-of select="desc"/></td>
                            <td><xsl:value-of select="status"/></td>
                            <td><xsl:value-of select="price"/></td>
                            <td><xsl:value-of select="substring(promoSeason, 6,2)"/></td>
                        </tr>
                    </xsl:for-each>
                </table>

            </body>

        </html>
    </xsl:template>

</xsl:stylesheet>