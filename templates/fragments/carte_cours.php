<div class="large-25 text-align-center flex justify-center small-100 medium-50 zoom">
    <div class="bg-blanc large-70 ombrage-carte border-radius-10 roboto padding-bottom-20 margin-top-70">
        <a href="<?= $ROOT ?>/public/detail_cours/<?= $cours->get("id") ?>">
            <div class="flex padding-5 align-item-center">
                <i class="bi <?= $cours->getTarget("prof")->getTarget("utilisateur")->get("connecte") == 1 ? "bi-circle-fill" : "bi-circle" ?>"></i>
                <p class="size-10 margin-left-5"><?= $cours->getTarget("prof")->getTarget("utilisateur")->get("connecte") == 1 ? "Connecté" : "Non connecté " ?></p>
            </div>
            <div class="justify-center justify-item-center grid">
                <div class="photo-profil" style="background-image: url('<?= asset("uploads/") ?><?= $cours->getTarget("prof")->get("photo") ? $cours->getTarget("prof")->get("photo") : "defaut.png" ?>'); background-size: <?= $cours->getTarget("prof")->get("zoom") !=0? $cours->getTarget("prof")->get("zoom") : "100" ?>%; background-position-x: <?= $cours->getTarget("prof")->get("pos_x")!=0 ? $cours->getTarget("prof")->get("pos_x") : "0" ?>px; background-position-y: <?= $cours->getTarget("prof")->get("pos_y")!=0 ? $cours->getTarget("prof")->get("pos_y") : "0" ?>px;">
                    <?php if ($cours->getTarget("prof")->getTarget("badge")->get("image") !== "") {
                         echo "<img class='medaille' src=". asset('image/' . $cours->getTarget('prof')->getTarget('badge')->get('image')) . ">";
                    } else {
                        echo "";
                    }?>
                </div>
                <div class="margin-bottom-5 flex justify-center margin-bottom-30">
                    <p><?= $cours->getTarget("prof")->getTarget("utilisateur")->get("pseudo") ?></p>
                    <?= $cours->getTarget("prof")->getTarget("utilisateur")->get("valider") == 1 ? "<i class='bi bi-check-circle padding-left-5' title='profil vérifié'></i>" : "" ?>
                </div>
                <p class="margin-bottom-5"><?= $cours->get("thematique") ?></p>
                <div class="flex justify-center">
                    <?php if ($cours->get("note") != null and $cours->get("note") != "0.0") {
                        include "templates/fragments/note_etoiles.php";
                    } else {
                        echo "Aucune note";
                    } ?>
                </div>
                <p class="margin-bottom-5">Prix : <?= $cours->get("prix") ?> €</p>
                <p class="margin-bottom-5">Nombre d'éleve : <?= $cours->get("nombreeleves") ?></p>
            </div>
        </a>
    </div>
</div>