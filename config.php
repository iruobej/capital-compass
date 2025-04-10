//Setup for the website
<?php
//API Keys
define('TL_CLIENT_ID', getenv('TL_CLIENT_ID'));
define('TL_CLIENT_SECRET', getenv('TL_CLIENT_SECRET'));
define('TL_REDIRECT_URI', getenv('TL_REDIRECT_URI'));
define('TL_ENVIRONMENT', 'sandbox');

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