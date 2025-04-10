//Setup for the website
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//API Keys
define('TL_CLIENT_ID', getenv('TL_CLIENT_ID'));
define('TL_CLIENT_SECRET', getenv('TL_CLIENT_SECRET'));
define('TL_REDIRECT_URI', getenv('TL_REDIRECT_URI'));
define('TL_ENVIRONMENT', 'sandbox');

echo 'CLIENT_ID: ' . TL_CLIENT_ID . '<br>';
echo 'CLIENT_SECRET: ' . TL_CLIENT_SECRET . '<br>';
echo 'REDIRECT_URI: ' . TL_REDIRECT_URI . '<br>';

//DB Setup
$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$port = getenv('DB_PORT');

$dsn = "pgsql:host=$host;port=$port;dbname=$db";
$pdo = new PDO($dsn, $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>