<?php
// echo '<pre>'; // formats output and adds linefeeds
//   print_r($_SERVER);
// echo '</pre>';
// die;

include_once './header.php';
include_once './database.php';

$stmt = $pdo->query("SELECT picture FROM pins");
?>

<div class="grid">
  <?php  while ($pin = $stmt->fetch()) {?>
  <div class="grid-item">
        <img src="<?php  echo $pin['picture']; ?>" class="pin-image" alt="...">
  </div>
  <?php } ?>


</div>

<div class="add_pin" style="position:fixed;right:10px;bottom:10px;z-index:2;">
  <button class="btn btn-light" id="open" style="border-radius:50px;font-size:1.75rem;width:3.5rem;"><i class="fa fa-plus"></i> </button>
</div>

<!--Creates the popup body-->
<div class="popup-overlay">
  <!--Creates the popup content-->
  <div class="popup-content">
    <h5>Create</h5>
    <hr>
    <h3><a href="add_pin.php">Pin</a></h3>
    <br>
    <h3><a href="add_board.php">Board</a></h3>
</div>

</div>


<div class="page-load-status">
  <p class="infinite-scroll-last">End of content</p>
  <p class="infinite-scroll-error">No more to load</p>
</div>


<?php
include_once './footer.php';
?>
