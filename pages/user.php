<?php
require '../config.php';
include_once("../models/User.php");
include_once("../models/Item.php");
include_once("../models/Avatar.php");
session_start();

$newUser = new User();
$getCollection = new Item();
$collection = $getCollection->getAllItemByUser($_SESSION['userId']);

// renvoie vers l'accueil si pas connecté
if (!isset($_SESSION['userLogin'])) {
  header("location: ../index.php");
}

// direction vers la création d'Article
if (isset($_POST['new-item'])) {
  header("location: ./new-item.php");
  exit();
}

// suppression d'un Article
if (isset($_POST['delete-item'])) {
  $deleteItem = new Item();
  $deleteItem->delete($_POST['delete-item']);
  header("location: ./user.php");
  exit();
}

// modification info Profil
if (isset($_SESSION['message'])) {
  $_SESSION['message'] = "";
}

if (isset($_POST['submitLogin'])) {
  if (!empty($_POST['newLogin'])) {
    $userLogin = $_SESSION['userLogin'];
    $newLogin = htmlentities($_POST['newLogin']);
    $newUser->updateUserLogin($userLogin, $newLogin);
    header('refresh: 2 ; url=user.php');
    exit();
  }
}

if (isset($_POST['submitPass'])) {
  if (!empty($_POST['newPass']) and (!empty($_POST['currentPass']))) {
    $userId = $_SESSION['userId'];
    $currentPass = htmlentities($_POST['currentPass']);
    $newPass = htmlentities($_POST['newPass']);

    $newUser->updateUserPassword($userId, $currentPass, $newPass);
    header('refresh: 2 ; url=user.php');
    exit();
  }
}

// création de l'AVATAR
if (isset($_POST['valid-avatar'])) {
  $avatar = new Avatar();
  $newAvatar = $avatar->createAvatar($_FILES['avatar']['name'], $_FILES['avatar']['size'], $_FILES['avatar']['type'], $_FILES['avatar']['tmp_name'], $_SESSION['userId']);
  $avatarResult = $avatar->getAvatarByUserId($_SESSION['userId']);
  $_SESSION['avatar'] = $avatarResult;
  header('location: ../index.php');
}
// modification de l'AVATAR
if (isset($_POST['update-avatar'])) {
  $avatar = new Avatar();
  $newAvatar = $avatar->updateAvatar($_POST['avatarId'], $_FILES['avatar']['name'], $_FILES['avatar']['size'], $_FILES['avatar']['type'], $_FILES['avatar']['tmp_name'], $_POST['userId']);
  header('location: ../index.php');
}

?>


<?php include('../components/header.php') ?>
<main>
  <h1 class="subtitle">Bienvenu sur ta Collection <span class="subtitle-name"><?= $_SESSION['userLogin'] ?></span></h1>

  <section class="profil-info">
    <form action="" method="post" class="infos-box">
      <!-- pseudo -->
      <div class="edit-box">
        <?php if (isset($_POST['editLogin'])): ?>

          <p class="profil-text">Pseudo:</p>
          <input type="text" name="newLogin" id="pseudo" class="edit-input" placeholder="nouveau pseudo" minlength="3" />

          <div class="info-duo">
            <button type="submit" name="cancelLogin" id="cancel" class="button button-red" value="">Annuler</button>
            <input type="submit" name="submitLogin" id="submitLogin" class="button" value="Valider">
          </div>


        <?php else: ?>

          <p class="profil-text">Pseudo:
            <span class="bold"><?= $_SESSION['userLogin'] ?></span>
          </p>
          <button type="submit" name="editLogin" id="modifier" class="button update-button" value="">Modifier pseudo</button>

        <?php endif; ?>

      </div>

      <!-- mot de passe -->
      <div class="edit-box">

        <?php if (isset($_POST['editPass'])): ?>

          <p class="profil-text">Mot de passe: </p>
          <input type="password" name="currentPass" id="currentPass" class="edit-input" placeholder="mot de passe actuel" minlength="3" />
          <input type="password" name="newPass" id="newPass" class="edit-input" placeholder="nouveau mot de passe" minlength="3" />
          <div class="info-duo">
            <button type="submit" name="cancelPass" id="cancel" class="button button-red">Annuler</button>
            <input type="submit" name="submitPass" id="submitPass" class="button" value="Valider">
          </div>
        <?php else: ?>
          <p class="profil-text">Mot de passe:
            <span class="bold">*****</span>
          </p>
          <button type="submit" name="editPass" id="modifier" class="button update-button" value="">Modifier mot de passe</button>

        <?php endif; ?>

      </div>

      <?php if (isset($_SESSION['message'])): ?>
        <p class="msg-show"><?= $_SESSION['message']; ?></p>
      <?php endif; ?>
    </form>

    <!-- Créer/Modifier AVATAR -->
    <?php if (empty($_SESSION['avatarProfil'])) : ?>
      <div class="edit-avatar">
        <p class="profil-text">Changer Avatar</p>
        <form enctype="multipart/form-data" action="" method="post">
          <input type="file" name="avatar" class="name">
          <input type="submit" name="valid-avatar" id="button" class="button " value="Valider Avatar">
        </form>
      </div>
    <?php else : ?>
      <div class="edit-avatar">
        <p class="profil-text">Changer Avatar</p>
        <form enctype="multipart/form-data" action="" method="post">
          <input type="file" name="avatar" class="name">
          <input type="hidden" name="userId" value=<?= $_SESSION['userId'] ?>>
          <input type="hidden" name="avatarId" value=<?= $_SESSION['avatarId'] ?>>
          <input type="submit" name="update-avatar" id="button" class="button valider button-center" value="Modifier Avatar">
        </form>
      </div>
    <?php endif ?>

  </section>

  <form action="" method="post">
    <input type="submit" name="new-item" id="button" class="create-button" value="Ajouter nouvelle élément !">
  </form>

  <section class="collection">
    <?php foreach ($collection as $item): ?>
      <article class="item-card">
        <div class="item-picture-box">
          <img src="#" alt="photo item" class="item-picture">
        </div>
        <h2 class="item-name"><?= $item['nom'] ?></h2>
        <p class="item-description"><?= $item['description'] ?></p>
        <form action="" method="post">
          <button type="submit" class="button button-red " name="delete-item" value="<?= $item['id'] ?>">X</button>
        </form>
      </article>
    <?php endforeach ?>

  </section>
</main>
<?php include('../components/footer.php') ?>