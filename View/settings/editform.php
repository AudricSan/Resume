<?php

use MyBook\Env;
use MyBook\PhpFormBuilder;

$Env = new Env;

if (!isset($_SESSION['logged'])) {
    header('location: /settings/login');
    die;
} else {
    $adminDAO       = new AdminDAO;
    $adminConnected = $adminDAO->validate($_SESSION['logged'], $_SESSION['uuid']);
    if (!$adminConnected) {
        unset($_SESSION['logged']);
        header('location: /');
        die;
    }
}

$elem = $_GET['elem'];
$id = $_GET['id'];

switch ($elem) {
    case 'CI':
        $CIDAO = new ContatInfoDAO;
        $res = $CIDAO->fetch($id);

        $new_form = new PhpFormBuilder('/settings/edit' . $elem);
        $new_form->add_input('ID',   array('type' => 'int',  'id' => '_id', 'name' => '_id', 'value' => $id, 'wrap_style' => 'display: none'));
        $new_form->add_input('Name', array('type' => 'text', 'id' => '_name', 'name' => '_name', 'value' => $res->_name));
        $new_form->add_input('Icon', array('type' => 'text', 'id' => '_icon', 'name' => '_icon', 'value' => $res->_icon));
        $new_form->add_input('Link', array('type' => 'text', 'id' => '_link', 'name' => '_link', 'value' => $res->_link));
        $new_form->build_form();
        break;

    case 'WE':
        $WEDAO = new WorkExperienceDAO;
        $res = $WEDAO->fetch($id);

        $citiesDAO = new CitiesDAO;
        $cities    = $citiesDAO->fetchAll();

        $options = array();
        foreach ($cities as $city) {
            $options[$city->_id] = $city->_name;
        }

        $new_form = new PhpFormBuilder('/settings/edit' . $elem);
        $new_form->add_input('ID',   array('type' => 'int',  'id' => '_id', 'name' => '_id', 'value' => $id, 'wrap_style' => 'display: none'));
        $new_form->add_input('Name', array('type' => 'text', 'id' => '_name', 'name' => '_name', 'value' => $res->_name));
        $new_form->add_input('Description', array('type' => 'text', 'id' => '_description', 'name' => '_description', 'value' => $res->_description));
        $new_form->add_input('Icon', array('type' => 'text', 'id' => '_icon', 'name' => '_icon', 'value' => $res->_icon));
        $new_form->add_input('cities', array('type' => 'select', 'options' => $options, 'id' => '_cities', 'name' => '_cities'));
        $new_form->add_input('Start', array('type' => 'date', 'id' => '_start', 'name' => '_start', 'value' => $res->_start));
        $new_form->add_input('End', array('type' => 'date', 'id' => '_end', 'name' => '_end', 'value' => $res->_end));
        $new_form->build_form();
        break;

    case 'TH':
        $THDAO = new TechnologiesDAO;
        $res = $THDAO->fetch($id);

        $TechLevelDAO = new TechnologyLevelDAO;
        $TechLevels   = $TechLevelDAO->fetchAll();

        $options = array();
        foreach ($TechLevels as $TechLevel) {
            $options[$TechLevel->_id] = $TechLevel->_name;
        }

        $new_form = new PhpFormBuilder('/settings/edit' . $elem);
        $new_form->add_input('ID',   array('type' => 'int',  'id' => '_id', 'name' => '_id', 'value' => $id, 'wrap_style' => 'display: none'));
        $new_form->add_input('Name', array('type' => 'text', 'id' => '_name', 'name' => '_name', 'value' => $res->_name));
        $new_form->add_input('Description', array('type' => 'text', 'id' => '_desc', 'name' => '_desc', 'value' => $res->_desc));
        $new_form->add_input('Icon', array('type' => 'text', 'id' => '_icon', 'name' => '_icon', 'value' => $res->_icon));
        $new_form->add_input('Level', array('type' => 'select', 'options' => $options, 'id' => '_Level', 'name' => '_Level'));
        $new_form->build_form();
        break;

    case 'PR':
        $PRDAO = new ProjectDAO;
        $res = $PRDAO->fetch($id);

        $TDAO         = new TechnologiesDAO;
        $technologies = $TDAO->fetchAll();
        foreach ($technologies as $technologie) {
            $options[$technologie->_id] = $technologie->_name;
        }

        $new_form = new PhpFormBuilder('/settings/edit' . $elem);
        $new_form->add_input('ID',   array('type' => 'int',  'id' => '_id', 'name' => '_id', 'value' => $id, 'wrap_style' => 'display: none'));
        $new_form->add_input('Name', array('type' => 'text', 'id' => '_name', 'name' => '_name', 'value' => $res->_name));
        $new_form->add_input('Description', array('type' => 'text', 'id' => '_desc', 'name' => '_desc', 'value' => $res->_desc));
        $new_form->add_input('Icon', array('type' => 'text', 'id' => '_icon', 'name' => '_icon', 'value' => $res->_icon));
        $new_form->add_input('Link', array('type' => 'text', 'id' => '_link', 'name' => '_link', 'value' => $res->_link));
        $new_form->add_input('Techonlogies', array('type' => 'checkbox', 'options' => $options, 'id' => 'techID', 'name' => 'techID'));
        $new_form->build_form();
        break;

    case 'LA':
        $LDAO = new LanguageDAO;
        $language = $LDAO->fetchByName($id);

        $SLDAO = new SelectedLanguageDAO;
        $res = $SLDAO->fetchByLanguage($language->_id);

        $LLDAO          = new LanguageLevelDAO;
        $languageLevels = $LLDAO->fetchAll();

        foreach ($languageLevels as $languageLevel) {
            $options[$languageLevel->_id] = $languageLevel->_name;
        }

        $new_form = new PhpFormBuilder('/settings/edit' . $elem);
        $new_form->add_input('ID',   array('type' => 'int',  'id' => '_id', 'name' => '_id', 'value' => $res->_id, 'wrap_style' => 'display: none'));
        $new_form->add_input('Language', array('type' => 'text', 'id' => '_language', 'name' => '_language', 'value' => $res->_language));
        $new_form->add_input('Level', array('type' => 'select', 'options' => $options, 'id' => '_level', 'name' => '_level'));
        $new_form->build_form();
        break;

    case 'ED':
        $EDAO = new EducationDAO;
        // $res = $EDAO->fetch($id);
        break;

    case 'PO':
        $PODAO = new PointOfInterestDAO;
        // $res = $PODAO->fetch($id);
        break;

    default:
        header('location: /settings');
        die();
}
