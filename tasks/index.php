<?php require_once "../inc/conn.php"; require_once "../inc/functions.php"; ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
<?php if(isset($_SESSION["user_id"])): ?>
        <?php $user_id = $_SESSION["user_id"] ?>
      <h3 class="mb-0">My Tasks</h3>
      <div>
        <span class="me-2">Hello, <?php if(isset($_SESSION["username"])) echo $_SESSION["username"] ?></span>
        <a class="btn btn-outline-danger btn-sm" href="../auth/logout.php">Logout</a>
      </div>
    </div>

    <div class="card shadow-sm mb-3">
      <div class="card-body">
        <h5 class="mb-3">Add Task</h5>
        <form class="row g-2" action="add.php" method="POST" >
          <div class="col-md-5">
            <input class="form-control" name="title" placeholder="Task title" />
          </div>
          <div class="col-md-5">
            <input class="form-control" name="desc" placeholder="Short description" />
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary w-100" type="submit" name="add" >Add</button>
          </div>
        </form>
      </div>
    </div>

        <?php require_once "../errors/errors_success.php" ?>

    <div class="card shadow-sm">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table align-middle">
              <?php
            $query = "select * from tasks where user_id=$user_id;";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0){
                $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
                ?>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                  </tr>
                </thead>
                <?php
                for($i = 0;$i < count($tasks); $i++){
                    $task = $tasks[$i];
                    ?>
                    <tbody>
                      <tr>
                        <td><?php echo $i+1 ; ?></td>
                        <td><?php echo $task["title"] ?></td>
                        <td><?php echo $task["description"] ?></td>
                        <td><span class="badge <?php if($task["status"] == "pending") echo "bg-warning text-dark"; else echo "bg-success";?>"><?php echo $task["status"] ?></span></td>
                        <td class="text-end">
                          <a class="btn btn-sm <?php if($task["status"] == "pending") echo "bg-success text-white"; else echo "bg-warning text-dark";?>" href="<?php echo "toggle.php?id=".$task["id"] ?>">Mark <?php if($task["status"] == "pending") echo "Done"; else echo "Pending";?></a>
                          <a class="btn btn-sm btn-secondary" href=<?php echo "edit.php?id=".$task["id"] ?>>Edit</a>
                          <form class="btn btn-sm" style="padding: 0px;" action="delete.php" method="POST">
                              <button class="btn btn-sm btn-danger" name="delete" type="submit" value="<?php echo $task["id"]; ?>">Delete</button>
                          </form>
                        </td>
                      </tr>
                    <?php
                }
            }else{
                ?><h1>NO TASKS ADDED YET!</h1>
                <?php
            }
            ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
    <?php else: ?>
      <h3 class="mb-0">LOG IN TO CREATE AND VIEW TASKS!</h3>
      <div>
        <a class="btn btn-outline-danger btn-sm" href="../auth/login.php">Log In</a>
      </div>
      <?php endif; ?>
  </div>
</body>
</html>
