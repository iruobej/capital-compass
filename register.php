<?php
session_start();

//Connecting to database 
$host = 'localhost';
$db = 'financial_app';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

//Checking connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

//Getting and sanitising inputs
$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

//Error handling
if($password !== $confirm_password){
    header("Location: register.html?error=" . urlencode("Passwords do not match"));
    exit();
}

if(strlen($password) < 12){
    header("Location: register.html?error=" . urlencode("Password must be at least 12 characters long"));
    exit();
}

if(!preg_match('/[^a-zA-Z0-9]/', $password)) {
    header("Location: register.html?error=" . urlencode("Password must include at least one special character"));
    exit();
}

if(!preg_match('/[A-Z]/', $password)){
    header("Location: register.html?error=" . urlencode("Password must include at least one uppercase letter"));
    exit();
}

if(!preg_match('/[a-z]/', $password)){
    header("Location: register.html?error=" . urlencode("Password must include at least one lowercase letter"));
    exit();
}

$sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    header("Location: register.html?error=" . urlencode("Username or email already exists"));
    exit();
}

//Hashing the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

//Inserting new user's credentials into database
$sql = "INSERT INTO users (username, password, email, firstname, lastname)
        VALUES ('$username', '$hashed_password', '$email', '$firstname', '$lastname')";

if($conn->query($sql) === TRUE) {
    $_SESSION['username'] = $firstname . ' ' . $lastname;

    //Redirecting to the home page
    header("Location: home.php");
    exit();
} else {
    header("Location: register.html?error=" . urlencode("Registration failed"));
    exit();
}

$conn->close();
?>