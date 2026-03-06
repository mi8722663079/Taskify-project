<?php session_start(); ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container py-5">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h3 class="mb-3">Login</h3>

        <?php
          if(isset($_SESSION["user_id"])){
            redirect("../errors/404.php");
          }
          require_once "../errors/errors_success.php" ?>

        <form action="handle_login.php" method="POST">
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" type="email" name="email" placeholder="email@example.com" />
          </div>

          <div class="mb-3">
            <label class="form-label">Password</label>
            <input class="form-control" placeholder="******" type="password" name="password" />
          </div>

          <button class="btn btn-dark w-100" type="submit" name="login">Login</button>
        </form>

        <p class="mt-3 mb-0">
          No account? <a href="register.php">Register</a>
        </p>
      </div>
    </div>
  </div>
</body>
</html>
