<?php
$dsn = 'mysql:host=localhost;dbname=mon_jeu;charset=utf8';
$user = 'root'; // Remplacez par votre utilisateur MySQL
$pass = ''; // Remplacez par votre mot de passe MySQL

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>