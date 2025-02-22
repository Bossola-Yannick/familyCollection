<?php
if (!empty($_SESSION)) {

  // deconnexion
  if (isset($_POST['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: ../index.php");
  }
};

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/header-footer.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <title>S-Quiz Game</title>
</head>

<body>

  <header class="header">
    <?php if (!isset($_SESSION['userId'])): ?>
      <!-- pas connecté  -->
      <div class="logo-box">
        <a href="../index.php">
          <img src="#" class="logo-header" alt="accueil" />
        </a>
      </div>

      <img class="quiz-logo" src="../assets/img/titre-logo.png" />

      <div class="logo-login">
        <a href="./connexion.php">
          <img src="#" alt="connexion">
        </a>
      </div>
    <?php else : ?>

      <!-- connecté USER -->
      <div class="logo-box">
        <a href="../index.php">
          <img src="#" class="logo-header" alt="accueil" />
        </a>
      </div>
      <img class="quiz-logo" src="../assets/img/titre-logo.png" />
      <form method="post" action="" class="box-login-disconnect">
        <a href="./profil.php" class="icon-account header-user-logo" type="submit" name="user-profil">
          <div class="box-account">
            <img src="#" alt="avatar" />
          </div>
          <!-- penser a refair une session=>userNumber -->
          <p class="login "><?= "{ " . $_SESSION['userNumber'] . " }" ?></p>
        </a>
        <button class="icon-account" type="submit" name="logout">
          <img src="#" alt="deconnexion" />
        </button>
      </form>
    <?php endif; ?>

  </header>