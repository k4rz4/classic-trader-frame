<?php

return function($router) {
    $router->get('/bets/list', 'App\\Controllers\\MainController@getBets');
    $router->post('/bets/place', 'App\\Controllers\\MainController@placeBet');
    $router->post('/clients/validate', 'App\\Controllers\\MainController@validateClient');
    // Add more routes here...
};