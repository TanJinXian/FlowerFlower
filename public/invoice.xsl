<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : invoice.xsl
    Created on : August 10, 2018, 7:29 AM
    Author     : User
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
                <title>invoice.xsl</title>
            </head>
            <body>
                <table>
                    <tr>
                        <h2>Invoice</h2>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Customer Name:</td>
                        <td>
                            <xsl:for-each select="Invoice/invoices" >
                                <xsl:if test=" position()= 1  ">
                                    <xsl:value-of select="custName" />
                                </xsl:if>
                            </xsl:for-each>
                        </td>
                    </tr>
                    <tr>
                        <td>Invoice No:</td>
                        <td>
                            <xsl:for-each select="Invoice/invoices" >
                                <xsl:value-of select="invoiceID" />
                            </xsl:for-each>
                        </td>
                        <td></td>
                        <td>Invoice Date:</td>
                        <td>
                            <xsl:for-each select="Invoice/invoices" >
                            <xsl:if test=" position()= 1  ">
                            <xsl:value-of  select="invoiceDate"/>
                            </xsl:if>
                            </xsl:for-each>
                        </td>
                    </tr>
                    <tr>
                        <th>Order NO</th>
                        <th>Order Date</th>
                        <th>Amount</th>                     
                    </tr>
                    <xsl:for-each select="Invoice/invoices" >
                        <tr>
                        
                            <td>
                                <xsl:value-of select="orderID" />
                            </td>
                            <td>
                                <xsl:value-of select="orderDate" />
                            </td>
                            <td>
                                <xsl:value-of select="amount" />
                            </td>
                       
                        </tr>
                    </xsl:for-each>
                    <tr>
                        <td>Total:</td>
                        <td>   <xsl:value-of select="sum(Invoice/invoices/amount)" />
                            
                        </td>
                        <td></td>
                    </tr>
                    
                </table>
            </body>
        </html>
    </xsl:template>

</xsl:stylesheet>
