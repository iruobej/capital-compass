<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$firstname = $_SESSION['firstname'];
$email = $_SESSION['email'];
$lastname = $_SESSION['lastname'];
$username = $_SESSION['username'];
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap');
        </style>
</head>
<body>
    <?php include 'navbar.php'; include 'config.php'; ?>
    <h1 id="header" style="text-align: center;">Profile</h1>
    <!-- <?php echo 'CLIENT_ID: ' . TL_CLIENT_ID . '<br>';
    echo 'CLIENT_SECRET: ' . TL_CLIENT_SECRET . '<br>';
    echo 'REDIRECT_URI: ' . TL_REDIRECT_URI . '<br>';?> -->
    <div class="notifications" style="text-align: center;">
        <div class="box">
            <h2>User Information</h2>
            <p>Full Name: <?php echo htmlspecialchars($firstname . ' ' . $lastname); ?><button class="edit-btn"><i class="fa-solid fa-pencil"></i></button></p> 
            <p>User Name: <?php echo htmlspecialchars($username); ?><button class="edit-btn"><i class="fa-solid fa-pencil"></i></button></p> 
            <p>Email: <?php echo htmlspecialchars($email); ?><button class="edit-btn"><i class="fa-solid fa-pencil"></i></button></p> 
        </div>
        <div class="box">
            <h2>Budgeting</h2>
            <p>I want an alert set if my balance falls below: £100 <button class="edit-btn"><i class="fa-solid fa-pencil"></i></button></p> </p> 
        </div>
        <div class="box">
            <h2>Badges and Achievments</h2>
            <p>Current Badge: Beginner Saver</p>
        </div>

        <?php
        $state = bin2hex(random_bytes(8));
        $nonce = bin2hex(random_bytes(8));

        $auth_url = "https://auth.truelayer.com/?" . http_build_query([
            'response_type' => 'code',
            'client_id' => TL_CLIENT_ID,
            'redirect_uri' => TL_REDIRECT_URI,
            'scope' => 'info accounts balance cards transactions direct_debits standing_orders offline_access',
            'providers' => 'uk-cs-mock uk-ob-all uk-oauth-all',
            'state' => $state,
            'nonce' => $nonce
        ]);
        echo '<pre>';
        var_dump(TL_CLIENT_ID);
        echo '</pre>';
        ?>
        <div class="box">
            <h2>Connect Banks</h2>
            <p>Connected Banks: Barclays, Monzo, Starling, etc</p>
            <?php echo '<pre>' . htmlspecialchars($auth_url) . '</pre>'; ?>
            <a href="<?= $auth_url ?>">Connect Bank</a>
        </div>
        <button style="background-color: red;" onclick="location.href='logout.php';">Logout</button>
    </div>
</body>