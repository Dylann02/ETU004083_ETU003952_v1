
<?php
session_start();
include('../inc/fonction.php');
$categories = get_categorie();
$categorie = $_POST['categorie'] ?? 'TOUS';
$liste = filtre($categorie);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Objets</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .mini-msg { font-size: 0.9em; color: #198754; margin-top: 4px; margin-bottom: 4px; }
        .dispo-date { font-size: 0.9em; color: #6c757d; }
    </style>
</head>
<body>
    <header class="bg-primary text-white py-3 mb-4">
        <div class="container"><h1 class="h3">Liste des objets empruntés</h1></div>
    </header>
    <div class="container mb-3">
        <a href="formulaire_ajout_objet.php" class="btn btn-success">Ajouter un nouveau objet</a>
    </div>

    <?php
    if (isset($_SESSION['id_membre'])) {
        $id_membre = $_SESSION['id_membre'];
        $conn = dbconnect();
        $sql = "SELECT COUNT(*) AS total FROM emprunt WHERE id_membre = $id_membre";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $total_emprunt = $row['total'];
        echo '<div class="container mb-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="alert alert-info p-2 mb-0">
                        Vous avez emprunté <strong>' . $total_emprunt . '</strong> objet(s).
                    </div>
                    <button class="btn btn-success btn-sm" onclick="this.nextElementSibling.style.display=\'inline-block\'">Rendre</button>
                    <span style="display:none;">
                        <form action="rendre_tout.php" method="post" style="display:inline;">
                            <input type="hidden" name="etat" value="abime">
                            <button type="submit" class="btn btn-danger btn-sm">Abîmé</button>
                        </form>
                        <form action="rendre_tout.php" method="post" style="display:inline;">
                            <input type="hidden" name="etat" value="ok">
                            <button type="submit" class="btn btn-primary btn-sm">OK!</button>
                        </form>
                    </span>
                </div>
            </div>';
    }
    ?>

    
    <div class="container mb-4">
        <form action="accueil.php" method="post" class="d-flex gap-2 align-items-center">
            <select name="categorie" class="form-select w-auto">
                <option value="TOUS" <?= $categorie === 'TOUS' ? 'selected' : '' ?>>TOUS</option>
                <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>
                    <option value="<?= htmlspecialchars($cat['nom_categorie']) ?>" <?= $cat['nom_categorie'] === $categorie ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['nom_categorie']) ?>
                    </option>
                <?php } ?>
            </select>
            <input type="submit" value="Trier" class="btn btn-primary">
        </form>
    </div>
    <main class="container">
        <div class="row g-4">
            <?php while ($obj = mysqli_fetch_assoc($liste)) { 
                
                $dispo = ($obj['date_retour'] != NULL && strtotime($obj['date_retour']) <= time());
                
                $is_just_emprunted = isset($_GET['success'], $_GET['id_objet']) && $_GET['success'] == 1 && $_GET['id_objet'] == $obj['id_objet'];
            ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary">
                                <i class="bi bi-box-seam me-2"></i><?= htmlspecialchars($obj['objet']) ?>
                            </h5>
                            <p><strong>Date d'emprunt :</strong> <?= htmlspecialchars($obj['date_emprunt']) ?></p>
                            <p>
                                <strong>Statut :</strong>
                                <?php
                                if (!$dispo || $is_just_emprunted) {
                                    $date_dispo = $obj['date_retour'] ? date('d/m/Y', strtotime($obj['date_retour'])) : 'indéterminée';
                                    echo "<span class='text-danger fw-bold'>Non disponible</span>";
                                    echo "<span class='dispo-date d-block'>Disponible le $date_dispo</span>";
                                    if ($is_just_emprunted) {
                                        echo '<div class="mini-msg">Emprunt enregistré avec succès !</div>';
                                    }
                                } else {
                                    echo "<span class='text-success'>Disponible depuis le " . date('d/m/Y', strtotime($obj['date_retour'])) . "</span>";
                                    ?>
                                    <form action="emprunter.php" method="post" class="mt-2 d-flex gap-2 align-items-center">
                                        <input type="hidden" name="id_objet" value="<?= $obj['id_objet'] ?>">
                                        <input type="number" name="duree" min="1" max="30" value="1" required class="form-control form-control-sm w-auto">
                                        <span>jour(s)</span>
                                        <button type="submit" class="btn btn-warning btn-sm">Emprunter</button>
                                    </form>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
</body>
</html>