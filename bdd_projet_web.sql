CREATE DATABASE IF NOT EXISTS bdd_projet_web;

USE bdd_projet_web;




CREATE TABLE IF NOT EXISTS t_utilisateur_uti (
    uti_id INT AUTO_INCREMENT PRIMARY KEY,
    uti_pseudo VARCHAR(255) UNIQUE NOT NULL,
    uti_email VARCHAR(255) UNIQUE NOT NULL,
    uti_motdepasse CHAR(60) NOT NULL,
    uti_role ENUM('Utilisateur', 'Administrateur') DEFAULT 'Utilisateur',
    uti_compte_active BOOLEAN DEFAULT 0,
    uti_code_activation CHAR(5)
);

