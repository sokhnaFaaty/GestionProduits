<?php
require_once(ROOT . "models/produitModel.php");

function handleImageUpload(): ?string {
    if (empty($_FILES['image']['name'])) return null;
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) return null;

    $allowed = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
    if (!in_array($_FILES['image']['type'], $allowed)) return null;
    if ($_FILES['image']['size'] > 2 * 1024 * 1024) return null;

    $ext  = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $name = uniqid('prod_') . '.' . $ext;
    $dir  = ROOT . 'public/uploads/produits/';
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    move_uploaded_file($_FILES['image']['tmp_name'], $dir . $name);
    return $name;
}

$ajoutProduit = function() {
    $errors = [];
    $save   = [];

    if(isset($_REQUEST["envoie"])){
        $save = $_POST;
        $data = [
            "reference" => trim($_REQUEST["reference"]),
            "libelle"   => trim($_REQUEST["libelle"]),
            "prix"      => trim($_REQUEST["prix"]),
            "quantite"  => trim($_REQUEST["quantite"])
        ];

        $errors = validDataProduit($data);

        if(empty($errors)){
            $data['image'] = handleImageUpload();
            addProduit($data);
            header("Location: " . path("produits","listeProduit"));
            exit();
        }
    }
    loadView("produits/ajoutProduit",[
        "errors" => $errors,
        "save"   => $save
    ],"base");
};

$supprimerProduit = function(){
    $id = (int)($_GET['id'] ?? 0);
    if ($id) deleteProduit($id);
    header("Location: " . path("produits","listeProduit"));
    exit;
};

$listeProduit = function(){
    $produits = getAllProduits();
    loadView("produits/listeProduit",["produits" => $produits],"side");
};

$modifierProduit = function(){
    $errors     = [];
    $save       = [];
    $id_produit = (int)($_REQUEST["id"] ?? 0);

    if(isset($_REQUEST["envoie"])){
        $save = $_POST;
        $data = [
            "reference" => trim($_REQUEST["reference"]),
            "libelle"   => trim($_REQUEST["libelle"]),
            "prix"      => trim($_REQUEST["prix"]),
            "quantite"  => trim($_REQUEST["quantite"])
        ];

        $errors = validDataProduit($data);

        if(empty($errors)){
            $nouvelleImage = handleImageUpload();
            if ($nouvelleImage) {
                $data['image'] = $nouvelleImage;
            } else {
                $ancienProduit = getProduitById($id_produit);
                $data['image'] = $ancienProduit['image'] ?? null;
            }
            updateProduit($id_produit, $data);
            header("Location: " . path("produits","listeProduit"));
            exit();
        }
    }

    $produit = getProduitById($id_produit);
    loadView("produits/ajoutProduit",[
        "errors"  => $errors,
        "save"    => $save,
        "id"      => $id_produit,
        "produit" => $produit,
    ],"base");
};

$pages = [
    "listeProduit"    => $listeProduit,
    "ajoutProduit"    => $ajoutProduit,
    "modifierProduit" => $modifierProduit,
    "supprimerProduit"=> $supprimerProduit
];

$page = $_REQUEST["page"] ?? "listeProduit";
if(array_key_exists($page, $pages)){
    $pages[$page]();
} else {
    echo "page introuvable";
    exit();
}
