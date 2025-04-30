<?php
header('Content-Type: application/json');

// Helper to load and decode JSON from file
function load_json($filename) {
    $file_path = __DIR__ . "/data/$filename";
    if (!file_exists($file_path)) {
        http_response_code(500);
        echo json_encode(["error" => "File not found: $filename"]);
        exit;
    }

    $content = file_get_contents($file_path);
    return json_decode($content, true);
}

// Route based on GET param
$type = $_GET['type'] ?? 'transactions';

if ($type === 'accounts') {
    $accounts = load_json('fake_accounts.json');
} elseif ($type === 'transactions') {
    $transactions = load_json('fake_transactions.json');
} else {
    http_response_code(400);
    echo json_encode(["error" => "Invalid type"]);
}
?>
