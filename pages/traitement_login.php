<?php
   include('../inc/fonction.php');
   
   $email =$_POST['email'];
   $mdp =$_POST['mdp'];

   $verif=login($email,$mdp);
   $ligne=get_membre();

   while($membre=mysqli_fetch_assoc($ligne))
   {
      if($verif['email'] == $membre['email'] && $verif['mdp'] = $membre['mdp'])
      {
         header('location:accueil.php');
      }
   }
?>