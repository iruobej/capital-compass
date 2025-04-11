<?php include '../navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budgeting Quiz</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1 style="text-align:center;">Budgeting Quiz</h1>
    <form id="quizForm">
        <div class="question">
            <p>1. What does the 50/30/20 rule suggest you spend 50% of your income on?</p>
            <label><input type="radio" name="q1" value="correct">Needs</label><br>
            <label><input type="radio" name="q1" value="wrong">Wants</label><br>
            <label><input type="radio" name="q1" value="wrong">Savings</label><br>
        </div>
        <div class="question">
            <p>2. What is a zero-based budget?</p>
            <label><input type="radio" name="q2" value="wrong">A budget where you save everything</label><br>
            <label><input type="radio" name="q2" value="correct">A budget where every dollar is assigned a job</label><br>
            <label><input type="radio" name="q2" value="wrong">A budget with no limits</label><br>
        </div>
        <div class="question">
            <p>3. Which of the following is a fixed expense?</p>
            <label><input type="radio" name="q3" value="correct">Rent</label><br>
            <label><input type="radio" name="q3" value="wrong">Groceries</label><br>
            <label><input type="radio" name="q3" value="wrong">Gas</label><br>
        </div>
        <div class="question">
            <p>4. What is the main benefit of tracking expenses?</p>
            <label><input type="radio" name="q4" value="wrong">It saves money automatically</label><br>
            <label><input type="radio" name="q4" value="correct">It helps identify spending habits</label><br>
            <label><input type="radio" name="q4" value="wrong">It increases your income</label><br>
        </div>
        <div class="question">
            <p>5. Which app is commonly used for personal budgeting?</p>
            <label><input type="radio" name="q5" value="correct">YNAB (You Need a Budget)</label><br>
            <label><input type="radio" name="q5" value="wrong">Zoom</label><br>
            <label><input type="radio" name="q5" value="wrong">Spotify</label><br>
        </div>
        <div class="question">
            <p>6. What should you do first when creating a budget?</p>
            <label><input type="radio" name="q6" value="correct">Calculate your monthly income</label><br>
            <label><input type="radio" name="q6" value="wrong">Start cutting expenses</label><br>
            <label><input type="radio" name="q6" value="wrong">Buy budgeting software</label><br>
        </div>
        <div class="question">
            <p>7. Why is an emergency fund important?</p>
            <label><input type="radio" name="q7" value="wrong">To spend on vacations</label><br>
            <label><input type="radio" name="q7" value="correct">To cover unexpected expenses</label><br>
            <label><input type="radio" name="q7" value="wrong">To pay for luxury items</label><br>
        </div>
        <div id="result" style="text-align:center; font-size:1.2rem; margin-top:20px;"></div>
        <button type="submit">Submit Quiz</button>
    </form>

    <script src="quiz.js"></script>
</body>
</html>




