<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once 'config.php';

if (!isset($_GET['code'])) {
    var_dump($_GET);
    die("Authorization code not provided in the callback.");
}

$code = $_GET['code'];

// Exchanging code for token
$data = http_build_query([
    'grant_type' => 'authorization_code',
    'client_id' => TL_CLIENT_ID,
    'client_secret' => TL_CLIENT_SECRET,
    'redirect_uri' => TL_REDIRECT_URI,
    'code' => $code
]);

$context = stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => "Content-Type: application/x-www-form-urlencoded",
        'content' => $data
    ]
]);

$response = file_get_contents("https://auth.truelayer-sandbox.com/connect/token", false, $context);

if ($response === false) {
    die("Failed to retrieve access token. Check your request or credentials.");
}

$tokens = json_decode($response, true);
if (!isset($tokens['access_token'])) {
    die("Access token not found in response. Full response: " . $response);
}

$accessToken = $tokens['access_token'];
$headers = [
    "Authorization: Bearer $accessToken",
    "Content-Type: application/json"
];

$httpContext = stream_context_create([
    'http' => [
        'method' => 'GET',
        'header' => implode("\r\n", $headers)
    ]
]);

// Fetching Accounts
$accountResponse = file_get_contents("https://api.truelayer-sandbox.com/data/v1/accounts", false, $httpContext);
$accountData = json_decode($accountResponse, true);

if (!isset($accountData['results'])) {
    die("Accounts not found in response.");
}

$_SESSION['accounts'] = $accountData['results'];

// Fetching Transactions
$allTransactions = [];

foreach ($accountData['results'] as $account) {
    $accountId = $account['account_id'];
    $transactionsUrl = "https://api.truelayer-sandbox.com/data/v1/accounts/$accountId/transactions";

    $transactionResponse = file_get_contents($transactionsUrl, false, $httpContext);
    $transactionData = json_decode($transactionResponse, true);

    if (isset($transactionData['results'])) {
        $allTransactions = array_merge($allTransactions, $transactionData['results']);
    }
}

$_SESSION['transactions'] = $allTransactions;

// Redirecting to home page once done
header("Location: home.php");
exit;
?>