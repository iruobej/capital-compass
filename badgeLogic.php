<?php
function getBadgeLevel($transactions, $goalsCompleted = 0, $monthsUnderBudget = 0, $customCategoriesTracked = 0) {
    $expenseCount = 0;

    foreach ($transactions as $txn) {
        if ($txn['amount'] < 0) {
            $expenseCount++;
        }
    }

    if ($expenseCount >= 100) {
        return "Money Master";
    }

    if ($expenseCount >= 50) {
        return "Financial Strategist";
    }

    if ($expenseCount >= 20) {
        return "Smart Planner";
    }

    if ($expenseCount >= 5) {
        return "Budget Explorer";
    }

    return "Beginner Saver";
}
