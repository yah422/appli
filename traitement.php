<?php

session_start();

if(isset($_POST['submit'])){
    
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
}
function ajoutPanier($product, $qtt) {
    if(isset($_POST['submit'])){
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
    
        if($name && $price && $qtt){
    
            $product = [
                "name" => $name,
                "price" => $price,
                "qtt" => $qtt,
                "total" => $price * $qtt,
            ];
    
            $_SESSION['products'][]= $product;

            $_SESSION['message'] = '<div class="alert alert-success" role="alert">  Votre produit à bien été enregistré !</div>';
        }
    }
}

function retirerPanier($product) {
    if(isset($_POST['submit'])){
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
    
        if($name && $price && $qtt){
    
            $product = [
                "name" => $name,
                "price" => $price,
                "qtt" => $qtt,
                "total" => $price * $qtt,
            ];
    
            $index = array_search($product, $_SESSION['products']);
    
            if ($index !== false) {
                unset($_SESSION['products'][$index]);
            }

            $_SESSION['message'] = '<div class="alert alert-success" role="alert">  Votre produit a bien été retiré du panier !</div>';
        }
    }
}
function clearPanier() {
    $_SESSION['products'] = array();
    $_SESSION['message'] = '<div class="alert alert-success" role="alert"> Le panier a été vidé !</div>';
}

if(isset($_POST['action'])){

    switch($_POST['action']){
        case "ajout":
            $ajoutPanier($_POST['product'], 1);
            break;
        case "supprimer": 
            $retirerPanier($_POST['product']);
            break;
        case "toutSupp":
            $clearPanier;
            break;
        case "ajoutQtt":
            $ajoutPanier($_POST['product'], 1);
            break;
        case "retirerQtt":
            $retirerPanier($_POST['product']);
            break;
    }

    }

header("Location:index.php");

?>

