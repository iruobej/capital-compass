<?php
function getBadgeLevel($transactions, $goalsCompleted = 0, $monthsUnderBudget = 0, $customCategoriesTracked = 0) {
    $expenseCount = 0;

    foreach ($transactions as $txn) {
        if ($txn['amount'] < 0) {
            $expenseCount++;
        }
    }

    if ($expenseCount >= 100) {
        return "Lvl 5/5 - Diamond";
    }

    if ($expenseCount >= 50) {
        return "Lvl 4/5 - Platinum";
    }

    if ($expenseCount >= 20) {
        return "Lvl 3/5 - Gold";
    }

    if ($expenseCount >= 5) {
        return "Lvl 2/5 - Silver";
    }

    if (empty($transactions)) {
        $badge = "Lvl 1/5 - Bronze";
    }

    return "Lvl 1/5 - Bronze";
}
