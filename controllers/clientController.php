<?php
require_once(ROOT."models/clientModel.php");



$ajoutClient = function (){
     $save = [];
     $errors = [];
    //  var_dump($_REQUEST);
    if(isset($_REQUEST["envoie"])){
        $save = $_POST;
        $nom = $_REQUEST["nom"];
        $prenom = $_REQUEST["prenom"];
        $telephone = $_REQUEST["telephone"];
        $email = $_REQUEST["email"];

        $errors = validDataClient($save);
   
       
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
};

$listeClient = function (){
    $clients = getAllClients();
    require_once(ROOT."views/clients/listeClient.php");
};

$modifClient =function(){
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
        
        $errors = validDataClient($save);
    
       
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
};

$suppClient=function (){
    if(isset($_GET["id"])){
        deleteClient($_GET["id"]);
        header("location:".WEBROOT."?controller=clients&page=listeClient");
        exit();
    }

};

$pages =[
    "listeClient" => $listeClient,
    "ajoutClient" => $ajoutClient ,
    "modifClient" => $modifClient,
    "suppClient" => $suppClient,
    ];
 $page = $_REQUEST["page"] ?? "listeClient" ;
//appelle l'objet
//  var_dump($pages[$page]);
//appelle la fonction
//  var_dump($pages[$page]());


 if(array_key_exists($page,$pages)){
    $pages[$page]();
 }else{
    echo "page introuvable";
    exit();
 }