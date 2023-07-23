<?php

namespace App\ClassicTrader\Helpers;

class CalculationHelper
{
    public function calculateTime($date, $drawTime)
    {
        $difference_in_seconds = strtotime($date) - time() + $drawTime;
        return $difference_in_seconds;
    }
}