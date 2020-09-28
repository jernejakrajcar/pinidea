<?php
include_once './header.php';
include_once './database.php'; //ko uporabljaš pdo vedno preveri če imaš ta stavek

$query = "SELECT u.avatar, u.nickname, u.bio FROM users u WHERE u.id=?";

$stmt = $pdo->prepare($query);
$stmt->execute([$_SESSION['user_id']]);

$user = $stmt->fetch();

$query2 = "SELECT b.name, GROUP_CONCAT(p.picture) as pins FROM boards b INNER JOIN boards_pins bp ON b.id=bp.board_id INNER JOIN pins p ON p.id=bp.pin_id WHERE b.user_id=? GROUP BY b.name";

$stmt2 = $pdo->prepare($query2);
$stmt2->execute([$_SESSION['user_id']]);



?>
<div class="container-fluid">

  <div class="profile-bio">
    <img class="avatar" src="<?php echo $user['avatar']; ?>">
    <h3><?php echo $user['nickname'];?></h3>
    <p>
      <?php echo $user['bio'];?>
    </p>
    <a href="account.php">
      Edit profile
    </a>

  </div>

  <div class="boards">
    <div class="row">
    <?php while ($boards = $stmt2->fetch()) { ?>

      <div class="col-sm-4" style="margin:1%;">
        <div class="image-box">
        <h3 class="submit-text"><?php echo $boards['name'];?></h3>
        <div class="bigger-picture">
        <?php
          $pieces = explode(",",$boards['pins']);
          if(isset($pieces[0])){ ?>
            <img src="<?php echo $pieces[0];?>">
          <?php }
          else { ?>
            <img src="pictures/grey_picture.jpg">
          <?php } ?>

        </div>
        <div class="two-small-picks">
          <?php
          if(isset($pieces[1])){ ?>
            <img src="<?php echo $pieces[1];?>">
          <?php }
          else { ?>
            <img src="pictures/grey_picture.jpg">
          <?php } ?>

          <?php
          if(isset($pieces[2])){ ?>
            <img src="<?php echo $pieces[2];?>">
          <?php }
          else { ?>
            <img src="pictures/grey_picture.jpg">
          <?php } ?>
        </div>
        </div>
      </div>

      <?php } ?>
      </div>
  </div>

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


<?php
include_once './footer.php'; ?>
