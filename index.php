<?php
require './config.php';
include_once("./models/User.php");
session_start();
$getUsers = new User();
$users = $getUsers->getAllUser();
var_dump($users);
if (isset($_POST['user-profil'])) {
  header("location: ./pages/user.php");
  exit();
}
if (isset($_POST['user-collection'])) {
  var_dump($_POST);
}
?>

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
          <img src="#" class="logo-header" alt="accueil" />
        </a>
      </div>

      <img class="quiz-logo" src="../assets/img/titre-logo.png" />

      <div class="logo-login">
        <a href="./pages/connexion.php">
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
        <button class="icon-account header-user-logo" type="submit" name="user-profil">
          <div class="box-account">
            <img src="./assets/img/Lamu 3.jpg" alt="avatar" />
          </div>
        </button>
        </button>
        <button class="icon-account" type="submit" name="logout">
          <img src="#" alt="deconnexion" />
        </button>
      </form>
    <?php endif; ?>

  </header>

  <main class="home-page">

    <h1 class="title">Family Collection</h1>

    <h3 class="subtitle">Sélectionnez quelle collection voir</h3>

    <section class="profil">
      <?php foreach ($users as $user) : ?>
        <article class="profil-item">
          <form method="post">
            <input type="hidden" name="usreID" value=<?= $user['id'] ?>>
            <button type="submit" class="avatar-button" name="user-collection">
              <figure class="profil-picture"><img src="./assets/img/Lamu 3.jpg" alt="profil de yannick"></figure>
            </button>
          </form>
          <h3 class="profil-name"><?= $user['login'] ?></h3>
        </article>

      <?php endforeach ?>

    </section>


  </main>














  <?php include("./components/footer.php") ?>