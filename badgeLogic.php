<?php
function getBadgeLevel($transactions, $conn, $user_id) {
    // Calculating spending ratio
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
        return "Insufficient Income Data";
    }

    $spendingRatio = $totalExpenses / $totalIncome;

    // Querying pass/fail ratio
    $stmt = $conn->prepare("
        SELECT COUNT(*) AS total, 
               SUM(CASE WHEN pass_fail = 'pass' THEN 1 ELSE 0 END) AS passed
        FROM quiz_attempts
        WHERE user_id = ?
    ");
    $stmt->execute([$user_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $quizPassRatio = ($row['total'] > 0) ? ($row['passed'] / $row['total']) : null;

    if ($quizPassRatio === null) {
        return "No Quiz Data";
    }

    // Normalising both ratios to a common scale
    $spendingScore = 1 - min($spendingRatio, 1.5); // lower = better, capped
    $quizScore = $quizPassRatio; // higher = better

    // Combining both (equal weighting here)
    $combinedScore = ($spendingScore + $quizScore) / 2;

    // Evaluating badge level
    if ($combinedScore >= 0.85) {
        return "5/5 – Diamond";
    } elseif ($combinedScore >= 0.7) {
        return "4/5 – Platinum";
    } elseif ($combinedScore >= 0.55) {
        return "3/5 – Gold";
    } elseif ($combinedScore >= 0.4) {
        return "2/5 – Silver";
    } else {
        return "1/5 – Bronze";
    }
}
?>