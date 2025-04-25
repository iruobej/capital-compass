<?php
// Safely fetch accounts
$accData = file_get_contents('https://capital-compass.onrender.com/api_connect.php?type=accounts');
$accJson = json_decode($accData, true);
$accounts = $accJson['accounts'] ?? [];

// Safely fetch transactions
$txData = file_get_contents('https://capital-compass.onrender.com/api_connect.php?type=transactions');
$txJson = json_decode($txData, true);
$transactions = $txJson['transactions'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome, <?php echo htmlspecialchars($firstname . ' ' . $lastname); ?></title>
    <link rel="stylesheet" href="styles.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap');
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <h1 class="header">Welcome, <?php echo htmlspecialchars($firstname . ' ' . $lastname); ?></h1>
        <h2 style="text-align: center;">Your Badge Level: <span class='badge'>Beginner Saver</span></h2>

        <section>
            <h3>- Displaying account data -</h3>
            <?php if (!empty($accounts)): ?>
                <ul>
                    <?php foreach ($accounts as $account): ?>
                        <li>
                            <?= htmlspecialchars($account['name']) ?> (<?= $account['type'] ?>) – £<?= number_format($account['balance'], 2) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No account data available. Try reloading or check your connection.</p>
            <?php endif; ?>
        </section>

        <section>
            <h3>- Displaying transactions -</h3>
            <?php if (!empty($transactions)): ?>
                <table id="txTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $tx): ?>
                            <tr>
                                <td><?= date("Y-m-d", strtotime($tx['timestamp'])) ?></td>
                                <td><?= htmlspecialchars($tx['description']) ?></td>
                                <td><?= $tx['transaction_type'] ?></td>
                                <td>£<?= number_format($tx['amount']['value'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No transactions available.</p>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>
