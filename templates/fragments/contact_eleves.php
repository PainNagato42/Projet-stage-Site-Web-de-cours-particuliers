<div class="message">
    <h3><?= $contact->getTarget("receveur")->getTarget("utilisateur")->get("nom") . " " . $contact->getTarget("receveur")->getTarget("utilisateur")->get("prenom") ?></h3>
    <p><?= $contact->get("contenu") ?></p>
    <p><?= $contact->getTarget("receveur")->getTarget("utilisateur")->get("email") ?></p>
    <p><?= $contact->getTarget("receveur")->getTarget("utilisateur")->get("telephone") ?></p>
</div>