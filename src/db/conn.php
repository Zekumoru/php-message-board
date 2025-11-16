<?php

// Recuperiamo le credenziali dal sistema cosi' l'app resta configurabile con variabili d'ambiente.
$servername = getenv("DB_HOST") ?: "localhost";
$username = getenv("DB_USER") ?: "root";
$password = getenv("DB_PASS") ?: "root";
$dbname = getenv("DB_NAME") ?: "php_message_board";

try {
    // Creiamo una connessione PDO per sfruttare prepared statements e gestione errori moderna.
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // In dev ci assicuriamo che il DB e le tabelle esistano per semplificare il bootstrap.
    $conn->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    $conn->exec("USE $dbname");

    $conn->exec("
        CREATE TABLE IF NOT EXISTS messages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            text VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
} catch (PDOException $e) {
    // Stampiamo l'errore cosi' l'utente capisce subito se la connessione fallisce.
    echo $e->getMessage();
}
