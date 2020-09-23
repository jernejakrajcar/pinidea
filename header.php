<?php
include_once './session.php';
include_once './database.php';

if (!isset($_SESSION['user_id'])) {

}
else{
  $query ="SELECT avatar FROM users WHERE id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$_SESSION['user_id']]);

  $avatar = $stmt->fetch();
}



?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/stylev2.css" rel="stylesheet" type="text/css">

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-white bg-white" style="min-height:1rem;">
    <div class="container-fluid">
      <div class="col">
      <a class="navbar-brand" href="index.php">
        <img src="pictures/pinterest_logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        Home
      </a>
    </div>

    <div class="col-lg-9" style="padding:0;">
      <form class="form-inline">
        <input class="form-control col-lg-10 mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="background-color:#dedede;border-radius:25px;">
        <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>

    <div class="col-sm" style="padding:0;margin:0;">
        <div class="row">
            <?php
                  if (isset($_SESSION['user_id'])) {
            ?>
            <a class="nav-link js-scroll-trigger" href="account.php" style="font-size:2.25rem;margin:0px;padding:0px;">
              <div class="avatar" style="height:80px;width:auto;border-radius:50%;">
                <img src="<?php echo $avatar['avatar'];?>" style="height:80px;width:80px;border:1px solid darkgrey;border-radius:50%;">
              </div>
            </a>
            <a class="nav-link js-scroll-trigger" href="logout.php"  style="font-size:1.5rem;padding:1.5rem;"><i class="fa fa-power-off"></i></a>
            <?php
                  if (isAdmin()) {
              ?>
              <a class="nav-item nav-link" href="#">admin</a>
              <a class="nav-link js-scroll-trigger" href="logout.php"><i class="fa fa-power-off"></i></a>
            <?php
                  }
            ?>
            <?php
                  }
                  else {
            ?>
            <a class="nav-item nav-link" href="login.php">Log in</a>
            <a class="nav-item nav-link" href="registration.php">Sign in</a>
            <?php
                  }
            ?>
        </div>
    </div>
    </div>
</nav>
