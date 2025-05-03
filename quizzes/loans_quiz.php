<?php include '../navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loans Quiz</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1 id="header" style="text-align:center;">Loans Quiz</h1>
    <div class="quiz-container">
        <form id="quizForm">
            <input type="hidden" name="topic" value="Loans" />
            <div class="question">
                <p>1. What is a loan?</p>
                <label><input type="radio" name="q1" value="correct">A sum of money borrowed to be paid back with interest</label><br>
                <label><input type="radio" name="q1" value="wrong">A type of savings account</label><br>
                <label><input type="radio" name="q1" value="wrong">An investment in stocks</label><br>
            </div>
            <div class="question">
                <p>2. What does "interest rate" refer to in a loan?</p>
                <label><input type="radio" name="q2" value="wrong">A tax on your income</label><br>
                <label><input type="radio" name="q2" value="wrong">The value of your property</label><br>
                <label><input type="radio" name="q2" value="correct">The cost of borrowing the money</label><br>
            </div>
            <div class="question">
                <p>3. What is the difference between secured and unsecured loans?</p>
                <label><input type="radio" name="q3" value="correct">Secured loans require collateral, unsecured do not</label><br>
                <label><input type="radio" name="q3" value="wrong">Unsecured loans are free</label><br>
                <label><input type="radio" name="q3" value="wrong">Secured loans are illegal</label><br>
            </div>
            <div class="question">
                <p>4. What is a credit score used for in loan approval?</p>
                <label><input type="radio" name="q4" value="correct">To assess your creditworthiness</label><br>
                <label><input type="radio" name="q4" value="wrong">To calculate taxes</label><br>
                <label><input type="radio" name="q4" value="wrong">To open a savings account</label><br>
            </div>
            <div class="question">
                <p>5. Which of the following is a common type of loan?</p>
                <label><input type="radio" name="q5" value="wrong">Payroll bond</label><br>
                <label><input type="radio" name="q5" value="wrong">Debit accrual</label><br>
                <label><input type="radio" name="q5" value="correct">Personal loan</label><br>
            </div>
            <div class="question">
                <p>6. What does loan term refer to?</p>
                <label><input type="radio" name="q6" value="wrong">The value of the loan</label><br>
                <label><input type="radio" name="q6" value="correct">The length of time to repay the loan</label><br>
                <label><input type="radio" name="q6" value="wrong">The number of interest payments</label><br>
            </div>
            <div class="question">
                <p>7. Why should you compare multiple lenders before accepting a loan?</p>
                <label><input type="radio" name="q7" value="correct">To find the best interest rate and terms</label><br>
                <label><input type="radio" name="q7" value="wrong">To avoid paying taxes</label><br>
                <label><input type="radio" name="q7" value="wrong">To delay your payments</label><br>
            </div>
            <div id="result" style="text-align:center; font-size:1.2rem; margin-top:20px;"></div>
            <button type="submit">Submit Quiz</button>
        </form>
    </div>
    <script src="quiz.js"></script>
</body>
</html>