<?php
include_once './header.php';
include_once './database.php';
?>

<div class="container-fluid" style="background-color:lightgrey;padding-top:1%;padding-bottom:21%;">
  <div class="board_form">
    <form method="get" action="board_insert.php">
        <div class="col">
          Name
          <input type="text" name="name" class="form-control mb-4" placeholder="Like Places to go or Healthy recipes" required="required" />

          <div class="form-check">
              <input type="checkbox" name="private[]" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1"><h4>Keep this board secret </h4></label>
            </div>
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
          <button type="submit" name="submit" class="btn btn-danger" style="margin-top:1rem;">Submit</button>
        </div>

    </form>
  </div>
</div>

<?php
include_once './footer.php';
?>
