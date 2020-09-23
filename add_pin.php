<?php
include_once './header.php';
include_once './database.php';

$query = "SELECT u.avatar, u.nickname FROM users u WHERE u.id=?";

$stmt = $pdo->prepare($query);
$stmt->execute([$_SESSION['user_id']]);

$user = $stmt->fetch();

?>

<div class="container-fluid" style="background-color:lightgrey;padding-top:1%;padding-bottom:21%;">
  <div class="pin_form">
    <form method="post" enctype="multipart/form-data" action="pin_insert.php">
      <div class="row">
        <div class="col">
          <div class="form-group" style="padding-top:35%;">
              <input type="file" name="file" accept=".png, .jpg, .jpeg, .gif">
          </div>
        </div>
        <div class="col">
          <input type="text" name="title" class="form-control mb-4" placeholder="Add your title" required="required" />
          <hr>
          <div class="row">
            <div class="col">
              <img class="avatar" src="<?php echo $user['avatar'];?>" style="height:5rem;width:auto;">
              <h6>Uporabnik: <?php echo $user['nickname'];?></h6>
            </div>
          </div>

          <br>
          <input type="text" name="description" class="form-control mb-4" placeholder="Add a short description..."/>
          <br>
          <input type="text" class="form-control" name="link" id="basic-url" aria-describedby="basic-addon3" placeholder="Add a destination link">
          <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
          <button type="submit" name="submit" class="btn btn-danger" style="margin-top:1rem;">Submit</button>
        </div>
      </div>

    </form>
  </div>
</div>

<?php
include_once './footer.php';
?>
