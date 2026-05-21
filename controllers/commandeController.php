<?php
require_once(ROOT."models/commandeModel.php");
require_once(ROOT."models/produitModel.php");

$listeCommande = function(){
    $commandes = getAllCommande();
    loadView("commandes/listeCommande",["commandes" => $commandes],"side");
    // require_once(ROOT."views/commandes/listeCommande.php");
};
$ajoutCommande = function(){
    
    $save = [];
    $errors =[];

    if(isset($_REQUEST["verif"])){
        $save =$_REQUEST;
        // $nom = $_REQUEST["nom"];
        // $prenom = $_REQUEST["prenom"];
        $telephone = $_REQUEST["telephone"];
        // $email = $_REQUEST["email"];

        $errors = validDataClient($save);
   
       
        if(empty($errors)){
            $searchClient = [
                // "nom" => $nom ,
                // "prenom" => $prenom,
                "telephone" => $telephone ,
                // "email" => $email,
            ];
          $result=  verifClient($searchClient);
          $verif = (!empty($result)) ? $result[0]: null;
          $allProduits = getAllProduits();
          var_dump($verif);
        // if(isset($_REQUEST["ajouter"])){
        //     $date = $_REQUEST["date_commande"];
        // }
    }
    }
    // require_once(ROOT."/views/commandes/ajoutCommande.php");
    loadView("commandes/ajoutCommande",[
         "save" => $save ,
          "errors" =>$errors ,
          "verif"=> $verif,
          "allProduits"=>$allProduits,
    ],"base");
};

$pages =[
    "listeCommande" => $listeCommande,
    "ajoutCommande" => $ajoutCommande,
];

$page = $_REQUEST["page"] ?? "listeCommande";
if(array_key_exists($page,$pages)){
    return $pages[$page]();
}else{
    echo "page introuvable";
    exit();
}