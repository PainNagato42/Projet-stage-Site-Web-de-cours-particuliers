<?php

class Auth
{

    // Role: concerne l'identité d'un utilisateur et les mecanismes
    // de creation de compte, connexion; deconnexion et suppression de compte
    // => gestion des comptes utilisateur

    public function login()
    {
        // connecter un utilisateur à l'application
        // à partir d'un mail et mot de passe => formulaire
        // 1. $_POST["email"] $_POST["password"]
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";

        // j'utilise mon objet utilisateur :
        $Utilisateur = new Utilisateur();

        // si j'ai un tableau vide :
        if (!$Utilisateur->loadUserByEmail($email)) {
            // => message d'erreur
            $erreur = "Les identifiants sont incorrects";
            // => reafficher le formulaire

            include "templates/pages/form-connexion.php";
            exit;
        }
        // si j'ai un utilisateur
        // on verifie le mot de passe
        if (!password_verify($password, $Utilisateur->get("password"))) {
            // si pas bon password
            // => message d'erreur
            $erreur = "Les identifiants sont incorrects";
            // => reafficher le formulaire
            include "templates/pages/form-connexion.php";
            exit;
        }
        // si le compte n'est pas activer
        if ($Utilisateur->actif == 0) {
            // => message d'erreur
            $erreur = "Votre compte n'est pas activé";
            // => reafficher le formulaire
            include "templates/pages/form-connexion.php";
            exit;
        }
        // le mot de passe est bon
        $Utilisateur->updateChamp("connecte", 1);
        $Utilisateur->updateChamp("derniereco", date("Y-m-d H:i:s"));
        userMessage("success", "Bonjour et bienvenue ".$Utilisateur->get("pseudo"));
        $this->session($Utilisateur);
    }

    public function session($Utilisateur)
    {
        // remplir la variable de session
        // $_SESSION

        // dire à la session que l'utilisateur est connecté
        $_SESSION["connected"] = true;
        // mettre l'id de l'utilisateur
        $_SESSION["id"] = $Utilisateur->id();
        // mettre le rôle de l'utilisateur
        $_SESSION["role"] = $Utilisateur->getTarget("role")->get("libelle");
    }

    public function connected()
    {
        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION["connected"]) and $_SESSION["connected"] == true) {
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        // vide la session et la detruire
        $U = new Utilisateur($_SESSION["id"]);
        $U->updateChamp("connecte", 0);
        $_SESSION = [];
        session_destroy();
        global $ROOT;
        header("Location: $ROOT/");
    }

    public function register()
    {
        // Rôle : Faire la création du compte
        // Parametres : $role role choisi

        $Utilisateur = new Utilisateur();
        $V = new Validator($Utilisateur);
        // si j'ai des erreurs
        $V->analyse();
            // si le tableau d'erreur n'est pas vide
            
        if (! empty($V->getErrors())) {
                // reaffiche le formulaire
            include "templates/pages/formulaire-creation-compte.php";
            exit;
        }
        
        // Si pas d'erreur
        // verifier si le mail n'existe pas
        if (!$Utilisateur->loadUserByEmail($_POST["email"])) {

            // donner les informations saisie

            // hasher le mot de passe
            $mdp = password_hash(isset($_POST["password"]) ? $_POST["password"] : "", PASSWORD_DEFAULT);

            // hasher le token
            $uniq = uniqid();
            $token = password_hash($uniq, PASSWORD_DEFAULT);

            $Utilisateur->set("pseudo", $_POST["pseudo"]);
            $Utilisateur->set("email", $_POST["email"]);
            $Utilisateur->set("password", $mdp);
            $Utilisateur->set("role", $_POST["role"]);
            $Utilisateur->set("creation", date("Y-m-d"));
            $Utilisateur->set("token", $token);

            // faire la création
            $Utilisateur->insert();

            // faire la creation prof pour l'utilisateur ayant son role prof
            if ($_POST["role"] == 2) {
                $Prof = new Prof();
                $tab = [
                    "lundi" => ["am" => 0, "pm" => 0, "ev" => 0],
                    "mardi" => ["am" => 0, "pm" => 0, "ev" => 0],
                    "mercredi" => ["am" => 0, "pm" => 0, "ev" => 0],
                    "jeudi" => ["am" => 0, "pm" => 0, "ev" => 0],
                    "vendredi" => ["am" => 0, "pm" => 0, "ev" => 0],
                    "samedi" => ["am" => 0, "pm" => 0, "ev" => 0],
                    "dimanche" => ["am" => 0, "pm" => 0, "ev" => 0],
                ];
                $str = json_encode($tab);
                $Prof->set("utilisateur", $Utilisateur->id());
                $Prof->set("disponibilites", $str);
                $Prof->insert();
            }

            // on envoie un mail de validation de l'email
            $Mailer = new Mailer();
            $Mailer->MailValidationAccount($_POST["pseudo"], $uniq, $_POST["email"]);
            userMessage("success", "Un email vous à été envoyé, pensez à vérifier vos spam");
        }
        

    }

    public function validationByEmail($email, $token)
    {
        // Rôle : Vérifie que l'email et le token est correct
        // Paramètres : $email email saisie
        //              $token token non hasher
        global $ROOT;
        $Utilisateur = new Utilisateur();

        if (!$Utilisateur->loadUserByEmail($email)) {
            // afficher un message d'erreur
            $erreur = "L'email est incorrect";
            // reafficher le template
            include "templates/pages/form-validation.php";
            exit;
        }
        if (!password_verify($token, $Utilisateur->get("token"))) {
            // afficher un message d'erreur
            $erreur = "activation du compte impossible";
            // reafficher le template
            include "templates/pages/form-validation.php";
            exit;
        }
        $Utilisateur->updateChamp("actif", 1);
        $Utilisateur->updateChamp("token", "");

        // faire la session
        $this->session($Utilisateur);
        userMessage("success", "Bonjour et bienvenue ".$Utilisateur->get("pseudo"));
    }
}
