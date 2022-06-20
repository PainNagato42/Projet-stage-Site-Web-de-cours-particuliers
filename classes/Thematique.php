<?php

/*
  Classe thematique pour la table thematique  
 */

class Thematique extends _model {
    
    // Attribut
    protected $table = "thematique";          // Nom de la table
    protected $field = ["libelle" => "VARCHAR"];        //  attributs réels de l'objet du modèle conceptuel

    function rechercheBylibelle($libelle) {
      // Rôle: rechercher les thematiques par libelle
      // parametre: $libelle contenu saisie

      $sql = "SELECT * FROM $this->table WHERE `libelle` LIKE :libelle LIMIT 5";
      $param = [":libelle" => "$libelle%"];

      $this->requete($sql, $param);

      return $this->sqlToTabObj($sql,$param);
    }

    function checkLibelle($valueChamp){
      // verifier si la valeur donné existe dans les labelles
      // $valueChamp : valeur donné du champ thematique

      $sql = "SELECT * FROM $this->table WHERE `libelle` = :libelle";
      $param = [":libelle" => $valueChamp];

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