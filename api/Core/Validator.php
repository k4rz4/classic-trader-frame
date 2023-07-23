<?php

namespace App\ClassicTrader\Core;

class Validator 
{
    public function validateString($string, $maxLength) 
    {
        if (!is_string($string)) {
            throw new \InvalidArgumentException('Provided value is not a string.');
        }

        if (strlen($string) > $maxLength) {
            throw new \InvalidArgumentException('Provided string is too long.');
        }
        
        return true;
    }
}