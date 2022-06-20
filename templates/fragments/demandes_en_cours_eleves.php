<div>
            <?php if(empty($listeMessage)) {
                echo "<p>Vous n'avez aucun message.</p>";
            } else { ?>
            <div class="mesdemandes">
                <?php
                //si le message n'est ni accepter ni refuser
                foreach($listeMessage as $message) {
                   include "templates/fragments/mes_messages_eleves.php";
                            } 
                            ?>
                            
                </div>
           <?php }
           ?>
</div>