<?php
session_start();
ob_start();
?>

    <?php

    if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
        echo "<p> Aucun produit en session ... </p>";
    }else {
        echo ' <div id="panier" class=" text-uppercase, fs-1"> <strong> Votre Panier </strong> </div> ' ;
        echo "<table id='table' class='table' >",
                "<thead class='table-primary'>",
                    "<tr>",
                        "<th>#</th>",
                        "<th>Image</th>",
                        "<th>Nom</th>",
                        "<th>Prix</th>",
                        "<th>Quantité</th>",
                        "<th>Total</th>",
                "</thead>",
                "<tbody>";
        $totalGeneral = 0;
        foreach($_SESSION['products'] as $index => $product){
            $img = $product["image"];
            echo "<tr>",
                    "<td>".($index)."</td>",
                    "<td><img src='images/$img' id='imgg' alt=''></td>",
                    "<td>".$product['name']."</td>",
                    "<td>".number_format($product['price'], 2,",","&nbsp")."&nbsp;€ </td> ",
                    "<td>".$product['qtt']."&nbsp; &nbsp;"."<a id='qtt' class='btn btn-primary' href='traitement.php?action=ajoutQtt&id=".$index."' role='button'>+</a>"."&nbsp;"."<a id='qtt' class='btn btn-primary' href='traitement.php?action=retirerQtt&id=".$index."' role='button'>-</a>"."</td>",
                    "<td>".number_format($product['total'], 2,",","&nbsp")."&nbsp;€&nbsp;"."<a id='total' class='btn btn-primary' href='traitement.php?action=supprimer&id=".$index."' role='button'> Supprimer </a>"."</td>",
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
        '<div id="divBtn" "> 
            <button  type="button" class="btn btn-primary"> <a id="btn"  href="index.php">  &#x2190; Retour </a> </button>
            <button class="btn btn-primary" id="videPanier" type="submit" name="clear"> <a id="btn" href=traitement.php?action=toutSupp> Vider le panier <a> </button>
        </div>';

        if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
            unset($_SESSION['message']); 
        }
    ?>

<?php
$title = "Récapitulatif Produit";
$content = ob_get_clean();
require_once "template.php"; 
?>