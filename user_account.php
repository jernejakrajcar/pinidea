<?php
include_once './header.php';
include_once './database.php'; //ko uporabljaš pdo vedno preveri če imaš ta stavek

$query = "SELECT u.avatar, u.nickname FROM users u WHERE u.id=?";

$stmt = $pdo->prepare($query);
$stmt->execute([$_SESSION['user_id']]);

$user = $stmt->fetch();

echo $user['avatar'];
echo $user['nickname'];
?>

<a href="account.php">
  Edit profile
</a>



<?php
include_once './header.php';
?>
