<?php

class Photo {

    public function __construct($prof) {
        $this->prof = $prof;
    }

    // attributs :
    protected $limit_weight = 1000000;
    protected $folder = "./uploads/";

    // methodes :
    public function changerPhoto(){
        // $_FILES = ["name" => "nom.jpg", "type" => "image/jpeg" ...]
        if(!empty($_FILES)) {
            // Verifier que l'utilisateur n'en a pas deja une
            if($this->prof->get("photo") != "") {
                unlink($this->folder.$this->prof->get("photo"));
            }

            if($_FILES["photo"]["error"]==0) {
                $extension = $this->VerifyExtension($_FILES["photo"]["name"]);
                if( $extension !== false) {
                    $from = $_FILES["photo"]["tmp_name"];
                    $newName = uniqid();
                    $to = $this->folder.$newName.".".$extension;
                    // on deplace physiquement le fichier
                    move_uploaded_file($from,$to);
                    // on enregistre en bdd
                    $this->prof->updateChamp("photo", $newName.".".$extension);
                }
                
            } else {
                // j'ai des erreurs
            }
        }
    }

    private function verifyExtension($name) {
        $extension = explode(".",strtolower($name))[1];
        if($extension == "jpg" OR $extension == "jpeg") {
            return "jpg";
        } elseif ($extension=="png") {
            return "png";
        }  else {
            return false;
        }
    }

    public function deletePhoto(){

    }


    // 2 Chose a prendere en compte
    // le deplacement physique de l'image de l'ordinateur client jusqu'au serveur
    // l'enregistrement du nom, (zoom, positionx, positiony) en bdd
}