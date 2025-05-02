<?php
function generateSuggestedActions($transactions) {
    $suggestedActions = [];
    $categoryTotals = [];

    foreach ($transactions as $txn) {
        $cat = $txn['category'];
        $amt = $txn['amount']['value'];

        if ($amt < 0) {  // Only counting expenses
            $categoryTotals[$cat] = ($categoryTotals[$cat] ?? 0) + abs($amt);
        }
    }

    if (($categoryTotals['Alcohol'] ?? 0) > 100) {
        $suggestedActions[] = "Consider reducing alcohol spending.";
    }

    if (($categoryTotals['Gaming'] ?? 0) > 150) {
        $suggestedActions[] = "Gaming expenses are high — consider setting a budget.";
    }

    if (($categoryTotals['Subscriptions'] ?? 0) > 200) {
        $suggestedActions[] = "Review your subscription services for unnecessary ones.";
    }

    if (empty($categoryTotals['Savings'] ?? [])) {
        $suggestedActions[] = "Start setting aside monthly savings.";
    }

    return $suggestedActions;
}
?>
