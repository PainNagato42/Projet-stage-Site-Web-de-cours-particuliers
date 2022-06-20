<?php

/*
  Classe diplome pour la table diplome  
 */

class Diplome extends _model {
    
    // Attribut
    protected $table = "diplome";          // Nom de la table
    protected $field = ["libelle" => "VARCHAR"];        //  attributs réels de l'objet du modèle conceptuel
}