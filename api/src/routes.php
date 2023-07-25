<?php
const CONTROLLERS_NS = 'App\\ClassicTrader\\Controllers\\';

return function($router) {
    $router->get('/vehicle-ad/{id}', CONTROLLERS_NS . 'VehicleAdController@getVehicleAdDetails');
    $router->post('/vehicle-ad/{id}/message', CONTROLLERS_NS . 'VehicleAdController@sendMessage');
    $router->post('/vehicle-ad/{id}/bookmark', CONTROLLERS_NS . 'VehicleAdController@saveBookmark');
};