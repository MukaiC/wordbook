<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/style.css">
    <title>Wordbook</title>
  </head>
  <body class="pt-3">
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-primary" style="background-color: #e3f2fd;"> -->
    <nav  class="navbar navbar-expand-lg navbar-dark" style="background-color: #5F9EA0;">
    <a class="navbar-brand" href="#">WordBook</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo ROOT_URL; ?>">Home</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo ROOT_URL; ?>quizzes">Quizzes</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo ROOT_URL; ?>words">My WordBook</a>
        </li>
      
      </ul>

      <ul class="navbar-nav navbar-right mr-auto">
        <?php if(isset($_SESSION['is_logged_in'])) : ?>
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo ROOT_URL; ?>">Welcome <?php echo $_SESSION['user_data']['name'] ?></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo ROOT_URL; ?>users/logout">Logout</a>
          </li>
        <?php else : ?>
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo ROOT_URL; ?>users/login">Login</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo ROOT_URL; ?>users/register">Register</a>
          </li>
      <?php endif; ?>
      </ul>
    </div>
    </nav>

  <main role="main" class="container">
    <div class="container mt-2">
      <?php Messages::display(); ?>
    </div>
      <?php require($view); ?>

  </main><!-- /.container -->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
