<div class="large-25 flex justify-center small-100 medium-50 zoom">
    <div class="bg-blanc large-70 ombrage-carte border-radius-10 roboto padding-bottom-20 margin-top-70">
        <a href="<?= $ROOT ?>/public/detail_cours/<?= $cours["id"] ?>">
            <div class="flex padding-5 align-item-center">
                <i class="bi <?= $cours["connecte"] == 1 ? "bi-circle-fill" : "bi-circle" ?>"></i>
                <p class="size-10 margin-left-5"><?= $cours["connecte"] == 1 ? "Connecté" : "Non connecté " ?></p>
            </div>
            <div class="justify-center justify-item-center grid">
                <div class="photo-profil" style="background-image: url('<?= asset("uploads/") ?><?= $cours["photo"] ? $cours["photo"] : "defaut.png" ?>'); background-size: <?= $cours["zoom"] ? $cours["zoom"] : "100" ?>%; background-position-x: <?= $cours["pos_x"] ? $cours["pos_x"] : "0" ?>%; background-position-y: <?= $cours["pos_y"] ? $cours["pos_y"] : "0" ?>%;">
                    <?php if ($cours["image"] !== "") {
                         echo "<img class='medaille' src=". asset('image/' . $cours['image']) . ">";
                    } else {
                        echo "";
                    }?>
                </div>
                <div class="margin-bottom-5 flex ">
                    <p><?= $cours["pseudo"]?></p>
                    <?= $cours["valider"] == 1 ? "<i class='bi bi-check-circle padding-left-5' title='profil vérifié'></i>" : "" ?>
                </div>
                <p class="margin-bottom-5"><?= $cours["thematique"] ?></p>
                <div class="flex align-item-center">
                    <?php if ($cours["note"] != null and $cours["note"] != "0.0") {
                        include "templates/fragments/note_etoiles.php";
                    } else {
                        echo "Aucune note";
                    } ?>
                </div>
                <p class="margin-bottom-5">Prix : <?= $cours["prix"] ?> €</p>
                <p class="margin-bottom-5">Nombre d'éleve : <?= $cours["nombreeleves"] ?></p>
            </div>
        </a>
    </div>
</div>