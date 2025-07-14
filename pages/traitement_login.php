<?php
session_start();
   include('../inc/fonction.php');
   
   $email =$_POST['email'];
   $mdp =$_POST['mdp'];

   $verif=login($email,$mdp);
   $ligne=get_membre();

   while($membre=mysqli_fetch_assoc($ligne))
   {
      if($verif['email'] == $membre['email'] && $verif['mdp'] = $membre['mdp'])
      {
         $_SESSION['id_membre']=$verif['id_membre'];
         header('location:accueil.php');
      }
   }
?>