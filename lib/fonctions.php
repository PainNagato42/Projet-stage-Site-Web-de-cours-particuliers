<?php
function asset($chemin) {
    global $ROOT;
    return $ROOT."/".$chemin;
}


/**
 * userMessage
 * Permet l'affichage d'un message a destination de l'utilisateur
 * @param  String $type , 3 valeurs possibles success, wraning, danger
 * @param  String $texte , Le messaage a afficher
 * 
 */
function userMessage($type,$texte){
    $_SESSION["message"][]=["type"=>$type, "content"=>$texte];
}


