<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Ajout produit </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <?php 

    session_start();

    $panier= $_SESSION['products'];
    function calculerNombreProduit(){
    $nbrTotal = 0;

    foreach( $panier as $quantite){
    $nbrTotal += $quantite;
    }
    return $nbrTotal;
    }

    $nbrProduitPanier = calculerNombreProduit($panier);

    ?>
    <div style="display: flex; gap:2" class="p-0">

        <div  class="d-grid gap-2 d-md-block">
        <button type="button" class="btn btn-primary"> <a style="text-decoration:none; color: white;"  href="index.php"> Ajouter produit </a> </button>
        <button type="button" class="btn btn-white text-primary" > <a style="text-decoration:none;" href="recap.php"> Panier </a>  </button>
        </div>

    </div>

    <h1 class="text-primary font-weight-bold p-4 pb-0 pt-0 "> Ajouter un produit </h1>
    <div class="p-5 pt-0 pb-0" >
    <form action="traitement.php" method="post">
        <p>
            <label>
                Nom du produit: <br>
                <input class=" border-0" type="text" name="name">
            </label>
        </p>
        <p>
            <label>
                Prix du produit : <br>
                <input class=" border-0" type="number" step="any" name="price">
            </label>
        </p>
        <p>
            <label>
                Quantité désirée: <br>
                <input class=" border-0" type="number" name="qtt" value="1">
            </label>
        </p>
    </div>
    <div d-flex align-item-center justify-content-center >
        <p class="p-4">
                <input class="form-control bg-primary text-white text-center" style="width:200px; height:40px;" type="submit" name="submit" value="Ajouter le produit">    
        </p>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>