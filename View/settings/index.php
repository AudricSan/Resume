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
        $contactInfos = $CIDAO->fetchAll();
        var_dump($contactInfos);
        ?>
    </section>

    <section>
        <h2><i class="fa-solid fa-person-digging"></i> Work experience</h2>
        <?php
        $WEDAO          = new WorkExperienceDAO;
        $workExperiense = $WEDAO->fetchAll();
        var_dump($workExperiense);
        ?>
    </section>

    <section>
        <h2><i class="fa-solid fa-flask"></i> Skills</h2>
        <h3><i class="fa-solid fa-desktop"></i> Technology</h3>
        <?php
        $TechDAO      = new TechnologiesDAO;
        $technologies = $TechDAO->fetchAll();
        var_dump($technologies);
        ?>

        <h3><i class="fa-solid fa-satellite"></i> Projets</h3>
        <?php
        $PRDAO    = new ProjectDAO;
        $projects = $PRDAO->fetchAll();
        var_dump($projects);
        ?>
    </section>

    <section>
        <h2><i class="fa-solid fa-comment-dots"></i> Languages</h2>
        <?php
        $SEL       = new SelectedLanguageDAO();
        $languages = $SEL->fetchAll();
        var_dump($languages);
        ?>
    </section>

    <section>
        <h2><i class="fa-solid fa-chalkboard-user"></i> Education</h2>
    </section>

    <section>
        <h2><i class="fa-solid fa-graduation-cap"></i> Licence</h2>
    </section>

    <section>
        <h2><i class="fa-solid fa-lightbulb"></i> Point of Interest</h2>
    </section>
</main>