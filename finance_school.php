<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capital Compass - Finance School</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap');
        </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <h1 id="header" style="text-align: center;">Finance School</h1>
    <h2 style="text-align: center;">Learning</h2>
    <div class="page-container">
        <div class="grid-layout1">
            <button class="school-option" onclick="location.href='schoolPages/budgeting.php';"><h2 class="option-text">Budgeting</h2></button>
            <button class="school-option" onclick="location.href='schoolPages/retirement.php';"><h2 class="option-text">Retirement</h2></button>
            <button class="school-option" onclick="location.href='schoolPages/investing.php';"><h2 class="option-text">Investing</h2></button>
            <button class="school-option" onclick="location.href='schoolPages/saving.php';"><h2 class="option-text">Saving</h2></button>
            <button class="school-option" onclick="location.href='schoolPages/isas.php';"><h2 class="option-text">ISAs</h2></button>
            <button class="school-option" onclick="location.href='schoolPages/crypto.php';"><h2 class="option-text">Cryptocurrency</h2></button>
            <button class="school-option" onclick="location.href='schoolPages/mortgages.php';"><h2 class="option-text">Mortgages</h2></button>
            <button class="school-option" onclick="location.href='schoolPages/loans.php';"><h2 class="option-text">Loans</h2></button>
        </div>
    </div>  
    <h2 style="text-align: center;">Quizzes</h2>
    <div class="page-container">
        <div class="grid-layout1">
            <button class="school-option" onclick="location.href='quizzes/budgeting_quiz.php';"><h2 class="option-text">Budgeting</h2></button>
            <button class="school-option" onclick="location.href='quizzes/retirement_quiz.php';"><h2 class="option-text">Retirement</h2></button>
            <button class="school-option" onclick="location.href='quizzes/investing_quiz.php';"><h2 class="option-text">Investing</h2></button>
            <button class="school-option" onclick="location.href='quizzes/saving_quiz.php';"><h2 class="option-text">Saving</h2></button>
            <button class="school-option" onclick="location.href='quizzes/isas_quiz.php';"><h2 class="option-text">ISAs</h2></button>
            <button class="school-option" onclick="location.href='quizzes/crypto_quiz.php';"><h2 class="option-text">Cryptocurrency</h2></button>
            <button class="school-option" onclick="location.href='quizzes/mortgages_quiz.php';"><h2 class="option-text">Mortgages</h2></button>
            <button class="school-option" onclick="location.href='quizzes/loans_quiz.php';"><h2 class="option-text">Loans</h2></button>
        </div>
    </div>  
    <footer>
        <p>&copy; 2025 Capital Compass</p>
    </footer>

</body>