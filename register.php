<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connecting to database 
$host = getenv('DB_HOST');
$db = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$port = getenv('DB_PORT');

$dsn = "pgsql:host=$host;port=$port;dbname=$db";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Sanitising and trim inputs
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $username = strtolower(trim($_POST['username']));
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validation
    if ($password !== $confirm_password) {
        header("Location: register.html?error=" . urlencode("Passwords do not match"));
        exit();
    }

    if (strlen($password) < 12) {
        header("Location: register.html?error=" . urlencode("Password must be at least 12 characters long"));
        exit();
    }

    if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
        header("Location: register.html?error=" . urlencode("Password must include at least one special character"));
        exit();
    }

    if (!preg_match('/[A-Z]/', $password)) {
        header("Location: register.html?error=" . urlencode("Password must include at least one uppercase letter"));
        exit();
    }

    if (!preg_match('/[a-z]/', $password)) {
        header("Location: register.html?error=" . urlencode("Password must include at least one lowercase letter"));
        exit();
    }

    // Checking for duplicate username or email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
    $stmt->execute([
        ':username' => $username,
        ':email' => $email
    ]);

    if ($stmt->rowCount() > 0) {
        header("Location: register.html?error=" . urlencode("Username or email already exists"));
        exit();
    }

    // Hashing password and inserting user into the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password, email, firstname, lastname) 
                           VALUES (:username, :password, :email, :firstname, :lastname)");
    $success = $stmt->execute([
        ':username' => $username,
        ':password' => $hashed_password,
        ':email' => $email,
        ':firstname' => $firstname,
        ':lastname' => $lastname
    ]);

    if ($success) {
        $_SESSION['username'] = $firstname . ' ' . $lastname;
        header("Location: home.php");
        exit();
    } else {
        header("Location: register.html?error=" . urlencode("Registration failed"));
        exit();
    }

} catch (PDOException $e) {
    die("DB connection failed: " . $e->getMessage());
}
?>