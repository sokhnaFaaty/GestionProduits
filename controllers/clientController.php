<?php
require_once(ROOT."models/clientModel.php");


$pages =["ajoutClient", "listeClient","modifClient"];

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
        header("location:".WEBROOT."?controller=clients&page=listeClient");
        exit();
        }
        
}
require_once(ROOT."views/clients/ajoutClient.php");   
}

function listeClient(){
    $clients = getAllClients();
    require_once(ROOT."views/clients/listeClient.php");
}

function modifClient(){
    if(!isset($_GET["id"])){
        header("location:".WEBROOT."?controller=clients&page=listeClient");
        exit();
    }
    if(isset($_GET["id"])){
        $client_id = $_GET["id"];
        $dataClient = getClientById($client_id );
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
            $modifClient = [
                "nom" => $nom ,
                "prenom" => $prenom,
                "email" => $email,
                "telephone" => $telephone 
            ];
        updateClient($client_id, $modifClient);
        header("location:".WEBROOT."?controller=clients&page=listeClient");
        exit();
        }
        }
        require_once(ROOT."views/clients/modifierClient.php");
    }
}