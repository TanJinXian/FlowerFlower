<?php
namespace App\lib;

class ReportFactory {
    public function getReport($r){
        if (strcmp($r, 'saleReport') == 0){
            return new DailySaleReport();
        }else if (strcmp($r, 'pickupReport') == 0){
            return new DailyPickupReport();
        }else if (strcmp($r, 'deliveryReport') == 0){
            return new DailyDeliveryReport();
        }
    }
}