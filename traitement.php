<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Traitement - PHP </title>
    <link rel="stylesheet" href="traitement.css">
</head>
<body>
    
</body>
</html>

<?php

session_start();

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
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
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

                $_SESSION['message'] = '<div class="alert alert-success" role="alert">  Votre produit à bien été enregistré !</div>';
                }
                break;
    }
        

}}

header("Location:index.php");

?>

