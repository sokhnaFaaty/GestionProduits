<?php
require_once(ROOT."models/clientModel.php");


$pages =["ajoutClient", "listeClient"];

function ajoutClient(){
     $errors = [];
     $save = [];
    //  var_dump($_REQUEST);
    if(isset($_REQUEST["envoie"])){
        $save = $_POST;
        $nom = $_REQUEST["nom"];
        $prenom = $_REQUEST["prenom"];
        $telephone = $_REQUEST["telephone"];
        $email = $_REQUEST["email"];
       
   
        if(empty($nom)){
            $errors["nomVide"] ="Veuillez remplir le nom";
        }
        if(empty($prenom)){
            $errors["prenomVide"] ="Veuillez remplir le prenom";
        }
        if(empty($telephone)){
            $errors["telephoneVide"] ="Veuillez remplir le telephone";
            }
        if(empty($email)){
                $errors["email"] ="Veuillez remplir l'email";
            }
       
        if(empty($errors)){
            $nbClient = [
                "nom" => $nom ,
                "prenom" => $prenom,
                "email" => $email,
                "telephone" => $telephone 
            ];
        saveClient($nbClient);
        }
        
}
require_once(ROOT."views/clients/ajoutClient.php");
}