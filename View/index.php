<header>
	<h1><i class='fa-solid fa-globe'></i> Resume - Web developers</h1>
	<blockquote>I'm a <mark class='highlight purple'><strong>Web developers</strong></mark> and a <mark
			class='highlight blue'><strong>Graphic Designer</strong></mark> in <mark
			class='highlight orange'><em>Belgium</em></mark>
		<!-- </br>with <mark class='highlight blue'>5 years</mark> of experience in graphic design and <mark
			class='highlight purple'>2 years</mark> in web development</blockquote> -->
</header>

<section>
	<h2> <i class='fa-solid fa-square-phone'></i> Contact information</h2>

	<?php

	use MyBook\Env;

	$CIDAO         = new ContatInfoDAO;
	$Env           = new Env;
	$contactsInfos = $CIDAO->fetchAll();
	?>

	<article class='grid _3'>
		<?php
		foreach ($contactsInfos as $contactInfo) {
			$icon    = $Env->isicon($contactInfo->_icon);
			$explode = explode(',', $contactInfo->_icon);
			$fa      = $Env->checkInput($explode[1]);
			$icon    = $Env->checkInput($explode[0]);

			echo "<p>";
			if ($icon) {
				echo "<i class='fa-$fa $icon'></i>";
			} else {
				echo "<img class='icon' src='images/icon/$contactInfo->_icon.svg' alt='icon for $contactInfo->_name' />";
			}
			echo "<a href='$contactInfo->_link' target='_blank'> $contactInfo->_name </a></p>";
		}
		?>
	</article>
</section>

<section>
	<?php
	$WEDAO           = new WorkExperienceDAO;
	$workExperienses = $WEDAO->fetchAll();

	if (!empty($workExperienses)) {
		echo "<h2> <i class='fa-solid fa-person-digging'></i> Work experience</h2>";
	}

	foreach ($workExperienses as $workExperiense) {
		$icon    = $Env->isicon($workExperiense->_icon);
		$explode = explode(',', $workExperiense->_icon);
		$fa      = $Env->checkInput($explode[1]);
		$icon    = $Env->checkInput($explode[0]);

		echo "<article><h3>$workExperiense->_description - $workExperiense->_city</h3><div class='callout'>";
		if ($icon) {
			echo "<i class='fa-$fa $icon'></i>";
		} else {
			echo "<img class='icon' src='images/icon/$workExperiense->_icon.svg' alt='icon for $workExperiense->_name' />";
		}
		echo "<p> $workExperiense->_name</p></div></article>";
	}
	?>
</section>

<section>
	<h2><i class='fa-solid fa-desktop'></i> Technology</h2>
	<?php
	$TDAO         = new TechnologiesDAO;
	$technologies = $TDAO->fetchAll();

	foreach ($technologies as $technology) {
		$icon = $Env->isicon($technology->_icon);
		echo "<article>
				<div class='callout'>";
		if ($icon) {
			$explode = explode(',', $technology->_icon);
			$fa      = $Env->checkInput($explode[1]);
			$icon    = $Env->checkInput($explode[0]);
			echo "<i class='fa-$fa $icon'></i>";
		} else {
			echo "<img class='icon' src='images/icon/$technology->_icon.svg' alt='icon for $technology->_name' />";
		}
		echo "
					<p> $technology->_name / $technology->_desc</p>
					<!-- <p class='level'> $technology->_level</p> -->
				</div>
			</article>
		";
	}
	?>
</section>

<section>
	<h2><i class='fa-solid fa-satellite'></i> Projets</h2>

	<?php
	$PDAO     = new ProjectDAO;
	$projects = $PDAO->fetchAll();

	foreach ($projects as $project) {
		$icon = $Env->isicon($project->_icon);
		echo "<article>
				<a href='$project->_link' target='_blank'>
					<div class='callout'>";
		if ($icon) {
			$explode = explode(',', $project->_icon);
			$fa      = $Env->checkInput($explode[1]);
			$icon    = $Env->checkInput($explode[0]);
			echo "<i class='fa-$fa $icon'></i>";
		} else {
			echo "<img class='icon' src='images/icon/$project->_icon.svg' alt='icon for $project->_name' />";
		}
		echo "
						<p> $project->_desc</p>
						<!-- <p class='level'> $project->_level</p> -->
					</div>
				</a>
			</article>
		";
	}
	?>
</section>

<section>
	<h2><i class='fa-solid fa-comment-dots'></i> Languages</h2>
	<article class='flex row'>
		<?php
		$SLDAO             = new SelectedLanguageDAO;
		$selectedLanguages = $SLDAO->fetchAll();

		foreach ($selectedLanguages as $language) {
			echo "
				<div>
					<h3>$language->_language</h3>
					<p class='highlight yellow'>$language->_level</p>
				</div>
		";
		}
		?>
	</article>
</section>

<section>
	<h2><i class='fa-solid fa-chalkboard-user'></i> Education</h2>

	<article class='flex row'>
		<?php
		$EDAO       = new EducationDAO;
		$educations = $EDAO->fetchAll();

		foreach ($educations as $education) {
			$timeStart = strtotime($education->_start);
			$timeEnd = strtotime($education->_end);

			$startDate = getDate($timeStart);
			$endDate   = getDate($timeEnd);

			$jsonStart = json_encode($startDate);
			$jsonEnd   = json_encode($endDate);

			$startDate = json_decode($jsonStart);
			$endDate   = json_decode($jsonEnd);

			echo "
			<div>
				<h3>$education->_name</h3>
				<time datetime='$education->_start'>$startDate->month - $startDate->year</time> - <time datetime='$education->_end'>$endDate->month - $endDate->year</time>
				<p>$education->_school - $education->_city, $education->_country</p>
			</div>
		";
		}
		?>
	</article>
</section>

<section>
	<h2><i class='fa-solid fa-graduation-cap'></i> Licence</h2>
	<article class='flex row'>

		<?php
		foreach ($educations as $education) {
			echo "
				<p>$education->_level : $education->_name</p>
			";
		}
		?>
	</article>
</section>

<section>
	<h2><i class='fa-solid fa-lightbulb'></i> Point of Interest</h2>

	<article class='grid _3'>
		<?php
		$POIDAO = new PointOfInterestDAO;
		$pois   = $POIDAO->fetchAll();
		foreach ($pois as $poi) {

			$icon = $Env->isicon($poi->_icon);

			if ($icon) {
				$explode = explode(',', $poi->_icon);
				$fa      = $Env->checkInput($explode[1]);
				$icon    = $Env->checkInput($explode[0]);
				echo "<p><i class='fa-$fa $icon'></i>";
			} else {
				echo "<p><img class='icon' src='images/icon/$poi->_icon.svg' alt='icon for $poi->_name' />";
			}
			echo "
				$poi->_name</p>
			";
		}
		?>
	</article>
</section>