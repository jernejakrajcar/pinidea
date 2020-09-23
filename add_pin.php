<?php
include_once './header.php';

?>

<div class="container-fluid" style="background-color:lightgrey;padding-top:1%;padding-bottom:20%;">
  <div class="pin_form">
    <form method="post" enctype="multipart/form-data" action="pin_insert.php">
      <div class="row">
        <div class="col">
          <div class="form-group">
              <input type="file" name="file" accept=".png, .jpg, .jpeg, .gif">
          </div>
        </div>
        <div class="col">
          <input type="text" name="title" class="form-control mb-4" placeholder="Add your title" required="required" />
          <hr>
          user
          <br>
          description
          <br>
          link
        </div>
      </div>

    </form>
  </div>
</div>

<?php
include_once './footer.php';
?>
