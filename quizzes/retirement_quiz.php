<?php include '../navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retirement Quiz</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1 style="text-align:center;">Retirement Quiz</h1>
    <form id="quizForm">
        <div class="question">
            <p>1. What is the main purpose of a retirement plan?</p>
            <label><input type="radio" name="q1" value="correct">To ensure financial security after you stop working</label><br>
            <label><input type="radio" name="q1" value="wrong">To buy a house</label><br>
            <label><input type="radio" name="q1" value="wrong">To pay off a car loan</label><br>
        </div>
        <div class="question">
            <p>2. What is a 401(k)?</p>
            <label><input type="radio" name="q2" value="correct">An employer-sponsored retirement savings plan</label><br>
            <label><input type="radio" name="q2" value="wrong">A health insurance plan</label><br>
            <label><input type="radio" name="q2" value="wrong">A mortgage account</label><br>
        </div>
        <div class="question">
            <p>3. At what age can you typically start withdrawing from a retirement account without penalty?</p>
            <label><input type="radio" name="q3" value="correct">59½</label><br>
            <label><input type="radio" name="q3" value="wrong">45</label><br>
            <label><input type="radio" name="q3" value="wrong">65</label><br>
        </div>
        <div class="question">
            <p>4. What does IRA stand for?</p>
            <label><input type="radio" name="q4" value="correct">Individual Retirement Account</label><br>
            <label><input type="radio" name="q4" value="wrong">Income Reserved Agreement</label><br>
            <label><input type="radio" name="q4" value="wrong">Invested Retirement Annuity</label><br>
        </div>
        <div class="question">
            <p>5. What is the benefit of employer matching in a retirement plan?</p>
            <label><input type="radio" name="q5" value="correct">It’s essentially free money added to your retirement savings</label><br>
            <label><input type="radio" name="q5" value="wrong">It increases your salary</label><br>
            <label><input type="radio" name="q5" value="wrong">It lowers your interest rates</label><br>
        </div>
        <div class="question">
            <p>6. Why is it important to start saving for retirement early?</p>
            <label><input type="radio" name="q6" value="correct">To benefit from compound interest over time</label><br>
            <label><input type="radio" name="q6" value="wrong">To avoid opening a savings account later</label><br>
            <label><input type="radio" name="q6" value="wrong">To avoid taxes altogether</label><br>
        </div>
        <div class="question">
            <p>7. What’s the main difference between a Roth IRA and a Traditional IRA?</p>
            <label><input type="radio" name="q7" value="correct">Roth IRA contributions are taxed now, withdrawals are tax-free</label><br>
            <label><input type="radio" name="q7" value="wrong">Traditional IRAs don’t require investment</label><br>
            <label><input type="radio" name="q7" value="wrong">Roth IRAs are only for business owners</label><br>
        </div>
        <button type="submit">Submit Quiz</button>
    </form>

    <div id="result" style="text-align:center; font-size:1.2rem; margin-top:20px;"></div>
    <script src="quiz.js"></script>
</body>
</html>