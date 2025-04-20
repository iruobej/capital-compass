<?php
function generateTrueLayerAuthURL() {
    $state = bin2hex(random_bytes(8));
    $nonce = bin2hex(random_bytes(8));

    $_SESSION['state'] = $state;
    $_SESSION['nonce'] = $nonce;

    return "https://auth.truelayer-sandbox.com/?" . http_build_query([
        'response_type' => 'code',
        'client_id' => getenv('TL_CLIENT_ID'),
        'redirect_uri' => getenv('TL_REDIRECT_URI'),
        'scope' => 'info accounts balance cards transactions direct_debits standing_orders offline_access',
        'providers' => 'uk-cs-mock uk-ob-all uk-oauth-all',
        'state' => $state,
        'nonce' => $nonce
    ]);
}

function exchangeAuthCodeForToken($code) {
    $postData = http_build_query([
        'grant_type' => 'authorization_code',
        'client_id' => getenv('TL_CLIENT_ID'),
        'client_secret' => getenv('TL_CLIENT_SECRET'),
        'redirect_uri' => getenv('TL_REDIRECT_URI'),
        'code' => $code
    ]);

    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded",
            'content' => $postData
        ]
    ]);

    $response = file_get_contents("https://auth.truelayer-sandbox.com/connect/token", false, $context);
    return json_decode($response, true);
}

function fetchAccounts($accessToken) {
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => "Authorization: Bearer $accessToken\r\n"
        ]
    ]);

    $response = file_get_contents("https://api.truelayer-sandbox.com/data/v1/accounts", false, $context);
    return json_decode($response, true);
}

function fetchAllTransactions($accessToken, $accounts) {
    $allTransactions = [];

    $httpContext = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => "Authorization: Bearer $accessToken\r\n"
        ]
    ]);

    foreach ($accounts['results'] as $account) {
        $accountId = $account['account_id'];
        $transactionsUrl = "https://api.truelayer-sandbox.com/data/v1/accounts/$accountId/transactions";

        $transactionResponse = file_get_contents($transactionsUrl, false, $httpContext);
        $transactionData = json_decode($transactionResponse, true);

        if (isset($transactionData['results'])) {
            $allTransactions = array_merge($allTransactions, $transactionData['results']);
        }
    }

    return $allTransactions;
}
?>