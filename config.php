<?php
require_once 'header.php';


function generer_bdd(): ?PDO
{
    $nomDuServeur = 'localhost';
    $nomUtilisateur = 'root';
    $motDePasse = '';
    $nomBDD = "bdd_projet_web";
    
    // Try d'établir une connexion à la base de données 
    try
    {
        // Instancier une nouvelle connexion.
        $pdo = new PDO("mysql:host=$nomDuServeur;dbname=$nomBDD", $nomUtilisateur, $motDePasse);
        
        // Définir le mode d'erreur sur "exception".
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
    // Catch les exceptions en cas d'erreur de connexion 
    catch(PDOException $e)
    {
        echo 'Erreur : ' . $e->getMessage();
        return null;
    }
}
?>
