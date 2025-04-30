<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$firstname = $_SESSION['firstname'];
$email = $_SESSION['email'];
$lastname = $_SESSION['lastname'];
$username = $_SESSION['username'];
$budget_alert = $_SESSION['budget_alert'] 
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
    <div class="notifications" style="text-align: center;">
        <div class="box">
            <h2>User Information</h2>
            <p>
                Full Name:
                <span class="display-value"><?php echo htmlspecialchars($firstname . ' ' . $lastname); ?></span>
                <span class="edit-inputs" style="display: none;">
                    <input type="text" class="edit-input first-name" value="<?php echo htmlspecialchars($firstname); ?>" placeholder="First Name">
                    <input type="text" class="edit-input last-name" value="<?php echo htmlspecialchars($lastname); ?>" placeholder="Last Name">
                </span>
                <button class="edit-btn"><i class="fa-solid fa-pencil"></i></button>
                <button class="save-btn" style="display: none;">Save</button>
            </p>
        
            <p data-field="username">
                User Name:
                <span class="display-value"><?php echo htmlspecialchars($username); ?></span>
                <span class="edit-inputs" style="display: none;">
                    <input type="text" class="edit-input first-name" value="<?php echo htmlspecialchars($username); ?>" placeholder="Username">
                </span>
                <button class="edit-btn"><i class="fa-solid fa-pencil"></i></button>
                <button class="save-btn" style="display: none;">Save</button>
            </p>
        
            <p data-field="email">
                Email:
                <span class="display-value"><?php echo htmlspecialchars($email); ?></span>
                <span class="edit-inputs" style="display: none;">
                    <input type="text" class="edit-input first-name" value="<?php echo htmlspecialchars($email); ?>" placeholder="Email">
                </span>
                <button class="edit-btn"><i class="fa-solid fa-pencil"></i></button>
                <button class="save-btn" style="display: none;">Save</button>
            </p>
            <!-- Password change form (submits to change_password.php) -->
            <form action="change_password.php" method="POST" class="password-form" style="text-align: left; display: inline-block;">
                <p data-field="change_password">
                    Password:
                    <span class="display-value">*******</span>
                    <span class="edit-inputs" style="display: none;">
                        <input class="edit-input" type="password" name="current_password" placeholder="Current Password" required><br><br>
                        <input class="edit-input" type="password" name="new_password" placeholder="New Password" required><br><br>
                        <input class="edit-input" type="password" name="confirm_password" placeholder="Confirm New Password" required><br><br>
                    </span>
                    <button type="button" class="edit-btn"><i class="fa-solid fa-pencil"></i></button>
                    <button class="save-btn" type="submit" style="display: none;">Save</button>   
                </p>
            </form>
        </div>  
        <div class="box">
            <h2>Budgeting</h2>
            <p data-field="budget">
                I want an alert set if my balance falls below: £
                <span class="display-value"><?php echo htmlspecialchars($budget_alert); ?></span>
                <input class="edit-input" type="number" min="0" value="<?php echo htmlspecialchars($budget_alert); ?>" style="display:none;">
                <button class="edit-btn"><i class="fa-solid fa-pencil"></i></button>
                <button class="save-btn" style="display:none;">Save</button>
            </p>
        </div>

        <?php
        require_once 'api_connect.php';
        require_once 'badgeLogic.php';
        $transactions = $_SESSION['transactions'] ?? [];

        $badge = getBadgeLevel($transactions);
        ?>

        <div class="box">
            <h2>Badges and Achievments</h2>
            <p>Current Badge: <?php echo "<span class='badge'>$badge</span>";?></p>
        </div>

        <div class="box">
            <h2>Connect Banks</h2>
            <p>Connected Banks: Barclays, Monzo, Starling, etc</p>
        </div>
        <button style="background-color: red;" onclick="location.href='logout.php';">Logout</button>
    </div>
<script src="profile.js"></script>
</body>