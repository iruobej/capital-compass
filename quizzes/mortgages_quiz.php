<?php include '../navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mortgages Quiz</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1 id="header" style="text-align:center;">Mortgages Quiz</h1>
    <div class="quiz-container">
    <form id="quizForm">
        <input type="hidden" name="topic" value="Budgeting" />
        <div class="question">
            <p>1. What is a mortgage?</p>
            <label><input type="radio" name="q1" value="correct">A loan used to purchase property</label><br>
            <label><input type="radio" name="q1" value="wrong">A type of insurance</label><br>
            <label><input type="radio" name="q1" value="wrong">A retirement account</label><br>
        </div>
        <div class="question">
            <p>2. What does a down payment refer to?</p>
            <label><input type="radio" name="q2" value="correct">Initial upfront portion paid when buying a house</label><br>
            <label><input type="radio" name="q2" value="wrong">Monthly insurance fee</label><br>
            <label><input type="radio" name="q2" value="wrong">Property taxes</label><br>
        </div>
        <div class="question">
            <p>3. What is typically the minimum credit score needed for a conventional mortgage?</p>
            <label><input type="radio" name="q3" value="wrong">500</label><br>
            <label><input type="radio" name="q3" value="correct">620</label><br>
            <label><input type="radio" name="q3" value="wrong">700</label><br>
        </div>
        <div class="question">
            <p>4. What does "fixed-rate mortgage" mean?</p>
            <label><input type="radio" name="q4" value="wrong">Rate changes monthly</label><br>
            <label><input type="radio" name="q4" value="wrong">No interest is charged</label><br>
            <label><input type="radio" name="q4" value="correct">Interest rate stays the same for the entire loan term</label><br>
        </div>
        <div class="question">
            <p>5. What is PMI?</p>
            <label><input type="radio" name="q5" value="correct">Private Mortgage Insurance</label><br>
            <label><input type="radio" name="q5" value="wrong">Public Market Index</label><br>
            <label><input type="radio" name="q5" value="wrong">Personal Money Investment</label><br>
        </div>
        <div class="question">
            <p>6. Why do lenders require a home appraisal?</p>
            <label><input type="radio" name="q6" value="correct">To confirm the property's market value</label><br>
            <label><input type="radio" name="q6" value="wrong">To inspect furniture</label><br>
            <label><input type="radio" name="q6" value="wrong">To assess neighbor quality</label><br>
        </div>
        <div class="question">
            <p>7. What happens in foreclosure?</p>
            <label><input type="radio" name="q7" value="wrong">You sell the home voluntarily</label><br>
            <label><input type="radio" name="q7" value="wrong">You get a second mortgage</label><br>
            <label><input type="radio" name="q7" value="correct">The lender takes possession of the home</label><br>
        </div>
        <div id="result" style="text-align:center; font-size:1.2rem; margin-top:20px;"></div>
        <button type="submit">Submit Quiz</button>
    </form>
    </div>
    <script src="quiz.js"></script>
</body>
</html>