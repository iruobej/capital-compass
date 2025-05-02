<?php
session_start();
if (!isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    require_once 'config.php';
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
    $stmt->execute([$_SESSION['username']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $_SESSION['user_id'] = $user['user_id'];
    }
}
if(!isset($_SESSION['username'])){
    header("Location: index.html");
    exit();
}
require_once 'config.php';
include 'suggestedActions.php';

// Loading accounts from local JSON
$_SESSION['accounts'] = json_decode(file_get_contents('data/fake_accounts.json'), true);

// Loading transactions from local JSON
$transactions = json_decode(file_get_contents('data/fake_transactions.json'), true);
$_SESSION['transactions'] = $transactions;

// Loading badge logic and compute badge
require 'badgeLogic.php';
$badge = getBadgeLevel($transactions, $conn, $_SESSION['user_id']);
$suggestions = generateSuggestedActions($transactions);


//Logic for goals table in the db
$stmt = $conn->prepare("SELECT * FROM goals WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$goals = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <h2 style="text-align: center;">Your Badge Level: <?php echo "$combinedScore";?></h2>
    <div class="page-container">
        <!--Displaying accounts-->
        <h2>Your Accounts: </h2>
        <?php if (isset($_SESSION['accounts']) && is_array($_SESSION['accounts'])): ?>
            <div class="account-scroll-container" >
                <?php foreach ($_SESSION['accounts'] as $account): ?>
                    <div class="account-box">
                        <h2><?= htmlspecialchars($account['name'] ?? 'Account') ?></h2>
                        <p><strong>Balance:</strong> £<?= htmlspecialchars($account['balance'] ?? 'N/A') ?></p>
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
            </div>
        <?php else: ?>
            <p>No account data available.</p>
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
            <div class="box">
                <h2>Net Cash Flow (Across Accounts)</h2><canvas id="cashFlowChart" width="800" height="400"></canvas>
                <?php
                $transactions = json_decode(file_get_contents('data/fake_transactions.json'), true);
                $daily_totals = [];

                foreach ($transactions as $txn) {
                    $date = substr($txn['timestamp'], 0, 10);
                    $amount = $txn['amount']['value'];

                    if (!isset($daily_totals[$date])) {
                        $daily_totals[$date] = 0;
                    }

                    $daily_totals[$date] += $amount;
                }

                ksort($daily_totals);
                $dates = json_encode(array_keys($daily_totals));
                $amounts = json_encode(array_values($daily_totals));
                ?>
            </div>

            <div class="box">
                <h2>Financial Goals</h2>
                <?php foreach ($goals as $goal): ?>
                    <div class="goal-item" data-goal-id="<?= $goal['goal_id'] ?>" data-field="description">
                        <span class="display-value"><?= htmlspecialchars($goal['description']) ?></span>
                        <span class="edit-inputs" style="display:none;">
                            <input type="text" class="edit-input" value="<?= htmlspecialchars($goal['description']) ?>" />
                        </span>
                        <button class="edit-btn">Edit</button>
                        <button class="save-btn" style="display:none;">Save</button>
                    </div>
                <?php endforeach; ?>
                <!-- Add button -->
                <button id="add-goal-btn">+ Add Goal</button>
                <div id="new-goal-container"></div>
            </div>

            <div class="box">
                <h2>Recent Transactions</h2>

                <input type="text" id="txSearch" onkeyup="filterTransactions()" placeholder="Search by date, category, or amount..." style="width: 100%; padding: 8px; margin-bottom: 10px;">

                <div style="max-height: 300px; overflow-y: auto;">
                    <table id="txTable">
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Amount</th>
                        </tr>
                        <?php if (isset($_SESSION['transactions'])): ?>
                            <?php foreach ($_SESSION['transactions'] as $tx): ?>
                                <?php
                                    $timestamp = $tx['timestamp'] ?? '';
                                    $formattedDate = 'Invalid date';
                                    if (!empty($timestamp)) {
                                        $dt = new DateTime($timestamp);
                                        $formattedDate = $dt->format('d-m-Y, H:i');
                                    }
                                    $category = $tx['category'] ?? 'N/A';
                                    $description = $tx['description'] ?? 'N/A';
                                    $amountVal = $tx['amount']['value'] ?? null;
                                    $amount = is_numeric($amountVal) ? number_format($amountVal, 2) : '0.00';
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($formattedDate) ?></td>
                                    <td><?= htmlspecialchars($description) ?></td>
                                    <td><?= htmlspecialchars($category) ?></td>
                                    <td>£<?= $amount ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4">No transactions available.</td></tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
            <div class="box">
                <h2>Suggested Actions</h2>
                <ul>
                    <?php if (!empty($suggestions)): ?>
                        <?php foreach ($suggestions as $action): ?>
                            <li><?php echo htmlspecialchars($action); ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No suggestions at the moment. Keep up the good work!</li>
                    <?php endif; ?>
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
                        text: 'GBP (£)'
                    },
                    beginAtZero: false
                }
            }
        }
    });
    </script>

</body>
</html>