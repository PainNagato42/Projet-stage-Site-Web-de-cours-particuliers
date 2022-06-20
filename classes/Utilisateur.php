<?php

/*
  Classe utilisateur pour la table utilisateur  
 */

class Utilisateur extends _model {
    
    // Attribut
    protected $table = "utilisateur";          // Nom de la table
    protected $field = ["email" => "VARCHAR", "telephone" => "VARCHAR", "nom" => "VARCHAR", "prenom" => "VARCHAR", "pseudo" => "VARCHAR", "password" => "VARCHAR", "role" => "LINK", "points" => "NUM", "actif" => "NUM", "creation" => "DATE", "token" => "VARCHAR", "valider" => "NUM", "datevalide" => "DATETIME", "signalement" => "LINK", "modification" => "DATETIME", "connecte" => "NUM", "derniereco" => "DATETIME"];        //  attributs réels de l'objet du modèle conceptuel
    protected $target = ["role" => "role", "signalement" => "signalement"];                     // Cibles pour les liens
    public $validation = ["email" => ["required" => true, "type" => "email"], "telephone" => ["required" => true, "type" => "telephone"], "nom" => ["required" => true, "type" => "text", "maxlength" => 80], "prenom" => ["required" => true, "type" => "text", "maxlength" => 80], "pseudo" => ["required" => true, "type" => "varchar", "maxlength" => 20], "password" => ["required" => true, "type" => "password"]];


    public function loadUserByEmail($email) {
      // Rôle : charger l'utilisateur par son email
      // Parametre : $email email saisie
      // retour : tableau ou tableau vide

      // construction de la requete SQL
      $sql = "SELECT * FROM `$this->table` WHERE `email` = :email";
      $param = [":email" => $email];

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




      
}