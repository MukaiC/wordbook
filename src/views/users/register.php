<div class="container">
    <div class="card mt-5">
      <div class="card-header">Register User</div>
      <div class="card-body">
        <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control" value="<?php echo $_POST['name'] ?? ''; ?>">
          </div>
          <div class="form-group">
              <label>Email</label>
              <input type="text" name="email" class="form-control" value="<?php echo $_POST['email'] ?? ''; ?>">
          </div>
          <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control">
          </div>
          <input class="btn btn-outline-primary" type="submit" name="submit" value="Register">
        </form>
        <div class="mt-3">
          <small class="text-muted">Already Have an Account?<a class="ml-2" href="<?php echo ROOT_URL; ?>users/login">Login</a></small>
        </div>
      </div>
    </div>
</div>
