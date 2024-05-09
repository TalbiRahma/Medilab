<?php
function connect()
{
    require_once 'config.php';
    try {
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        $conn = new PDO($dsn, $user, $password, $options);
        echo "Connected to the $db database successfully!";
        return $conn;
    } catch (PDOException $e) {
        $e->getMessage();

        die("Fin du programme...");
    }
}

?>