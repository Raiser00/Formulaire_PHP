<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <meta name="description" content="<?php echo $metaDescription; ?>">
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>

<?php

session_start();


?>

<nav>
    <ul>
        <li><a href="index.php" <?php echo ($currentPage === 'index') ? 'class="active"' : ''; ?>>Accueil</a></li>
        <li><a href="contact.php" <?php echo ($currentPage === 'contact') ? 'class="active"' : ''; ?>>Contact</a></li>
        
        <?php 
        if(isset($_SESSION['connected']) && $_SESSION['connected'] == 1)
        {
            echo "<li><a href=\"profil.php\" <?php echo ($currentPage === 'profil') ? 'class=\"active\"': ''; ?>Profil</a></li>";
        }
        else
        {
            echo "<li><a href=\"connexion.php\" <?php echo ($currentPage === 'connexion') ? 'class=\"active\"': ''; ?>Connexion</a></li>"; 
        }
        ?>
        
        <li><a href="carrousel.php" <?php echo ($currentPage === 'carrousel') ? 'class="active"': ''; ?>>Carrousel</a></li>
        <li><a href="dog.php" <?php echo ($currentPage === 'dog') ? 'class="active"': ''; ?>>Dog</a></li>
    </ul>
</nav>

