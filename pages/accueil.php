<?php
    include('../inc/fonction.php');
    $liste = liste_objet();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Objets</title>

    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>

    <header class="bg-primary text-white py-3 mb-4">
        <div class="container">
            <h1 class="h3">Liste des objets empruntés</h1>
        </div>
    </header>

    <main class="container">
        <div class="row g-4">
            <?php while($objet = mysqli_fetch_assoc($liste)) { ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary">
                                <i class="bi bi-box-seam me-2"></i><?php echo ($objet['objet']); ?>
                            </h5>
                            <p class="mb-1"><strong>Date d'emprunt :</strong> <?php echo ($objet['date_emprunt']); ?></p>
                            <p class="mb-0">
                                <strong>Statut :</strong>
                                <?php 
                                    if ($objet['date_retour'] != NULL) {
                                        echo "<span class='text-success'>Disponible depuis le " . ($objet['date_retour']) . "</span>";
                                    } else {
                                        echo "<span class='text-danger fw-bold'>Non retourné</span>";
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>

</body>
</html>
