<?php
include_once './header.php';
include_once './database.php';

if ($_SESSION['nickname'] != 'OrewaAdmin') {
  header("Location: index.php");
}

else {

}

$user = $_GET['id'];

$query ="DELETE FROM boards_pins WHERE board_id = (SELECT b.id FROM boards b INNER JOIN users u ON u.id=b.user_id WHERE u.id=?)";
$stmt = $pdo->prepare($query);
$stmt->execute([$user]);

$query2 ="DELETE FROM boards_pins WHERE pin_id = (SELECT p.id FROM pins p INNER JOIN users u ON u.id=p.user_id WHERE u.id=?)";
$stmt2 = $pdo->prepare($query2);
$stmt2->execute([$user]);

$query3 ="DELETE FROM categories_pins WHERE pin_id =(SELECT p.id FROM pins p INNER JOIN users u ON u.id=p.user_id WHERE u.id=?)";
$stmt3 = $pdo->prepare($query3);
$stmt3->execute([$user]);

$query4 ="DELETE FROM boards WHERE user_id = (SELECT u.id FROM users u WHERE u.id=?)";
$stmt4 = $pdo->prepare($query4);
$stmt4->execute([$user]);

$query5 ="DELETE FROM pins WHERE user_id = (SELECT u.id FROM users u WHERE u.id=?)";
$stmt5 = $pdo->prepare($query5);
$stmt5->execute([$user]);

$query6 ="DELETE FROM users WHERE id=?";
$stmt6 = $pdo->prepare($query6);
$stmt6->execute([$user]);


header("Location: admin.php");



?>
