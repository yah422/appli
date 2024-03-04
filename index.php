<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="display:flex; flex-direction: column; align-items: center; align-content: center; justify-content: center;" >
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
   <section style="border:1px solid blue; width:500px; height: 600px;     display: flex; justify-content: space-evenly; align-items: center; flex-direction: column;" >
    <div style="display: flex; gap:2" class="p-0">

        <div  class="d-grid gap-2 d-md-block">
        <button type="button" class="btn btn-primary"> <a style="text-decoration:none; color: white;"  href="index.php"> Ajouter produit </a> </button>
       

        <button type="button" class="btn btn-white text-primary" > <a style="text-decoration:none;" href="recap.php">
         Panier </a>  </button> 
        
        </div>
        <div style=" color:white; display:flex; flex-direction: row; align-content: center; justify-content: center; align-items: center; border-radius:100px; background-color:red; width:30px; height:20px" >
        
        <?php 
    
        session_start();

        function calculerNombreProduit(){
        $nbrTotal = 0;
        foreach($_SESSION['products'] as $index => $product){
            $nbrTotal = $index + 1;
        }
        return $nbrTotal;
        }
    
        echo calculerNombreProduit(); ?>
        </div>

    </div>

    <h1 class="text-primary font-weight-bold p-4 pb-0 pt-0 "> Ajouter un produit </h1>
    <div class="p-5 pt-0 pb-0" >
    <form action="traitement.php?action=ajout" method="post">
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
                <input id="" class="form-control bg-primary text-white text-center" style="width:200px; height:40px;" type="submit" name="submit" href="index.php" value="Ajouter le produit">    
        </p>
    </form>
    </div>

        <?php 

        if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
            unset($_SESSION['message']); 
        }

        ?>

    </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>