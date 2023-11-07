<!-- <?php ?> -->
<?php
include 'db.php';

$id = (int) $_GET['trackID'];

// echo $id;

$sql = "DELETE FROM tasks WHERE id = '$id' ";

$del = $db->query($sql);

if ($del) {
    header('location: index.php');
}

?>