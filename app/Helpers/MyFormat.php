<?php 
namespace App\Helpers;

class MyFormat {

    const CURRENCY_SYMBOL = 'Rp ';

    public static function currency($amount)
    {
        return self::CURRENCY_SYMBOL . number_format($amount, 0, ',', '.');
    }

    public static function tanggal($date, $format = 'd M Y')
    {
        return \Carbon\Carbon::parse($date)->format($format);
    }
}