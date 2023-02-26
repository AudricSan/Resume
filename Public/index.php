<?php

// Use this namespace
use MyBook\Route;
use MyBook\Uuid;
use Random\Randomizer;

// Include ENV class
include_once('../model/class/Route.php');
include_once('../model/class/Uuid.php');
include_once('../model/class/Env.php');

// Class & DAO
include_once('../model/class/Admin.php');
include_once('../model/dao/AdminDAO.php');

include_once('../model/class/ContactInfo.php');
include_once('../model/dao/ContatInfoDAO.php');

include_once('../model/class/WorkExperience.php');
include_once('../model/dao/WorkExperienceDAO.php');

include_once('../model/class/technologies.php');
include_once('../model/dao/technologiesDAO.php');

include_once('../model/class/project.php');
include_once('../model/dao/projectDAO.php');

include_once('../model/class/SelectedLanguage.php');
include_once('../model/dao/SelectedLanguageDAO.php');

include_once('../model/class/Education.php');
include_once('../model/dao/EducationDAO.php');

include_once('../model/class/PointOfInterest.php');
include_once('../model/dao/PointOfInterestDAO.php');

include_once('../model/class/city.php');
include_once('../model/dao/citiesDAO.php');

include_once('../model/class/TechnologyLevel.php');
include_once('../model/dao/TechnologyLevelDAO.php');

// Define a global basepath
define('BASEPATH', '/');
session_start();

// This function just renders a simple header
function head() {
  include_once('include/header.php');
}

function foot() {
  include_once('include/footer.php');
}

//Base Route
Route::add('/', function () {
  head();
  include_once('../View/index.php');
  foot();
});

Route::add('/settings', function () {
  head();
  include_once('../View/Settings/index.php');
  foot();
});

Route::add('/settings/login', function () {
  head();
  include_once('../View/Settings/login.php');
  foot();
});

Route::add('/settings/log', function () {
  head();
  $adminDAO = new AdminDAO;
  $adminDAO->login($_POST);
  foot();
}, 'post');

// SETTINGS ADD
Route::add('/settings/addInfo', function () {
  $CIDAO = new ContatInfoDAO;
  $CIDAO->store($_POST);
}, 'post');

Route::add('/settings/addWork', function () {
  $WEDAO = new WorkExperienceDAO;
  $WEDAO->store($_POST);
}, 'post');

Route::add('/settings/addTech', function () {
  $TechDAO = new TechnologiesDAO;
  $TechDAO->store($_POST);
}, 'post');

// Settings Edit
Route::add('/settings/editinfo', function () {
  $CIDAO = new ContatInfoDAO;
  $CIDAO->update(1, $_GET);
}, 'get');

// Setting Remove
Route::add('/settings/removeinfo', function () {
  $CIDAO = new ContatInfoDAO;
  $CIDAO->delete($_GET);
}, 'get');

Route::add('/settings/removeWE', function () {
  $WEDAO = new WorkExperienceDAO;
  $WEDAO->delete($_GET);
}, 'get');

Route::add('/settings/removeTechno', function () {
  $TechDAO = new TechnologiesDAO;
  $TechDAO->delete($_GET);
}, 'get');

Route::add('/settings/removeProject', function () {
  $PRDAO = new ProjectDAO;
  $PRDAO->delete($_GET);
}, 'get');

Route::add('/settings/removelanguage', function () {
  $SELDAO = new SelectedLanguageDAO;
  $SELDAO->delete($_GET);
}, 'get');

Route::add('/settings/removeEducation', function () {
  $EDDAO = new EducationDAO;
  $EDDAO->delete($_GET);
}, 'get');

Route::add('/settings/removePOI', function () {
  $POIDAO = new PointOfInterestDAO;
  $POIDAO->delete($_GET);
}, 'get');







































// ERROR ROUTE
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