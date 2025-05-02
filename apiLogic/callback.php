<?php
session_start();
require_once 'api_connect.php';

// Ensuring code is received
if (!isset($_GET['code'])) {
    die("No authorisation code provided.");
}

// Exchanging code for token
$tokenData = exchangeAuthCodeForToken($_GET['code']);
$accessToken = $tokenData['access_token'] ?? null;

if (!$accessToken) {
    die("Failed to get access token.");
}

$_SESSION['access_token'] = $accessToken;

// Fetching accounts
$accounts = fetchAccounts($accessToken);
$_SESSION['accounts'] = $accounts;

// Fetching transactions
$transactions = fetchAllTransactions($accessToken, $accounts);
$_SESSION['transactions'] = $transactions;

// Redirecting to profile once done
header("Location: /profile/profile.php");
exit;
?>