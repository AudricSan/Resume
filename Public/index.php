<?php

// Use this namespace
use MyBook\Route;
use MyBook\Uuid;
use Random\Randomizer;

// Include class
include '../model/class/Route.php';
include '../model/class/env.php';

// Define a global basepath
define('BASEPATH', '/');

// This function just renders a simple header
function head()
{
  include_once('include/header.php');
}

function foot()
{
  include_once('include/footer.php');
}

//Base Route
Route::add('/', function () {
  head();
  include_once('../View/index.php');
  foot();
});

// ERROR
// 404 not found route
Route::pathNotFound(function ($path) {
  head();
  include('../view/error/404.php');
  foot();
});

// 405 method not allowed route
Route::methodNotAllowed(function ($path, $method) {
  head();
  include('../view/error/405.php');
  foot();
});
//

//This route is for debugging only
// Return all known routes
Route::add('/routes', function () {
  $routes = Route::getAll();
  echo '<ul>';
  foreach ($routes as $route) {
    echo '<li>' . $route['expression'] . ' (' . $route['method'] . ')</li>';
  }
  echo '</ul>';
});

Route::add('/UUID', function () {
  include_once('../Model/class/uuid.php');
  $uuid = new Uuid;

  $myuuid['V1'] = $uuid->v1();
  $myuuid['V2'] = $uuid->v2();
  $myuuid['V3'] = $uuid->v3($_GET['n']);
  $myuuid['V4'] = $uuid->v4();
  $myuuid['V5'] = $uuid->v5($_GET['n']);

  var_dump($myuuid);
});
//

// Run the Router with the given Basepath
Route::run(BASEPATH);
// Activez le mode sensible à la casse, les barres obliques de fin de ligne et le mode de correspondance multiple en définissant les paramètres à true.
// Route::run(BASEPATH, true, true, true) ;