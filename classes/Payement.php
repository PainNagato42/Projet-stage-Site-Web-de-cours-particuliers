<?php

require_once('vendor/autoload.php');

class Payement extends _model
{
    // Attributs
    protected $table = "payement";
    protected $field = ["date" => "DATETIME", "clesecrete" => "VARCHAR", "utilisateur" => "LINK", "prix" => "NUM", "point" => "NUM"];
    protected $target = ["utilisateur" => "utilisateur"];
    protected $formuleChoisie;

    public function __construct($choix=NULL)
    {
        
        if($choix != NULL){
            $F = new Formule();
            $this->formuleChoisie = $F->loadById($choix);
        }
        
    }


    public function pay()
    {

        header('Content-Type: application/json');

        try {
            // Execute le code de stripe
            \Stripe\Stripe::setApiKey('sk_test_51KtuKlKxiFntIlabcw44wc2XCvycpjdvVk2uqNk4t76pne9H06nJRjmVEYtM8MEMrx2mShmBE1uqmYY0y6WWE4TH003F6sB6JE');
            // Create a PaymentIntent with amount and currency
            $intent = \Stripe\PaymentIntent::create([
                "amount" => $this->formuleChoisie["prix"] * 100,
                'currency' => 'eur'
            ]);
            // Enregistrer les infos de la transaction dans la table payments
            $this->set("date", date("Y-m-d h:i:s"));
            $this->set("clesecrete", $intent->client_secret);
            $this->set("utilisateur", $_SESSION["id"]);
            $this->set("prix", $this->formuleChoisie["prix"]);
            $this->set("point", $this->formuleChoisie["nbpoint"]);
            $this->insert();

            $output = [
                'clientSecret' => $intent->client_secret,
            ];

            echo json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function crediter($id, $point)
    {
        // Rechercher le payement effectué
        // En fonction de la formule choisis on credite l'uilisateur
        // Si tout s'est bien passé : on supprime l'entree de payment 
        $U = new Utilisateur($id);
        $pointActuel = $U->get("points");
        $U->updateChamp("points", $pointActuel + $point);
    }

    public function loadBySecret($secret) {

        $sql = "SELECT * FROM payement WHERE `clesecrete`=:secret";
        $param = [":secret" => $secret];

        $req = $this->requete($sql,$param);

        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function annulation($id){

        $sql = "DELETE FROM payement WHERE `utilisateur`=:id";
        $param = [":id" => $id];

        $this->requete($sql,$param);

    }
    public function supprimePayement($secret){

        $sql = "DELETE FROM payement WHERE `clesecrete`=:cle";
        $param = [":cle" => $secret];

        $this->requete($sql,$param);
    }
}
