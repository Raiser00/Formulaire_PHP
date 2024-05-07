<?php
$pageTitre = "Contact";
$metaDescription = "Contactez-nous pour toute question!";
$currentPage = 'contact';
require_once 'connexionManager.php';
require_once 'header.php';
?>


<?php
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['tokenCsrf']) && $_POST['tokenCsrf'] === $_SESSION['tokenCsrf']) {
        // Vérification du champ nom
        $nom = $_POST["nom"];
        if (empty($nom)) {
            $errors["nom"] = "Le champ nom est requis.";
        } elseif (strlen($nom) < 2 || strlen($nom) > 255) {
            $errors["nom"] = "Le nom doit comporter entre 2 et 255 caractères.";
        }

        // Vérification du champ prénom
        $prenom = $_POST["prenom"];
        if (strlen($prenom) > 255) {
            $errors["prenom"] = "Le prénom ne peut pas dépasser 255 caractères.";
        }

        // Vérification du champ email
        $email = $_POST["email"];
        if (empty($email)) {
            $errors["email"] = "Le champ email est requis.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Adresse email invalide.";
        }

        // Vérification du champ message
        $message = $_POST["message"];
        if (empty($message)) {
            $errors["message"] = "Le champ message est requis.";
        } elseif (strlen($message) < 10 || strlen($message) > 3000) {
            $errors["message"] = "Le message doit comporter entre 10 et 3000 caractères.";
        }

        // Si aucune erreur, traitement du formulaire
        if (empty($errors)) {
            // Traitement du formulaire (envoi d'email, enregistrement en base de données, etc.)

            // Affichage du message de succès
            echo "<p>Le formulaire a bien été envoyé !</p>";
        }
    }
    else
    {
        echo "error";
    }
}
?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<input type="hidden" name="tokenCsrf" value="<?=ConnexionManager::createTokenCsrf()?>">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" value="<?php echo isset($nom) ? htmlspecialchars($nom) : ''; ?>">
    <?php if (isset($errors["nom"])) echo "<p>{$errors["nom"]}</p>"; ?>

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" value="<?php echo isset($prenom) ? htmlspecialchars($prenom) : ''; ?>">
    <?php if (isset($errors["prenom"])) echo "<p>{$errors["prenom"]}</p>"; ?>

    <label for="email">Email :</label>
    <input type="email" id="email" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
    <?php if (isset($errors["email"])) echo "<p>{$errors["email"]}</p>"; ?>

    <label for="message">Message :</label>
    <textarea id="message" name="message"><?php echo isset($message) ? htmlspecialchars($message) : ''; ?></textarea>
    <?php if (isset($errors["message"])) echo "<p>{$errors["message"]}</p>"; ?>

    <button type="submit">Envoyer</button>
</form>


<?php include('footer.php'); ?>
<?php
// Fonction pour afficher les erreurs sous les champs concernés
function displayError($fieldName, $errors) {
    if(isset($errors[$fieldName])) {
        echo '<p class="error">' . $errors[$fieldName] . '</p>';
    }
}

// Fonction pour réafficher les entrées utilisateur
function rePopulateField($fieldName) {
    if(isset($_POST[$fieldName])) {
        echo 'value="' . htmlspecialchars($_POST[$fieldName]) . '"';
    }
}

// Initialisation des variables d'erreur
$errors = array();

// Initialisation des variables pour les données du formulaire
$nom = $prenom = $email = $message = '';

// Vérification des soumissions de formulaire
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification du champ nom
    if(empty($_POST["nom"])) {
        $errors['nom'] = "Le champ nom est requis.";
    } elseif(strlen($_POST["nom"]) < 2 || strlen($_POST["nom"]) > 255) {
        $errors['nom'] = "Le nom doit contenir entre 2 et 255 caractères.";
    } else {
        $nom = $_POST["nom"];
    }

    // Vérification du champ prénom
    if(strlen($_POST["prenom"]) > 0 && (strlen($_POST["prenom"]) < 2 || strlen($_POST["prenom"]) > 255)) {
        $errors['prenom'] = "Le prénom doit contenir entre 2 et 255 caractères.";
    } else {
        $prenom = $_POST["prenom"];
    }

    // Vérification du champ email
    if(empty($_POST["email"])) {
        $errors['email'] = "Le champ email est requis.";
    } elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format d'email invalide.";
    } else {
        $email = $_POST["email"];
    }

    // Vérification du champ message
    if(empty($_POST["message"])) {
        $errors['message'] = "Le champ message est requis.";
    } elseif(strlen($_POST["message"]) < 10 || strlen($_POST["message"]) > 3000) {
        $errors['message'] = "Le message doit contenir entre 10 et 3000 caractères.";
    } else {
        $message = $_POST["message"];
    }

    // Si aucune erreur, envoyer l'email
    if(count($errors) == 0) {
        $to = "votre_email@exemple.com"; // Adresse email de réception
        $subject = "Projet web - Formulaire de contact"; // Sujet du mail
        
        // Construire le message HTML
        $message_body = "<html><body>";
        $message_body .= "<h2>Nouveau message de contact</h2>";
        $message_body .= "<p><strong>Nom:</strong> $nom</p>";
        $message_body .= "<p><strong>Prénom:</strong> $prenom</p>";
        $message_body .= "<p><strong>Email:</strong> $email</p>";
        $message_body .= "<p><strong>Message:</strong><br>$message</p>";
        $message_body .= "</body></html>";

        // En-têtes pour l'email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: $nom <$email>" . "\r\n";

        // Envoyer l'email
        if(mail($to,$subject,$message_body,$headers)) {
            echo '<p class="success">Le formulaire a bien été envoyé!</p>';
        } else {
            echo '<p class="error">Erreur lors de l\'envoi du formulaire.</p>';
        }
    } else {
        echo '<p class="error">Le formulaire n\'a pas été envoyé!</p>';
    }
}
?>



