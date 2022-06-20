<?php

/*
  Classe message pour la table message  
 */

class Message extends _model
{

  // Attribut
  protected $table = "message";          // Nom de la table
  protected $field = ["receveur" => "LINK", "expediteur" => "LINK", "contenu" => "TEXT", "date" => "DATETIME", "lu" => "NUM", "reponse" => "TEXT", "datereponse" => "DATETIME", "accepte" => "NUM", "signalement" => "LINK", "cours" => "LINK"];        //  attributs réels de l'objet du modèle conceptuel
  protected $target = ["receveur" => "prof", "expediteur" => "utilisateur", "signalement" => "signalement", "cours" => "cours"];             // Cibles pour les liens
  public $validation = ["contenu" => ["required" => true, "type" => "message", "maxlength" => 500], "reponse" => ["required" => true, "type" => "message", "maxlength" => 500]];

  function messagesAttente($prof)
  {
    // Rôle : recuperer les messages du prof
    // parametre : $prof : id du prof

    $sql = "SELECT * FROM `$this->table` WHERE `receveur` = :prof AND reponse = '' AND accepte != 1";
    $param = [":prof" => $prof];

    $this->requete($sql, $param);

    return $this->sqlToTabObj($sql, $param);
  }

  function compteurByExpediteur($id)
  {
    // Rôle : compte le nombre de message envoyer de l'utilisateur
    // $id : id de l'utilisateur
    $sql = "SELECT COUNT(expediteur) as `count` FROM `$this->table` WHERE `expediteur` = :expediteur";
    $param = [":expediteur" => $id];

    $req = $this->requete($sql, $param);

    $ligne = $req->fetch(PDO::FETCH_ASSOC);
    return $ligne["count"];
  }

  function compteurOfReponse($id)
  {
    // Rôle : compte le nombre de reponse du prof
    // $id : id du prof
    $sql = "SELECT COUNT(*) as `count` FROM `$this->table` WHERE `receveur` = :receveur AND `reponse` != ''";
    $param = [":receveur" => $id];

    $req = $this->requete($sql, $param);

    $ligne = $req->fetch(PDO::FETCH_ASSOC);
    return $ligne["count"];
  }

  function eleveAccepte($id)
  {
    // recupere les messages dont le prof à accepte l'eleve
    // $id : id du prof

    $sql = "SELECT * FROM `$this->table` WHERE `receveur` = :receveur AND `reponse` != '' AND `accepte` = 1";
    $param = [":receveur" => $id];

    $this->requete($sql, $param);

    return $this->sqlToTabObj($sql, $param);
  }

  function dejaDemander($id_cours)
  {
    // recupere le cours deja demander par l'utilisateur

    $sql = "SELECT * FROM `$this->table` WHERE `expediteur` = :expediteur AND `cours` = :cours";

    $param = [":expediteur" => $_SESSION["id"], ":cours" => $id_cours];

    // faire la preparation et l'execution de la requete
    $req = $this->requete($sql, $param);

    // Si on a un retour "false", on ne charge rien
    if ($req === false) {
      $this->values = [];
      return false;
    }

    // récupérer la première ligne
    $ligne = $req->fetch(PDO::FETCH_ASSOC);
    // Si on n'a pas de ligne, on ne charge rien
    if (empty($ligne)) {
      $this->values = [];
      return false;
    }

    // On a une ligne
    $this->values = $ligne;
    return true;
  }

  function messagesAttenteEleve($id){
    //réccupere les messages en attente d'un eleves
    // param : 
    //      $id: id de l'utilisateur

    $sql = "SELECT * FROM `$this->table` WHERE `expediteur` = :id AND reponse = '' AND accepte != 1";
    $param = [":id" => $id];

    $this->requete($sql, $param);

    return $this->sqlToTabObj($sql, $param);


  }

  function mesCoursAccepte($id){

    // recupere les messages dont le prof à accepte l'eleve
    // $id : id de l'éleve

    $sql = "SELECT * FROM `$this->table` WHERE `expediteur` = :id AND `reponse` != '' AND `accepte` = 1";
    $param = [":id" => $id];

    $this->requete($sql, $param);

    return $this->sqlToTabObj($sql, $param);

  }




}
