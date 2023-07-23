<?php

namespace App\ClassicTrader\Helpers;

class ValidationHelper
{
    public function validateNumbers($numbersString, $min=0, $max=60)
    {
        $numbers = explode(',', $numbersString);
        $atLeastOne = 0;
        foreach ($numbers as $key => $number) {
            if (!$this->testRange($number, $min, $max)) {
                $atLeastOne++;
            }
        }
        return ($atLeastOne > 0) ? false : true;
    }

    private function testRange($int, $min, $max)
    {
        return ($min <= $int && $int <= $max) ? true : false;
    }
}