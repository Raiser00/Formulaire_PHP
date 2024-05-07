<?php
require_once 'config.php';




class ConnexionManager
{
    

    public static function send_activationCode(string $email, int $id)
    {
        $code = strval(rand(10000, 99999));
        
        $destinataire = $email;
        $sujet = 'code de validation';
        $message = 'votre code est : ' . $code;
        $entete = "From: admin@test.com\r\n" . 
        "To: $destinataire\r\n" . 
        "Subject: $sujet\r\n" . 
        "Content-Type: text/html; charset=\"UTF-8\"\r\n" . 
        "Content-Transfer-Encoding: quoted-printable\r\n";

        mail($destinataire, $sujet, $message, $entete);

        $table = "t_utilisateur_uti";
        $pdo = generer_bdd();

        $request = "UPDATE $table SET uti_code_activation = $code WHERE uti_id = $id";
        $stmt = $pdo->prepare($request);
        $stmt->execute();

    }

    public static function is_valideCode(int $id, int $code):bool
    {
        $pdo = generer_bdd();

        $sql = "SELECT * FROM t_utilisateur_uti WHERE uti_id = $id";
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user['uti_code_activation'] == $code)
        {
            $request = "UPDATE t_utilisateur_uti SET uti_compte_active = 1 WHERE uti_id = $id";

            $stmt2 = $pdo->prepare($request);
            $stmt2->execute();
            return true;

        } 
        else 
        {
            return false;
        }
    }
}


