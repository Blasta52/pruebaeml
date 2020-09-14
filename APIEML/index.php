<?php 
	
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    	die();
    }

    require __DIR__ . '/vendor/autoload.php';
	require('./routes/index.php');
	require('./helpers/database.php');

	$url = isset($_GET['url']) ? $_GET['url'] : '/';

	routeHandler($url, $_SERVER['REQUEST_METHOD']);

?>