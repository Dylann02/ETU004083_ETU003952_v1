<?php 
    include('../inc/fonction.php');
    $nom=$_POST['nom'];
    $email=$_POST['email'];
    $naissance=$_POST['anniv'];
    $genre=$_POST['genre'];
    $mdp=$_POST['mdp'];
    $ville=$_POST['ville'];

    insert_membre($email,$nom,$genre,$naissance,$ville,$mdp);

?>