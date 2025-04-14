<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: index.html");
    exit();
}
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome, <?= htmlspecialchars($_SESSION['firstname'] . ' ' . $_SESSION['lastname']) ?></title>
    <link rel="stylesheet" href="styles.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap');
        </style>
</head>
<body >
    <?php include 'navbar.php'; ?>
    <h1 id="header">Welcome, <?= htmlspecialchars($_SESSION['firstname'] . ' ' . $_SESSION['lastname']) ?></h1>
    <div class="page-container">
        <?php if (isset($_SESSION['accounts']['results']) && is_array($_SESSION['accounts']['results'])): ?>
            <?php foreach ($_SESSION['accounts']['results'] as $account): ?>
                <div class="box">
                    <h2><?= htmlspecialchars($account['display_name'] ?? 'Account') ?></h2>
                    <p>Type: <?= htmlspecialchars($account['account_type'] ?? 'N/A') ?></p>
                    <p>Currency: <?= htmlspecialchars($account['currency'] ?? 'N/A') ?></p>
                    <p>Account Number: <?= htmlspecialchars($account['account_number']['number'] ?? 'N/A') ?></p>
                    <p>Sort Code: <?= htmlspecialchars($account['account_number']['sort_code'] ?? 'N/A') ?></p>
                    <p>IBAN: <?= htmlspecialchars($account['account_number']['iban'] ?? 'N/A') ?></p>
                    <p>Bank: <?= htmlspecialchars($account['provider']['display_name'] ?? 'N/A') ?></p>
                    <?php if (!empty($account['provider']['logo_uri'])): ?>
                        <img src="<?= htmlspecialchars($account['provider']['logo_uri']) ?>" alt="Bank Logo" width="100">
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No account data available. Try reconnecting your bank.</p>
        <?php endif; ?>
        <!-- Balances -->
        <div class="box">
            <h2>Balances</h2>
            <p>Checking: £1,356.79</p>
            <p>Savings: £3,452.00</p>
        </div>
        <div class="grid-layout">
            <div class="box"><h2>Budget Line Graph</h2></div>
            <div class="box">
                <h2>Financial Goals</h2>
                    <p>Goal 1: £0.00</p>
                    <p>Goal 2: £0.00</p>
                    <p>Goal 3: £0.00</p>
            </div>
            <div class="box">
                <h2>Recent Transactions</h2>
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Amount</th>
                    </tr>
                    <tr>
                        <td>01/01/2021</td>
                        <td>Income</td>
                        <td>$100.00</td>
                    </tr>
                    <tr>
                        <td>01/02/2021</td>
                        <td>Expense</td>
                        <td>$50.00</td>
                    </tr>
                </table>
            </div>
            <div class="box">
                <h2>Suggested Actions</h2>
                <ul>
                    <li>Set up a budget</li>
                    <li>Set up a savings goal</li>
                    <li>Review recent transactions</li>
                </ul>
            </div>
        </div>
    </div>  
    <footer>
        <p>&copy; 2025 Capital Compass</p>
    </footer>

</body>
</html>