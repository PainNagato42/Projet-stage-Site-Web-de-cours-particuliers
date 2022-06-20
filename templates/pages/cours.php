<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <?php include("./templates/fragments/head.php")?>
    </head>
    <body>
        <!--Début header-->
    <?php include "templates/fragments/header.php" ?>
    <!--Fin header-->
    <!--Début mon profil-->
    <div class="flex container padding-top-150 padding-bottom-100 sm-no-flex justify-between">
        <div class="large-60 bg-blanc ombrage-carte border-radius-20 padding-bottom-50 padding-top-50">
            <h5 class="padding-bottom-20"><?= $C->get("thematique") ?></h5>
            <div class=" line-height-50  padding-left-70 text-align-center">
                <p class="teko uppercase size-30 ">Contenu du cours</p>
                <p class=" font-weight-100 teko uppercase font-size-20 ">
                    <?php
                     foreach($motCle as $mcle) {
                        if($mcle != "" or $mcle != NULL) {
                            echo "<strong class='mot_cle'>" . $mcle ."</strong>";
                        } else {
                            echo "";
                        }
                     } ?>
                        


                </p>
                <p class="teko uppercase size-30 ">éléves qui ont suivit ce cours:</p>
                <div class="flex justify-center font-size-20  ">
                    <p class="teko uppercase margin-right-5"><?= $C->get("nombreeleves") ?></p>
                    <i class="bi bi-people-fill"></i>
                </div>
                <label class="teko uppercase size-30 line-height-30 ">Mes tarifs :</label>
                <ul class=" tarif teko line-height-30 ">
                    <li><?= $C->get("prix") ?>€/heures</li>
                    <li>Possibilité de remboursement jusqu'a 48 heures avant le début du cours</li>
                    <div class="large-100 text-align-center">
                        <button class="margin-top-10 btn btn_savoir" id="demande">Faire la demande pour ce cours</button>
                    </div>
            </div>
        </div>
        <div class="flex large-40 justify-flex-end small-100">
            <div class=" bg-carte large-70 small-100  ombrage-carte border-radius-20 roboto padding-bottom-20">
                <div class="flex  padding-5 align-item-center">
                    <i class="bi <?= $C->getTarget("prof")->getTarget("utilisateur")->get("connecte") == 1 ? "bi-circle-fill" : "bi-circle" ?>"></i>
                    <p class="size-10 margin-left-5"><?= $C->getTarget("prof")->getTarget("utilisateur")->get("connecte") == 1 ? "Connecté" : "Non connecté " ?></p>
                </div>
                <div class="justify-center justify-item-center">
                    <div class="photo-profil"
                        style="background-image: url('<?= asset("uploads/") ?><?= $C->getTarget("prof")->get("photo") ? $C->getTarget("prof")->get("photo") : "defaut.png" ?>'); background-size: <?= $C->getTarget("prof")->get("zoom") ? $C->getTarget("prof")->get("zoom") : "100" ?>%; background-position-x: <?= $C->getTarget("prof")->get("pos_x") ? $C->getTarget("prof")->get("pos_x") : "0" ?>px;background-position-y: <?= $C->getTarget("prof")->get("pos_y") ? $C->getTarget("prof")->get("pos_y") : "0" ?>px;">
                        <?php if ($C->getTarget("prof")->getTarget("badge")->get("image") !== "") {
                         echo "<img class='medaille' src=". asset('image/' . $C->getTarget('prof')->getTarget('badge')->get('image')) . ">";
                    } else {
                        echo "";
                    }?>
                    </div>
                    <div class="margin-bottom-5 flex ">
                        <p><?= $C->getTarget("prof")->getTarget("utilisateur")->get("pseudo") ?></p>
                        <?= $C->getTarget("prof")->getTarget("utilisateur")->get("valider") == 1 ? "<i class='bi bi-check-circle padding-left-5' title='profil vérifié'></i>" : "" ?>
                    </div>
                    <p class="margin-bottom-5"><?= $C->get("thematique") ?></p>
                    <div class="flex align-item-center">
                        <?php if ($C->get("note") != null and $C->get("note") != "0.0") {
                            include "templates/fragments/note_etoiles_cours.php";
                        } else {
                            echo "Aucune note";
                        } ?>
                    </div>
                    <p class="margin-bottom-5">Prix : <?= $C->get("prix") ?> €</p>
                    <p class="margin-bottom-5">Nombre d'éleve : <?= $C->get("nombreeleves") ?></p>
                </div>
                <div class="large-100 text-align-center">
                    <a class="margin-top-10 btn btn_savoir" href="<?= $ROOT ?>/public/detail_prof/<?= $C->getTarget("prof")->get("id") ?>">Voir le profil du prof</a>
                    
                </div>
            </div>
        </div>
    </div>
    <!--Fin mon profil-->
    <!--Debut déscriptif du cours-->
    <div class="padding-top-20 padding-bottom-20 margin-top-10">
        <div class="container">
            <div class="large-100 ombrage-carte border-radius-20 padding-15">
                <h5>Descriptif du cours</h5>
                <div class="padding-left-70 line-height-50 teko size-25 grid justify-center">
                    <p><?= $C->get("detail") ?></p>
                </div>
            </div>
        </div>
    </div>
    <!--Fin déscriptif du cours--> 
    <!--Debut vos avis-->
    <div class="container padding-bottom-100 padding-top-100">
        <div class="large-100 flex justify-center">
            <div class=" large-70 small-100 bg-blanc ombrage-carte border-radius-20 margin-top-70 margin-bottom-30">
                <h5 class="padding-bottom-20">Vos avis direct sur ce cours</h5>
            </div>
            <?php
                foreach($liste as $avis) { 
                    include "templates/fragments/avis_cours.php";
                }
             ?>  
        </div>
    </div>
    <!--Fin vos avis-->
    <!--Notez le prof-->
    <div class="bg-annuaire padding-bottom-100">
        <div class="container">
            <h5>Envie de noter notre prof direct</h5>
            <form class="container bg-blanc-2 border-radius-10 box-shadow-30-30-6 padding-75" method="POST" action="<?= $ROOT ?>/prive/avis/<?= $C->id() ?>">
            <div class="large-100 font-size-60 text-align-center padding-bottom-50 padding-top-50">
                    <div class="noter">
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                    </div>
            </div>           
                <div class="justify-center flex margin-bottom-70">
                    <input class="uppercase border-radius-10 large-50 teko border-none width-80 padding-15 font-size-20 padding-bottom-200 bg-blanc" type="text" name="avis" placeholder="Entrer votre message ici..."></div>
            <div class="flex justify-center">
                <input type="hidden" id="hiddenNote" name="note" value="">
                <input class="btn" type="submit" value="Envoyer">
            </div>
            </form>
        </div>
    </div>
    <div class="mask"></div>
    <div class="popup">
        <h3>Contenu de la demande</h3>
        <form method="POST" action="<?=$ROOT?>/prive/envoi_demande/">
            <textarea name="contenu"></textarea>
            <input type="hidden" name="receveur" value="<?= $C->getTarget("prof")->get("id") ?>">
            <input type="hidden" name="id_cours" value="<?= $C->get("id") ?>">
            <input type="submit" value="Valider">
        </form>
    </div>
    <!--fin notez le prof-->
    <!--Début Footer-->
    <footer class="c-333 teko flex container justify-center">
        <div class="c-333 large-33 display-inline-grid justify-center">
            <p class="size-30 bold">A propos</p>
            <a class="c-333 decoration-none" href="" alt="Lien vers Qui somme-nous">Qui sommes-nous</a>
            <a class="c-333 decoration-none" href="" alt="Lien vers Nos valeur">Nos valeurs</a>
            <a class="c-333 decoration-none" href="" alt="Lien vers Mention légals">Mentions légales</a>
            <a class="c-333 decoration-none" href="" alt="Lien vers Confidentialité">Confidentialité</a>
            <a class="c-333 decoration-none" href="" alt="Lien vers Crédits">Crédits</a>
        </div>
        <div class="large-33 grid justify-center justify-item-center">
            <p class="size-30 bold">Suivez-nous</p>
            <div class="flex">
                <a class="c-333 decoration-none margin-right-10 small-100 margin-left-60" href=""
                    alt="Lien vers Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                <a class="c-333 decoration-none margin-right-10 small-100 margin-left-60" href=""
                    alt="Lien vers twitter">
                    <i class="bi bi-twitter"></i>
                </a>
                <a class="c-333 decoration-none margin-right-10 small-100 margin-left-60" href=""
                    alt="lien vers instagram">
                    <i class="bi bi-instagram"></i>
                </a>
                <a class="c-333 decoration-none small-100 margin-left-60" href="" alt="lien vers linkedin">
                    <i class="bi bi-linkedin"></i>
                </a>
            </div>
        </div>
        <div class="large-33 display-inline-grid justify-center">
            <p class="size-30 bold">Assistance</p>
            <a class="c-333 decoration-none" href="" alt="Lien vers Centre d'aide">Centre d'aide</a>
            <a class="c-333 decoration-none" href="" alt="Lien vers Contact">Contact</a>
        </div>
    </footer>
    <!--Fin Footer-->

    <script src="<?= asset("js/detail_cours.js") ?>" defer></script>
    </body>
</html>