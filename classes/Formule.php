<?php

class Formule extends _model {

    // Attribut
    protected $table = "formule";          // Nom de la table
    protected $field = ["ndpoint" => "NUM", "prix" => "NUM"];
    

    public function loadByid($id) {
        // Rôle : charger la formule par son id
        // Parametre : $id id choisi
        // retour : tableau ou tableau vide
  
        // construction de la requete SQL
        $sql = "SELECT * FROM $this->table WHERE `id`=:id";
        $param = [":id" => $id];
  
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
        return $this->values = $ligne;
        }
}