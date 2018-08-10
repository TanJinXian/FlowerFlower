<?php

namespace App;

class FlowerOrderFactory
{
    public static function createOrder()
    {
        return new FlowerOrder();
    }

    public static function createOrderDetail()
    {
        return new OrderDetail();
    }

    public static function createPayment()
    {
        return new Payment();
    }
}
