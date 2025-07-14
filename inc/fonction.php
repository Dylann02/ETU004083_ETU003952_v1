<?php 
    require('connexion.php');

    function get_membre()
    {
        $requete = "SELECT * FROM membre";
        $result = mysqli_query(dbconnect(),$requete);

        return $result;
    }

    function insert_membre($email,$nom,$genre,$anniv,$ville,$mdp)
    {
        $requete = "INSERT INTO membre (nom,date_naissance,genre,email,ville,mdp,image_profil) VALUES ('$nom','$anniv','$genre','$email','$ville','$mdp',NULL)";
        $result = mysqli_query(dbconnect(),$requete);

        return $result;
    }

    function login($email,$mdp)
    {
        $requete = "SELECT * FROM membre WHERE email = $email AND mdp = $mdp";
        $result = $result = mysqli_query(dbconnect(),$requete);
        $ligne = mysqli_fetch_assoc( $result);

        return $ligne;
    }

?>