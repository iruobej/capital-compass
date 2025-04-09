//Setup for the website
<?php
//API Keys
$plaidClientId = getenv('PLAID_CLIENT_ID');
$plaidSecret = getenv('PLAID_SECRET');

define('PLAID_CLIENT_ID', $plaidClientId);
define('PLAID_SECRET', $plaidSecret);

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