<?php 
include 'header.inc.php';
?>
<div class="col-md-10 mx-auto col-lg-5">
    <h1 class="dispaly-2" style="margin: 0.5em;">Welcome to Shopping List</h1>
        <form class="p-4 p-md-5 border rounded-3 bg-light" action="authenticate.php" method="post" name="login">
          <?php if (isset($loginError)) { echo '<div class="alert alert-danger" role="alert">' . $loginError . '</div>'; }?>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            <label for="username">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <label for="password">Password</label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        </form>
      </div>
<?php 
include 'footer.inc.php';
?>
