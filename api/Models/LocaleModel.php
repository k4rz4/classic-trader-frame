<?php 

namespace App\ClassicTrader\Models;
use App\ClassicTrader\Core\Model;

class LocaleModel extends Model
{
    public $locales = [];

    public function __construct($database)
    {
        parent::__construct($database);
    }

    public function mapDataToObject(array $data)
    {
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $data[$key] = html_entity_decode($value);
            }
        }
    
        $this->locales = $data;
        
        return $this;
    }

    public function getLocale($locale)
    {
        return $this->locales[$locale] ?? null;
    }

}