<?php
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

<div class="toggleDiv">
    <input id="toggle" class="toggle" type="checkbox" onclick=darkmode()>
</div>

<main>
    <h1>Books settings</h1>

    <section>
        <h2><i class="fa-solid fa-globe"></i> Resume - Title <button onclick="addfomrs(this)" class="add"> Add </button>
        </h2>

        <div class="callout">
            <form class='hidden' method='POST' action='/settings/addTitle'>
                <label for='_title'>Title</label>
                <input type='textarea' id='_title' name='_title'>

                <input type='submit' value='Submit'>
            </form>
        </div>

        <?php
        $TDAO        = new TitlelDAO;
        $titles = $TDAO->fetchAll(); ?>
        <table>
            <thead>
                <tr>
                    <th>Content</th>
                    <th>EDIT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($titles as $title) {
                    echo "
                        <tr>
                            <td> $title->_content </td>
                            <td>
                                <!-- <a href=''> <button class='edit'> edit </button></a> -->
                                <a href='/settings/removetitle?id=$title->_id'  > <button class='remove' > remove </button></a>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2><i class="fa-solid fa-square-phone"></i> Contact information <button onclick="addfomrs(this)" class="add">
                Add </button>
        </h2>

        <div class="callout">
            <form class='hidden' method='POST' action='/settings/addInfo'>
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
                    echo "
                        <tr>
                            <td> $contactInfo->_name </td>
                            <td> $contactInfo->_icon </td>
                            <td> $contactInfo->_link </td>
                            <td>
                                <!-- <a href=''> <button class='edit'> edit </button></a> -->
                                <a href='/settings/removetitle?id=$contactInfo->_id'  > <button class='remove' > remove </button></a>
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
                    echo "
                    <tr>
                        <td> $workExperiense->_name </td>
                        <td> $workExperiense->_description </td>
                        <td> $workExperiense->_icon </td>
                        <td> $workExperiense->_city </td>
                        <td> $workExperiense->_country </td>
                        <td> $workExperiense->_start </td>
                        <td> $workExperiense->_end </td>
                        <td>
                            <!-- <a href=''> <button class='edit'> edit </button></a> -->
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
                    echo "
                        <tr>
                            <td> $technology->_name </td>
                            <td> $technology->_desc </td>
                            <td> $technology->_icon </td>
                            <td> $technology->_level </td>
                            <td>
                                <!-- <a href=''> <button class='edit'> edit </button></a> -->
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

                <?php
                $TDAO         = new TechnologiesDAO;
                $technologies = $TDAO->fetchAll();

                foreach ($technologies as $technologie) {
                    echo "
                        <label for='$technologie->_id'>$technologie->_name</label>
                        <input type='checkbox' id='$technologie->_id' name='techID=$technologie->_id' value='$technologie->_id'>";
                }
                ?>

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
                        echo "
                            <tr>
                                <td> $project->_name </td>
                                <td> $project->_desc </td>
                                <td> $project->_icon </td>
                                <td> $project->_link </td>
                                <td>";

                        foreach ($project->_techno as $key => $value) {
                            echo $value->_name . ',';
                        }
                        echo " 
                                </td>
                                <td>
                                    <!-- <a href=''> <button class='edit'> edit </button></a> -->
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
                                <!-- <a href=''> <button class='edit'> edit </button></a> -->
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
        $educations = $EDDAO->fetchAll();?>

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
                                <!-- <a href=''> <button class='edit'> edit </button></a> -->
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
                    echo "
                        <tr>
                            <td> $pointOfInterest->_name </td>
                            <td> $pointOfInterest->_icon </td>
                            <td>
                                <!-- <a href=''> <button class='edit'> edit </button></a> -->
                                <a href='/settings/removePOI?id=$pointOfInterest->_id'> <button class='remove'> remove </button></a>
                            </td>
                        </tr>";
                } ?>
            </tbody>
        </table>
    </section>
</main>