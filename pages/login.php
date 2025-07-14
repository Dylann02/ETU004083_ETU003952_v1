


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Connexion</title>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css">
  <style>
    .container-box {
      display: flex;
      height: 100vh;
      align-items: center;
      justify-content: center;
      background: #f8f9fa;
    }
    .card {
      display: flex;
      flex-direction: row;
      width: 800px;
      border: none;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .left {
      background-color:#0d6efd;
      color: white;
      padding: 40px;
      flex: 1;
      border-top-left-radius: 10px;
      border-bottom-left-radius: 10px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .right {
      padding: 40px;
      flex: 1;
      background-color: white;
      border-top-right-radius: 10px;
      border-bottom-right-radius: 10px;
    }
    .btn-purple {
      background-color:#0d6efd;
      color: white;
    }
  </style>
</head>
<body>
  <div class="container-box">
    <div class="card">
      <div class="left text-center">
        <h2>Hello, Friend!</h2>
        <p>Register with your personal details<br>to use all of site features</p>
        <a href="signin.php" class="btn btn-light mt-3">Sign Up</a>
      </div>
      <div class="right">
        <h3 class="mb-4">Sign In</h3>
        <form action="traitement_login.php" method="post">
          <div class="mb-3">
            <label>Email :</label>
            <input type="email" class="form-control" name="email" placeholder="Entrer votre email" required>
          </div>
          <div class="mb-3">
            <label>Mot de passe :</label>
            <input type="password" class="form-control" name="mdp" placeholder="Entrer votre mot de passe" required>
          </div>
          <button type="submit" class="btn btn-purple w-100">Se connecter</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>