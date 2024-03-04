<?php

session_start();


if(isset($_GET['action'])){

    switch($_GET['action']){
        case "ajout":
            if(isset($_POST['submit'])){
                $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
                $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT );
            
                if($name && $price && $qtt){
            
                    $product = [
                        "name" => $name,
                        "price" => $price,
                        "qtt" => $qtt,
                        "total" => $price * $qtt,
                    ];
            
                    $_SESSION['products'][]= $product;
                    
                    $_SESSION['message'] = '<div class="alert alert-success" role="alert"> Votre produit à bien été enregistré ! </div>';
                    } else {
                        $_SESSION['message'] = '<div class="alert alert-danger" role="alert">Votre produit n\'a pas été enregistré !  </div>';
                    }
            }
            break;
        case "supprimer": 
            if (isset($_SESSION['products'][$indice])) {
                unset($_SESSION['products'][$indice]);
                $_SESSION['message'] = '<div class="alert alert-success" role="alert"> Le produit a été supprimé avec succès ! </div>';
            } else {
                $_SESSION['message'] = '<div class="alert alert-danger" role="alert"> L\'indice du produit à supprimer n\'existe pas ! </div>';
            }
            break;
        case "toutSupp":
            if (isset($_SESSION['products'][$indice])) {
                unset($_SESSION['products'][$indice]);
            }
            break;
        case "ajoutQtt":
            if (isset($_SESSION['products'][$indice])) {
                $_SESSION['products'][$indice]['qtt']++;
                $_SESSION['message'] = '<div class="alert alert-success" role="alert"> La quantité a été augmentée avec succès ! </div>';
            } else {
                $_SESSION['message'] = '<div class="alert alert-danger" role="alert"> L\'indice du produit à mettre à jour n\'existe pas ! </div>';
            }
            break;
        case "retirerQtt":
            if (isset($_SESSION['products'][$indice]) && $_SESSION['products'][$indice]['qtt'] > 1) {
                $_SESSION['products'][$indice]['qtt']--;
                $_SESSION['message'] = '<div class="alert alert-success" role="alert"> La quantité a été diminuée avec succès ! </div>';
            } else {
                $_SESSION['message'] = '<div class="alert alert-warning" role="alert"> Opération non autorisée. </div>';
            }
            break;
    }

    }

header("Location:index.php");

?>

