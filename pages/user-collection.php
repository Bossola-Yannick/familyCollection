<?php
require '../config.php';
include_once("../models/User.php");
include_once("../models/Item.php");
session_start();

$getCollection = new Item();
$collection = $getCollection->getAllItemByUser($_SESSION['collectionId']);

if (isset($_POST['return'])) {
  header("location: ../index.php");
  exit();
}
?>

<?php include('../components/header.php') ?>
<main>
  <h1>Bienvenu sur la collection de <?= $_SESSION['collectionLogin'] ?></h1>

  <section class="collection">
    <?php foreach ($collection as $item): ?>
      <article class="item-card">
        <div class="item-picture-box">
          <img src="#" alt="photo item" class="item-picture">
        </div>
        <h2 class="item.name"><?= $item['nom'] ?></h2>
        <p class="item.description"><?= $item['description'] ?></p>

      </article>
    <?php endforeach ?>
  </section>

  <form method="post">
    <button type="submit" class="button return" name="return">
      Retour Accueil
    </button>
  </form>
</main>
<?php include('../components/footer.php') ?>