<?php

/*
  Classe cours pour la table cours  
 */

class Cours extends _model
{

  // Attribut
  protected $table = "cours";          // Nom de la table
  protected $field = ["prof" => "LINK", "thematique" => "VARCHAR", "detail" => "TEXT", "prix" => "NUM", "niveau" => "VARCHAR", "note" => "NUM", "date" => "DATETIME", "nombreeleves" => "NUM", "motcles" => "JSON"];        //  attributs réels de l'objet du modèle conceptuel
  protected $target = ["prof" => "prof"];                     // Cibles pour les liens
  public $validation = ["thematique" => ["required" => true, "type" => "text", "maxlength" => 15], "detail" => ["required" => true, "type" => "varchar"], "prix" => ["required" => true, "type" => "prix"], "motcles" => ["type" => "motcles"]];

  protected $counter; 

  

  function compteurByProf($prof)
  {
    // Rôle : recuperer le nombre exact de cours pour l'id du prof
    // Retour : nombre de cours
    // parametre : $prof id du prof

    // construire la requête
    $sql = "SELECT COUNT(prof) as `count` FROM `$this->table` WHERE `prof` = :prof";
    $param = [":prof" => $prof];

    $req = $this->requete($sql, $param);

    $ligne = $req->fetch(PDO::FETCH_ASSOC);
    return $ligne["count"];
  }

  function loadByProf($prof)
  {
    // Rôle : recuperer les cours du prof
    // parametre : $prof : id du prof

    $sql = "SELECT * FROM `$this->table` WHERE `prof` = :prof";
    $param = [":prof" => $prof];

    $this->requete($sql, $param);

    return $this->sqlToTabObj($sql, $param);
  }

  function rechercheCoursAncien($filtre, $niveau, $connecte, $offset)
  {
    //Role : cherche un cours part detail, thematique et motcles

    // faire le calcul pour la offset
    $calcOffset = ($offset - 1) * 12;

    // recherche tout niveau connecté ou non
    if ($niveau === "all" and $connecte == false) {
      $requete = "WHERE `detail` LIKE :filtre OR `thematique` LIKE :filtre OR `motcles` = :filtreMot ORDER BY `note` DESC LIMIT 12 OFFSET $calcOffset";
    } //recherche niveau choisi connecté ou non
    else if ($niveau != "all" and $connecte == false) {
      $requete = "WHERE (`detail` LIKE :filtre OR `thematique` LIKE :filtre OR `motcles` LIKE :filtre) AND (`niveau` = :niveau) ORDER BY `note` DESC LIMIT 12 OFFSET $calcOffset";
    } //recherche tout niveau connecté
    else if ($niveau === "all" and $connecte == 1) {
      $requete = "
        LEFT JOIN `prof` ON `cours`.`prof` = `prof`.`id`
        LEFT JOIN `utilisateur` ON `prof`.`utilisateur` = `utilisateur`.`id`
        WHERE (`utilisateur`.`connecte` = 1) AND (`cours`.`detail` LIKE :filtre OR `cours`.`thematique` LIKE :filtre OR `cours`.`motcles` = :filtreMot) ORDER BY `cours`.`note` DESC LIMIT 12 OFFSET $calcOffset";
    } // recherche niveau choisi connecté
    else if ($niveau != "all" and $connecte == 1) {
      $requete = "
        LEFT JOIN `prof` ON `cours`.`prof` = `prof`.`id`
        LEFT JOIN `utilisateur` ON `prof`.`utilisateur` = `utilisateur`.`id`
        WHERE (`utilisateur`.`connecte` = 1) AND (`cours`.`detail` LIKE :filtre OR `cours`.`thematique` LIKE :filtre OR `cours`.`motcles` = :filtreMot) AND (`niveau` = :niveau) ORDER BY `cours`.`note` DESC LIMIT 12 OFFSET $calcOffset";
    }

    $sql = "SELECT * FROM `cours` $requete";

    $param = [":filtre" => "%$filtre%", ":filtreMot" => $filtre, ":niveau" => $niveau];

    return $this->sqlToTabObj($sql, $param);
  }


  function rechercheCours($filtre, $niveau, $connecte, $offset)
  {
    //Role : cherche un cours part detail, thematique et motcles
    global $db;
    
    $calcOffset = ($offset-1) * 12;

    $sql = "SELECT * FROM cours
    LEFT JOIN prof ON cours.`prof`=prof.`id`
    LEFT JOIN utilisateur ON prof.`utilisateur`=utilisateur.`id`  
    WHERE (detail LIKE :filtre OR thematique LIKE :filtre OR motcles LIKE :filtre) AND niveau LIKE :niveau";

    $param = [":filtre"=>"%".$filtre."%", ":niveau"=>"%".$niveau."%"];

    if($connecte == 1){
      $sql.= " AND utilisateur.`connecte`=true";    
    }

    $req = $db->prepare($sql);
    if($req->execute($param)){
      $this->counter = count($req->fetchAll());
      
    }
    $sql.= " ORDER BY cours.`note` DESC LIMIT 12 OFFSET $calcOffset";
    
    $req2 = $db->prepare($sql);
    $req2->execute($param);
    $results=[]; 
    while($ligne = $req2->fetch(PDO::FETCH_ASSOC)){
      $C = new Cours();
      $C->values = $ligne;
      $results[] = $C;
    }
    return $results;
  
  }

  function coursLesPlusSuivi()
  {
    // Afficher les cours ayant le nombre d'élève le plus haut

    $sql = "SELECT * FROM $this->table
      ORDER BY `nombreeleves` DESC 
      LIMIT 8";

    $this->requete($sql);
    return $this->sqlToTabObj($sql);
  }

  function countAll()
  {

    $sql = "SELECT COUNT(*) AS 'count'  FROM `$this->table`";

    $req = $this->requete($sql);

    $ligne = $req->fetch(PDO::FETCH_ASSOC);
    return $ligne["count"];
  }

  /**
   * Get the value of counter
   */ 
  public function getCounter()
  {
    return $this->counter;
  }
}
