<?php include '../navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saving Quiz</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1 id="header" style="text-align:center;">Saving Quiz</h1>
    <div class="quiz-container">
        <form id="quizForm">
            <div class="question">
                <p>1. What is an emergency fund?</p>
                <label><input type="radio" name="q1" value="correct">Money set aside for unexpected expenses</label><br>
                <label><input type="radio" name="q1" value="wrong">A vacation savings account</label><br>
                <label><input type="radio" name="q1" value="wrong">A fund to invest in stocks</label><br>
            </div>
            <div class="question">
                <p>2. What is compound interest?</p>
                <label><input type="radio" name="q2" value="correct">Interest earned on both principal and previous interest</label><br>
                <label><input type="radio" name="q2" value="wrong">Interest only on principal</label><br>
                <label><input type="radio" name="q2" value="wrong">Interest paid yearly without growth</label><br>
            </div>
            <div class="question">
                <p>3. Which type of savings account typically earns the most interest?</p>
                <label><input type="radio" name="q3" value="correct">High-yield savings account</label><br>
                <label><input type="radio" name="q3" value="wrong">Checking account</label><br>
                <label><input type="radio" name="q3" value="wrong">Standard savings account</label><br>
            </div>
            <div class="question">
                <p>4. Why should you automate your savings?</p>
                <label><input type="radio" name="q4" value="correct">It ensures consistent saving without thinking about it</label><br>
                <label><input type="radio" name="q4" value="wrong">To avoid bank fees</label><br>
                <label><input type="radio" name="q4" value="wrong">To increase debt</label><br>
            </div>
            <div class="question">
                <p>5. What’s a common savings goal?</p>
                <label><input type="radio" name="q5" value="correct">Buying a house</label><br>
                <label><input type="radio" name="q5" value="wrong">Paying more taxes</label><br>
                <label><input type="radio" name="q5" value="wrong">Spending without limits</label><br>
            </div>
            <div class="question">
                <p>6. How can budgeting help with saving?</p>
                <label><input type="radio" name="q6" value="correct">It helps identify areas to cut back and save</label><br>
                <label><input type="radio" name="q6" value="wrong">It encourages overspending</label><br>
                <label><input type="radio" name="q6" value="wrong">It tracks credit card points</label><br>
            </div>
            <div class="question">
                <p>7. What is a good rule of thumb for emergency savings?</p>
                <label><input type="radio" name="q7" value="correct">3–6 months of expenses</label><br>
                <label><input type="radio" name="q7" value="wrong">1 month of rent</label><br>
                <label><input type="radio" name="q7" value="wrong">1 year of income</label><br>
            </div>
            <div id="result" style="text-align:center; font-size:1.2rem; margin-top:20px;"></div>
            <button type="submit">Submit Quiz</button>
        </form>
    </div>
    <script src="quiz.js"></script>
</body>
</html>
