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

   

    $sql = <<<SQL
    INSERT INTO users (id, username, password, email, firstname, lastname) VALUES
    (1, '@j.iruobe', '$2y$12$g77enCFF3SNDi0kGkZjaKOru0qn.I4oIAWVsBQnVIn0F4iodKWbhy', 'joshuairuobe@gmail.com', 'Joshua', 'Iruobe'),
(2, 'johndoe', '$2y$12$ctdPvRGKONO.tMfyR56ys.Ksct3lIdSlyjCeILmJ0OjgwAyglFiwa', 'johndoe@gmail.com', 'John', 'Doe'),
(4, 'johndee', '$2y$12$khLKE1L8jFDwoGJIJbGx2.UlPGjN0PJTeoElLlKXXYLE75y/DN3y.', 'johndee@gmail.com', 'John', 'Dee'),
(6, 'johndeed', '$2y$12$KeoUxVLnb9oczmIWse5aYOYMTSxN66MBEojoTRNb6Kjve4RKSMep6', 'johndeed@gmail.com', 'John', 'Deed'),
(7, 'jbrown', '$2y$12$qdpOL34SAe.O13fjeTjyl.Hhia5z3JVg2qXB1XEp5G1gyllL4i1Y2', 'jbrown@outlook.com', 'James', 'Brown'),
(8, 'johns', '$2y$12$uE7D61pjlGt/fXsujTrMYeff5q2kxlO87fGxCjFNBZJUC/vwfAQOG', 'john@gmail.com', 'John', 'Johns'),
(9, 'j.irobz', '$2y$12$XHZYzoU4rpTY2a3BTONov..lWlP9V1mClpoqksHR1kzESpBsssSIe', 'iruobejoshua96@gmail.com', 'Joshua', 'Iruobe'),
(10, 'sssss', '$2y$12$rekMs3P5otUtuiACUkFxHOcdYsYrqw5WKiKy7h4T/dA8SKaTzETrS', 'sssss@gmail.com', 'Shazza', 'Iruobe');
    
SQL;

    $pdo->exec($sql);
    echo "Users imported successfully!";

} catch (PDOException $e) {
    echo "DB import failed: " . $e->getMessage();
}
?>
