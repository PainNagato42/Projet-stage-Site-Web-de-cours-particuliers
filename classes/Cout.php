<?php

class Cout {

    protected $id;
    protected $action;
    protected $prix;

     public function loadByAction($action) {
         // recupere toute la table

         $sql = "SELECT * FROM cout WHERE `action` = :action";
         $param = [":action" => $action];

         global $db;
         $req = $db->prepare($sql);

         
         if($req->execute($param)) {
             return $req->fetch(PDO::FETCH_ASSOC);
         }
         


     }

     public function coutEleve($id) {
        // $id = id de l'utilisateur

        $U = new Utilisateur($id);
        $pointActuel = $U->get("points");
        $debit = $this->loadByAction("debiteleve");
        $U->updateChamp("points", $pointActuel - $debit["prix"]);
     }
     
     /**
      * coutProf
      *
      * @param  mixed $id, id de l'utilisateur
      * @return void
      */
     public function coutProf($id) {
         // $id de l'utilisateur du prof

        $U = new Utilisateur($id);
        $pointActuel = $U->get("points");
        $debit = $this->loadByAction("debitprof");
        $U->updateChamp("points", $pointActuel - $debit["prix"]);
     }

     public function remboursement($id) {
        // $id de l'utilisateur
        
        $U = new Utilisateur($id);
        $pointActuel = $U->get("points");
        $debit = $this->loadByAction("debiteleve");
        $U->updateChamp("points", $pointActuel + $debit["prix"]);
     }
}