<?php

$pageTitre = "Connexion";
$metaDescription = "Contactez-nous pour toute question!";
$currentPage = 'connexion';
require_once 'connexionManager.php';
require_once 'header.php';


// Inclusion du fichier de configuration de la base de données
require_once 'config.php';


// Vérification des données reçues
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['tokenCsrf']) && $_POST['tokenCsrf'] === $_SESSION['tokenCsrf']) {
        // Vérifie si les champs requis sont vides
        if (empty($_POST['connexion_pseudo']) || empty($_POST['connexion_motDePasse'])) {
            echo "Tous les champs sont requis.";
        } else {


            try {
                $pdo = generer_bdd();


                // Requête de vérification des informations de connexion
                $sql = "SELECT * FROM t_utilisateur_uti WHERE uti_pseudo = :pseudo";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':pseudo', $_POST['connexion_pseudo']);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);



                if (!empty($user) && password_verify($_POST['connexion_motDePasse'], $user['uti_motdepasse'])) {
                    if ($user['uti_compte_active'] == 0) {
                        // Le compte est inactif, afficher le formulaire d'activation
                        ConnexionManager::send_activationCode($user['uti_email'], $user['uti_id']);
                        $_SESSION['id'] = $user['uti_id'];
                        header('Location: activation.php');
                        exit;
                    } else {
                        // Le compte est actif, connexion réussie
                        $_SESSION['connected'] = 1;
                        $_SESSION['id'] = $user['uti_id'];
                        header('Location: profil.php');
                        exit;
                    }
                } else {
                    // Identifiants invalides
                    echo "Identifiants invalides.";
                }
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion : " . $e->getMessage();
            }
        }
    }
    else
    {
        echo "error";
    }
}
?>




<main>
    <h1>Connexion</h1>
    <form method="post">
        <input type="hidden" name="tokenCsrf" value="<?= ConnexionManager::createTokenCsrf() ?>">
        <input type="hidden" name="formNom" value="connexion">
        <label for="connexion_pseudo">Pseudo :</label>
        <input type="text" id="connexion_pseudo" name="connexion_pseudo" required minlength="2" maxlength="255">
        <label for="connexion_motDePasse">Mot de passe :</label>
        <input type="password" id="connexion_motDePasse" name="connexion_motDePasse" required minlength="8" maxlength="72">
        <input type="submit" value="Se connecter">
    </form>
    <p>Vous n'avez pas de compte ? <a href="inscription.php">Inscrivez-vous ici</a>.</p>
</main>

<?php require_once 'footer.php'; ?>