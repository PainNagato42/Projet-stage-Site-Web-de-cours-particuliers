<div class=" margin-bottom-30 large-100 bg-blanc ombrage-carte border-radius-20 flex">
    <?php
    // $user l'utilisateur qui a posté le com
    $User = $avis->getTarget("de"); 
   
    if($User->getTarget("role")->get("libelle")=="prof"){
        
        $P = new Prof();
        $P->loadByUtilisateur($User->get("id"));
        
        if($P->get("photo")!=""){
            $photo = $P->get("photo");
        }else{
            $photo="";
        }
    }else{
        $photo ="";
    }
    
    if($photo !== ""){
        ?>
        <div class="photo-avis" style="background-image: url('<?= asset("uploads/").$photo ?>'); background-size: <?= $P->get("zoom") ?>%; background-position-x: <?= $P->get("pos_x") /2 ?>px;background-position-y: <?= $P->get("pos_y") /2?>px;">
        </div>
        <?php
    }else{
        ?>
        <div class="photo-avis lettre_pseudo">
        <?= $avis->getTarget("de")->get("pseudo")[0] ?>
        </div>
        <?php
    }
    ?>
    
    <div class="flex align-item-center">
        <div class="margin-bottom-5 notes">
            <div class="notes-barre" style="width:<?= $avis->get("note") / 5 * 100 ?>%;"></div>
        </div>
    </div>
    <p class="padding-left-20 teko font-size-20 width-80 align-item-center flex"><?= $avis->html("commentaire") ?></p>
</div>