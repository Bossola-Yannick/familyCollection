<?php
require '../config.php';
include_once("../models/User.php");
include_once("../models/Item.php");
include_once("../models/Image.php");

session_start();

if (isset($_POST['valid'])) {
  $name = htmlspecialchars($_POST['name']);
  $_SESSION['name-item'] = $name;
  $description = htmlspecialchars($_POST['description']);
  $_SESSION['description-item'] = $description;
  $id_user = $_SESSION['userId'];
  $newItem = new Item();
  $newItem->createItem($name, $description, $id_user);
  $getIdItem = $newItem->getLastItem();
  $_SESSION['lastItem'] = $getIdItem[0]['id'];
};
if (isset($_POST['valid-image'])) {
  $image = new Image();
  $newImage = $image->createImage($_FILES['image']['name'], $_FILES['image']['size'], $_FILES['image']['type'], $_FILES['image']['tmp_name'], $_SESSION['lastItem']);
  header('location: ./user.php');
}
?>

<?php include('../components/header.php') ?>
<main>
  <h1 class="autor-title">Nouvelle Article</h1>

  <?php if (!isset($_POST['valid'])): ?>
    <form action="" method="post" class="form-new-item">
      <input type="text" name="name" class="edit-input" placeholder="Non de l'article">
      <input type="text" name="description" class="edit-input" placeholder="Description ou info">
      <input type="submit" name="valid" id="button" class="button valider button-center" value="Valider">
    </form>
  <?php elseif (isset($_POST['valid'])): ?>
    <h2 class="item-title"><?= $_SESSION['name-item'] ?></h2>
    <h3 class="item-description"><?= $_SESSION['description-item'] ?></h3>
    <form enctype="multipart/form-data" action="" method="post" class="form-new-item">
      <input type="file" name="image" class="name">
      <input type="submit" name="valid-image" id="button" class="button" value="Valider">
    </form>
  <?php endif ?>
</main>
<?php include('../components/footer.php') ?>