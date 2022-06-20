<?php

// Initialisation : gestion du debug
ini_set("display_errors", true);
error_reporting(E_ALL);

session_start();
global $ROOT;
$ROOT = "http://localhost/ProfDirect";

// Se connecter à la base de données et récupérer un "objet" pour manipuler les données
global $db;
$db = new PDO("mysql:host=localhost;dbname=prof_direct;charset=UTF8", "root", "");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

// charger les classes
include_once "classes/_model.php";
include_once "classes/Auth.php";
include_once "classes/Photo.php";
include_once "classes/Avis.php";
include_once "classes/Badge.php";
include_once "classes/Cours.php";
include_once "classes/Diplome.php";
include_once "classes/Mailer.php";
include_once "classes/Message.php";
include_once "classes/Prof.php";
include_once "classes/Role.php";
include_once "classes/Signalement.php";
include_once "classes/Thematique.php";
include_once "classes/Utilisateur.php";
include_once "classes/Validator.php";

// charger les modules
include_once "modules/module_public.php";
include_once "modules/module_prive.php";