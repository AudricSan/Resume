<?php

// $payer = $_POST["poeple"];
$car = $_POST["car"];
$date = $_POST["date"];
$km = $_POST["km"];
$prix = $_POST["price"];
$litre = $_POST["litre"];
$total = $_POST["total"];
$more = $_POST["coms"];

// var_dump($_POST);

if ($_POST['car']) {
    $message = "$date, $litre, $km, $prix, $car, $more
        ||||||||||||||||||||||||||||||||||||||
        Payer = $payer, 
        voiture = $car, 
        date = $date, 
        kilometrage = $km, 
        prix au litre = $prix,  
        Litre de cardurant = $litre, 
        total payer = $total.
    ";

    mail('yrosier@gmail.com', "$car, Gazoline", $message);
    // echo ('SEND');
}

// exit;
header('location: index.php');