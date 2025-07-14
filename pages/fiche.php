<?php
    include("../inc/fonction.php");
session_start();
$image=get_image($_GET['id']);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Fiche objet</h1>
    <div class="container">
        <h2>Images de l'objet</h2>
        <div class="row">
            <?php while ($img = mysqli_fetch_assoc($image)) { ?>
                <div class="col-md-4 mb-3">
                    <img src="../uploads/<?php echo htmlspecialchars($img['nom_image']); ?>" class="img-fluid" alt="Image de l'objet">
                </div>
            <?php } ?>
        </div>
</body>
</html>