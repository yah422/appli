<?php 
    session_start();
    ob_start();
    ?>

    <section>
    <div id="divSection" class="p-0">

        <div  class="d-grid gap-2 d-md-block">
        <button type="button" class="btn btn-primary"> <a id="btn"  href="index.php"> Ajouter produit </a> </button>
       

        <button type="button" class="btn btn-white text-primary" > <a id="aPanier" href="recap.php">
         Panier </a>  </button> 
        
        </div>
        <div id="divFunction" >
        
        <?php 
    
        function calculerNombreProduit(){
            $nbrTotal = 0;
            if (isset($_SESSION['products']) && !empty($_SESSION['products'])){

                foreach($_SESSION['products'] as $index => $product){
                    $nbrTotal = $index + 1;
                }
            }
            return $nbrTotal;
        }
    
        echo calculerNombreProduit(); ?>
        </div>

    </div>

    <h1 class="text-primary font-weight-bold p-4 pb-0 pt-0 "> Ajouter un produit </h1>
    <div class="p-5 pt-0 pb-0" >
    <form action="traitement.php?action=ajout" method="post" enctype="multipart/form-data"> 

        <p>
            <label for="file"> Fichier </label>
            <input type="file" name="file">
        </p>
        <p>
            <label>
                Nom du produit: <br>
                <input id="" class=" border-0" type="text" name="name">
            </label>
        </p>
        <p>
            <label>
                Prix du produit : <br>
                <input id="" class=" border-0" type="number" step="any" name="price">
            </label>
        </p>
        <p>
            <label>
                Quantité désirée: <br>
                <input id="" class=" border-0" type="number" min="0" name="qtt" value="1">
            </label>
        </p>
    </div>
    <div d-flex align-item-center justify-content-center >
        <p class="p-4">
                <input id="i" class="form-control bg-primary text-white text-center" type="submit" name="submit" href="index.php" value="Ajouter le produit">    
        </p>
    </form>
    </div>

    <?php
    $content = ob_get_clean();
    $title = "Ajout produit";
    require_once "template.php"; ?>


   

      