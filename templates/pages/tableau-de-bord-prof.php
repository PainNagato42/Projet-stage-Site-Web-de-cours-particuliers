<?php global $ROOT; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
   
    <title></title>
    <meta name="description" content="">
    <?php include("./templates/fragments/head.php")?>
</head>

<body>
    <?php include "templates/fragments/header.php" ?>
    <h1>Mon tableau de bord</h1>
    <div class="row justify-around medium-container small-container">
        <div class="vignette">
            <i class="bi bi-person-plus"></i>
            <p><?php
                if (empty($listeMessage)) {
                    echo "0";
                } else {
                    $nombreAttente = 0;
                    foreach ($listeMessage as $accept) {

                        if ($accept->get("reponse") == "") {
                            $nombreAttente += 1;
                        }
                    }
                    echo $nombreAttente;
                } ?></p>
            <h3>nouvelles demandes</h3>
        </div>
        <div class="vignette">
            <i class="bi bi-book"></i>
            <p><?= $C->compteurByProf($P->get("id"))  ?></p>
            <h3>Cours proposés</h3>
        </div>
        <div class="vignette">
            <i class="bi bi-wallet"></i>
            <p><?= $P->getTarget("utilisateur")->get("points") ?></p>
            <h3>points</h3>
        </div>
    </div>

    <div class="row justify-around medium-container small-container">
        <div class="demandes width-40">
            <h2>Mes demandes en cours</h2>
            <div class="mesdemandes">
                <?php include "templates/fragments/demandes_en_cours.php" ?>
            </div>
        </div>
        <div class="contacts width-40">
            <h2>Mes contacts</h2>
            <div class="mescontacts">
                <?php
                if (empty($listeContact)) {
                    echo "<p>Vous n'avez aucun contact.</p>";
                } else { ?>
                    <?php foreach ($listeContact as $contact) {
                        include "templates/fragments/contact.php";
                    }
                    ?>
                <?php }
                ?>
            </div>
        </div>

    </div>
    <div class="statistiques container medium-container small-container margin-bottom-30">
        <h2>Mes statistiques</h2>
        <div class="flex justify-around align-item-center">
            <div class="">
                <p>Vous avez accepté <span id="accepte"><?= $P->totalEleves($P->get("id")) ?></span> élève(s)</p>
                <p>Vous avez refusé <span id="refuser"><?php
                                                        if (empty($listeMessage)) {
                                                            echo "0";
                                                        } else {
                                                            $nombreRefus = 0;
                                                            foreach ($listeMessage as $refuser) {
                                                                if ($refuser->get("reponse") != "" and $refuser->get("accepte") == 0) {
                                                                    $nombreRefus += 1;
                                                                }
                                                            }
                                                            echo $nombreRefus;
                                                        } ?>
                    </span> élèves(s)</p>
                <p>Vous avez <span id="attente"><?php
                                                if (empty($listeMessage)) {
                                                    echo "0";
                                                } else {
                                                    $nombreAttente = 0;
                                                    foreach ($listeMessage as $accept) {
                                                        if ($accept->get("reponse") == "") {
                                                            $nombreAttente += 1;
                                                        }
                                                    }
                                                    echo $nombreAttente;
                                                } ?></span> élève(s) en attente</p>
            </div>
            <div style="width: 200px; height: 200px"><canvas id="graphique" style="display: block; box-sizing: border-box; height: 200px; width: 200px;" width="200" height="200"></canvas></div>
        </div>
    </div>
    <div class="mask"></div>
    <div class="popup">
        <h3>Repondre au message pour <span id="choix_validation"></span></h3>
        <form method="POST" action="<?= $ROOT ?>/prive/envoi_reponse/">
            <textarea name="reponse"></textarea>
            <input type="hidden" id="statut" name="statut">
            <input type="hidden" id="id" name="id_message">
            <input type="submit" value="Repondre">
        </form>
    </div>
    <!--Début Footer-->
    <footer class="c-333 teko flex container justify-center small-center">
        <div class="c-333 large-33 display-inline-grid justify-center small-100">
            <p class="size-30 bold">A propos</p>
            <a class="c-333 decoration-none" href="" alt="Lien vers Qui somme-nous">Qui sommes-nous</a>
            <a class="c-333 decoration-none" href="" alt="Lien vers Nos valeur">Nos valeurs</a>
            <a class="c-333 decoration-none" href="" alt="Lien vers Mention légals">Mentions légales</a>
            <a class="c-333 decoration-none" href="" alt="Lien vers Confidentialité">Confidentialité</a>
            <a class="c-333 decoration-none" href="" alt="Lien vers Crédits">Crédits</a>
        </div>
        <div class="large-33 grid justify-center justify-item-center small-100">
            <p class="size-30 bold">Suivez-nous</p>
            <div class="flex">
                <a class="c-333 decoration-none margin-right-10 small-100 margin-left-60" href="" alt="Lien vers Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                <a class="c-333 decoration-none margin-right-10 small-100 margin-left-60" href="" alt="Lien vers twitter">
                    <i class="bi bi-twitter"></i>
                </a>
                <a class="c-333 decoration-none margin-right-10 small-100 margin-left-60" href="" alt="lien vers instagram">
                    <i class="bi bi-instagram"></i>
                </a>
                <a class="c-333 decoration-none small-100 margin-left-60" href="" alt="lien vers linkdin">
                    <i class="bi bi-linkedin"></i>
                </a>
            </div>
        </div>
        <div class="large-33 display-inline-grid justify-center small-100">
            <p class="size-30 bold">Assistance</p>
            <a class="c-333 decoration-none" href="" alt="Lien vers Centre d'aide">Centre d'aide</a>
            <a class="c-333 decoration-none" href="" alt="Lien vers Contact">Contact</a>
        </div>
    </footer>
    <!--Fin Footer-->
    <script src="<?= $ROOT ?>/node_modules/chart.js/dist/chart.js" defer></script>
    <script src="<?= $ROOT ?>/js/dashboard.js" defer></script>
</body>

</html>