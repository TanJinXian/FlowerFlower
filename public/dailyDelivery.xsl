<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- Tan Jin Xian
    -->
    <xsl:template match="/">
        <html>
            <head>
                <title>Daily Pickup Report</title>
            </head>
            <body>
                <hr />
                <table border="1" align="center">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Delivery Address</th>
                        <th>Payment Amount</th>
                    </tr>
                    <xsl:for-each select="orderReport/order" >
                        <tr>
                            <td><xsl:value-of select="orderid" /></td> 
                            <td><xsl:value-of select="custName" /></td> 
                            <td><xsl:value-of select="DeliveryAddress" /></td> 
                            <td><xsl:value-of select="totalPayment" /></td>
                            
                        </tr>
                    </xsl:for-each>
                    <tr>
                            <td></td> 
                            <td></td> 
                            <td><b>Total</b></td>
                        <td><xsl:value-of select="sum(orderReport/order/totalPayment)" /></td>
                    </tr>
                </table>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
