<?php
include_once './header.php';
?>
<div class="container-fluid" style="background-color:#dbdbdb;padding:2rem;">
  <div class="container" style="padding:5rem;margin-bottom:25.75rem;background-color:white;">
    <h1>Prijava</h1>


    <form action="login_check.php" method="post">
        <input type="email" name="email" class="form-control mb-4" placeholder="email" required="required" />
        <input type="password" name="pass" class="form-control mb-4" placeholder="password" required="required" />
        <input type="submit" class="btn btn-danger" value="Prijava" />
    </form>

    <a href="registration.php">Create an account</a>
  </div>
</div>
<?php
include_once './footer.php';
?>
