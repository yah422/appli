<?php
session_start();
ob_start();
?>

    <?php
    if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
        echo "<p> Aucun produit en session ... </p>";
    }else {
        echo ' <div class=" text-uppercase, fs-1" style=" width:100%; height:200px; color:#1c6de2; display: flex; flex-direction: row; align-content: center; justify-content: center; align-items: center;"> <strong> Votre Panier </strong> </div> ' ;
        echo "<table class='table' style=' font-family: system-ui; width: 900px; height: auto; border: 2px solid #155eb5;' >",
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
                    "<td>".($index)."</td>",
                    "<td>".$product['name']."</td>",
                    "<td>".number_format($product['price'], 2,",","&nbsp")."&nbsp;€ </td> ",
                    "<td>".$product['qtt']."&nbsp; &nbsp;"."<a style='border-radius:15px;width: 20px; height: 25px; display: flex; flex-direction: row; align-content: center; justify-content: center; align-items: center; ' class='btn btn-primary' href='traitement.php?action=ajoutQtt&id=".$index."' role='button'>+</a>"."&nbsp;"."<a style='border-radius:15px; width: 20px; height: 25px; display: flex; flex-direction: row; align-content: center; justify-content: center; align-items: center;' class='btn btn-primary' href='traitement.php?action=retirerQtt&id=".$index."' role='button'>-</a>"."</td>",
                    "<td>".number_format($product['total'], 2,",","&nbsp")."&nbsp;€&nbsp;"."<a style='border-radius:15px; display: flex; flex-direction: row; align-content: center; justify-content: center; align-items: center; width:100px;' class='btn btn-primary' href='traitement.php?action=supprimer&id=".$index."' role='button'> Supprimer </a>"."</td>",
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
        '<div style="display:flex; gap:400px; "> 
            <button  type="button" class="btn btn-primary"> <a style="text-decoration:none; color: white;"  href="index.php">  &#x2190; Retour </a> </button>
            <button class="btn btn-primary" style="border-radius: 5px;" type="submit" name="clear"> <a style="text-decoration:none; color: white;" href=traitement.php?action=toutSupp> Vider le panier <a> </button>
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

    