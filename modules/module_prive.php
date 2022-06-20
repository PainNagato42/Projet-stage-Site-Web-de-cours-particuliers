<?php

function prive_modifProfilEleve()
{
    $U = new Utilisateur($_SESSION["id"]);
    $V = new Validator($U);
    include "templates/pages/form-modif-profil.php";
}

function prive_modifProfilProf()
{
    $P = new Prof();
    $P->loadByUtilisateur();
    $dispo = $P->get("disponibilites");
    $dispo = json_decode($dispo, true);
    $D = new Diplome();
    $liste = $D->all();
    $cours = new Cours();
    $listeCours = $cours->loadByProf($P->id());
    $V = new Validator($P);
    include "templates/pages/form-modif-prof.php";
}

function prive_afficheFormCours()
{
    $C = new Cours();
    $P = new Prof();
    $P->loadByUtilisateur();
    $V = new Validator($C);
    $C->set("prof", $P->id());
    //verifier si le prof a pas plus de 3 cours
    if ($C->compteurByProf($P->id()) < 3) {
        $C->set("date", date("Y-m-d H:i:s"));
        $C->insert();
        global $ROOT;
        header("Location: $ROOT/prive/ajout_cours/$C->id");
    } else {
        userMessage("danger", "Vous avez utilisé tout vos emplacement de cours disponible");
        global $ROOT;
        header("Location: $ROOT/");
    }
}

function prive_ajoutCours()
{
    $C = new Cours($_GET["id"]);
    $V = new Validator($C);
    // afficher la page du formulaire de creation de cours
    include "templates/pages/form-ajout-cours.php";
}

function prive_envoiPhoto()
{
    $P = new Prof();
    $P->loadByUtilisateur($_SESSION["id"]);
    $id_prof = $P->get("id");
    $Ph = new Photo($P);
    $Ph->changerPhoto();
    global $ROOT;
    header("Location: $ROOT/prive/ajustement_photo/$id_prof");
}

function prive_traitementPhoto()
{
    $P = new Prof($_GET["id"]);
    $P->updateChamp("zoom", $_POST["zoom"]);
    $P->updateChamp("pos_x", $_POST["pos_x"]);
    $P->updateChamp("pos_y", $_POST["pos_y"]);
    global $ROOT;
    header("Location: $ROOT/prive/modif_profil_prof/");
}

function prive_modifMotcles()
{
    // faire la modif des mot cles
    $C = new Cours($_GET["id"]);
    $V = new Validator($C);
    $V->analyse();
    $errors = $V->getErrors();
    if (empty($errors)) {
        $C->updateChamp("motcles", strtolower($_POST["motcles"]));
        echo ('{"success":"ok"}');
    } else {
        $errors_json = json_encode($errors);
        echo ('{"errors":' . $errors_json . '}');
    }
}

function ajoutAvis($id)
{
    global $ROOT;
    // $id : $_GET["id"] (id du cours)
    $A = new Avis();
    $C = new Cours($id);
    if (isset($_SESSION) and !isset($_SESSION['id'])) {
        userMessage("danger", "Vous devez être connecter pour envoyer votre avis");
        header("Location: $ROOT/public/detail_cours/$id");
        exit;
    }
    //si c'est son cours ou si il a déja envoyer un avis pour ce cours on refuse l'avis
    if ($C->getTarget("prof")->getTarget("utilisateur")->id() == $_SESSION['id']) {
        userMessage("danger", "Vous ne pouvez pas donner votre avis sur un de vos cours");
        header("Location: $ROOT/public/detail_cours/$id");
        exit;
    }
    if ($A->verifieAvis($id, $_SESSION['id'])) {
        userMessage("danger", "Vous avez déjà donner votre avis sur ce cours");
        header("Location: $ROOT/public/detail_cours/$id");
        exit;
    }
    $A->set("de", $_SESSION['id']);
    $A->set("pour", $id);
    $A->set("commentaire", $_POST["avis"]);
    $A->set("note", $_POST["note"]);
    $A->set("date", date("Y-m-d H:i:s"));
    $A->insert();
    $A->moyenne($id);
    userMessage("success", "Votre avis a bien été envoyé");
    header("Location: $ROOT/public/detail_cours/$id");
}

function prive_dashboardProf()
{
    $P = new Prof();
    $P->loadByUtilisateur($_SESSION["id"]);
    $C = new Cours();
    $C->loadByProf($P->get("id"));
    $M = new Message();
    $listeMessage = $M->messagesAttente($P->get("id"));
    $listeContact = $M->eleveAccepte($P->get("id"));
    include "templates/pages/tableau-de-bord-prof.php";
}

function prive_envoiDemande()
{
    global $ROOT;
    $U = new Utilisateur($_SESSION["id"]);
    $M = new Message();
    $Cout = new Cout();
    $debit = $Cout->loadByAction("debiteleve");
    $prix = $debit["prix"];
    $V = new Validator($M);
    $V->analyse();
    $errors = $V->getErrors();
    $id_cours = $_POST["id_cours"];
    $C = new Cours($id_cours);
    if($_SESSION["id"] == $C->prof->utilisateur->id()) {
        userMessage("danger", "Vous ne pouvez pas faire une demande sur votre cours");
        header("Location: $ROOT/public/detail_cours/$id_cours");
        exit;
    }
    if ($M->dejaDemander($id_cours) == false) {
        if (empty($errors)) {
            if ($U->get("points") >= $prix) {
                $M->set("receveur", $_POST["receveur"]);
                $M->set("expediteur", $_SESSION["id"]);
                $M->set("contenu", $_POST["contenu"]);
                $M->set("date", date("Y-m-d H:i:s"));
                $M->set("cours", $id_cours);
                $M->insert();
                $Cout->coutEleve($_SESSION["id"]);
                userMessage("success", "Votre demande a bien été envoyer et votre compte a bien été debité de $prix points");
                $id_cours = $_POST["id_cours"];
                header("Location: $ROOT/public/detail_cours/$id_cours");
            } else {
                userMessage("danger", "Vous n'avez pas assez de points pour faire la demande");
                header("Location: $ROOT/index.php#achat_points");
            }
        } else {
            userMessage("danger", "Le champ est obligatoire ou incorrect");
            header("Location: $ROOT/public/detail_cours/$id_cours");
        }
    } else {
        userMessage("danger", "Vous avez déjà une demande pour ce cours");
        header("Location: $ROOT/public/detail_cours/$id_cours");
    }
}

function prive_envoiReponse()
{
    global $ROOT;
    $U = new Utilisateur($_SESSION["id"]);
    $Cout = new Cout();
    $debit = $Cout->loadByAction("debitprof");
    $prix = $debit["prix"];
    $M = new Message($_POST["id_message"]);
    $V = new Validator($M);
    $V->analyse();
    $errors = $V->getErrors();
    if (empty($errors)) {
        if ($_POST["statut"] == 0) {
            $M->updateChamp("reponse", $_POST["reponse"]);
            $M->updateChamp("accepte", $_POST["statut"]);
            $M->updateChamp("datereponse", date("Y-m-d H:i:s"));
            $Mailer = new Mailer();
            $Mailer->mailRefusEleve($M->get("expediteur"), $M->get("receveur"));
            $Cout = new Cout();
            $Cout->remboursement($M->get("expediteur"));
            header("Location: $ROOT/prive/dashboard_prof/");
        }
        if ($_POST["statut"] == 1) {
            if($U->get("points") >= $prix) {
                $C = new Cours($M->get("cours"));
            $nbEleveActuel = $C->get("nombreeleves");
            $C->updateChamp("nombreeleves", $nbEleveActuel +1);
            $M->updateChamp("reponse", $_POST["reponse"]);
            $M->updateChamp("accepte", $_POST["statut"]);
            $M->updateChamp("datereponse", date("Y-m-d H:i:s"));
            $Mailer = new Mailer();
            $Cout = new Cout();
            $Cout->coutProf($_SESSION["id"]);
            $Mailer->mailAcceptationEleve($M->get("expediteur"), $M->get("receveur"));
            userMessage("success", "Votre compte a été debité de $prix points");
            header("Location: $ROOT/prive/dashboard_prof/");
            } else {
                userMessage("danger", "Vous n'avez pas assez de points pour faire la demande");
                header("Location: $ROOT/index.php#achat_points");
            }
        }
    } else {
        userMessage("danger", "Le champ repondre est obligatoire ou incorrect");
        header("Location: $ROOT/prive/dashboard_prof/");
    }
}

function prive_dashboardEleve()
{
    $U = new Utilisateur($_SESSION["id"]);
    $M = new Message();
    $listeMessage = $M->messagesAttenteEleve($_SESSION["id"]);
    $listeContact = $M->mesCoursAccepte($_SESSION["id"]);
    include "templates/pages/tableau-de-bord-eleve.php";
}

function prive_achatPoint()
{
    include "templates/pages/checkout.php";
}

function prive_createPayment($id)
{
    $P = new Payement($id);
    $P->pay();
}

function prive_successPayment($secret)
{
    $P = new Payement();
    $payment = $P->loadBySecret($secret);
    $P->crediter($_SESSION["id"], $payment["point"]);
    $points= $payment["point"];
    userMessage("success", "Votre compte à bien été crédité de $points");
    $P->supprimePayement($secret);
    global $ROOT;
    if ($_SESSION["role"] === "eleve") {
        header("Location: $ROOT/prive/dashboard_eleve/");
    } elseif ($_SESSION["role"] === "prof") {
        header("Location: $ROOT/prive/dashboard_prof/");
    }
}

function prive_annulationPayment()
{
    $P = new Payement();
    $P->annulation($_SESSION["id"]);
    userMessage("success", "L'annulation de paiement à bien été effectué");
    global $ROOT;
    header("Location: $ROOT/");
}
