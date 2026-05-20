<?php

function validDataClient(array $data):array{
     $errors = [];
        if(empty($data["nom"])){
            $errors["nomVide"] ="Veuillez remplir le nom";
        }
        if(empty($data["prenom"])){
            $errors["prenomVide"] ="Veuillez remplir le prenom";
        }
        if(empty($data["telephone"])){
            $errors["telephoneVide"] ="Veuillez remplir le telephone";
            }
        if(empty($data["email"])){
                $errors["email"] ="Veuillez remplir l'email";
            }
        return $errors;
}