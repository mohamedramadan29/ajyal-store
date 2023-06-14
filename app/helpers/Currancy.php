<?php

namespace App\helpers;

use NumberFormatter;
class Currancy{
    public static  function formate($amount,$currancy = null){
        $formatter = new NumberFormatter(config('app.locale'),NumberFormatter::CURRENCY);
        if($currancy === null){
            $currancy = config('app.currancy',"USD");
        }
        return $formatter->formatCurrency($amount,$currancy);
    } 
}
