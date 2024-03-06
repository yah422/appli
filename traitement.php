<?php
session_start();
ob_start();

$id = isset($_GET['id']) ? $_GET['id'] : null ;
if(isset($_GET['action'])){

    switch($_GET['action']){
        case "ajout":
            if(isset($_POST['submit'])){
                $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
                $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT );
                $image = "image/";

                //upload image
                if(isset($_FILES['file'])){
                    $tmpName = $_FILES['file']['tmp_name'];
                    $name = $_FILES['file']['name'];
                    $size = $_FILES['file']['size'];
                    $error = $_FILES['file']['error'];
                    $type = $_FILES['file']['type'];
                    
                    $tabExtension = explode('.',$name);
                    $extension = strtolower(end($tabExtension));
                    $tailleMax = 200000;
                    $extesionAutorisees = ['jpg','jpeg','gif','png'];
                    
                    if(in_array($extension, $extesionAutorisees) && $size <= $tailleMax && $error == 0){
                        $uniqueName = uniqid('',true);
                        $fileName = $uniqueName. '.' .$extension;
                        // var_dump("/images/".$fileName);die;
                        move_uploaded_file($tmpName, './images/'.$fileName);
                    }
                }

            
                if($name && $price && $qtt && $image){
            
                    $product = [
                        "name" => $name,
                        "price" => $price,
                        "qtt" => $qtt,
                        "total" => $price * $qtt,
                        "image" => $image,
                        
                    ];
            
                    $_SESSION['products'][]= $product;
                    
                    $_SESSION['message'] = '<div class="alert alert-success" role="alert"> Votre produit à bien été enregistré ! </div>';
                    } else {
                        $_SESSION['message'] = '<div class="alert alert-danger" role="alert">Votre produit n\'a pas été enregistré !  </div>';
                    }

                }
                header("Location:index.php");die;
                break;    
            

        case "supprimer": 
            if (isset($_SESSION['products'][$id])) {
                unset($_SESSION['products'][$id]);
                $_SESSION['message'] = '<div class="alert alert-success" role="alert"> Le produit a été supprimé avec succès ! </div>';
            } else {
                $_SESSION['message'] = '<div class="alert alert-danger" role="alert"> L\'indice du produit à supprimer n\'existe pas ! </div>';
            }
            
            header("Location:recap.php");die;
            break;
            

        case "toutSupp":
            if (isset($_SESSION['products'])) {
                unset($_SESSION['products']);
                
            }
            header("Location:recap.php");die;
            break;
            

        case "ajoutQtt":
            if (isset($_SESSION['products'])) {
                $_SESSION['products'][$id]['qtt']++;
                $_SESSION['products'][$id]['total'] = $_SESSION['products'][$id]['qtt']*$_SESSION['products'][$id]['price'];
                $_SESSION['message'] = '<div class="alert alert-success" role="alert"> La quantité a été augmentée avec succès ! </div>';
            } else {
                $_SESSION['message'] = '<div class="alert alert-danger" role="alert"> L\'indice du produit à mettre à jour n\'existe pas ! </div>';
               
            }
            header("Location:recap.php");die;
            break;

            case "retirerQtt":
                if (isset($_SESSION['products']) && isset($_SESSION['products'][$id]) && $_SESSION['products'][$id]['qtt'] > 0) {
                    $_SESSION['products'][$id]['qtt']--;
                    $_SESSION['products'][$id]['total'] = $_SESSION['products'][$id]['qtt']*$_SESSION['products'][$id]['price'];
                    if ($_SESSION['products'][$id]['qtt'] == 0) {
                        unset($_SESSION['products'][$id]);
                        $_SESSION['message'] = '<div  id="message" class="alert alert-success" role="alert">Le produit a été supprimé avec succès !</div>';
                    } else {
                        $_SESSION['message'] = '<div  id="message" class="alert alert-success" role="alert">La quantité a été diminuée avec succès !</div>';
                    }
                } else {
                    $_SESSION['message'] = '<div id="message"  class="alert alert-warning" role="alert">Opération non autorisée.</div>';
                    
                }
                header("Location:recap.php");die;
                break;
    }

    }
    ?>
    <?php
    $content = ob_get_clean();
    $title = "Ajout produit";
    require_once "template.php"; ?>


