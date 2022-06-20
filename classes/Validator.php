<?php

class Validator{

    public function __construct($objet){
        // je recupere le tabelau des champs à valider
         $this->champsAValider = $objet->validation;
    }

    protected $errors = [];
    /**
    * Get the value of errors
    */ 
    public function getErrors()
    {
       return $this->errors;
    }

    public function analyse() {
        // Rôle : Vérifier le POST envoyer
        foreach($_POST as $index=>$value) {
            if(isset($this->champsAValider[$index])){
                // Vérifier si le champ est requis
                if(isset($this->champsAValider[$index]["required"]) AND $this->champsAValider[$index]["required"]===true){
                     $this->testRequired($index);
                }
 
                // Vérifier si j'ai une longueur maximum
                if(isset($this->champsAValider[$index]["maxlength"])){
                    $this->testMaxLength($index);
                }
 
                // Je teste les types de données : 
                // methode : test_type
                $nomdeMethode = "test_".$this->champsAValider[$index]["type"];
 
                if(method_exists($this,$nomdeMethode)){
                    $this->$nomdeMethode($index);
                }
 
            }
        }
 
    }
 
 
    public function testRequired($key){
        if(empty($_POST[$key])){
           $this->errors[$key][]="Le champs est obligatoire"; 
        }
    }
 
    public function testMaxLength($key){
        if(strlen($_POST[$key]) > $this->champsAValider[$key]['maxlength']){
            $this->errors[$key][] = "Le texte est trop long";
        }
    }
 
    public function test_email($key){
         // teste si la donnée a un format d'email
         if(!filter_var($_POST[$key],FILTER_VALIDATE_EMAIL)){
             $this->errors[$key][] = "Le format de l'adresse mail n'est pas correct";
         }
    }
 
     public function test_text($key){
        // verifie qu'il n'y a que des lettres et pas de script
       $reg = "/[0-9]/";
       $reg2 = "/<script>/";
       if(preg_match($reg,$_POST[$key])==true) {
           $this->errors[$key][] = "Le text doit comporter que des lettres";
       }
       if(preg_match($reg2,$_POST[$key])==true) {
           $this->errors[$key][] = "Le format du text n'est pas incorrect";
       }
     }
 
     public function test_telephone($key){
         // verification du numero de téléphone
         $reg = "/[0-9\/_ -]{10,14}/";
         if(preg_match($reg,$_POST[$key])==false){
                 $this->errors[$key][] = "Le format du numero de téléphone est invalide";
         }
     }

     public function test_siret($key){
        // verification du numero de siret
        $reg = "/[0-9]{14}/";
        if(preg_match($reg,$_POST[$key])==false){
                $this->errors[$key][] = "Le format du numero de siret est invalide";
        }
    }

    public function test_varchar($key){
        // verification du numero de siret
        $reg = "/<script>/";
        if(preg_match($reg,$_POST[$key])==true){
                $this->errors[$key][] = "Le format du text est incorrect";
        }
    }

    public function test_password($key){
        // verification du numero de siret
        $reg = "/<script>/";
        if(preg_match($reg,$_POST[$key])==true){
                $this->errors[$key][] = "Le format du text est incorrect";
        }
    }

    public function test_prix($key){
        // verification du numero de siret
        $reg = "/[0-9]/";
        if(preg_match($reg,$_POST[$key])==false){
            $this->errors[$key][] = "Le Prix est incorrect";    
        }
    }

    public function test_motcles($key){
        // verification du numero de siret
        $reg = "/<script>/";
        if(preg_match($reg,$_POST[$key])==true){
                $this->errors[$key][] = "Le format du text est incorrect";
        }
            
    }
    

}