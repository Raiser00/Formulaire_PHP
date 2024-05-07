<?php



$pageTitre = "Inscription";
$metaDescription = "Contactez-nous pour toute question!";
$currentPage = 'inscription';
require_once 'header.php';


// Inclusion du fichier de configuration de la base de données
require_once 'config.php';

// Initialisation des variables
$pseudo = $email = $motDePasse = $motDePasse_confirmation = "";
$errors = array();

// Vérification de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation des champs du formulaire
    $pseudo = $_POST['inscription_pseudo'];
    $email = $_POST[ 'inscription_email'];
    $motDePasse = $_POST['inscription_motDePasse'];
    $motDePasse_confirmation = $_POST['inscription_motDePasse_confirmation'];

    // Vérification des champs requis
    if (empty($pseudo) || empty($email) || empty($motDePasse) || empty($motDePasse_confirmation)) {
        $errors[] = "Tous les champs sont requis.";
    }

    // Vérification de la correspondance des mots de passe
    if ($motDePasse !== $motDePasse_confirmation) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    }

    // Autres validations (longueur du pseudo, validité de l'email, etc.)

    // Si aucune erreur, insérer dans la base de données
    if (empty($errors)) {
        try {
            // Hacher le mot de passe
            $motDePasseHash = password_hash($motDePasse, PASSWORD_DEFAULT);

            $pdo = generer_bdd();

            // Préparation de la requête SQL d'insertion
            $sql = "INSERT INTO t_utilisateur_uti (uti_pseudo, uti_email, uti_motdepasse) VALUES (:pseudo, :email, :motDePasse)";

            // Préparation de la requête avec PDO
            $stmt = $pdo->prepare($sql);

            // Exécution de la requête avec les valeurs liées
            $stmt->execute([
                'pseudo' => $pseudo,
                'email' => $email,
                'motDePasse' => $motDePasseHash
            ]);

            echo "inscription réussi";
        } catch (PDOException $e) {
            // Gestion des erreurs de la base de données
            echo "Erreur d'insertion dans la base de données: " . $e->getMessage();
        }
    }
}
?>



    <h1>Inscription</h1>
    
    <?php if (!empty($errors)) : ?>
        <div class="errors">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="pseudo">Pseudo :</label>
            <input type="text" name="inscription_pseudo" id="pseudo" value="<?php echo htmlspecialchars($pseudo); ?>">
        </div>
        <div>
            <label for="email">Email :</label>
            <input type="email" name="inscription_email" id="email" value="<?php echo htmlspecialchars($email); ?>">
        </div>
        <div>
            <label for="motDePasse">Mot de passe :</label>
            <input type="password" name="inscription_motDePasse" id="motDePasse">
        </div>
        <div>
            <label for="motDePasse_confirmation">Confirmer le mot de passe :</label>
            <input type="password" name="inscription_motDePasse_confirmation" id="motDePasse_confirmation">
        </div>
        <button type="submit">S'inscrire</button>
    </form>
<?php

require_once 'footer.php';


