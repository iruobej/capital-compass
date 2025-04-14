<?php
//Setup for the website
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//API Keys
define('TL_CLIENT_ID', 'sandbox-capitalcompass-9d49f5');
define('TL_CLIENT_SECRET', 'f770c65f-8a3d-42c2-ad4e-17698a11631b');
define('TL_REDIRECT_URI', 'https://capital-compass.onrender.com/callback.php');
define('TL_ENVIRONMENT', 'sandbox');

//DB Setup
$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$port = getenv('DB_PORT');

$dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require";
$conn = new PDO($dsn, $user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>