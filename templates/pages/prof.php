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
    <div class="flex container justify-between margin-bottom-70">
        <div class="large-40 small-100 margin-top-70">
            <div class="bg-carte grid large-70 small-100 ombrage-carte border-radius-20 roboto padding-bottom-20">
                <div class="flex padding-5 align-item-center">
                    <i class="bi <?= $P->getTarget("utilisateur")->get("connecte") == 1 ? "bi-circle-fill" : "bi-circle" ?>"></i>
                    <p class="size-10 margin-left-5"><?= $P->getTarget("utilisateur")->get("connecte") == 1 ? "Connecté" : "Non connecté " ?></p>
                </div>
                <div class="text-align-center">
                    <div class="photo-profil" style="background-image: url('<?= asset("uploads/") ?><?= $P->get("photo") ? $P->get("photo") : "defaut.png" ?>'); background-size: <?= $P->get("zoom") ? $P->get("zoom") : "100" ?>%; background-position-x: <?= $P->get("pos_x") ? $P->get("pos_x") : "0" ?>px;background-position-y: <?= $P->get("pos_y") ? $P->get("pos_y") : "0" ?>px;">
                    <?php if ($P->getTarget("badge")->get("image") !== "") {
                         echo "<img class='medaille' src=". asset('image/' . $P->getTarget('badge')->get('image')) . ">";
                    } else {
                        echo "";
                    }?>
                    </div>
                    <div class="margin-bottom-5 flex justify-center">
                        <p><?= $P->getTarget("utilisateur")->html("pseudo") ?></p>
                        <?= $P->getTarget("utilisateur")->get("valider") == 1 ? "<i class='bi bi-check-circle padding-left-5' title='profil vérifié'></i>" : "" ?>
                    </div>
                    <p class="margin-bottom-5">Nombre d'éleve : <?= $P->totalEleves($P->id()); ?></p>
                </div>
            </div>
        </div>
        <div class="large-60 small-100 margin-top-70 bg-blanc box-shadow-0-30-70 border-radius-20">
            <h5>Mon profil</h5>
            <div class="padding-15">
                <p class="teko uppercase font-size-20">Pseudo : <?= $P->getTarget("utilisateur")->html("pseudo") ?></p>
                <p class="teko uppercase font-size-20">Diplôme : <?= $P->getTarget("diplome")->get("libelle") ?></p>
                <p class="teko uppercase font-size-20">Pofessionnelle : <?= $P->get("pro") == 1 ? "Oui" : "Non" ?></p>
                <p class="teko uppercase font-size-20">Disponibilité :</p>
                <table class="no_pointer table-dispo">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Lun</th>
                            <th>Mar</th>
                            <th>Mer</th>
                            <th>Jeu</th>
                            <th>Ven</th>
                            <th>Sam</th>
                            <th>Dim</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Matin</th>
                            <td class="<?= $dispo["lundi"]["am"] == 1 ? "dispo" : "" ?>"></td>
                            <td class="<?= $dispo["madi"]["am"] == 1 ? "dispo" : "" ?>"></td>
                            <td class="<?= $dispo["mercredi"]["am"] == 1 ? "dispo" : "" ?>"></td>
                            <td class="<?= $dispo["jeudi"]["am"] == 1 ? "dispo" : "" ?>"></td>
                            <td class="<?= $dispo["vendredi"]["am"] == 1 ? "dispo" : "" ?>"></td>
                            <td class="<?= $dispo["samedi"]["am"] == 1 ? "dispo" : "" ?>"></td>
                            <td class="<?= $dispo["dimanche"]["am"] == 1 ? "dispo" : "" ?>"></td>
                        </tr>
                        <tr>
                            <th>A-M</th>
                            <td class="<?= $dispo["lundi"]["pm"] == 1 ? "dispo" : "" ?>"></td>
                            <td class="<?= $dispo["mardi"]["pm"] == 1 ? "dispo" : "" ?>"></td>
                            <td class="<?= $dispo["mercredi"]["pm"] == 1 ? "dispo" : "" ?>"></td>
                            <td class="<?= $dispo["jeudi"]["pm"] == 1 ? "dispo" : "" ?>"></td>
                            <td class="<?= $dispo["vendredi"]["pm"] == 1 ? "dispo" : "" ?>"></td>
                            <td class="<?= $dispo["samedi"]["pm"] == 1 ? "dispo" : "" ?>"></td>
                            <td class="<?= $dispo["dimanche"]["pm"] == 1 ? "dispo" : "" ?>"></td>
                        </tr>
                        <tr>
                            <th>Soir</th>
                            <td class="<?= $dispo["lundi"]["ev"] == 1 ? "dispo" : "" ?>"></td>
                            <td class="<?= $dispo["mardi"]["ev"] == 1 ? "dispo" : "" ?>"></td>
                            <td class="<?= $dispo["mercredi"]["ev"] == 1 ? "dispo" : "" ?>"></td>
                            <td class="<?= $dispo["jeudi"]["ev"] == 1 ? "dispo" : "" ?>"></td>
                            <td class="<?= $dispo["vendredi"]["ev"] == 1 ? "dispo" : "" ?>"></td>
                            <td class="<?= $dispo["samedi"]["ev"] == 1 ? "dispo" : "" ?>"></td>
                            <td class="<?= $dispo["dimanche"]["ev"] == 1 ? "dispo" : "" ?>"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    <!--Fin mon profil-->
    <!--Debut a propos de moi-->
    <div class="container margin-bottom-70 margin-top-70">
       <div class="padding-15 bg-blanc box-shadow-0-30-70 border-radius-30">
           <h5>A propos de moi</h5>
            <p class="teko uppercase text-align-justify white-space font-size-20">
            <?= $P->html("description") ?>
            </p>
       </div>
        
    </div>
    <!--Fin a propos de moi-->
    <!--Debut Mes cours-->
    <div class="bg-descriptif-cours padding-75 margin-bottom-100">
        <div class="large-100 flex justify-center">
            <div class="border-radius-30 teko border-none padding-15 large-40 font-size-20 bg-blanc-2 margin-bottom-70 small-100 small-margin-bottom-70 text-align-center">
                <h5>Mes cours</h5>
            </div>
        </div>
        <div class=" container flex space-around">
            <?php
            //pour chaque cours du prof on les affiches
            foreach ($liste as $cours) {
            ?>

                <div class="large-20 border-radius-10 teko border-none padding-15 font-size-20 bg-blanc-2 small-100 small-margin-bottom-70 text-align-center">
                    <a href="<?= $ROOT ?>/public/detail_cours/<?= $cours->get("id") ?>">
                        <p class="font-size-30 uppercase font-weight-semi-bold padding-bottom-20"><?= $cours->html("thematique") ?></p>
                        <?php
                        $motCle = explode(";", $cours->get("motcles"));
                        foreach ($motCle as $mcle) { ?>
                            <p><?= $mcle ?></p>
                        <?php } ?>

                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!--Fin Mes cours-->
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
                <a class="c-333 decoration-none margin-right-10 small-100 margin-left-60" href="" alt="Lien vers Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                <a class="c-333 decoration-none margin-right-10 small-100 margin-left-60" href="" alt="Lien vers twitter">
                    <i class="bi bi-twitter"></i>
                </a>
                <a class="c-333 decoration-none margin-right-10 small-100 margin-left-60" href="" alt="lien vers instagram">
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
    <script src="./js/app.js" defer></script>
</body>

</html>