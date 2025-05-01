<?php
function getBadgeLevel($transactions) {
    $expenseCount = 0;

    foreach ($transactions as $txn) {
        if ($txn['amount'] < 0) {
            $expenseCount++;
        }
    }

    if ($expenseCount >= 100) {
        return "5/5 - Diamond";
    }

    if ($expenseCount >= 50) {
        return "4/5 - Platinum";
    }

    if ($expenseCount >= 20) {
        return "3/5 - Gold";
    }

    if ($expenseCount >= 5) {
        return "2/5 - Silver";
    }

    if (empty($transactions)) {
        $badge = "1/5 - Bronze";
    }

    return "1/5 - Bronze";
}
