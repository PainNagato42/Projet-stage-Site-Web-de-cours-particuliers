<?php global $ROOT; ?>
<!DOCTYPE html>
<html>

<head>
    <?php include "templates/fragments/head.php" ?>
    <title></title>
</head>

<body>
    <?php include "templates/fragments/header.php" ?>
    <div class="redimension container">
        <div class="photo-profil margin-bottom-30" style="background-image: url('<?= asset("uploads/") . $P->get("photo") ?>'); background-size: <?= $P->get("photo") ? $P->get("zoom") . "%"  : "100%" ?>; background-position: <?= $P->get("photo") ? $P->get("pos_x") . "px"  : "0px" ?> <?= $P->get("photo") ? $P->get("pos_y") . "px"  : "0px" ?>"></div>
        <form method="POST" class="text-align-center" action="<?= $ROOT ?>/prive/traitement_photo/<?= $_GET["id"] ?>">
            <div>
                <label for="zoom">Zoom</label>
                <input type="range" max="400" min="100" step="2" id="zoom" name="zoom" value="<?= $P->get("photo") ? $P->get("zoom")  : "100" ?>" />
            </div>
            <div>
                <input type="hidden" max="100" min="-100" step="2" id="posx" name="pos_x" value="<?= $P->get("photo") ? $P->get("pos_x")  : "0" ?>" />
            </div>
            <div>
                <input type="hidden" max="100" min="-100" step="2" id="posy" name="pos_y" value="<?= $P->get("photo") ? $P->get("pos_y")  : "0" ?>" />
            </div>
            <input class="btn" type="submit" value="Valider" />
        </form>
    </div>

    <script src="<?= asset("js/redimension.js") ?>"></script>
</body>

</html>