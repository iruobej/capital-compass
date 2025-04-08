<?php
$plaidClientId = getenv('PLAID_CLIENT_ID');
$plaidSecret = getenv('PLAID_SECRET');

define('PLAID_CLIENT_ID', $plaidClientId);
define('PLAID_SECRET', $plaidSecret);
?>