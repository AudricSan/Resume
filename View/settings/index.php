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
?>

<main>
    <h1>Books settings</h1>

    <section>
        <h2><i class="fa-solid fa-square-phone"></i> Contact information <button onclick="addfomrs(this)" class="add"> Add </button></h2>

        <div class="callout">
            <form class='hidden' method='POST' action='/settings/addInfo'>
                <label style="display: none;" for='_id'>ID</label>
                <input style="display: none;" type='int' id='_id' name='_id'>

                <label for='_name'>Name</label>
                <input type='text' id='_name' name='_name'>

                <label for='_icon'>Icon</label>
                <input type='text' id='_icon' name='_icon'>

                <label for='_link'>Link</label>
                <input type='text' id='_link' name='_link'>

                <input type='submit' value='Submit'>
            </form>
        </div>

        <?php
        $CIDAO        = new ContatInfoDAO;
        $contactInfos = $CIDAO->fetchAll(); ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Icon</th>
                    <th>Link</th>
                    <th>EDIT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($contactInfos as $contactInfo) {
                    $icon = $Env->isicon($contactInfo->_icon);
                    echo "
                        <tr>
                            <td> $contactInfo->_name </td>";
                    if ($icon) {
                        $explode = explode(',', $contactInfo->_icon);
                        $fa      = $Env->checkInput($explode[1]);
                        $icon    = $Env->checkInput($explode[0]);
                        echo "<td><i class='fa-$fa $icon'></i> $contactInfo->_icon </td>";
                    } else {
                        echo "<td><img class='icon' src='images/icon/$contactInfo->_icon.svg' title='icon for $contactInfo->_name' /> </td>";
                    }
                    echo " 
                            <td> $contactInfo->_link </td>
                            <td>
                                <a href='/edit?id=$contactInfo->_id&elem=CI'> <button class='edit'> edit </button></a>
                                <a href='/settings/removeCI?id=$contactInfo->_id'  > <button class='remove' > remove </button></a>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2><i class="fa-solid fa-person-digging"></i> Work experience <button onclick="addfomrs(this)" class="add"> Add
            </button> </h2>

        <?php
        $citiesDAO = new CitiesDAO;
        $cities    = $citiesDAO->fetchAll();
        ?>

        <div class="callout">
            <form class='hidden' method='POST' action='/settings/addWork'>
                <label for='_name'>Name</label>
                <input type='text' id='_name' name='_name'>

                <label for='_description'>Description</label>
                <input type='text' id='_description' name='_description'>

                <label for='_icon'>Icon</label>
                <input type='text' id='_icon' name='_icon'>

                <label for='_city'>City</label>
                <select id="_city" name="_city">
                    <?php foreach ($cities as $city) {
                        echo "<option value='$city->_id'>$city->_name - $city->_country</option>";
                    } ?>
                </select>

                <label for='_start'>Start</label>
                <input type='date' id='_start' name='_start'>

                <label for='_end'>End</label>
                <input type='date' id='_end' name='_end'>

                <input type='submit' value='Submit'>
            </form>
        </div>

        <?php
        $WEDAO           = new WorkExperienceDAO;
        $workExperienses = $WEDAO->fetchAll(); ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Icon</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>EDIT</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($workExperienses as $workExperiense) {
                    $icon = $Env->isicon($workExperiense->_icon);
                    echo "
                    <tr>
                        <td> $workExperiense->_name </td>
                        <td> $workExperiense->_description </td>";
                    if ($icon) {
                        $explode = explode(',', $workExperiense->_icon);
                        $fa      = $Env->checkInput($explode[1]);
                        $icon    = $Env->checkInput($explode[0]);
                        echo "<td><i class='fa-$fa $icon'></i> $workExperiense->_icon </td>";
                    } else {
                        echo "<td><img class='icon' src='images/icon/$workExperiense->_icon.svg' title='icon for $workExperiense->_name' /> </td>";
                    }
                    echo " 
                        <td> $workExperiense->_city </td>
                        <td> $workExperiense->_country </td>
                        <td> $workExperiense->_start </td>
                        <td> $workExperiense->_end </td>
                        <td>
                            <a href='/edit?id=$workExperiense->_id&elem=WE'> <button class='edit'> edit </button></a>
                            <a href='/settings/removeWE?id=$workExperiense->_id'> <button class='remove'> remove </button></a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2><i class="fa-solid fa-desktop"></i> Technology <button onclick="addfomrs(this)" class="add"> Add </button>
        </h2>

        <?php
        $TechLevelDAO = new TechnologyLevelDAO;
        $TechLevels   = $TechLevelDAO->fetchAll();
        ?>

        <div class="callout">
            <form class='hidden' method='POST' action='/settings/addTech'>
                <label for='_name'>Name</label>
                <input type='text' id='_name' name='_name'>

                <label for='_description'>Description</label>
                <input type='text' id='_description' name='_description'>

                <label for='_icon'>Icon</label>
                <input type='text' id='_icon' name='_icon'>

                <label for='_level'>Level</label>
                <select id="_level" name="_level">
                    <?php foreach ($TechLevels as $TechLevel) {
                        echo "<option value='$TechLevel->_id'>$TechLevel->_name</option>";
                    } ?>
                </select>

                <input type='submit' value='Submit'>
            </form>
        </div>

        <?php
        $TechDAO      = new TechnologiesDAO;
        $technologies = $TechDAO->fetchAll(); ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Icon</th>
                    <th>Level</th>
                    <th>EDIT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($technologies as $technology) {
                    $icon = $Env->isicon($technology->_icon);
                    echo "
                        <tr>
                            <td> $technology->_name </td>
                            <td> $technology->_desc </td>";
                    if ($icon) {
                        $explode = explode(',', $technology->_icon);
                        $fa      = $Env->checkInput($explode[1]);
                        $icon    = $Env->checkInput($explode[0]);
                        echo "<td><i class='fa-$fa $icon'></i> $technology->_icon </td>";
                    } else {
                        echo "<td><img class='icon' src='images/icon/$technology->_icon.svg' title='icon for $technology->_name' /> $technology->_icon </td>";
                    }
                    echo "
                            <td> $technology->_level </td>
                            <td>
                                <a href='/edit?id=$technology->_id&elem=TH'> <button class='edit'> edit </button></a>
                                <a href='/settings/removeTechno?id=$technology->_id'> <button class='remove'> remove </button></a>
                            </td>
                        </tr>";
                } ?>
            </tbody>
        </table>
    </section>

    <section>

        <h2><i class="fa-solid fa-satellite"></i> Projets <button onclick="addfomrs(this)" class="add"> Add </button>
        </h2>

        <div class="callout">
            <form class='hidden' method='POST' action='/settings/addProject'>
                <label for='_name'>Name</label>
                <input type='text' id='_name' name='_name'>

                <label for='_description'>Description</label>
                <input type='text' id='_description' name='_description'>

                <label for='_icon'>Icon</label>
                <input type='text' id='_icon' name='_icon'>

                <label for='_link'>Link</label>
                <input type='text' id='_link' name='_link'>
                <div>
                    <?php
                    $TDAO         = new TechnologiesDAO;
                    $technologies = $TDAO->fetchAll();
                    foreach ($technologies as $technologie) {
                        echo "
                        <label for='$technologie->_id'>$technologie->_name</label>
                        <input type='checkbox' id='$technologie->_id' name='techID=$technologie->_id' value='$technologie->_id'>";
                    }
                    ?>
                </div>
                <input type='submit' value='Submit'>
            </form>
        </div>

        <?php
        $PRDAO    = new ProjectDAO;
        $projects = $PRDAO->fetchAll();
        ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Icon</th>
                    <th>link</th>
                    <th>Tecno</th>
                    <th>EDIT</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($projects) {
                    foreach ($projects as $project) {
                        $icon = $Env->isicon($project->_icon);

                        echo "
                            <tr>
                                <td> $project->_name </td>
                                <td> $project->_desc </td>";
                        if ($icon) {
                            $explode = explode(',', $project->_icon);
                            $fa      = $Env->checkInput($explode[1]);
                            $icon    = $Env->checkInput($explode[0]);
                            echo "<td><i class='fa-$fa $icon'></i> $project->_icon </td>";
                        } else {
                            echo "<td><img class='icon' src='images/icon/$project->_icon.svg' title='icon for $project->_name' /> $project->_icon.svg </td>";
                        }
                        echo "
                                <td> $project->_link </td>
                                <td>";

                        foreach ($project->_techno as $key => $value) {
                            echo $value->_name . ',';
                        }
                        echo " 
                                </td>
                                <td>
                                    <a href='/edit?id=$project->_id&elem=PR'> <button class='edit'> edit </button></a>
                                    <a href='/settings/removeProject?id=$project->_id'> <button class='remove'> remove </button></a>
                                </td>
                            </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2><i class="fa-solid fa-comment-dots"></i> Languages <button onclick="addfomrs(this)" class="add"> Add
            </button> </h2>

        <div class="callout">
            <form class='hidden' method='POST' action='/settings/addalanguage'>
                <?php
                $LLDAO          = new LanguageLevelDAO;
                $languageLevels = $LLDAO->fetchAll();

                $LDAO      = new LanguageDAO;
                $languages = $LDAO->fetchAll();
                ?>

                <label for='_language'>Level</label>
                <select id="_language" name="_language">
                    <?php foreach ($languages as $language) {
                        echo "<option value='$language->_id'>$language->_name</option>";
                    } ?>
                </select>

                <label for='_level'>Level</label>
                <select id="_level" name="_level">
                    <?php foreach ($languageLevels as $languageLevel) {
                        echo "<option value='$languageLevel->_id'>$languageLevel->_name</option>";
                    } ?>
                </select>

                <input type='submit' value='Submit'>
            </form>
        </div>

        <?php
        $SELDAO    = new SelectedLanguageDAO();
        $languages = $SELDAO->fetchAll(); ?>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>level</th>
                    <th>EDIT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($languages as $language) {
                    echo "
                        <tr>
                            <td> $language->_language</td>
                            <td> $language->_level </td>
                            <td>
                                <a href='/edit?id=$language->_id&elem=LA'> <button class='edit'> edit </button></a>
                                <a href='/settings/removelanguage?id=$language->_id'> <button class='remove'> remove </button></a>
                            </td>
                        </tr>";
                } ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2><i class="fa-solid fa-chalkboard-user"></i> Education <button onclick="addfomrs(this)" class="add"> Add
            </button> </h2>

        <div class="callout">
            <form class='hidden' method='POST' action='/settings/addeducation'>
                <label for='_name'>Name</label>
                <input type='text' id='_name' name='_name'>

                <label for='_school'>School</label>
                <input type='text' id='_school' name='_school'>

                <label for='_start'>Start</label>
                <input type='date' id='_start' name='_start'>

                <label for='_end'>End</label>
                <input type='date' id='_end' name='_end'>

                <label for='_city'>City</label>
                <select id="_city" name="_city">
                    <?php foreach ($cities as $city) {
                        echo "<option value='$city->_id'>$city->_name - $city->_country</option>";
                    } ?>
                </select>

                <?php
                $ELDAO  = new EducationLevelDAO;
                $levels = $ELDAO->fetchAll();
                ?>

                <label for='_level'>Level</label>
                <select id="_level" name="_level">
                    <?php foreach ($levels as $level) {
                        echo "<option value='$level->_id'>$level->_name</option>";
                    } ?>
                </select>

                <input type='submit' value='Submit'>
            </form>
        </div>

        <?php
        $EDDAO      = new EducationDAO();
        $educations = $EDDAO->fetchAll(); ?>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>school</th>
                    <th>start</th>
                    <th>end</th>
                    <th>city</th>
                    <th>country</th>
                    <th>level</th>
                    <th>EDIT</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($educations as $education) {
                    echo "
                        <tr>
                            <td> $education->_name </td>
                            <td> $education->_school </td>
                            <td> $education->_start </td>
                            <td> $education->_end </td>
                            <td> $education->_city </td>
                            <td> $education->_country </td>
                            <td> $education->_level </td>
                            <td>
                                <a href='/edit?id=$education->_id&elem=ED'> <button class='edit'> edit </button></a>
                                <a href='/settings/removeEducation?id=$education->_id'> <button class='remove'> remove </button></a>
                            </td>
                        </tr>";
                } ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2><i class="fa-solid fa-graduation-cap"></i> Licence</h2>
        <table>
            <thead>
                <tr>
                    <th>Level</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($educations as $education) {
                    echo "
                        <tr>
                            <td> $education->_level </td>
                            <td> $education->_name </td>
                        </tr>";
                } ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2><i class="fa-solid fa-lightbulb"></i> Point of Interest <button onclick="addfomrs(this)" class="add">
                Add</button> </h2>

        <div class="callout">
            <form class='hidden' method='POST' action='/settings/addPOI'>
                <label for='_name'>Name</label>
                <input type='text' id='_name' name='_name'>

                <label for='_icon'>Icon</label>
                <input type='text' id='_icon' name='_icon'>

                <input type='submit' value='Submit'>
            </form>
        </div>

        <?php
        $POIDAO           = new PointOfInterestDAO();
        $pointOfInterests = $POIDAO->fetchAll(); ?>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>icon</th>
                    <th>EDIT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($pointOfInterests as $pointOfInterest) {
                    $icon = $Env->isicon($pointOfInterest->_icon);
                    echo "
                        <tr>
                            <td> $pointOfInterest->_name </td>";
                    if ($icon) {
                        $explode = explode(',', $pointOfInterest->_icon);
                        $fa      = $Env->checkInput($explode[1]);
                        $icon    = $Env->checkInput($explode[0]);
                        echo "<td><i class='fa-$fa $icon'></i> $pointOfInterest->_icon </td>";
                    } else {
                        echo "<td><img class='icon' src='images/icon/$technology->_icon.svg' title='icon for $technology->_name' /> $technology->_icon </td>";
                    }
                    echo "
                            <td>
                                <a href='/edit?id=$pointOfInterest->_id&elem=PO'> <button class='edit'> edit </button></a>
                                <a href='/settings/removePOI?id=$pointOfInterest->_id'> <button class='remove'> remove </button></a>
                            </td>
                        </tr>";
                } ?>
            </tbody>
        </table>
    </section>
</main>