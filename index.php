<?php
include "lib/init.php";
global $ROOT;
if (isset($_GET["module"])) {
    /****************************************************/
    /*                  MODULE PUBLIC                  */
    /***************************************************/
    if ($_GET["module"] === "public") {
        if (isset($_GET["action"])) {
            if ($_GET["action"] === "choix_role") {
                // afficher la page de choix de role
                include "templates/pages/choix-role.php";
            }
            if ($_GET["action"] === "inscription") {
                // afficher la page du formulaire de creation du compte
                public_inscription();
            }
            if ($_GET["action"] === "creation_compte") {
                public_creationCompte();
            }
            if ($_GET["action"] === "connexion") {
                // afficher la page du formulaire de connexion
                include "templates/pages/form-connexion.php";
            }
            if ($_GET["action"] === "connecte") {
                public_connexion();
            }
            if ($_GET["action"] === "validation") {
                // afficher la page de validation
                include "templates/pages/form-validation.php";
            }
            if ($_GET["action"] === "traitement_validation") {
                public_validation($_GET["id"]);
            }
            if ($_GET["action"] === "liste_cours_rechercher") {
                public_listeRechercher();
            }
            if ($_GET["action"] === "deconnexion") {
                public_logout();
            }
            if ($_GET["action"] === "detail_cours") {
                public_detailCours();
            }
            if ($_GET["action"] === "detail_prof") {
                public_detailProf();
            }
        }
        /****************************************************/
        /*                  MODULE PRIVE                   */
        /***************************************************/
    } else if ($_GET["module"] === "prive") {
        if ($_GET["action"] === "modif_profil") {
            // afficher la page de modification du profil
            if ($_SESSION != [] and $_SESSION["role"] === "eleve") {
                prive_modifProfilEleve();
            } elseif ($_SESSION["role"] === "prof") {
                userMessage("danger", "Vous n'avez pas accès à cette page");
                header("Location: $ROOT/");
            } else {
                header("Location: $ROOT/public/connexion/");
            }
        }
        if ($_GET["action"] === "modif_profil_prof") {
            // afficher la page de modification du profil
            if ($_SESSION != [] and $_SESSION["role"] === "prof") {
                prive_modifProfilProf();
            } elseif ($_SESSION["role"] === "eleve") {
                userMessage("danger", "Vous n'avez pas accès à cette page");
                header("Location: $ROOT/");
            } else {
                header("Location: $ROOT/public/connexion/");
            }
        }
        if ($_GET["action"] === "affiche_form_cours") {
            if ($_SESSION != [] and $_SESSION["role"] === "prof") {
                prive_afficheFormCours();
            } elseif($_SESSION["role"] === "eleve") {
                userMessage("danger", "Vous n'avez pas accès à cette page");
                header("Location: $ROOT/");
            } else {
                header("Location: $ROOT/public/connexion/");
            }
        }
        if ($_GET["action"] === "ajout_cours") {
            if ($_SESSION != [] and $_SESSION["role"] === "prof") {
                prive_ajoutCours();
            } elseif($_SESSION["role"] === "eleve") {
                userMessage("danger", "Vous n'avez pas accès à cette page");
                header("Location: $ROOT/");
            } else {
                header("Location: $ROOT/public/connexion/");
            }
        }
        if ($_GET["action"] === "envoi_photo") {
            if ($_SESSION != [] and $_SESSION["role"] === "prof") {
                prive_envoiPhoto();
            } elseif($_SESSION["role"] === "eleve") {
                userMessage("danger", "Vous n'avez pas accès à cette page");
                header("Location: $ROOT/");
            } else {
                header("Location: $ROOT/public/connexion/");
            }
        }
        if ($_GET["action"] === "ajustement_photo") {
            if ($_SESSION != [] and $_SESSION["role"] === "prof") {
                $P = new Prof($_GET["id"]);
                include "templates/pages/redimension.php";
            } elseif($_SESSION["role"] === "eleve") {
                userMessage("danger", "Vous n'avez pas accès à cette page");
                header("Location: $ROOT/");
            } else {
                header("Location: $ROOT/public/connexion/");
            }
        }
        if ($_GET["action"] === "traitement_photo") {
            if ($_SESSION != [] and $_SESSION["role"] === "prof") {
                prive_traitementPhoto();
            } elseif($_SESSION["role"] === "eleve") {
                userMessage("danger", "Vous n'avez pas accès à cette page");
                header("Location: $ROOT/");
            } else {
                header("Location: $ROOT/public/connexion/");
            }
        }
        if ($_GET["action"] === "avis") {
            if ($_SESSION != []) {
                ajoutAvis($_GET["id"]);
            } else {
                header("Location: $ROOT/public/connexion/");
            }
        }
        if ($_GET["action"] === "dashboard_eleve") {
            if ($_SESSION != []) {
                prive_dashboardEleve();
            } else {
                header("Location: $ROOT/public/connexion/");
            }
        }
        if ($_GET["action"] === "dashboard_prof") {
            if ($_SESSION != []) {
                prive_dashboardProf();
            } else {
                header("Location: $ROOT/public/connexion/");
            }
        }
        if ($_GET["action"] === "envoi_demande") {
            if ($_SESSION != []) {
                prive_envoiDemande();
            } else {
                header("Location: $ROOT/public/connexion/");
            }
        }
        if ($_GET["action"] === "envoi_reponse") {
            if ($_SESSION != [] and $_SESSION["role"] === "prof") {
                prive_envoiReponse();
            } elseif($_SESSION["role"] === "eleve") {
                userMessage("danger", "Vous n'avez pas accès à cette page");
                header("Location: $ROOT/");
            } else {
                header("Location: $ROOT/public/connexion/");
            }
        }
        if ($_GET["action"] === "achat_point") {
            if ($_SESSION != []) {
                prive_achatPoint();
            } else {
                header("Location: $ROOT/public/connexion/");
            }
        }
        if ($_GET["action"] === "create-payment-intent") {
            if ($_SESSION != []) {
                prive_createPayment($_GET["id"]);
            } else {
                header("Location: $ROOT/public/connexion/");
            }
        }
        if ($_GET["action"] === "success") {
            if ($_SESSION != []) {
                prive_successPayment($_GET["payment_intent_client_secret"]);
            } else {
                header("Location: $ROOT/public/connexion/");
            }
        }
        if ($_GET["action"] === "annulation") {
            if ($_SESSION != []) {
                prive_annulationPayment();
            } else {
                header("Location: $ROOT/public/connexion/");
            }
        }
        /****************************************************/
        /*                  MODULE API                     */
        /***************************************************/
    } else if ($_GET["module"] === "api") {
        if ($_GET["action"] === "ajax_modif") {
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                // on effectue un traitement spécifique pour l'ajax
                public_modif();
            }
        }
        if ($_GET["action"] === "ajax_motcles") {
            // on effectue un traitement spécifique pour l'ajax
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                prive_modifMotcles();
            }
        }
        if ($_GET["action"] === "liste_motcles") {
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $C = new Cours($_GET["id"]);
                echo json_encode($C->motcles);
            }
        }
        if ($_GET["action"] === "ajax_thematique") {
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $T = new Thematique();
                $liste = $T->rechercheBylibelle($_POST["theme"]);
                include "templates/fragments/thematique.php";
            }
        }
        if ($_GET["action"] === "traitement_dispo") {
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                //mettre a jours les dispo dans la bdd
                $P = new Prof();
                $P->loadByUtilisateur($_SESSION["id"]);
                $P->updateChamp("disponibilites", json_encode($_POST["dispo"]));
            }
        }
    }
} else {
    /// exemple afficher la page d'accueil
    $C = new cours();
    $liste = $C->coursLesPlusSuivi();
    include "templates/pages/home.php";
}

