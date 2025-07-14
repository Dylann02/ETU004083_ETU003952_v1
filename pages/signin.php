<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h1>Signin</h1>
    <form action="traitement_inscription.php" method="post">
        <p>Email : <input type="email" name="email" placeholder="entere votre email"></p>
        <p>Nom : <input type="text" name="nom" placeholder="entrer votre nom"></p>
        <p>Date de naissance : <input type="date" name="anniv"></p>
        <p>Genre : <input type="text" name="genre" ></p>
        <p>Ville : <input type="text" name="ville"></p>
        <p>Mots de passe : <input type="password" name="mdp"></p>
        <input type="submit" value="valider">
    </form>
</body>
</html>