<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Récapitulatif des produits </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style=" display: flex; flex-direction: column; align-content: center; justify-content: center; align-items: center;" >
    <nav class="navbar mb-4" style="background-color: #e3f2fd; width:100%;">
        <div class="container-fluid m-1" style=" display:flex; flex-direction: row; align-content: center; justify-content: space-evenly; align-items: center;">
            <div style="display:flex;">
                <a class="navbar-brand" href="#"> Application PHP </a>
            </div>
            <div style="display:flex;">
                <ul class="navbar-nav" style="display:flex; flex-direction:row; gap:50px;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php"> Accueil </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="recap.php"> Panier </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
        echo "<p> Aucun produit en session ... </p>";
    }else {
        echo ' <div class=" text-uppercase, fs-1" style=" width:100%; height:200px; color:#1c6de2; display: flex; flex-direction: row; align-content: center; justify-content: center; align-items: center;"> <strong> Votre Panier </strong> </div> ' ;
        echo "<table class='table' style=' font-family: system-ui; width: 800px; height: auto; border: 2px solid #155eb5;' >",
                "<thead class='table-primary'>",
                    "<tr>",
                        "<th>#</th>",
                        "<th>Nom</th>",
                        "<th>Prix</th>",
                        "<th>Quantité</th>",
                        "<th>Total</th>",
                "</thead>",
                "<tbody>";
        $totalGeneral = 0;
        foreach($_SESSION['products'] as $index => $product){
            echo "<tr>",
                    "<td>".$index."</td>",
                    "<td>".$product['name']."</td>",
                    "<td>".number_format($product['price'], 2,",","&nbsp")."&nbsp;€</td>",
                    "<td>".$product['qtt']."</td>",
                    "<td>".number_format($product['total'], 2,",","&nbsp")."&nbsp;€</td>",
                "</tr>";
            $totalGeneral += $product['total'];

        }
        echo "<tr>",
                "<td colspan=4><strong> Total général : </strong> </td>",
                "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
            "</tr>",
            "</tbody>",
            "</table>";
            
    }
    echo 
        '<div> 
            <button type="button" class="btn btn-primary"> <a style="text-decoration:none; color: white;"  href="index.php">  &#x2190; Retour </a> </button></div>
         <div>';
    
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>