<?php
namespace App\ClassicTrader\Models;

use App\ClassicTrader\Core\Model;

class ImageModel extends Model
{
    public $id;
    public $url;
    public $description; //LocaleModel
    public $position;

    public function __construct($database)
    {
        parent::__construct($database);
        $this->description = new LocaleModel($database);
    }

    public function mapDataToObject(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->url = $data['url'] ?? null;
        // if (isset($data['car']) && is_array($data['car'])) {

        // }
        $this->description->mapDataToObject($data['description'] ?? []);
        $this->position = $data['position'] ?? null;

        return $this;
    }

}