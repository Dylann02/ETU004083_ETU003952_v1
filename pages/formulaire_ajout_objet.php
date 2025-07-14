<?php
include("../inc/fonction.php"); 
$categories = get_categorie();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un objet</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        
        body {
            background: #f8f9fa;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        
        .card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            padding: 2rem;
        }

        
        .card h2 {
            font-weight: 700;
            color: #0d6efd; 
            text-align: center;
            margin-bottom: 1.5rem;
        }

        label {
            font-weight: 600;
            color: #495057;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 8px rgba(13, 110, 253, 0.25);
        }
        .btn-primary {
            border-radius: 8px;
            font-weight: 600;
            padding: 10px 0;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0b5ed7;
        }

        .mb-3 {
            margin-bottom: 1.25rem !important;
        }


        @media (max-width: 576px) {
            .card {
                margin: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>Ajouter un objet</h2>
        <form action="traitement_ajout_objet.php" method="post" enctype="multipart/form-data" novalidate>
            <div class="mb-3">
                <label for="nom_objet">Nom de l'objet</label>
                <input type="text" name="nom_objet" id="nom_objet" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="id_categorie">Catégorie</label>
                <select name="id_categorie" id="id_categorie" class="form-control" required>
                    <?php foreach ($categories as $cat) { ?>
                        <option value="<?= htmlspecialchars($cat['id_categorie']) ?>"><?= htmlspecialchars($cat['nom_categorie']) ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="images">Images (la première sera l’image principale)</label>
                <input type="file" name="images[]" id="images" multiple class="form-control" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter l'objet</button>
        </form>
    </div>
</body>
</html>
