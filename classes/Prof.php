<?php

/*
  Classe prof pour la table prof  
 */

class Prof extends _model {
    
    // Attribut
    protected $table = "prof";          // Nom de la table
    protected $field = ["utilisateur" => "LINK", "photo" => "VARCHAR","zoom" => "NUM","pos_y" => "NUM","pos_x" => "NUM", "badge" => "LINK", "description" => "TEXT", "diplome" => "LINK", "pro" => "NUM", "siret" => "VARCHAR", "disponibilites" => "JSON", "avantage" => "NUM", "finavantage" => "DATETIME"];        //  attributs réels de l'objet du modèle conceptuel
    protected $target = ["utilisateur" => "utilisateur", "badge" => "badge", "diplome" => "diplome"];                     // Cibles pour les liens
    public $validation = ["description" => ["required" => true, "type" => "varchar"], "siret" => ["type" => "siret", "maxlength" => 14]];

    function loadByUtilisateur($id=NULL) {
      // Rôle: charger prof par l'id de l'utilisateur
      // Parametre : neant
      if($id=== NULL){
       $id = $_SESSION["id"];
      }
      // construction de la requete
      $sql = "SELECT * FROM `$this->table` WHERE `utilisateur` = :utilisateur";
      $param = [":utilisateur" => $id];

      // preparation et execution de la requete
      $req = $this->requete($sql, $param);

        // récupérer la première ligne
        $ligne = $req->fetch(PDO::FETCH_ASSOC);

        // On a une ligne
        $this->values = $ligne;
        return true;
    }

    function totalEleves($id){
      //Role : fait la somme des éleves du prof
      //parametre : 
      //    $id : id du prof

      $sql = "SELECT sum(nombreeleves) FROM `cours` WHERE `prof` = :prof";

      $param = [":prof" => $id];

      $req = $this->requete($sql, $param);

      $ligne = $req->fetch(PDO::FETCH_ASSOC);

      return $ligne["sum(nombreeleves)"];

      
    }

}