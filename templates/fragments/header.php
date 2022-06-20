<?php global $ROOT; ?>
<header class="header">
    <a href="<?= $ROOT ?>" class="logo"><strong>Prof</strong>Direct</a>
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu">
        <li><a href="<?= $ROOT ?>/">Accueil</a></li>
        <?php
        if (isset($_SESSION) and !isset($_SESSION['id'])) { ?>
            <li><a href="<?= $ROOT ?>/public/choix_role/">S'inscrire</a></li>
        <?php }
        ?>

        <?php
        if (isset($_SESSION) and !isset($_SESSION['id'])) { ?>
            <li><a href="<?= $ROOT ?>/public/connexion/">Se connecter</a></li>
        <?php }
        ?>
        <?php
        if (isset($_SESSION["connected"]) and $_SESSION["connected"] == true) {
            if ($_SESSION["role"] === "prof") { ?>
                <li><a href="<?= $ROOT ?>/prive/affiche_form_cours/">Ajouter un cours</a></li>
        <?php }
        }
        ?>
        <?php
        if (isset($_SESSION["connected"]) and $_SESSION["connected"] == true) {
            if ($_SESSION["role"] === "eleve") { ?>
                <li><a href="<?= $ROOT ?>/prive/modif_profil/">Modifier votre profil</a></li>
            <?php } else if ($_SESSION["role"] === "prof") { ?>
                <li><a href="<?= $ROOT ?>/prive/modif_profil_prof/">Modifier votre profil</a></li>
            <?php } ?>
        <?php }
        ?>
        <li><a href="">Contact</a></li>
        <?php
        if (isset($_SESSION["connected"]) and $_SESSION["connected"] == true) {
            if ($_SESSION["role"] === "eleve") { ?>
                <li><a href="<?= $ROOT ?>/prive/dashboard_eleve/">Tableau de bord</a></li>
            <?php } else if ($_SESSION["role"] === "prof") { ?>
                <li><a href="<?= $ROOT ?>/prive/dashboard_prof/">Tableau de bord</a></li>
            <?php }} ?>
        <?php
        if (isset($_SESSION["connected"]) and $_SESSION["connected"] == true) { ?>
            <li><a href="<?= $ROOT ?>/public/deconnexion/">Se déconnecter</a></li>
        <?php }
        ?>
    </ul>
</header>
<div style="height: 70px"></div>
<?php 
 if(isset($_SESSION['message']) AND ! empty($_SESSION["message"])){
     ?>
     <div class="user-messages-container" id="msg-container">
     <?php
     foreach($_SESSION["message"] as $k => $message){
        ?>
        <div class="user-message <?=$message["type"]?>">
            <p><?=$message['content']?></p>
        </div>
        <?php
     }

     $_SESSION['message']=[];
    ?>
    </div>
    <script>
        setTimeout(()=>{
            var mess = document.getElementById("msg-container");
            mess.style.top ="-100px";
            setTimeout(()=>{
               mess.parentElement.removeChild(mess); 
            },1000)
            
        },4000)
    </script>
    <?php
 }
?>