<?php

$server = 'localhost';
$user = 'root';
$mdp = '';
$db = 'bdd_projet_web';

try
{
    $pdo = new PDO("mysql:host=$server;dbname=$db", $user, $mdp);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "
    CREATE TABLE IF NOT EXISTS t_utilisateur_uti (
        uti_id INT AUTO_INCREMENT PRIMARY KEY,
        uti_pseudo VARCHAR(255) UNIQUE NOT NULL,
        uti_email VARCHAR(255) UNIQUE NOT NULL,
        uti_motdepasse CHAR(60) NOT NULL,
        uti_role ENUM('Utilisateur', 'Administrateur') DEFAULT 'Utilisateur',
        uti_compte_active BOOLEAN DEFAULT 0,
        uti_code_activation CHAR(5)
    )
    ";

    $pdo->exec($query);
}
catch(PDOException $e)
{
    echo 'error: ' . $e->getMessage();
}