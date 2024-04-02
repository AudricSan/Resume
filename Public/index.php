<?php

// Use this namespace
use MyBook\Route;
use MyBook\Uuid;
use MyBook\Env;
use MyBook\PhpFormBuilder;

// Include ENV class
include_once("../model/class/Route.php");
include_once("../model/class/Uuid.php");
include_once("../model/class/Env.php");
include_once("../model/class/FormsBuilder.php");

// Class & DAO
include_once("../model/class/Admin.php");
include_once("../model/dao/AdminDAO.php");

include_once("../model/class/ContactInfo.php");
include_once("../model/dao/ContatInfoDAO.php");

include_once("../model/class/WorkExperience.php");
include_once("../model/dao/WorkExperienceDAO.php");

include_once("../model/class/Technologies.php");
include_once("../model/dao/TechnologiesDAO.php");

include_once("../model/class/Project.php");
include_once("../model/dao/ProjectDAO.php");

include_once("../model/class/SelectedLanguage.php");
include_once("../model/dao/SelectedLanguageDAO.php");

include_once("../model/class/Education.php");
include_once("../model/dao/EducationDAO.php");

include_once("../model/class/PointOfInterest.php");
include_once("../model/dao/PointOfInterestDAO.php");

include_once("../model/class/City.php");
include_once("../model/dao/CitiesDAO.php");

include_once("../model/class/TechnologyLevel.php");
include_once("../model/dao/TechnologyLevelDAO.php");

include_once("../model/class/TechnologyUse.php");
include_once("../model/dao/TechnologyUseDAO.php");

include_once("../model/class/LanguageLevel.php");
include_once("../model/dao/LanguageLevelDAO.php");

include_once("../model/class/Language.php");
include_once("../model/dao/LanguageDAO.php");

include_once("../model/class/EducationLevel.php");
include_once("../model/dao/EducationLevelDAO.php");

// Define a global basepath
define("BASEPATH", "/");
session_start();

// This function just renders a simple header
function head() {
  include_once("include/header.php");
}

function foot() {
  include_once("include/footer.php");
}

//Base Route
Route::add("/", function () {
  head();
  include_once("../view/index.php");
  foot();
});

Route::add("/settings", function () {
  head();
  include_once("../view/settings/index.php");
  foot();
});

Route::add("/settings/login", function () {
  head();
  include_once("../view/settings/login.php");
  foot();
});

Route::add("/settings/log", function () {
  head();
  $adminDAO = new AdminDAO;
  $adminDAO->login($_POST);
  foot();
}, "post");

// SETTINGS ADD
Route::add("/settings/addInfo", function () {
  $CIDAO = new ContatInfoDAO;
  $CIDAO->store($_POST);
}, "post");

Route::add("/settings/addWork", function () {
  $WEDAO = new WorkExperienceDAO;
  $WEDAO->store($_POST);
}, "post");

Route::add("/settings/addTech", function () {
  $TechDAO = new TechnologiesDAO;
  $TechDAO->store($_POST);
}, "post");

Route::add("/settings/addProject", function () {
  $proDAO = new ProjectDAO;
  $proDAO->store($_POST);
}, "post");

Route::add("/settings/addalanguage", function () {
  $LangDAO = new SelectedLanguageDAO;
  $LangDAO->store($_POST);
}, "post");

Route::add("/settings/addeducation", function () {
  $EDAO = new EducationDAO;
  $EDAO->store($_POST);
}, "post");

Route::add("/settings/addPOI", function () {
  $POIDAO = new PointOfInterestDAO;
  $POIDAO->store($_POST);
}, "post");

// Setting Remove
Route::add("/settings/removeCI", function () {
  $CIDAO = new ContatInfoDAO;
  $CIDAO->delete($_GET);
}, "get");

Route::add("/settings/removeWE", function () {
  $WEDAO = new WorkExperienceDAO;
  $WEDAO->delete($_GET);
}, "get");

Route::add("/settings/removeTechno", function () {
  $TechDAO = new TechnologiesDAO;
  $TechDAO->delete($_GET);
}, "get");

Route::add("/settings/removeProject", function () {
  $PRDAO = new ProjectDAO;
  $PRDAO->delete($_GET);
}, "get");

Route::add("/settings/removelanguage", function () {
  $SELDAO = new SelectedLanguageDAO;
  $SELDAO->delete($_GET);
}, "get");

Route::add("/settings/removeEducation", function () {
  $EDDAO = new EducationDAO;
  $EDDAO->delete($_GET);
}, "get");

Route::add("/settings/removePOI", function () {
  $POIDAO = new PointOfInterestDAO;
  $POIDAO->delete($_GET);
}, "get");

// Setting Edit
Route::add("/edit", function () {
  head();
  include_once("../view/settings/editform.php");
  foot();
});

Route::add("/settings/editCI", function () {
  $CIDAO = new ContatInfoDAO;
  $CIDAO->update($_POST['_id'], $_POST);
}, 'post');

Route::add("/settings/editWE", function () {
  $WEDAO = new WorkExperienceDAO;
  $WEDAO->update($_POST['_id'], $_POST);
}, 'post');

Route::add("/settings/editTH", function () {
  $THDAO = new TechnologiesDAO;
  $THDAO->update($_POST['_id'], $_POST);
}, 'post');

Route::add("/settings/editPR", function () {
  $PRDAO    = new ProjectDAO;
  $PRDAO->update($_POST['_id'], $_POST);
}, 'post');













// ERROR ROUTE
// 404 not found route
Route::pathNotFound(function ($path) {
  head();
  include("../view/error/404.php");
  foot();
});

// 405 method not allowed route
Route::methodNotAllowed(function ($path, $method) {
  head();
  include("../view/error/405.php");
  foot();
});
//

//This route is for debugging only
// Return all known routes
Route::add("/routes", function () {
  $routes = Route::getAll();
  echo "<ul>";
  foreach ($routes as $route) {
    echo "<li>" . $route["expression"] . " (" . $route["method"] . ")</li>";
  }
  echo "</ul>";
});

Route::add("/test", function () {
  head();
  include_once("../view/test.php");
  foot();
});

Route::add("/UUID", function () {
  include_once("../Model/class/uuid.php");
  $uuid = new Uuid;

  $myuuid["V1"] = $uuid->v1();
  $myuuid["V2"] = $uuid->v2();
  $myuuid["V3"] = $uuid->v3($_GET["n"]);
  $myuuid["V4"] = $uuid->v4();
  $myuuid["V5"] = $uuid->v5($_GET["n"]);

  var_dump($myuuid);
});
//

// Run the Router with the given Basepath
Route::run(BASEPATH);
// Activez le mode sensible à la casse, les barres obliques de fin de ligne et le mode de correspondance multiple en définissant les paramètres à true.
// Route::run(BASEPATH, true, true, true) ;