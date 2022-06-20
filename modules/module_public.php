<?php

function public_inscription()
{
    $Utilisateur = new Utilisateur();
    $V = new Validator($Utilisateur);
    include "templates/pages/formulaire-creation-compte.php";
}

function public_creationCompte()
{
    // faire la creation du compte
    $Auth = new Auth();
    $Auth->register();
    global $ROOT;
    header("Location: $ROOT/");
}

function public_connexion()
{
    // faire la connexion du compte
    $Auth = new Auth();
    $Auth->login();
    global $ROOT;
    if($_SESSION["role"] === "eleve") {
        header("Location: $ROOT/");
    } elseif($_SESSION["role"] === "prof") {
        header("Location: $ROOT/prive/dashboard_prof/");
    }
    
}

function public_validation($token)
{
    // faire la validation du compte
    $Auth = new Auth();
    $Auth->validationByEmail($_POST["email"], $token);
    global $ROOT;
    header("Location: $ROOT/");
}


function public_listeRechercher()
{
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        echo '{"error":"error"}';
        return false;
    }
    $offset = explode("_", $_GET["id"]);
    $C = new Cours();
    $liste = $C->rechercheCours(strtolower($_GET["filtre"]), $_GET["niveau"], isset($_GET["connecte"]) ? 1 : 0, $offset[1]);
    $countAll = $C->getCounter();
    var_dump($countAll);
    $pages = ceil($countAll / 12);
    include "templates/pages/cours_rechercher.php";
}

function public_logout()
{
    // faire la deconnexion du compte
    $Auth = new Auth();
    $Auth->logout();
    global $ROOT;
    header("Location: $ROOT/");
}

function public_detailCours()
{
    $C = new cours($_GET["id"]);
    $motCle = explode(";", $C->get("motcles"));
    $A = new Avis();
    $liste = $A->chercheAvis($_GET["id"]);
    include "templates/pages/cours.php";
}

function public_detailProf()
{
    $P = new Prof($_GET["id"]);
    $dispo = $P->disponibilites;
    $dispo = json_decode($dispo, true);
    $C = new Cours();
    $liste = $C->loadByProf($P->get("id"));
    include "templates/pages/prof.php";
}

function public_modif()
{
    // faire la modification du profil de l'utilisateur

    if ($_POST["table"] === "general") {
        $U = new Utilisateur($_SESSION["id"]);
    } else if ($_POST["table"] === "profil") {
        $U = new Prof();
        $U->loadByUtilisateur();
    } else if ($_POST["table"] === "cours") {
        $U = new Cours($_GET["id"]);
        $T = new Thematique();
    } else {
        $msg = ["prbleme" => "table"];
        echo (json_encode($msg));
    }

    $V = new Validator($U);
    $V->analyse();

    $errors = $V->getErrors();

    if (empty($errors)) {


        foreach ($_POST as $champ => $valeurDuChamps) {
            if ($champ != "table") {
                $U->updateChamp($champ, $valeurDuChamps);
                if ($champ === "thematique") {
                    $U->updateChamp($champ, $valeurDuChamps);
                    if ($T->checkLibelle(ucfirst($valeurDuChamps)) != true) {
                        $T->set("libelle", ucfirst($valeurDuChamps));
                        $T->insert();
                    }
                }
            }
        }
        $msg = ["success" => "ok"];
        echo (json_encode($msg));
    } else {
        $errors;
        $msg = ['errors' => $errors];
        echo (json_encode($msg));
    }
}
