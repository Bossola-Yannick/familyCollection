<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/header-footer.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>S-Quiz Game</title>
</head>

<body>

  <header class="header">
    <?php if (!isset($_SESSION['userId'])): ?>
      <!-- pas connecté  -->
      <div class="logo-box">
        <a href="../index.php">
          <img src="../assets/img/accueil-logo.png" class="logo-header" alt="connexion" />
        </a>
      </div>

      <img class="quiz-logo" src="../assets/img/titre-logo.png" />

      <div class="logo-login">
        <a href="./connexion.php">
          <img src="../assets/img/utilisateur.png">
        </a>
      </div>
    <?php elseif ($_SESSION['userRole'] == "admin") : ?>

      <!-- connecté ADMIN-->
      <div class="logo-box">
        <a href="../index.php">
          <img src="../assets/img/accueil-logo.png" class="logo-header" alt="connexion" />
        </a>
      </div>
      <img class="quiz-logo" src="../assets/img/titre-logo.png" />
      <form method="post" action="" class="box-login-disconnect">
        <a href="./admin.php" class="icon-account header-user-logo" type="submit" name="user-profil">
          <div class="box-account">
            <img src="../assets/img/redSuit.png" class="logo-admin" />
          </div>
        </a>
        <button class="icon-account" type="submit" name="logout">
          <img src="../assets/img/deconnexion.png" alt="deconnexion" />
        </button>
      </form>
    <?php else : ?>

      <!-- connecté USER -->
      <div class="logo-box">
        <a href="../index.php">
          <img src="../assets/img/accueil-logo.png" class="logo-header" alt="connexion" />
        </a>
      </div>
      <img class="quiz-logo" src="../assets/img/titre-logo.png" />
      <form method="post" action="" class="box-login-disconnect">
        <a href="./profil.php" class="icon-account header-user-logo" type="submit" name="user-profil">
          <div class="box-account">
            <img src="../assets/img/utilisateur.png" />
          </div>
          <!-- penser a refair une session=>userNumber -->
          <p class="login "><?= "{ " . $_SESSION['userNumber'] . " }" ?></p>
        </a>
        <button class="icon-account" type="submit" name="logout">
          <img src="../assets/img/deconnexion.png" alt="deconnexion" />
        </button>
      </form>
    <?php endif; ?>

  </header>

  <main class="home-page">

    <h1 class="title">Family Collection</h1>

    <h3 class="subtitle">Sélectionnez quelle collection choisir</h3>

    <section class="profil">
      <a href="./pages/user.php">
        <article class="profil-item">
          <figure class="profil-picture"><img src="./assets/img/Lamu 3.jpg" alt="profil de yannick"></figure>
          <h3 class="profil-name">Gwénaelle</h3>
        </article>
      </a>
      <a href="./pages/user.php">
        <article class="profil-item">
          <figure class="profil-picture"><img src="./assets/img/Lamu 3.jpg" alt="profil de yannick"></figure>
          <h3 class="profil-name">Yannick</h3>
        </article>
      </a>
      <a href="./pages/user.php">
        <article class="profil-item">
          <figure class="profil-picture"><img src="./assets/img/Lamu 3.jpg" alt="profil de yannick"></figure>
          <h3 class="profil-name">Cassandra</h3>
        </article>
      </a>

    </section>


  </main>














  <?php include("./components/footer.php") ?>