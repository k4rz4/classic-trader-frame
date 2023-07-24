<?php
const CONTROLLERS_NS = 'App\\ClassicTrader\\Controllers\\';

return function($router) {
    $router->get('/vehicle-ad/{id}', CONTROLLERS_NS . 'VehicleAdController@getVehicleAdDetails');
};