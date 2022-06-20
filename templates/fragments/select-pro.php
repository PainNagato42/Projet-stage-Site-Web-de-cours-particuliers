<select data-table="profil" class="auto-save" name="pro" id="pro">
    <?php
if($P->pro == 1) { ?>
    <option value="0">Non</option>
    <option value="1" selected>Oui</option>
<?php } else { ?>
    <option value="0">Non</option>
    <option value="1">Oui</option>
<?php } ?>

</select>