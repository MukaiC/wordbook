<div class="container">
    <div class="card mt-5">
      <div class="card-header">User Login</div>
      <div class="card-body">
        <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="form-group">
              <label>Email</label>
              <input type="text" name="email" class="form-control">
          </div>
          <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control">
          </div>
          <input class="btn btn-outline-primary" type="submit" name="submit" value="Login">

        </form>
        <div class="mt-3">
          <small class="text-muted">Need an Account?<a class="ml-2" href="<?php echo ROOT_URL; ?>users/register">Register</a></small>
        </div>
      </div>
    </div>
</div>
