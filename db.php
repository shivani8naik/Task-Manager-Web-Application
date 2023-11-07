<?php

$db = new mysqli;

$db->connect('localhost', 'root', 'shivani', 'task_manager');

if (!$db) {

    echo "error";
}