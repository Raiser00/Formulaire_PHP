<?php

$server = 'localhost';
$user = 'root';
$mdp = '';

try
{
    $pdo = new PDO("mysql:host=$server", $user, $mdp);

    // Set the error mode to "exception".
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Execute the SQL query to create the "bdd_projet_web" database.
    $pdo->exec("CREATE DATABASE bdd_projet_web DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;");
}
// Catch exceptions in case of a connection error:
catch(PDOException $e)
{
    echo 'Error: ' . $e->getMessage();
}
