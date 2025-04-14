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
            echo '<pre>';
            print_r($_SESSION['accounts']);
            echo '</pre>';
            <!--Displaying accounts-->
            <?php if (isset($_SESSION['accounts']['results']) && is_array($_SESSION['accounts']['results'])): ?>
            <?php foreach ($_SESSION['accounts']['results'] as $account): ?>
                <div class="box">
                    <h2><?= htmlspecialchars($account['display_name'] ?? 'Account') ?></h2>
                    <p><strong>Type:</strong> <?= htmlspecialchars($account['account_type'] ?? 'N/A') ?></p>
                    <p><strong>Currency:</strong> <?= htmlspecialchars($account['currency'] ?? 'N/A') ?></p>

                    <?php if (isset($account['account_number'])): ?>
                        <p><strong>Account Number:</strong> <?= htmlspecialchars($account['account_number']['number'] ?? 'N/A') ?></p>
                        <p><strong>Sort Code:</strong> <?= htmlspecialchars($account['account_number']['sort_code'] ?? 'N/A') ?></p>
                        <p><strong>IBAN:</strong> <?= htmlspecialchars($account['account_number']['iban'] ?? 'N/A') ?></p>
                    <?php endif; ?>

                    <?php if (isset($account['provider'])): ?>
                        <p><strong>Bank:</strong> <?= htmlspecialchars($account['provider']['display_name'] ?? 'N/A') ?></p>
                        <?php if (!empty($account['provider']['logo_uri'])): ?>
                            <img src="<?= htmlspecialchars($account['provider']['logo_uri']) ?>" alt="Bank Logo" width="100">
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No account data available. Try <a href="<?= $auth_url ?>">connecting/reconnecting your bank.</a></p>
        <?php endif; ?>

        <!-- Balances -->
        <div class="box">
            <h2>Balances</h2>
            <p>Checking: £1,356.79</p>
            <p>Savings: £3,452.00</p>
        </div>

        <div class="grid-layout">
            <div class="box"><h2>Balance Amount Line Graph</h2></div>
            <div class="box">
                <h2>Financial Goals</h2>
                    <p>Goal 1: £0.00</p>
                    <p>Goal 2: £0.00</p>
                    <p>Goal 3: £0.00</p>
            </div>
            <!--Displaying the user's transactions-->
            <div class="box">
                <h2>Recent Transactions</h2>

                <input type="text" id="txSearch" onkeyup="filterTransactions()" placeholder="Search by date, category, or amount..." style="width: 100%; padding: 8px; margin-bottom: 10px;">

                <div style="max-height: 300px; overflow-y: auto;">
                    <table id="txTable">
                        <tr>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Amount</th>
                        </tr>
                        <?php if (isset($_SESSION['transactions'])): ?>
                            <?php foreach ($_SESSION['transactions'] as $tx): ?>
                                <?php
                                    $timestamp = $tx['timestamp'] ?? 'N/A';
                                    $category = $tx['transaction_category'] ?? 'N/A';
                                    $amountVal = $tx['amount']['value'] ?? null;
                                    $amount = is_numeric($amountVal) ? number_format($amountVal, 2) : '0.00';
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($timestamp) ?></td>
                                    <td><?= htmlspecialchars($category) ?></td>
                                    <td>£<?= $amount ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="3">No transactions available.</td></tr>
                        <?php endif; ?>
                    </table>
                </div>
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
    <script src="home.js"></script>
</body>
</html>