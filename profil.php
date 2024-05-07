<?php
$currentPage = 'profil';
require_once 'config.php';
require_once 'header.php';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    unset($_SESSION['id']);
    unset($_SESSION['connected']);
    header('Location: connexion.php');
    exit;
}

$id = $_SESSION['id'];

$pdo = generer_bdd();

        $sql = "SELECT * FROM t_utilisateur_uti WHERE uti_id = $id";
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


?>

<h2>profil</h2>

<p>Pseudo : <?=$user['uti_pseudo'] ?? '' ?></p>
<p>Email : <?=$user['uti_email'] ?? '' ?></p>



<form method="post">
<input type="submit" value="deconnexion">
</form>

<?php

require_once 'footer.php';
?>