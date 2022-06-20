<?php global $ROOT; ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Paiement</title>
    <meta name="description" content="A demo of a payment on Stripe" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?= $ROOT ?>/css/checkout.css" type="text/css"/>
    <?php include "templates/fragments/head.php" ?>
    
  </head>
  <body>
    <!-- Display a payment form -->
    <form id="payment-form">
      <div id="payment-element">
        <!--Stripe.js injects the Payment Element-->
      </div>
      <button class="margin-bottom-30" id="submit">
        <div class="spinner hidden" id="spinner"></div>
        <span id="button-text">Payer maintenant</span>
      </button>
      <button class="annule">
        <a href="<?= $ROOT ?>/prive/annulation/">Annuler le paiement</a>
      </button>
      <div id="payment-message" class="hidden"></div>
      
    </form>
    
    
    <script src="https://js.stripe.com/v3/"></script>
    <script src="<?= $ROOT ?>/js/checkout.js" defer></script>
  </body>
</html>