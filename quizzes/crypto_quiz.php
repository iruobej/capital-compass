<?php include '../navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cryptocurrency Quiz</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1 id="header" style="text-align:center;">Cryptocurrency Quiz</h1>
    <div class="quiz-container">
        <form id="quizForm">
            <input type="hidden" name="topic" value="Cryptocurrency" />
            <div class="question">
                <p>1. What is the underlying technology of most cryptocurrencies?</p>
                <label><input type="radio" name="q1" value="correct">Blockchain</label><br>
                <label><input type="radio" name="q1" value="wrong">Cloud Storage</label><br>
                <label><input type="radio" name="q1" value="wrong">Data Mining</label><br>
            </div>
            <div class="question">
                <p>2. What is Bitcoin often referred to as?</p>
                <label><input type="radio" name="q2" value="correct">Digital Gold</label><br>
                <label><input type="radio" name="q2" value="wrong">Crypto Cash</label><br>
                <label><input type="radio" name="q2" value="wrong">E-Stocks</label><br>
            </div>
            <div class="question">
                <p>3. What does "HODL" mean in the crypto community?</p>
                <label><input type="radio" name="q3" value="correct">Hold on for dear life</label><br>
                <label><input type="radio" name="q3" value="wrong">High Order Decentralized Ledger</label><br>
                <label><input type="radio" name="q3" value="wrong">Hyper Online Digital Ledger</label><br>
            </div>
            <div class="question">
                <p>4. Which of the following is NOT a cryptocurrency?</p>
                <label><input type="radio" name="q4" value="correct">PayPal</label><br>
                <label><input type="radio" name="q4" value="wrong">Ethereum</label><br>
                <label><input type="radio" name="q4" value="wrong">Cardano</label><br>
            </div>
            <div class="question">
                <p>5. What is a crypto wallet used for?</p>
                <label><input type="radio" name="q5" value="correct">To store and manage private keys</label><br>
                <label><input type="radio" name="q5" value="wrong">To generate fiat currency</label><br>
                <label><input type="radio" name="q5" value="wrong">To mine coins</label><br>
            </div>
            <div class="question">
                <p>6. What is the purpose of mining in Bitcoin?</p>
                <label><input type="radio" name="q6" value="correct">To validate transactions and secure the network</label><br>
                <label><input type="radio" name="q6" value="wrong">To create NFTs</label><br>
                <label><input type="radio" name="q6" value="wrong">To send emails securely</label><br>
            </div>
            <div class="question">
                <p>7. What is an ICO in the crypto world?</p>
                <label><input type="radio" name="q7" value="correct">Initial Coin Offering</label><br>
                <label><input type="radio" name="q7" value="wrong">Internet Currency Outlet</label><br>
                <label><input type="radio" name="q7" value="wrong">Initial Crypto Ownership</label><br>
            </div>
            <div id="result" style="text-align:center; font-size:1.2rem; margin-top:20px;"></div>
            <button type="submit">Submit Quiz</button>
        </form>
    </div>
    <script src="quiz.js"></script>
</body>
</html>