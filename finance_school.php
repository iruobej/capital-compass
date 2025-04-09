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
    <div class="page-container">
        <div class="grid-layout1">
            <button class="school-option" onclick="location.href='budgeting.php';"><h2 class="option-text">Budgeting</h2></button>
            <button class="school-option" onclick="location.href='retirement.php';"><h2 class="option-text">Retirement</h2></button>
            <button class="school-option" onclick="location.href='investing.php';"><h2 class="option-text">Investing</h2></button>
            <button class="school-option" onclick="location.href='saving.php';"><h2 class="option-text">Saving</h2></button>
            <button class="school-option" onclick="location.href='isas.php';"><h2 class="option-text">ISAs</h2></button>
            <button class="school-option" onclick="location.href='crypto.php';"><h2 class="option-text">Cryptocurrency</h2></button>
            <button class="school-option" onclick="location.href='mortgages.php';"><h2 class="option-text">Mortgages</h2></button>
            <button class="school-option" onclick="location.href='loans.php';"><h2 class="option-text">Loans</h2></button>
        </div>
    </div>  
    <footer>
        <p>&copy; 2025 Capital Compass</p>
    </footer>

</body>