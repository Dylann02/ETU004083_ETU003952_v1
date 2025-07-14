
<?php
session_start();
require('../inc/connexion.php');
if (!isset($_SESSION['id_membre'])) header('Location: ../login.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_objet = intval($_POST['id_objet']);
    $duree = intval($_POST['duree']);
    $id_membre = $_SESSION['id_membre'];
    $date_emprunt = date('Y-m-d');
    $date_retour = date('Y-m-d', strtotime("+$duree days"));
    mysqli_query(dbconnect(), "INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES ('$id_objet', '$id_membre', '$date_emprunt', '$date_retour')");
    header("Location: accueil.php?success=1&id_objet=$id_objet");
    exit();
}
header('Location: accueil.php');
exit();