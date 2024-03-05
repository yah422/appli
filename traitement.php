<?php
session_start();
ob_start();

if (isset($_POST['submit'])) {
   
    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
 
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
      
            $product['image'] = $uploadFile;
        } else {
            $_SESSION['message'] = '<div class="alert alert-danger" role="alert">Erreur lors de l\'upload de l\'image.</div>';
        }
    }
    
}
$id = isset($_GET['id']) ? $_GET['id'] : null ;
if(isset($_GET['action'])){

    switch($_GET['action']){
        case "ajout":
            if(isset($_POST['submit'])){
                $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
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
                $_SESSION['message'] = '<div class="alert alert-success" role="alert"> La quantité a été augmentée avec succès ! </div>';
            } else {
                $_SESSION['message'] = '<div class="alert alert-danger" role="alert"> L\'indice du produit à mettre à jour n\'existe pas ! </div>';
               
            }
            header("Location:recap.php");die;
            break;

            case "retirerQtt":
                if (isset($_SESSION['products']) && isset($_SESSION['products'][$id]) && $_SESSION['products'][$id]['qtt'] > 0) {
                    $_SESSION['products'][$id]['qtt']--;
            
                    if ($_SESSION['products'][$id]['qtt'] == 0) {
                        unset($_SESSION['products'][$id]);
                        $_SESSION['message'] = '<div style="display:flex;" class="alert alert-success" role="alert">Le produit a été supprimé avec succès !</div>';
                    } else {
                        $_SESSION['message'] = '<div style="display:flex;" class="alert alert-success" role="alert">La quantité a été diminuée avec succès !</div>';
                    }
                } else {
                    $_SESSION['message'] = '<div style="display:flex;" class="alert alert-warning" role="alert">Opération non autorisée.</div>';
                    
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


