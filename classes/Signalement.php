<?php

/*
  Classe signalement pour la table signalement  
 */

class Signalement extends _model {
    
    // Attribut
    protected $table = "signalement";          // Nom de la table
    protected $field = ["contenu" => "TEXT", "de" => "LINK", "cible" => "LINK", "date" => "DATETIME"];        //  attributs réels de l'objet du modèle conceptuel
    protected $target = ["de" => "utilisateur", "cible" => "utilisateur"];          // Cibles pour les liens
    protected $validation = ["contenu" => ["required" => true, "type" => "message", "maxlength" => 500]];
}