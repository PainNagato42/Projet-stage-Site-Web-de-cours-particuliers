<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
class Mailer
{


    public function MailValidationAccount($pseudo, $uniq, $email)
    {
        // Rôle : faire l'envoi du mail pour activer le compte
        // Retour : néant
        // Parametre :  $pseudo pseudo saisie
        //              $uniq = token non hasher 
        //              $email email saisie
        global $ROOT;
        /*
                // Pour les tests sinon $to = "$email"
        $sujet = "ProfDirect : Activation de votre compte";
        $message = '<html><head><meta http-equiv="Content-Type" content="text/html;charset=utf8"><title>Activez votre compte Prof Direct en un clic</title></head><body>';
        $message .= "<h1>Bonjour {$pseudo}</h1>";
        $message .= "<p>Pour activer votre compte, veuillez cliquer (ou recopier) le lien ci-dessous : </p>";
        $message .= "<a title='lien d'activation de votre compte Prof Direct' href='{$ROOT}/public/validation/{$uniq}'>Lien d'activation du compte</a>";
        $message .= "</body></html>";
        
        $headers = "MIME-Version: 1.0\n";
        $headers .= "Content-Type: text/html; charset=utf8\n";
        $headers .= 'From: ProfDirect <mail_php@prof-direct.com>' . "\n";
        $headers.= "To: <{$email}>";
        
        mail($email, $sujet, $message, $headers); */

        $mail = new PHPMailer(true);
        $mail->setFrom("mail_php@prof-direct.com");
        $mail->addAddress($email, $pseudo);
        $mail->Subject = "Validation de votre compte Prof-Driect";
        $mail->Body = "Merci de valider votre compte en cliquant sur le lien ci-dessous $ROOT/public/validation/$uniq";

        if (!$mail->send()) {
            echo "Le mail n'a pas été envoyé";
        } else {
            echo "Ca marche de ouf !";
        }
        
        
    }

    function mailAcceptationEleve($id_expediteur, $id_prof) {
        // faire l'envoi du mail pour l'eleve ayant été accepté
        // $id_expediteur : l'id de l'expediteur du message (id de l'utilisateur)
        // $id_prof : id du prof (receveur)


        $U = new Utilisateur($id_expediteur);
        $P = new Prof($id_prof);
        $pseudoProf = $P->getTarget("utilisateur")->get("pseudo");
        $emailProf = $P->getTarget("utilisateur")->get("email");
        $telProf = $P->getTarget("utilisateur")->get("telephone");

        $mail = new PHPMailer(true);
        $mail->setFrom("mail_php@prof-direct.com");
        $mail->addAddress($U->get("email"), $U->get("pseudo"));
        $mail->Subject = "Votre demande de cours a ete accepte";
        $mail->Body = "Bonjour $U->pseudo, le prof $pseudoProf vous à accepté voici ces coordonnées email: $emailProf, telephone: $telProf";
        $mail->send();

    }

    function mailRefusEleve($id_expediteur, $id_prof) {
        // faire l'envoi du mail pour l'eleve ayant été refusé 
        // $id_expediteur : l'id de l'expediteur du message (id de l'utilisateur)
        // $id_prof : id du prof (receveur)

        $U = new Utilisateur($id_expediteur);
        $P = new Prof($id_prof);
        $pseudoProf = $P->getTarget("utilisateur")->get("pseudo");

        $mail = new PHPMailer(true);
        $mail->setFrom("mail_php@prof-direct.com");
        $mail->addAddress($U->get("email"), $U->get("pseudo"));
        $mail->Subject = "Votre demande de cours a ete refuse";
        $mail->Body = "Bonjour $U->pseudo, le prof $pseudoProf vous à refusé votre demande de cours";
        $mail->send();

    }
}
