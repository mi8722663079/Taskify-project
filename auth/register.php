<?php session_start(); ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Register</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container py-5">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h3 class="mb-3">Create account</h3>

        <!-- alerts placeholder -->
        <?php
          if(isset($_SESSION["user_id"])){
            redirect("../errors/404.php");
          }
          require_once "../errors/errors_success.php" ?>

        <form action="handle_register.php" method="POST">
          <div class="mb-3">
            <label class="form-label" >Name</label>
            <input class="form-control" type="text" name="name" value="<?php if(isset($_SESSION["name"])) echo $_SESSION["name"]; ?>" />
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" type="email" name="email" placeholder="email@example.com" value="<?php if(isset($_SESSION["email"])) echo $_SESSION["email"]; ?>" />
          </div>

          <div class="mb-3">
            <label class="form-label">Password</label>
            <input class="form-control" placeholder="******" name="password" type="password" />
          </div>

          <button class="btn btn-primary w-100" type="submit" name="register">Register</button>
        </form>

        <p class="mt-3 mb-0">
          Already have account? <a href="login.php">Login</a>
        </p>
      </div>
    </div>
  </div>
</body>
</html>
