<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: index.html");
    exit();
}
// Mock fallback for accounts and transactions using local API
$accData = file_get_contents('https://capital-compass.onrender.com/api_connect.php?type=accounts');
$accJson = json_decode($accData, true);
$_SESSION['accounts'] = $accJson['accounts'] ?? [];

$txData = file_get_contents('https://capital-compass.onrender.com/api_connect.php?type=transactions');
$txJson = json_decode($txData, true);
$_SESSION['transactions'] = $txJson['transactions'] ?? [];

require 'badgeLogic.php';
$transactions = $_SESSION['transactions'];
$badge = getBadgeLevel($transactions);

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
    <h2 style="text-align: center;">Your Badge Level: <?php echo "<span class='badge'>$badge</span>";?></h2>
    <div class="page-container">
            <!--Displaying accounts-->
            <?php if (isset($_SESSION['accounts']) && is_array($_SESSION['accounts'])): ?>
            <?php foreach ($_SESSION['accounts'] as $account): ?>
                <div class="box">
                    <h2><?= htmlspecialchars($account['name'] ?? 'Account') ?></h2>
                    <p><strong>Balance: </strong>£<?= htmlspecialchars($account['balance'] ?? 'N/A') ?></p>
                    <p><strong>Currency:</strong> <?= htmlspecialchars($account['currency'] ?? 'N/A') ?></p>

                    <?php if (isset($account['account_number'])): ?>
                        <p><strong>Account Number:</strong> <?= htmlspecialchars($account['account_number']['number'] ?? 'N/A') ?></p>
                        <p><strong>Sort Code:</strong> <?= htmlspecialchars($account['account_number']['sort_code'] ?? 'N/A') ?></p>
                        <p><strong>IBAN:</strong> <?= htmlspecialchars($account['account_number']['iban'] ?? 'N/A') ?></p>
                    <?php endif; ?>

                    <?php if (isset($account['bank_name'])): ?>
                        <p><strong>Bank:</strong> <?= htmlspecialchars($account['bank_name'] ?? 'N/A') ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No account data available. </p>
        <?php endif; ?>
        
        <?php
        $standardTotal = 0;
        $savingsTotal = 0;
        foreach ($_SESSION['accounts'] as $account) {
            $type = strtolower($account['type'] ?? '');
            $balance = $account['balance'] ?? 0;

            if ($type === 'savings') {
                $savingsTotal += $balance;
            } else {
                $standardTotal += $balance;
            }
        }
        ?>


        <!-- Total Balance -->
        <div class="box">
            <h2>Balances</h2>
            <p>Standard (Checking): £<?= number_format($standardTotal, 2) ?></p>
            <p>Savings: £<?= number_format($savingsTotal, 2) ?></p>
        </div>

        <div class="grid-layout">
            <div class="box"><h2>Balance Amount Line Graph</h2><canvas id="cashFlowChart" width="800" height="400"></canvas>
            </div>
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
                                    $category = $tx['transaction_type'] ?? 'N/A';
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const ctx = document.getElementById('cashFlowChart').getContext('2d');

    const cashFlowChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo $dates; ?>,
            datasets: [{
                label: 'Net Cash Flow (GBP)',
                data: <?php echo $amounts; ?>,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.3,
                pointRadius: 5,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Daily Net Cash Flow',
                    font: { size: 18 }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'GBP'
                    },
                    beginAtZero: false
                }
            }
        }
    });
    </script>

</body>
</html>