<?php

use MyBook\Env;

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
        break;

    case 'WE':
        $WEDAO = new WorkExperienceDAO;
        $res = $WEDAO->fetch($id);
        break;

    case 'TH':
        $THDAO = new TechnologiesDAO;
        $res = $THDAO->fetch($id);
        break;

    case 'PR':
        $PRDAO = new ProjectDAO;
        $res = $PRDAO->fetch($id);
        break;

    case 'LA':
        $LADAO = new LanguageDAO;
        $res = $LADAO->fetch($id);
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


var_dump($res);

echo "

<main>
    <h1>Edition Forms</h1>

    <section>
        <div class='callout'>
            <form method='POST' action='/settings/edit$elem'>
                <label style='display: none;' for='_id'>ID</label>
                <input style='display: none;' type='int' id='_id' name='_id' value='$res->_id'>

                <label for='_name'>Name</label>
                <input type='text' id='_name' name='_name' value='$res->_name'>

                <label for='_icon'>Icon</label>
                <input type='text' id='_icon' name='_icon' value='$res->_icon'>

                <label for='_link'>Link</label>
                <input type='text' id='_link' name='_link' value='$res->_link'>

                <input type='submit' value='Submit'>
            </form>
        </div>
    </section>
</main>";
