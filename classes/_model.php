<?php

/*
  Classe mère pour les classes correspondants aux tables de la base de données  
 */

class _model {

    // Attribut à surcharger
    protected $table = "";          // Nom de la table
    protected $field = [];        //  attributs réels de l'objet du modèle conceptuel
    protected $target = [];             // Cibles pour les liens 
    protected $values = [];            // Valeurs lues dans la table 

    function __construct($id = null) {
        // Rôle : initialiser (le charger)
        // Retour : néant (on ne peut pas gérer un retour sur le constructeur)
        // Paramètres:
        //      $id : id de la tache à charger

        if (!empty($id)) { // Si $id ne vaut pas null
            $this->loadById($id);
        }
    }

    public function __get($name) {
        // Rôle : appelée automatiquement quand on utilise  $objet->attribut  
        // Retour : ce que l'on veut que représente $attribut
        // Paramétre :
        //      $name: nom de l'attribut virtule que l'on veut montrer
        
                
        // Est-ce un lien
        if ($this->field[$name] == "LINK") {
            return $this->getTarget($name);
        }
        //Est-ce du json
        if ($this->field[$name] == "JSON") {
            return $this->get($name);
        }
        
        return $this->html($name);
        
    }
    
    public function __set($name, $value) {
        // Rôle : appelée automatiquement quand on utilise  $objet->attribut = value 
        // Retour : néant
        // Paramétres :
        //      $name: nom de l'attribut virtuel que l'on veut modifier
        //      $value : valeur à lui donner
        
        $this->set($name, $value);
        
    }
    
    public function __isset($name) {
        // Rôle : appelée automatiquement quand on utilise  isset($objet->attribut)
        // Retour : néant
        // Paramétres :
        //      $name: nom de l'attribut virtuel que l'on veut modifier
        //      $value : valeur à lui donner

        return isset($this->values[$name]);
        
    }

    public function id() {
        // Rôle : récuperer l'id de l'objet courant
        // Pararmetre : néant
        // Retour : id

        return $this->get("id");
    }

    function get($nom) {
        // Rôle : récupérer la valeur d'un attribut de l'utilisateur
        // Retour : la valeur de l'attribut
        // paramètres :
        //      $nom : nom de l'attribut
        // $nom est-il bien un attribut
        if (!( isset($this->field[$nom]) or $nom === "id")) {
            return null; //TODO DECOMMENTER
        }


        // On veut donner l'attribut (si il existe)
        if (isset($this->values[$nom])) {
            return $this->values[$nom];
        }  else {
            return ["NUM" => 0, "VARCHAR" => "", "TEXT" => "","JSON" => NULL, "DATETIME" => "0000-00-00 00:00:00" , "DATE" => "0000-00-00", "LINK" => 0][$this->field[$nom]];
        }
    }

    function getTarget($nom) {
        // Rôle : retourner l'objet pointé par un champs de type LINK
        // Retour : un objet (un objet d'une des classes héritées de _model)
        // paramètres: 
        //      $nom: nom du champs à "suivre"
        // SI ce n'est pas un lien
        if (!isset($this->field[$nom]) or $this->field[$nom] != "LINK" or!isset($this->target[$nom])) {
            // On retourne un objet un objet neutre
            return new _model();   // On pourrait aussi décider de retourner null
        }

        // C'est un lien, on va donc chercher l'objet pointé (chargé si il est valorisé)
        $classe = $this->target[$nom];

        return new $classe($this->get($nom));
    }

    function set($nom, $valeur) {
        // Rôle : Modifier  la valeur d'un attribut 
        // Retour : true si ok, false si valeur rejetée
        // paramètres :
        //      $nom : nom de l'attribut  
        //      $valeur : valeur à lui donner
        // $nom est-il bien un attribut
        if (!( isset($this->field[$nom]) or $nom === "id")) {
            return false;
        }

        // Controle que la valeur est autorisée
        // TODO
        // Mettre la nouvelle valeur dans $this->valeurs[$nom]
        $this->values[$nom] = $valeur;
        return true;
    }
    
    function html($name) {
        // Rôle: récupérer la valeur d'un champ  du MCD sous forme propre pour html (affichage via HTML correct)
        // Retour: du texte affichage en HTML
        // Paramètres:
        //      $name : nom de l'attribut   
        
        return nl2br(htmlentities($this->get($name)));
    }

    protected function requete($sql, $param = []) {
        // Préparer et exécuter une requête
        // Retour : une requete préparée et exécutée, false en cas d'erreur
        // Paramètres :
        //      $sql : texte de la requête
        //      $param : les paramétres de cette requêtes valoris (tableau)

        global $db;
        
        // Préparation
        $req = $db->prepare($sql);
        if ($req === false) {
            echo "Erreur sur la requete $sql";
            return false;
        }

        // Exécution :
        $exe = $req->execute($param);
        if ($exe === false) {
            echo "Erreur sur la requete $sql";
            print_r($param);
            return false;
        }

        return $req;
    }

    function loadById($id) {
        // Rôle: charger l'objet courant depuis la base de données (en connaisant la clé primaire
        // REtour : true si on a trouvé, false sinon
        // Paramètre :
        //      $id : valeur de l'id de l'utilisateur recherché
        // Construire la requête sql et ses paramètres
        $sql = "SELECT * FROM `$this->table` WHERE `id` = :id";
        $param = [":id" => $id];

        $req = $this->requete($sql, $param);

        // Si on a un retour "false", on ne charge rien
        if ($req === false) {
            $this->values = [];
            return false;
        }

        // récupérer la première ligne
        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        // Si onn'a pas de ligne, on ne charge rien
        if (empty($ligne)) {
            $this->values = [];
            return false;
        }

        // On a une ligne
        $this->values = $ligne;
        return true;
    }

    function insert() {
        // insérer l'enregistrement dans la base de données
        // Retour: true ou false
        // Parametres : néant
        // construction de la requete
        // construire la liste des champs
        $champs = [];
        foreach ($this->field as $nom => $type) {
            // ajouter la séquence
            $champs[] = "`$nom` = :$nom";
            $param[":$nom"] = $this->get($nom);
        }

        $sql = "INSERT INTO `$this->table` SET " . implode(',', $champs);

        $req = $this->requete($sql, $param);

        if ($req == false)
            return false;
        if ($req->rowCount() !== 1)
            return false;

        // Tout c'est bien passé : mettre à jour l'id
        global $db;
        $this->set("id", $db->lastInsertId());

        return true;
    }

    function insertChamp($champ, $valeur) {
        // insérer l'enregistrement dans la base de données
        // Retour: true ou false
        // Parametres : $champ champ saisie, $valeur valeur donnée

        // construction de la requete
        $sql = "INSERT INTO `$this->table` SET `$champ` = :$champ";
        $param = [":$champ" => $valeur];

        // faire la preparation et l'execution de la requete
        $req = $this->requete($sql, $param);

        if ($req == false)
            return false;
        if ($req->rowCount() !== 1)
            return false;

        // Tout c'est bien passé : mettre à jour l'id
        global $db;
        $this->set("id", $db->lastInsertId());

        return true;
    }

    function update() {
        // Met à jour l'enregistrement courant dans la base de données
        // Retour: true ou false
        // Paramètres: néant
        // Construire la reqête et ses paramètres :
        // Construire la liste des champs
        $champs = [];
        $param = [];
        foreach ($this->field as $nom => $type) {
            // ajouter la séquence nomChamp = valeur
            $champs[] = "`$nom` = :$nom";
            $param[":$nom"] = $this->get($nom);
        }
        $sql = "UPDATE `$this->table` SET " . implode(',', $champs) . " WHERE id = :id";
        $param[":id"] = $this->get("id");

        $req = $this->requete($sql, $param);

        if ($req === false)
            return false;

        return true;
    }

    function updateChamp($champ, $valeur) {
        // Met à jour l'enregistrement courant dans la base de données
        // Retour: true ou false
        // Parametres : $champ champ saisie, $valeur valeur donnée

        // Construire la reqête et ses paramètres :
        $sql = "UPDATE `$this->table` SET `$champ` = :$champ WHERE id = :id";
        $param = [":$champ" => $valeur, ":id" => $this->id()];
        
        // faire la preparation et l'execution de la requete
        $req = $this->requete($sql, $param);

        if ($req === false)
            return false;

        return true;
    }

    function tabToObj($tab) {
        // Rôle : transformer un tableau en objet d'une classe données (classe correspondant à un modèle de données)
        // Retour : un objet de la calsse souhaitée, initilaisé avec ses valeurs
        // Paramètres :
        //      $tab : tableau des valeurs à charger  [ nomCh1 => value1, nomCh2 => value2, .... ]

        // pendre la classe de l'objet courant
        $classe = get_class($this);
        
        // Prendre un objet de la classe indiquée
        $obj = new $classe();

        // Le charger depuis le tableau (en passant par les setters)
        foreach ($tab as $nom => $value) {
            $obj->set($nom, $value);
        }
        // Le retourner
        return $obj;
    }

    function sqlToTabObj($sql, $param = []) {
        // Role : convertir le résultat d'une requête SQL en liste de d'objets (tableaux indexé d'objets)
        // Retour: tableau index [ id1 => obj1, id2 => obj2 ]
        // Paramètres :
        //      $sql : requête SQL
        //      $param: paramètres de la reqête sql

        $req = $this->requete($sql, $param);
        if ($req === false){
            return [];
        }   

        // On part d'un tableau vide pour le résultat
        $resultat = [];
        // tant que la requête fourni une ligne
        while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {
            
            // Transformer la ligne en un objet
            $obj = $this->tabToObj($ligne);

            // Ajouter cette ligne dans le tableau résultat
            $resultat[$obj->id()] = $obj;
        }
        return $resultat;
    }

    function all() {
        // Rôle: récupérer tous les objets de la table
        // Retour: tableau indexé d'objets utilisateur, l'index atant l'id
        // paramètres: néant
        // construire la requête
        $sql = "SELECT * FROM `$this->table`";

        // Tranformer le résultat de la reqûete en un tableau d'objets
        return $this->sqlToTabObj($sql);
    }
}