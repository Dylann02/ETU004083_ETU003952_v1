<?php
include("../inc/fonction.php");
session_start();

$nom_objet = $_POST['nom_objet'];
$id_categorie = $_POST['id_categorie'];
$id_membre = $_SESSION['id_membre']; 

$uploadDir = '../uploads/';
$maxSize = 10 * 1024 * 1024; 
$allowedMimeTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];

if (!isset($_FILES['images'])) {
    die("Aucune image n'a été envoyée.");
}

$images = $_FILES['images'];
$cheminsImages = [];

for ($i = 0; $i < count($images['name']); $i++) {
    $tmp = $images['tmp_name'][$i];
    $size = $images['size'][$i];
    $name = $images['name'][$i];

    if (!file_exists($tmp)) continue;

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $tmp);
    finfo_close($finfo);

    if (!in_array($mime, $allowedMimeTypes)) {
        die("Fichier non autorisé : $name");
    }

    if ($size > $maxSize) {
        die("Image trop grande : $name (max " . ($maxSize / 1024 / 1024) . " Mo)");
    }

    $ext = pathinfo($name, PATHINFO_EXTENSION);
    $base = pathinfo($name, PATHINFO_FILENAME);
    $newName = $base . '_' . uniqid() . '.' . $ext;
    $path = $uploadDir . $newName;

    if (move_uploaded_file($tmp, $path)) {
        $cheminsImages[] = $newName; 
    }
}

if (count($cheminsImages) > 0) {
    $conn = dbconnect(); 

  
    $requete = "INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES ('%s', %d, %d)";
    $requete = sprintf($requete, 
                       mysqli_real_escape_string($conn, $nom_objet),
                       intval($id_categorie),
                       intval($id_membre));
    
    if (!mysqli_query($conn, $requete)) {
        die("Erreur lors de l'insertion de l'objet: " . mysqli_error($conn));
    }
    
    $id_objet = mysqli_insert_id($conn);

   
    foreach ($cheminsImages as $i => $nom_image) {
        $requete = "INSERT INTO images_objet (id_objet, nom_image) VALUES (%d, '%s')";
        $requete = sprintf($requete, 
                           intval($id_objet),
                           mysqli_real_escape_string($conn, $nom_image));
        
        if (!mysqli_query($conn, $requete)) {
            die("Erreur lors de l'insertion de l'image: " . mysqli_error($conn));
        }
    }

    header("Location: liste.php");
    exit();
} else {
    die("Aucune image valide n'a été téléchargée.");
}
?>