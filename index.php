<?php
$pageTitre = "Accueil";
$metaDescription = "Bienvenue sur notre site!";
$currentPage = 'index';
require_once 'header.php';
?>
<main>
    <h2><?php echo $pageTitre; ?></h2>
    <p>Contenu de la page d'accueil...</p>
</main>
<?php include('footer.php'); ?>
