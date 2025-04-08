<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    //require 'database.php'; //File to connect to database

    $host = getenv('DB_HOST');
    $db = getenv('DB_NAME');
    $user = getenv('DB_USER');
    $pass = getenv('DB_PASS');
    $port = getenv('DB_PORT');
    
    $dsn = "pgsql:host=$host;port=$port;dbname=$db";
    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $username = strtolower(trim($_POST['username']));
        $password = trim($_POST['password']);

        //Querying the database for the user
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // User authentication
        if ($user && password_verify($password, $user['password'])){
            //Password correct, start session and redirect
            $_SESSION['username'] = $username;
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['email'] = $user['email'];
            header("Location: home.php");
            exit();
        } else {
            //Invalid credentials
            header("Location: login.html?error=" . urlencode("Invalid username or password"));
        }
        

    } catch (PDOException $e) {
        die("DB connection failed: " . $e->getMessage());
    }
?>