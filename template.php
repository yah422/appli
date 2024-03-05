
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="display:flex; flex-direction: row; align-content: center; justify-content: center; align-items: center;">
    <div id="wrapper">
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

    if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']); 
    }

?>

        <?= $content; ?>

    </div>



</div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>