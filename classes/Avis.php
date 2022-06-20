<?php

/*
  Classe avis pour la table avis  
 */

class Avis extends _model {
    
    // Attribut
    protected $table = "avis";          // Nom de la table
    protected $field = ["de" => "LINK", "pour" => "LINK", "commentaire" => "TEXT", "note" => "NUM", "date" => "DATETIME", "signalement" => "LINK"];        //  attributs réels de l'objet du modèle conceptuel
    protected $target = ["de" => "utilisateur", "pour" => "cours", "signalement" => "signalement"];                     // Cibles pour les liens
    public $validation = ["commentaire" => ["required" => true, "type" => "message", "maxlength" => 500]];

    function verifieAvis($id_cours, $id_utilisateur) {
      // Verifie l'avis de l'utilisateur pour un cours

      $sql = "SELECT * FROM `$this->table` WHERE `pour` = :pour AND `de` = :de";
      $param = [":pour" => $id_cours, "de" => $id_utilisateur];

      $this->requete($sql, $param);

      return $this->sqlToTabObj($sql, $param);
    }

    function chercheAvis($id){
      //role : reccupere les avis d'un cours
      //parametre : 
      //    $id : id du cours

      $sql = "SELECT * FROM `avis` WHERE `pour` = :id LIMIT 3";

      $param = [":id" => $id];

      $this->requete($sql, $param);

      return $this->sqlToTabObj($sql, $param);
    }

    function moyenne($id_cours) {
      // recuperer toute les notes du cours
      //parametre : 
      //    $id_cours : l'id du cours
      $sql ="SELECT `note` FROM `avis` WHERE `pour` = :pour";
      $param = [":pour" => $id_cours];

      global $db;
      $notes = [];
      $req = $db->prepare($sql);
      if($req->execute($param)){
        while($ligne = $req->fetch(PDO::FETCH_ASSOC)){
          $notes[] = $ligne["note"];
        }
      }

      $nombre = count($notes);
      $somme = array_sum($notes);

      $Cour = new Cours($id_cours);
      $Cour->updateChamp("note",$somme/$nombre);


    }

}