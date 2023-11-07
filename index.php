<!DOCTYPE html>
<?php
include 'db.php';

$page = (isset($_GET['page']) ? (int) $_GET['page'] : 1);
$perPage = (isset($_GET['per-page']) && ((int) $_GET['per-page']) <= 50 ? (int) $_GET['per-page'] : 5);
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

$sql = "select * from tasks limit " . $start . " , " . $perPage . " ";
$total = $db->query("SELECT * FROM tasks")->num_rows;
$pages = ceil($total / $perPage);
$rows = $db->query($sql);

?>

<html lang="en">

<head>
  <title>My Task Manager</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="styles.css" />
</head>

<body>
  <div class="container">
    <div class="header">
      <h1 class="display-4 text-dark text-center mb-4">My Task Manager</h1>
      <p class="text-muted text-center" id="currentDate"></p>

    </div>

    <div class="button-group">
      <button type="button" class="btn btn-primary" data-target="#taskModal" data-toggle="modal">Add Task</button>
      <button type="button" class="btn btn-info print" onclick="print();">Print</button>
    </div>

    <hr>

    <div id="taskModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Task</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="add.php">
          <div class="form-group">
            <label for="task" class="font-weight-bold">Task Description:</label>
            <input type="text" required name="task" class="form-control" placeholder="Enter your task">
          </div>
          <div class="text-center mt-3">
            <button type="submit" name="send" class="btn btn-success">Add Task</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <div class="row">
      <div class="col-md-8 mx-auto">
        <div class="task-list">
          <?php
          while ($row = $rows->fetch_assoc()) : ?>
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"><?php echo $row['task']; ?></h5>
                <div class="action-buttons">
                  <a class="btn btn-warning" href="update.php?trackID=<?php echo $row['id']; ?>">Edit</a>
                  <a class="btn btn-danger" href="delete.php?trackID=<?php echo $row['id']; ?>">Delete</a>

                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>

        <div class="pagination-container">
          <nav aria-label="Page navigation">
            <ul class="pagination  justify-content-center">
              <?php for ($i = 1; $i <= $pages; $i++) : ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $i ?>&per-page=<?php echo $perPage; ?>"><?php echo $i; ?></a></li>
              <?php endfor; ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <script>
  // Function to update the dynamic date
  function updateCurrentDate() {
    const currentDate = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = currentDate.toLocaleDateString('en-US', options);
    document.getElementById('currentDate').textContent = formattedDate;
  }

  // Call the function to set the initial date
  updateCurrentDate();
</script>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    // Get the current year for the copyright
    $("#year").text(new Date().getFullYear());
  </script>
</body>

</html>
