<?php
namespace App\ClassicTrader\Helper;

class Helper {
    public static function objectToArray($object) {
        if (is_object($object)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $object = get_object_vars($object);
        }

        if (is_array($object)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return array_map([self::class, 'objectToArray'], $object);
        }
        else {
            // Return array
            return $object;
        }
    }
}
