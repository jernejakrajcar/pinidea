<?php
include_once './header.php';
include_once './database.php';

$pin = $_GET['id'];
$user_id = $_SESSION['user_id'];

$query = "SELECT p.title, p.picture, p.description, u.nickname, u.avatar FROM pins p INNER JOIN users u ON u.id=p.user_id WHERE p.id=?";

$stmt = $pdo->prepare($query);
$stmt->execute([$pin]);

$pin_info = $stmt->fetch();


?>

<div class="container-fluid" style="padding-left:5rem;padding-right:5rem;">
    <div class="middle">

          <div class="pin-info-image">
            <img src="<?php echo $pin_info['picture']; ?>" style="height:auto;width:100%;">
          </div>

          <div class="info">
            <h3><?php echo $pin_info['title']; ?></h3>
            <h5 style="color:gray;"><?php echo $pin_info['description']; ?></h5>
            <hr>
            <div class="avatar" >
              <img src="<?php echo $pin_info['avatar']; ?>" style="height:80px;width:80px;border-radius:50%;">
            </div>
            <p><?php echo $pin_info['nickname']; ?></p>
            <hr>

            <?php $query = "SELECT b.name FROM boards b INNER JOIN boards_pins bp ON b.id=bp.board_id WHERE bp.pin_id=? AND b.user_id =?";

            $stmt = $pdo->prepare($query);
            $stmt->execute([$pin,$user_id]);

            $pin_in_board_info = $stmt->fetch();

            if(isset($pin_in_board_info['name'])){
              echo '<h5>This pin is saved by you in this board: '.$pin_in_board_info['name'].'</h5>';
            }
            else
            { ?>
              <form method="get" action="pin_in_board.php">
              <select name="board_id" class="form-control mb-4" required="required">
                  <?php
                  $query ="SELECT id, name FROM boards WHERE user_id=? ORDER by name";
                  $stmt = $pdo->prepare($query);
                  $stmt->execute([$_SESSION['user_id']]);
                  while ($row = $stmt->fetch()) {
                      echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                  }
                  ?>
              </select>
              <input type="hidden" name="pin_id" value="<?php echo $pin;?>">
              <button type="submit" name="submit" class="btn btn-danger" style="margin-top:1rem;">Submit</button>
            </form>

            <?php
            }

            ?>

          </div>


    </div>

</div>



<?php
include_once './footer.php';
?>
