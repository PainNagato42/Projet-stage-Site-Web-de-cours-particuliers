<div class="message">
    <h3><?= $contact->getTarget("expediteur")->get("nom") . " " . $contact->getTarget("expediteur")->get("prenom") ?></h3>
    <p><?= $contact->get("contenu") ?></p>
    <p><?= $contact->getTarget("expediteur")->get("email") ?></p>
    <p><?= $contact->getTarget("expediteur")->get("telephone") ?></p>
</div>