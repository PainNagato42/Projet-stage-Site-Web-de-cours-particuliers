<div class="message">
    <h3><?= $message->getTarget("expediteur")->get("pseudo") ?></h3>
    <p><?= $message->get("contenu") ?></p>
    <button class="accepte" data-id="<?= $message->id() ?>">accepter</button>
    <button class="refuse" data-id="<?= $message->id() ?>">refuser</button>
    <div class="reponse_accepte"></div>
    <div class="reponse_refuse" data-refus="<?= $message->id() ?>"></div>
</div>