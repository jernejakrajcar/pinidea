<?php
include_once './header.php';
include_once './database.php'; //ko uporabljaš pdo vedno preveri če imaš ta stavek

$query = "SELECT u.avatar, u.nickname, u.first_name, u.last_name, u.email, u.pass, u.phone, c.name, l.title FROM users u INNER JOIN countries c ON c.id=u.country_id INNER JOIN languages l ON l.id=u.language_id WHERE u.id=?";

$stmt = $pdo->prepare($query);
$stmt->execute([$_SESSION['user_id']]);

$user = $stmt->fetch();


?>

<div class="container-fluid" style="padding-left:5rem;padding-right:5rem;">
  <div class="top">
    <h2>Edit profile</h2>
  </div>

  <!--tukaj naprej poteka obrazec-->
  <form action="account_change.php" enctype="multipart/form-data" method="post">
    <h5>Photo</h5>

    <div class="row">
      <img class="avatar" src="<?php echo $user['avatar']; ?>">

      <div class="form-group" style="padding:1.75rem;">
          <input type="file" name="file" accept=".png, .jpg, .jpeg, .gif">
      </div>
    </div>

    <div class="row">
      <div class="col">
        <h5>First name</h5>
        <input type="text" class="form-control" name="first_name" value="<?php echo $user['first_name']; ?>">
      </div>

      <div class="col">
        <h5>Last name</h5>
        <input type="text" class="form-control" name="last_name" value="<?php echo $user['last_name']; ?>">
      </div>
    </div>

    <h5>Nickname</h5>
    <input type="text" class="form-control" name="nickname" value="<?php echo $user['nickname']; ?>">

    <hr>

    <h3>Basic information</h3>

    <h5>Email</h5>
    <input type="text" class="form-control" name="email" value="<?php echo $user['email']; ?>">

    <h5>Phone</h5>
    <input type="text" class="form-control" name="phone" value="<?php echo $user['phone']; ?>">

    <div class="row">
      <div class="col">
        <h5>Country</h5>
        <input type="text" class="form-control" name="country" value="<?php echo $user['name']; ?>">
      </div>

      <div class="col">
        <h5>Language</h5>
        <input type="text" class="form-control" name="language" value="<?php echo $user['title']; ?>">
      </div>
    </div>

    <input type="hidden" name="avatar" value="<?php echo $user['avatar'];?>">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">

    <button type="submit" name="submit" class="btn btn-danger" style="margin-top:1rem;">Submit</button>
  </form>
</div>

<?php
include_once './footer.php';
?>
