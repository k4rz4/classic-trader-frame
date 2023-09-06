# ClassicTrader App
----------
This repository contains the ClassicTrader App, a web application built with vanilla PHP. This framework is a rework of a previous project [LogilotoGame](https://github.com/k4rz4/logilotto-game). This project is part of a technical interview process.

## Overview

The ClassicTrader App is a vehicle trading platform where users can view details about various vehicles, including images, descriptions, and other relevant information. The application is structured following the MVC (Model-View-Controller) pattern, which separates the application logic into three interconnected components.

## Structure

The application is divided into several key components:

- **Models**: These are responsible for handling data and business logic. Each model represents a specific entity (e.g., Vehicle, Image, Contact) and contains methods for manipulating these entities' data.

- **Controllers**: These act as an interface between Models and Responses. They handle user requests, interact with the Models to retrieve/update data, and pass the data to the Response.

- **Core**: This contains the base classes for Models and Controllers, as well as other core functionalities like database connection and request handling.

- **Services**: These are used to handle specific business logic that doesn't belong in the Models or Controllers. For example, the VehicleAdService handles operations related to vehicle advertisements.

- **Helpers**: These are utility classes or functions that provide common functionality needed across the application. For example, the Helper class contains a method for converting objects to arrays.

- **Http**: This directory contains classes responsible for handling HTTP requests and responses, including routing and dispatching requests to the appropriate controller.

Here is the directory structure of the application:

```
.
├── api
│   ├── config
│   │   └── config.ini
│   ├── Controllers
│   │   ├── MainController.php
│   │   └── VehicleAdController.php
│   ├── Core
│   │   ├── ControllerFactory.php
│   │   ├── Controller.php
│   │   ├── Database.php
│   │   ├── HttpClient.php
│   │   ├── Logger.php
│   │   ├── Model.php
│   │   ├── Service.php
│   │   └── Validator.php
│   ├── Helper
│   │   └── Helper.php
│   ├── Http
│   │   ├── Dispatcher.php
│   │   ├── IRequest.php
│   │   ├── Request.php
│   │   ├── Response.php
│   │   └── Router.php
│   ├── Models
│   │   ├── CarModel.php
│   │   ├── ContactModel.php
│   │   ├── ImageModel.php
│   │   ├── LocaleModel.php
│   │   ├── LocationModel.php
│   │   └── VehicleAdModel.php
│   ├── public
│   │   └── index.php
│   ├── Services
│   │   └── VehicleAdService.php
│   └── src
│       ├── core.php
│       └── routes.php
├── composer.json
├── composer.lock
├── db
│   └── migrations
│       └── 20230724131357_my_new_migration.php
├── docker-compose.yml
├── Dockerfile
├── logs
│   └── app.log
├── phinx.yml
├── phpunit.xml
├── readme.md
└── tests
    └── myTest.php
```
## Available Routes

The application defines several routes for handling HTTP requests. Here is a list of the available routes:

- `GET /vehicle-ad/{id}`: This route is used to retrieve the details of a specific vehicle ad. The `{id}` parameter in the URL should be replaced with the ID of the vehicle ad you want to retrieve.

- `POST /vehicle-ad/{id}/message`: This route is used to send a message related to a specific vehicle ad. The `{id}` parameter in the URL should be replaced with the ID of the vehicle ad you are sending a message about. The message content should be included in the body of the POST request.

- `POST /vehicle-ad/{id}/bookmark`: This route is used to save a specific vehicle ad as a bookmark. The `{id}` parameter in the URL should be replaced with the ID of the vehicle ad you want to bookmark.

Here is the code snippet that defines these routes:

```php
return function($router) {
    $router->get('/vehicle-ad/{id}', CONTROLLERS_NS . 'VehicleAdController@getVehicleAdDetails');
    $router->post('/vehicle-ad/{id}/message', CONTROLLERS_NS . 'VehicleAdController@sendMessage');
    $router->post('/vehicle-ad/{id}/bookmark', CONTROLLERS_NS . 'VehicleAdController@saveBookmark');
};
```

To use these routes, you need to make HTTP requests to the corresponding URLs. You can use any HTTP client to do this, such as `curl` or Postman.
## Usage

To use the application, navigate to the root of the project:

```bash
$ docker-compose up --build
```

Then, open your web browser and navigate to `http://localhost:8080/vehicle-ad/{id}` 

## License

This project is licensed under the MIT License.
