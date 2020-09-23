<?php
include_once './header.php';
?>
<div class="container-fluid" style="background-color:#dbdbdb;padding:2rem;">
  <div class="container" style="padding:5rem;margin-bottom:11.75rem;background-color:white;">
    <h1>Registracija</h1>

    <form action="user_insert.php" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="form-group" style="padding:1.75rem;">
            <input type="file" name="file" accept=".png, .jpg, .jpeg, .gif">
        </div>
      </div>
        <input type="text" name="nickname" class="form-control mb-4" placeholder="Username" required="required" />
        <input type="email" name="email" class="form-control mb-4" placeholder="email" required="required" />
        <input type="text" name="phone" class="form-control mb-4" placeholder="Phone" />
        <select name="country_id" class="form-control mb-4" required="required">
            <?php
            include_once './database.php';
            $query ="SELECT * FROM countries ORDER BY name";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
            }
            ?>
        </select>
        <select name="language_id" class="form-control mb-4" required="required">
            <?php
            include_once './database.php';
            $query ="SELECT * FROM languages ORDER BY title";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
            }
            ?>
        </select>
        <input type="password" name="pass1" class="form-control mb-4" placeholder="Password" required="required" />
        <input type="password" name="pass2" class="form-control mb-4" placeholder="Confirm password" required="required" />
        <button type="submit" name="submit" class="btn btn-danger" style="margin-top:1rem;">Submit</button>
    </form>
  </div>
</div>

<?php
include_once './footer.php';
?>
