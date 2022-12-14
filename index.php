<?php 

// J'appelle les fonctions du ou des controllers en fonction de la variable $_GET["page"]

session_start();
include 'router.php';
$route=new \apps\router\router();
$route->route();
