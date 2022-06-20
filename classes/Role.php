<?php

/*
  Classe role pour la table role  
 */

class Role extends _model {
    
    // Attribut
    protected $table = "role";          // Nom de la table
    protected $field = ["libelle" => "VARCHAR"];        //  attributs réels de l'objet du modèle conceptuel
}