<?php
include 'db.php';

if (isset($_POST['send'])) {

    $name = htmlspecialchars($_POST['task']);

    // echo $name;

    $sql = "INSERT INTO tasks (task) VALUES ('$name')";

    $val = $db->query($sql);

    if ($val) {

        header('location: index.php');
    }
}
