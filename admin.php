<?php
include_once './header.php';
include_once './database.php';

if ($_SESSION['nickname'] != 'OrewaAdmin') {
  header("Location: index.php");
}

else {
  echo '<h5 style="color:red;padding:10px;">Welcome Admin!</h5>';
}
?>

<div class="container-fluid">
  <div class="my-container">
    <hr>
    <h3 style="background-color:lightsalmon;padding:1rem;border-radius:5px;">Manage users</h3>
    <?php
      $query = "SELECT u.id, u.avatar, u.nickname, u.email FROM users u ORDER by u.nickname";

      $stmt = $pdo->prepare($query);
      $stmt->execute();

    ?>

    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">id#</th>
      <th scope="col">avatar</th>
      <th scope="col">nickname</th>
      <th scope="col">email</th>
      <th scope="col">delete</th>
    </tr>
  </thead>
  <tbody>

    <?php while ($user = $stmt->fetch()) {
      //echo '<tr><td>'.$row['naziv'].'</td>';
      ?>

    <tr>
      <td class="table-text"><?php echo $user['id'];?></td>
      <td class="table-text"><img src="<?php echo $user['avatar'];?>"style="height:50px;width:50px;border-radius:50%;"></td>
      <td class="table-text"><?php echo $user['nickname'];?></td>
      <td class="table-text"><?php echo $user['email'];?></td>
      <td><a class="table-link-delete" href="delete_user.php?id=<?php echo $user['id']; ?>">Delete</a></td>
    </tr>


    <!-- echo '<td>'.'<a href="izbris.php?ajdi='.$row['id_i'].'">Odstrani</a>'.'</td>'; -->

    <?php
      }
  ?>
  </tbody>
</table>
  </div>
</div>

<?php
include_once './footer.php';
 ?>
