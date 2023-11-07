<!DOCTYPE html>
<?php
include 'db.php';
$id = $_GET['trackID'];
$sql = "SELECT * FROM tasks WHERE id = '$id'";
$rows = $db->query($sql);
$row = $rows->fetch_assoc();
// var_dump($row);
if (isset($_POST['send'])) {

    $task = htmlspecialchars($_POST['task']);
    $sql2 = "UPDATE tasks SET task ='$task' WHERE id = '$id'";
    $db->query($sql2);
    header('location: index.php');
}


?>
<html lang="en">

<head>
    <title>Update Task</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
</head>

<body>
    <div class="container">
        <h1 class="display-4 text-dark text-center mb-3">Update Task</h1>
        <form method="post">
            <div class="form-group">
                <label for="task">Task:</label>
                <input type="text" required name="task" value="<?php echo $row['task']; ?>" class="form-control">
            </div>
            <button type="submit" name="send" class="btn btn-success">Update</button>
            <a href="index.php" class="btn btn-warning">Back</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>

</html>