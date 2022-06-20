<?php
foreach($liste as $diplome){
    if($P->diplome->libelle == $diplome->libelle){ ?>
    <option value="<?= $diplome->id() ?>" selected><?= $diplome->libelle ?></option> <?php } else { ?>
        <option value="<?= $diplome->id() ?>"><?= $diplome->libelle ?></option>
    <?php } 
 } ?>
