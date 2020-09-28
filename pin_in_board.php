<?php
include_once './database.php';


$board_id = $_GET['board_id'];
$pin_id = $_GET['pin_id'];

echo $pin_id;
echo '<br>';
echo $board_id;

$query = "INSERT INTO boards_pins (pin_id, board_id) VALUES (?,?)";
$stmt = $pdo->prepare($query);
$stmt->execute([$pin_id,$board_id]);

header("Location: index.php");
