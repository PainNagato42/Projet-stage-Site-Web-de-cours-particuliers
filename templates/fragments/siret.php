<?php
    if($P->pro == 1) {
        $class = "block";
    } else {
        $class = "none";
    }
 ?>
<p style="color:red" data-id="siret"></p>
<div class="siret" style="display: <?= $class ?>">
    <label for="siret">Siret :</label>
    <input data-table="profil" class="auto-save" type="text" name="siret" id="siret" value="<?= $P->siret ?>"><br><br>
</div>
