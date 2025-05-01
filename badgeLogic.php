<?php
function getBadgeLevel($transactions) {
    $totalIncome = 0;
    $totalExpenses = 0;

    foreach ($transactions as $txn) {
        if (!isset($txn['amount']['value'])) continue;

        $value = $txn['amount']['value'];

        if ($value > 0) {
            $totalIncome += $value;
        } elseif ($value < 0) {
            $totalExpenses += abs($value);
        }
    }

    if ($totalIncome == 0) {
        return "No Income Data";
    }

    $spendingRatio = $totalExpenses / $totalIncome;

    if ($spendingRatio <= 0.4) {
        return "5/5 – Diamond";
    } elseif ($spendingRatio <= 0.6) {
        return "4/5 – Platinum";
    } elseif ($spendingRatio <= 0.8) {
        return "3/5 – Gold";
    } elseif ($spendingRatio <= 1.0) {
        return "2/5 – Silver";
    } else {
        return "1/5 – Bronze";
    }
}
?>