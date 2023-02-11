<?php

$keywords = 'HTML, CSS, JavaScript, Resume, Audric, Rosier, Audric Rosier';
$description = 'Audric Rosier Resume Web Developeur';
$autor = "Audric Rosier";

?>

<!DOCTYPE HTML>
<html lang='en/us'>

<head>
	<!-- HTML BASIC META -->
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0, shrink-to-fit=no'>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv='X-UA-Compatible' content='IE=edge' />

	<!-- META AUTOR -->
	<title>Audric Rosier - Resume</title>
	<meta name='keywords' content='<?php echo $keywords; ?>'>
	<meta name='description' content='<?php echo $description; ?>'>
	<meta name='auteur' content='<?php echo $autor; ?>'>

	<!-- META AND LINK FOR FAVICON -->
	<link rel='apple-touch-icon' sizes='180x180' href='$imglink/ico/apple-touch-icon.png'>
	<link rel='icon' type='image/png' sizes='32x32' href='$imglink/ico/favicon-32x32.png'>
	<link rel='icon' type='image/png' sizes='16x16' href='$imglink/ico/favicon-16x16.png'>
	<link rel='manifest' href='$imglink/ico/site.webmanifest'>
	<link rel='mask-icon' href='$imglink/ico/safari-pinned-tab.svg' color='#5bbad5'>
	<meta name='apple-mobile-web-app-title' content='Photographics'>
	<meta name='application-name' content='Photographics'>
	<meta name='msapplication-TileColor' content='#ffffff'>
	<meta name='theme-color' content='#ffffff'>

	<!-- STYLESHEET -->
	<link rel="stylesheet" type='text/css' href="colors.css">

	<link rel="stylesheet" type='text/css' href="reset.css">

	<link rel="stylesheet" type='text/css' href="index.css">
	<link rel="stylesheet" type='text/css' href="min.css">

	<!-- IMPORT ICON -->
	<script src='https://kit.fontawesome.com/eb747bd21c.js' crossorigin='anonymous'></script>
	<link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">
	<link rel="stylesheet" href="myfont/style.css">
</head>

<body>

	<input id="toggle" class="toggle" type="checkbox" onclick=darkmode()>

	<header>
		<h1> 🌐 Resume - Web Master</h1>
		<blockquote>I'm a <mark class="highlight purple"><strong>Web developers</strong></mark> and a <mark class="highlight blue"><strong>Graphic Designer</strong></mark> in <mark class="highlight orange"><em>Belgium</em></mark>
			</br>with <mark class="highlight blue">5 years</mark> of experience in graphic design and <mark class="highlight purple">2 years</mark> in web development</blockquote>
	</header>

	<section>
		<h2> <i class="fa-solid fa-square-phone"></i> Contact information</h2>


		<article class="grid _3">
			<p> <i class="fa-regular fa-paper-plane"></i> <a href="mailto:audricrosier@gmail.com"> audricrosier@gmail.com</a></p>
			<p> <i class="fa-solid fa-mobile"></i> <a href="tel:0032485836132"> +32485836132</a></p>
			<p> <i class="fa-solid fa-link"></i> <a href="https://www.linkedin.com/in/audricrosier/"> Audric Rosier</a></p>
			<p> <i class="fa-brands fa-github"></i> <a href="https://github.com/AudricSan"> AudricSan</a></p>
			<p> <i class="fa-solid fa-camera-retro"></i> <a href="https://www.instagram.com/audric_san/"> @audric_san</a></p>
		</article>
	</section>

	<section>
		<h2> <i class="fa-solid fa-person-digging"></i> Work experience</h2>

		<article>
			<h3>Carrefour Market / Intermarché - [Hamme-Mille]</h3>
			<div class="callout">
				<i class="fa-solid fa-shop"></i>
				<p>departement manager</p>
			</div>
		</article>

		<article>
			<h3>Pizzeria Volare - [Tourinne La Grosse]</h3>
			<div class="callout">
				<i class="fa-solid fa-pizza-slice"></i>
				<p>Barman, Server in an italian restaurant</p>
			</div>
		</article>

		<article>
			<h3>CHU Saint-Pierre - [Bruxelles]</h3>
			<div class="callout">
				<i class="fa-solid fa-hospital"></i>
				<p> Receptionist</p>
			</div>
		</article>

		<article>
			<h3>Epansion Partners - [Namur]</h3>
			<div class="callout">
				<i class="fa-solid fa-desktop"></i>
				<p>Junior Designer General re-design, adaptation of graphic charter.</p>
			</div>
		</article>

	</section>

	<section>
		<h2><i class="fa-solid fa-flask"></i> Skills</h2>
		<h3><i class="fa-solid fa-desktop"></i> Technology</h3>

		<article>
			<div class="callout">
				<img class="icon" src="003.svg" title="1" />
				<p>The historical language of the layout of html pages. I use it to create my web design that I make interactive afterwards in JS. </p>
			</div>
		</article>

		<article>
			<div class="callout">
				<img class="icon" src="002.svg" title="1" />
				<p>The historical language of the creation of web pages! I realize the skeleton of my web pages with it.</p>
			</div>
		</article>

		<article>
			<div class="callout">
				<img class="icon" src="004" title="2" />
				<p>The programming language that I use in front-end to make interactive the web pages that I realize in Html and Css.</p>
			</div>
		</article>

		<article>
			<div class="callout">
				<img class="icon" src="001.svg" title="3" />
				<p>I work with it since 3 years. I use it exclusively in Back-end to realize all what I need to make a dynamic website.</p>
			</div>
		</article>

		<article>
			<div class="callout">
				<img class="icon" src="005.svg" title="4" />
				<p>I use it since 3 years in total symbiosis with PHP</p>
			</div>
		</article>

		<article>
			<div class="callout">
				<img class="icon" src="006.png" title="5" />
				<p>I’m using the Laravel framework according to the project and the client's request</p>
			</div>
		</article>

		<article>
			<h3><i class="fa-solid fa-satellite"></i> Projets</h3>
		</article>

		<article>
			<div class="callout">
				<img class="icon" src="kanatraing.png" title="6" />
				<p>A site to study Japanese Kana and share your skills.</p>
			</div>
		</article>

		<article>
			<div class="callout">
				<img class="icon" src="photographics.png" title="7" />
				<p>My final project, a website that any photographer can duplicate to use as a showcase site easily configurable.</p>
			</div>
		</article>

		<article>
			<p class="icon 01"></p>
	</section>

	<section>
		<h2><i class="fa-solid fa-comment-dots"></i> Languages</h2>

		<article class="flex row">
			<div>
				<h3>Frensh [Francais]</h3>
				<p class="highlight yellow">Native</p>
			</div>

			<div>
				<h3>English</h3>
				<p class="highlight yellow">Fluent</p>
			</div>

			<div>
				<h3>Japanese [日本語]</h3>
				<p class="highlight yellow">Beginner</p>
			</div>
		</article>
	</section>

	<section>
		<h2><i class="fa-solid fa-chalkboard-user"></i> Education</h2>

		<article class="flex row">
			<div>
				<h3>Web Developers</h3>
				<time datetime="2020-09-01">Sept 2020</time> - <time datetime="2022-06-30"> June 2022</time>
				<p><a href="https://ifosup.wavre.be/" target="_blank">IFOSUP - Wavre, Belgium </a></p>
			</div>

			<div>
				<h3>Computer graphics courses (design creation)</h3>
				<time datetime="2017-09-01">Sept 2017</time> - <time datetime="2019-06-30"> June 2019</time>
				<p><a href="https://www.ifapme.be/centre-de-formations/perwez" target="_blank"> IFAPME - Perwer, Belgium </a></p>
			</div>
		</article>
	</section>

	<section>
		<h2><i class="fa-solid fa-graduation-cap"></i> Licence</h2>

		<article class="flex row">
			<p>BAC + 2 : Web Developer</p>
			<p>BES : Computer graphics designer</p>
		</article>
	</section>

	<section>
		<h2>💡Point of Interest</h2>

		<article class="grid _3">
			<p><i class="fa-solid fa-pencil"></i> design</p>
			<p><i class="em em-jp"></i> Japanese</p>
			<p><i class="fa-solid fa-camera"></i> Photographie</p>
			<p><i class="fa-solid fa-child-reaching"></i> Scouting</p>
			<p><i class="fa-solid fa-gamepad"></i> video Games</p>
		</article>
	</section>

	<script>
		function darkmode() {
			var element = document.body;
			element.classList.toggle("dark");
		}
	</script>

</body>

</html>