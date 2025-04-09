<?php
$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$port = getenv('DB_PORT');

$dsn = "pgsql:host=$host;port=$port;dbname=$db";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Drop and recreate the users table
    $pdo->exec("
        DROP TABLE IF EXISTS users;

        CREATE TABLE users (
            id SERIAL PRIMARY KEY,
            username VARCHAR(255) NOT NULL,
            password TEXT NOT NULL,
            email VARCHAR(255) UNIQUE NOT NULL,
            firstname VARCHAR(255),
            lastname VARCHAR(255)
        );
    ");

    
    $sql = <<<'SQL'
    INSERT INTO users (id, username, password, email, firstname, lastname) VALUES
    (1, 'j.irobz', '$2y$12$XHZYzoU4rpTY2a3BTONov..lWlP9V1mClpoqksHR1kzESpBsssSIe', 'joshuairuobe@gmail.com', 'Joshua', 'Iruobe')
SQL;

    $pdo->exec($sql);
    echo "Users table reset and single user imported!";

} catch (PDOException $e) {
    echo "DB import failed: " . $e->getMessage();
}
?>
