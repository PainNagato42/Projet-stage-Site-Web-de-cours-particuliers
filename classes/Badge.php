<?php

/*
  Classe badge pour la table badge  
 */

class Badge extends _model {
    
    // Attribut
    protected $table = "badge";          // Nom de la table
    protected $field = ["libelle" => "VARCHAR", "image" => "VARCHAR"];        //  attributs réels de l'objet du modèle conceptuel
}