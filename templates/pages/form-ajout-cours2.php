<?php global $ROOT; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST" action="#" id="form_profil">
        <p style="color:red" data-id="thematique"></p>
        <label for="thematique">Thematique :</label>
        <input data-table="cours" class="auto-save" type="text" name="thematique" id="thematique" value="<?= $C->thematique ?>">
        <p style="color:red" data-id="prix"></p>
        <label for="prix">Prix :</label>
        <input data-table="cours" class="auto-save" type="number" id="prix" name="prix" min="0" required value="<?= $C->prix ?>"><br><br>
        <p style="color:red" data-id="niveau"></p>
        <label for="niveau">Niveau :</label>
        <select data-table="cours" class="auto-save" name="niveau" id="niveau">
            <option value="">Choisir le niveau</option>
            <option value="debutant">Débutant</option>
            <option value="intermediaire">Intermédiaire</option>
            <option value="expert">Expert</option>
            <option value="tous">tous niveau</option>
        </select>
        <?php
            if($C->get("niveau") !=""){
                ?>
                <script>
                    document.querySelector('#niveau option[value="<?=$C->get("niveau")?>"]').selected ="true";
                </script>
                <?php
            }
        ?>
        <p style="color:red" data-id="detail"></p>
        <label for="detail">Détail :</label>
        <textarea data-table="cours" class="auto-save" name="detail" id="detail" cols="30" rows="10"><?= $C->detail ?></textarea>
        <p style="color:red" data-id="motcles"></p>
        <label>Mots clés :</label>
        <div class="mots-cles"></div>
        <input type="text" name="motcles" id="saisie-mots" value=""/>
        <span id="ajouter-mot">+</span><br><br>
        <input id="hidden" type="hidden" value="<?= $C->id() ?>">
        <input type="submit" value="Valider">
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="<?= asset("js/modif_cours.js") ?>"></script>

</body>
</html>