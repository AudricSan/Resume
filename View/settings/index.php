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

<main>
    <h1>Books settings</h1>

    <section>
        <h2><i class="fa-solid fa-globe"></i> Resume - Title</h2>
    </section>

    <section>
        <h2><i class="fa-solid fa-square-phone"></i> Contact information</h2>
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

            <?php
            foreach ($contactInfos as $contactInfo) {
                echo "
                    <tbody>
                        <tr>
                            <td> $contactInfo->_name </td>
                            <td> $contactInfo->_icon </td>
                            <td> $contactInfo->_link </td>
                            <td>
                             <button class='edit'> edit </button>
                             <button class='remove'> remove </button>
                            </td>
                        </tr>
                    </tbody>";
            }
            ?>
        </table>

        <button class="add"> Add </button>

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
    </section>

    <section>
        <h2><i class="fa-solid fa-person-digging"></i> Work experience</h2>
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

            <?php
            foreach ($workExperienses as $workExperiense) {
                echo "
                    <tbody>
                        <tr>
                            <td> $workExperiense->_name </td>
                            <td> $workExperiense->_description </td>
                            <td> $workExperiense->_icon </td>
                            <td> $workExperiense->_city </td>
                            <td> $workExperiense->_country </td>
                            <td> $workExperiense->_start </td>
                            <td> $workExperiense->_end </td>
                            <td>
                             <button class='edit'> edit </button>
                             <button class='remove'> remove </button>
                            </td>                        </tr>
                    </tbody>";
            }
            ?>
        </table>

        <button class="add"> Add </button>

        <div class="callout">
            <form class='hidden' method='POST' action='/settings/addInfo'>
                <label for='_name'>Name</label>
                <input type='text' id='_name' name='_name'>

                <label for='_description'>Description</label>
                <input type='text' id='_description' name='_description'>

                <label for='_icon'>Icon</label>
                <input type='text' id='_icon' name='_icon'>

                <label for='_city'>City</label>
                <input type='text' id='_city' name='_city'>

                <label for='_country'>Country</label>
                <input type='text' id='_country' name='_country'>

                <label for='_start'>Start</label>
                <input type='date' id='_start' name='_start'>

                <label for='_end'>End</label>
                <input type='date' id='_end' name='_end'>

                <input type='submit' value='Submit'>
            </form>
        </div>
    </section>

    <section>
        <h2><i class="fa-solid fa-flask"></i> Skills</h2>
        <h3><i class="fa-solid fa-desktop"></i> Technology</h3>
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

            <?php
            foreach ($technologies as $technology) {
                echo "
                    <tbody>
                        <tr>
                            <td> $technology->_name </td>
                            <td> $technology->_desc </td>
                            <td> $technology->_icon </td>
                            <td> $technology->_level </td>
                            <td>
                             <button class='edit'> edit </button>
                             <button class='remove'> remove </button>
                            </td>
                        </tr>
                    </tbody>";
            } ?>
        </table>

        <button class="add"> Add </button>

        <div class="callout">
            <form class='hidden' method='POST' action='/settings/addInfo'>
                <label for='_name'>Name</label>
                <input type='text' id='_name' name='_name'>

                <label for='_description'>Description</label>
                <input type='text' id='_description' name='_description'>

                <label for='_icon'>Icon</label>
                <input type='text' id='_icon' name='_icon'>

                <label for='_level'>Level</label>
                <input type='text' id='_level' name='_level'>

                <input type='submit' value='Submit'>
            </form>
        </div>

        <h3><i class="fa-solid fa-satellite"></i> Projets</h3>
        <?php
        $PRDAO    = new ProjectDAO;
        $projects = $PRDAO->fetchAll(); ?>
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

            <?php
            foreach ($projects as $project) {
                echo "
                    <tbody>
                        <tr>
                            <td> $project->_name </td>
                            <td> $project->_desc </td>
                            <td> $project->_icon </td>
                            <td> $project->_link </td>";

                foreach ($project->_techno as $key => $value) {
                    echo "<td> $value->_name </td>";
                }
                echo "      <td>
                             <button class='edit'> edit </button>
                             <button class='remove'> remove </button>
                            </td>
                        </tr>
                    </tbody>";
            } ?>
        </table>

        <button class="add"> Add </button>

        <div class="callout">
            <form class='hidden' method='POST' action='/settings/addInfo'>
                <label for='_name'>Name</label>
                <input type='text' id='_name' name='_name'>

                <label for='_description'>Description</label>
                <input type='text' id='_description' name='_description'>

                <label for='_icon'>Icon</label>
                <input type='text' id='_icon' name='_icon'>

                <label for='_link'>Link</label>
                <input type='text' id='_link' name='_link'>

                <input type='submit' value='Submit'>
            </form>
        </div>
    </section>

    <section>
        <h2><i class="fa-solid fa-comment-dots"></i> Languages</h2>
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

            <?php
            foreach ($languages as $language) {
                echo "
                    <tbody>
                        <tr>
                            <td> $language->_language</td>
                            <td> $language->_level </td>
                            <td>
                             <button class='edit'> edit </button>
                             <button class='remove'> remove </button>
                            </td>
                        </tr>
                    </tbody>";
            } ?>
        </table>

        <button class="add"> Add </button>

        <div class="callout">
            <form class='hidden' method='POST' action='/settings/addInfo'>
                <label for='_language'>Language</label>
                <input type='text' id='_language' name='_language'>

                <label for='_level'>Level</label>
                <input type='text' id='_level' name='_level'>

                <input type='submit' value='Submit'>
            </form>
        </div>
    </section>

    <section>
        <h2><i class="fa-solid fa-chalkboard-user"></i> Education</h2>
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

            <?php
            foreach ($educations as $education) {
                echo "
                    <tbody>
                        <tr>
                            <td> $education->_name </td>
                            <td> $education->_school </td>
                            <td> $education->_start </td>
                            <td> $education->_end </td>
                            <td> $education->_city </td>
                            <td> $education->_country </td>
                            <td> $education->_level </td>
                            <td>
                             <button class='edit'> edit </button>
                             <button class='remove'> remove </button>
                            </td>
                        </tr>
                    </tbody>";
            } ?>
        </table>

        <button class="add"> Add </button>

        <div class="callout">
            <form class='hidden' method='POST' action='/settings/addInfo'>
                <label for='_name'>Name</label>
                <input type='text' id='_name' name='_name'>

                <label for='_school'>School</label>
                <input type='text' id='_school' name='_school'>

                <label for='_start'>Start</label>
                <input type='text' id='_start' name='_start'>

                <label for='_end'>End</label>
                <input type='text' id='_end' name='_end'>

                <label for='_city'>City</label>
                <input type='text' id='_city' name='_city'>

                <label for='_country'>Country</label>
                <input type='text' id='_country' name='_country'>

                <label for='_level'>Level</label>
                <input type='text' id='_level' name='_level'>

                <input type='submit' value='Submit'>
            </form>
        </div>
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

            <?php
            foreach ($educations as $education) {
                echo "
                    <tbody>
                        <tr>
                            <td> $education->_level </td>
                            <td> $education->_name </td>
                        </tr>
                    </tbody>";
            } ?>
        </table>
    </section>

    <section>
        <h2><i class="fa-solid fa-lightbulb"></i> Point of Interest</h2>
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

            <?php
            foreach ($pointOfInterests as $pointOfInterest) {
                echo "
                    <tbody>
                        <tr>
                            <td> $pointOfInterest->_name </td>
                            <td> $pointOfInterest->_icon </td>
                            <td>
                             <button class='edit'> edit </button>
                             <button class='remove'> remove </button>
                            </td>
                        </tr>
                    </tbody>";
            } ?>
        </table>

        <button class="add"> Add </button>

        <div class="callout">
            <form class='hidden' method='POST' action='/settings/addInfo'>
                <label for='_name'>Name</label>
                <input type='text' id='_name' name='_name'>

                <label for='_icon'>Icon</label>
                <input type='text' id='_icon' name='_icon'>

                <input type='submit' value='Submit'>
            </form>
        </div>
    </section>
</main>