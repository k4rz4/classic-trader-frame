<?php
namespace App\ClassicTrader\Models;

use App\ClassicTrader\Core\Model;

class VehicleAdModel extends Model
{
    public $id;
    public $uid;
    public $detailUrl;
    public $hasChanges;
    public $car; //CarModel
    public $yearOfProduction;
    public $titleShort; //LocaleModel
    public $horsepower;
    public $cubicCapacity;
    public $manufacturerCode;
    public $steering;
    public $cylinder;
    public $gearbox;
    public $gears;
    public $gearType;
    public $frontBrakes;
    public $rearBrakes;
    public $doors;
    public $fuel;
    public $firstRegistrationDate;
    public $numberOfPreviousOwner;
    public $chassisNumber;
    public $engineNumber;
    public $gearboxNumber;
    public $matchingNumbers;
    public $replica;
    public $converted;
    public $colorOutside;
    public $colorInside;
    public $manufacturerColorNameOutside; //LocaleModel
    public $manufacturerColorNameInside; //LocaleModel
    public $interiorMaterial;
    public $sunroof;
    public $electricWindows;
    public $foldingRoof;
    public $centralLocking;
    public $airbag;
    public $heatedSeats;
    public $abs;
    public $airconditioning;
    public $powerSteering;
    public $cruiseControl;
    public $price;
    public $priceCurrency;
    public $priceOnRequest;
    public $mileageUnit;
    public $mileageByUnit;
    public $vatReclaimable;
    public $location; //LocationModel
    public $standardImages = []; //array of ImageModel
    public $damageImages = []; //array of ImageModel
    public $restorationImages = []; //array of ImageModel
    public $embeddedVideoCode;
    public $description; // LocaleModel
    public $stateCategory;
    public $extras = []; // array of ImageModel
    public $report;
    public $reportMark;
    public $starsEngine;
    public $starsTechnik;
    public $starsPaint;
    public $starsInterior;
    public $licensed;
    public $readyToRide;
    public $milleMiglia;
    public $mainInspection;
    public $oldtimerLicensePlate;
    public $fiva;
    public $fia;
    public $accidentFree;
    public $mainInspectionUntil;
    public $files = []; //array of ImageModel
    public $contact; //ContactModel
    public $status;
    public $locale;
    public $datePublished;
    public $updatedAt;

    public function __construct($database)
    {
        parent::__construct($database);
        $this->car = new CarModel($database);
        $this->titleShort = new LocaleModel($database);
        $this->manufacturerColorNameOutside = new LocaleModel($database);
        $this->manufacturerColorNameInside = new LocaleModel($database);
        $this->location = new LocationModel($database);
        $this->contact = new ContactModel($database);
        $this->description = new LocationModel($database);
    }

    public function mapDataToObject(array $data): VehicleAdModel
    {
        $this->id = $data['id'] ?? null;
        $this->uid = $data['uid'] ?? null;
        $this->detailUrl = $data['detailUrl'] ?? null;
        $this->hasChanges = $data['hasChanges'] ?? null;
        $this->car->mapDataToObject($data['car'] ?? []);
        $this->yearOfProduction = $data['yearOfProduction'] ?? null;
        $this->titleShort->mapDataToObject($data['titleShort'] ?? []);
        $this->horsepower = $data['horsepower'] ?? null;
        $this->cubicCapacity = $data['cubicCapacity'] ?? null;
        $this->manufacturerCode = $data['manufacturerCode'] ?? null;
        $this->steering = $data['steering'] ?? null;
        $this->cylinder = $data['cylinder'] ?? null;
        $this->gearbox = $data['gearbox'] ?? null;
        $this->gears = $data['gears'] ?? null;
        $this->gearType = $data['gearType'] ?? null;
        $this->frontBrakes = $data['frontBrakes'] ?? null;
        $this->rearBrakes = $data['rearBrakes'] ?? null;
        $this->doors = $data['doors'] ?? null;
        $this->fuel = $data['fuel'] ?? null;
        $this->firstRegistrationDate = $data['firstRegistrationDate'] ?? null;
        $this->numberOfPreviousOwner = $data['numberOfPreviousOwner'] ?? null;
        $this->chassisNumber = $data['chassisNumber'] ?? null;
        $this->engineNumber = $data['engineNumber'] ?? null;
        $this->gearboxNumber = $data['gearboxNumber'] ?? null;
        $this->matchingNumbers = $data['matchingNumbers'] ?? null;
        $this->replica = $data['replica'] ?? null;
        $this->converted = $data['converted'] ?? null;
        $this->colorOutside = $data['colorOutside'] ?? null;
        $this->colorInside = $data['colorInside'] ?? null;
        $this->manufacturerColorNameOutside->mapDataToObject($data['manufacturerColorNameOutside'] ?? []);
        $this->manufacturerColorNameInside->mapDataToObject($data['manufacturerColorNameInside'] ?? []);
        $this->interiorMaterial = $data['interiorMaterial'] ?? null;
        $this->sunroof = $data['sunroof'] ?? null;
        $this->electricWindows = $data['electricWindows'] ?? null;
        $this->foldingRoof = $data['foldingRoof'] ?? null;
        $this->centralLocking = $data['centralLocking'] ?? null;
        $this->airbag = $data['airbag'] ?? null;
        $this->heatedSeats = $data['heatedSeats'] ?? null;
        $this->abs = $data['abs'] ?? null;
        $this->airconditioning = $data['airconditioning'] ?? null;
        $this->powerSteering = $data['powerSteering'] ?? null;
        $this->cruiseControl = $data['cruiseControl'] ?? null;
        $this->price = $data['price'] ?? null;
        $this->priceCurrency = $data['priceCurrency'] ?? null;
        $this->priceOnRequest = $data['priceOnRequest'] ?? null;
        $this->mileageUnit = $data['mileageUnit'] ?? null;
        $this->mileageByUnit = $data['mileageByUnit'] ?? null;
        $this->vatReclaimable = $data['vatReclaimable'] ?? null;
        $this->location->mapDataToObject($data['location'] ?? []);

        foreach ($data['standardImages'] ?? [] as $imageData) {
            $image = new ImageModel($this->db);
            $image->mapDataToObject($imageData);
            $this->standardImages[] = $image;
        }
        
        foreach ($data['damageImages'] ?? [] as $imageData) {
            $image = new ImageModel($this->db);
            echo 'titleShort: ', var_export($this->titleShort, true), "\n";
            $image->mapDataToObject($imageData);
            $this->damageImages[] = $image;
        }
        
        foreach ($data['restorationImages'] ?? [] as $imageData) {
            $image = new ImageModel($this->db);
            $image->mapDataToObject($imageData);
            $this->restorationImages[] = $image;
        }
        
        $this->embeddedVideoCode = $data['embeddedVideoCode'] ?? null;

        $this->description->mapDataToObject($data['description'] ?? []);
        $this->stateCategory = $data['stateCategory'] ?? null;

        foreach ($data['extras'] ?? [] as $imageData) {
            $image = new ImageModel($this->db);
            $image->mapDataToObject($imageData);
            $this->extras[] = $image;
        }

        $this->report = $data['report'] ?? null;
        $this->reportMark = $data['reportMark'] ?? null;
        $this->starsEngine = $data['starsEngine'] ?? null;
        $this->starsTechnik = $data['starsTechnik'] ?? null;
        $this->starsPaint = $data['starsPaint'] ?? null;
        $this->starsInterior = $data['starsInterior'] ?? null;
        $this->licensed = $data['licensed'] ?? null;
        $this->readyToRide = $data['readyToRide'] ?? null;
        $this->milleMiglia = $data['milleMiglia'] ?? null;
        $this->mainInspection = $data['mainInspection'] ?? null;
        $this->oldtimerLicensePlate = $data['oldtimerLicensePlate'] ?? null;
        $this->fiva = $data['fiva'] ?? null;
        $this->fia = $data['fia'] ?? null;
        $this->accidentFree = $data['accidentFree'] ?? null;
        $this->mainInspectionUntil = $data['mainInspectionUntil'] ?? null;

        foreach ($data['files'] ?? [] as $imageData) {
            $image = new ImageModel($this->db);
            $image->mapDataToObject($imageData);
            $this->files[] = $image;
        }

        $this->contact->mapDataToObject($data['contact'] ?? []);
        $this->status = $data['status'] ?? null;
        $this->locale = $data['locale'] ?? null;
        $this->datePublished = $data['datePublished'] ?? null;
        $this->updatedAt = $data['updatedAt'] ?? null;

        return $this;
    }

    public function getVehicleAdDetails($data): VehicleAdModel
    {
        return $this->mapDataToObject($data);
    }

}