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

    public function validateInteger($integer)
    {
        if (!is_numeric($integer) || floor($integer) != $integer) {
            throw new \InvalidArgumentException('Provided value is not an integer.');
        }
    
        return true;
    }

    public function validateArray($array)
    {
        if (!is_array($array)) {
            throw new \InvalidArgumentException('Provided value is not an array.');
        }

        return true;
    }

    public function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Provided value is not a valid email address.');
        }

        return true;
    }

    public function validateUrl($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Provided value is not a valid URL.');
        }

        return true;
    }
}
