<?php
require_once './database.php';

$user = $_GET['user_id'];
$name = $_GET['name'];

if(isset($_GET['private'])){
  // $private je true oz. checkbox je obkljukan
  $private = 1;
}
else{
  // $private ni obkljukan oz. je enak false
  $private = 0;
}


if (!empty($name) && !empty($user)) {

    $query = "INSERT INTO boards(name, private, user_id) VALUES(?,?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$name,$private,$user]);

    header("Location: user_account.php");
}
else{
  header("Location: login.php");
}

?>
