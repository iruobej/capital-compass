<?php include '../navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISAs Quiz</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1 id="header" style="text-align:center;">ISAs Quiz</h1>
    <div class="quiz-container">
        <form id="quizForm">    
            <input type="hidden" name="topic" value="ISAs" />
            <div class="question">
                <p>1. What does ISA stand for?</p>
                <label><input type="radio" name="q1" value="wrong">Investment Stock Agreement</label><br>
                <label><input type="radio" name="q1" value="correct">Individual Savings Account</label><br>
                <label><input type="radio" name="q1" value="wrong">Instant Savings Arrangement</label><br>
            </div>
            <div class="question">
                <p>2. Which type of ISA allows you to invest in the stock market?</p>
                <label><input type="radio" name="q2" value="correct">Stocks and Shares ISA</label><br>
                <label><input type="radio" name="q2" value="wrong">Cash ISA</label><br>
                <label><input type="radio" name="q2" value="wrong">Lifetime ISA</label><br>
            </div>
            <div class="question">
                <p>3. What is the annual ISA allowance for the 2024/25 tax year (subject to updates)?</p>
                <label><input type="radio" name="q3" value="wrong">£10,000</label><br>
                <label><input type="radio" name="q3" value="wrong">£25,000</label><br>
                <label><input type="radio" name="q3" value="correct">£20,000</label><br>
            </div>
            <div class="question">
                <p>4. What makes an ISA tax-efficient?</p>
                <label><input type="radio" name="q4" value="correct">No income tax or capital gains tax on returns</label><br>
                <label><input type="radio" name="q4" value="wrong">ISA interest is added to your salary</label><br>
                <label><input type="radio" name="q4" value="wrong">You get tax rebates every month</label><br>
            </div>
            <div class="question">
                <p>5. Can you open more than one type of ISA in the same tax year?</p>
                <label><input type="radio" name="q5" value="wrong">No, only one ISA per year</label><br>
                <label><input type="radio" name="q5" value="wrong">Yes, unlimited accounts of all types</label><br>
                <label><input type="radio" name="q5" value="correct">Yes, but you can only pay into one of each type</label><br>
            </div>
            <div class="question">
                <p>6. What is a Lifetime ISA primarily used for?</p>
                <label><input type="radio" name="q6" value="correct">Buying your first home or retirement</label><br>
                <label><input type="radio" name="q6" value="wrong">Starting a business</label><br>
                <label><input type="radio" name="q6" value="wrong">Funding a vacation</label><br>
            </div>
            <div class="question">
                <p>7. What happens if you withdraw from a Lifetime ISA for non-eligible reasons?</p>
                <label><input type="radio" name="q7" value="wrong">You lose the full amount</label><br>
                <label><input type="radio" name="q7" value="correct">You pay a 25% penalty</label><br>
                <label><input type="radio" name="q7" value="wrong">There are no penalties</label><br>
            </div>
            <div id="result" style="text-align:center; font-size:1.2rem; margin-top:20px;"></div>
            <button type="submit">Submit Quiz</button>
        </form>
    </div>
    <script src="quiz.js"></script>
</body>
</html>



