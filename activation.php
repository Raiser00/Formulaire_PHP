<?php
$currentPage = 'activation.php';
require_once 'connexionManager.php';
require_once 'header.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(!empty($_POST["activationCode"]) && strlen($_POST["activationCode"]) == 5)
    {
       if(ConnexionManager::is_valideCode($_POST['activation_user_id'], $_POST['activationCode']))
       {
        $_SESSION['activation']= 1;
        header("Location: connexion.php");
        exit;
       }
       else
       {
        $message = "code activation erroné";
       }
    }
    else
    {
        $message = "erreur formulaire";
    }
}




?>

<h2>activation</h2>

<?=$message ?? '' ?>

<form method="post">
    <input type="hidden" value="<?=$_SESSION['id']?>" id="activation_user_id" name="activation_user_id">

    <label for="activationCode">Entrer votre code d'activation</label><br>

    <input type="text" id="activationCode" name="activationCode" maxlength="5" minlength="5" required><br>

    <input type="submit" value="valider">




</form>

<?php
require_once 'footer.php';

