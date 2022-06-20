<div class="message">
    <h3><b>Pour le cours : </b><?= $message->getTarget("cours")->get("thematique") ?></h3>
    <p><b>Pseudo du prof : <?= $message->getTarget("receveur")->getTarget("utilisateur")->get("pseudo") ?></b></p>
    <p><?= $message->get("contenu") ?></p>
</div>