<?php
$currentPage = 'profil';
require_once 'config.php';
require_once 'connexionManager.php';
require_once 'header.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['tokenCsrf']) && $_POST['tokenCsrf'] === $_SESSION['tokenCsrf'])
    {
        unset($_SESSION['id']);
        unset($_SESSION['connected']);
        header('Location: connexion.php');
        exit;
    }
    else
    {
        echo "error";
    }
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
<input type="hidden" name="tokenCsrf" value="<?=ConnexionManager::createTokenCsrf()?>">
<input type="submit" value="deconnexion">
</form>

<?php

require_once 'footer.php';
?>