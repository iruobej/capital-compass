<?php include '../navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investing Quiz</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1 style="text-align:center;">Investing Quiz</h1>
    <div class="quiz-container">
        <form id="quizForm">
            <div class="question">
                <p>1. What is diversification in investing?</p>
                <label><input type="radio" name="q1" value="correct">Spreading investments across different assets</label><br>
                <label><input type="radio" name="q1" value="wrong">Investing all in one stock</label><br>
                <label><input type="radio" name="q1" value="wrong">Avoiding all risky investments</label><br>
            </div>
            <div class="question">
                <p>2. What type of investment is typically considered the least risky?</p>
                <label><input type="radio" name="q2" value="correct">Government Bonds</label><br>
                <label><input type="radio" name="q2" value="wrong">Stocks</label><br>
                <label><input type="radio" name="q2" value="wrong">Cryptocurrency</label><br>
            </div>
            <div class="question">
                <p>3. What is a dividend?</p>
                <label><input type="radio" name="q3" value="correct">A payment made to shareholders from a company’s profits</label><br>
                <label><input type="radio" name="q3" value="wrong">A type of stock</label><br>
                <label><input type="radio" name="q3" value="wrong">A government tax</label><br>
            </div>
            <div class="question">
                <p>4. What is a mutual fund?</p>
                <label><input type="radio" name="q4" value="correct">A pool of funds from many investors to buy a diversified portfolio</label><br>
                <label><input type="radio" name="q4" value="wrong">A fund managed by one person for their own use</label><br>
                <label><input type="radio" name="q4" value="wrong">A savings account with high interest</label><br>
            </div>
            <div class="question">
                <p>5. What does ROI stand for?</p>
                <label><input type="radio" name="q5" value="correct">Return on Investment</label><br>
                <label><input type="radio" name="q5" value="wrong">Rate of Inflation</label><br>
                <label><input type="radio" name="q5" value="wrong">Ratio of Interest</label><br>
            </div>
            <div class="question">
                <p>6. What is the stock market?</p>
                <label><input type="radio" name="q6" value="correct">A place where stocks are bought and sold</label><br>
                <label><input type="radio" name="q6" value="wrong">A bank for large investors</label><br>
                <label><input type="radio" name="q6" value="wrong">A type of mutual fund</label><br>
            </div>
            <div class="question">
                <p>7. What does it mean to have a long-term investment strategy?</p>
                <label><input type="radio" name="q7" value="correct">Investing with the intention of holding for several years</label><br>
                <label><input type="radio" name="q7" value="wrong">Selling quickly after buying</label><br>
                <label><input type="radio" name="q7" value="wrong">Avoiding all stocks</label><br>
            </div>
            <div id="result" style="text-align:center; font-size:1.2rem; margin-top:20px;"></div>
            <button type="submit">Submit Quiz</button>
        </form>
    </div>
    <script src="quiz.js"></script>
</body>
</html>
