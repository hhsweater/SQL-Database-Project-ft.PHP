<?php

require_once 'models/database.php';
require_once 'models/students.php';

$action = htmlspecialchars(filter_input(INPUT_POST, "action"));
$id = htmlspecialchars(filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT));
$name = htmlspecialchars(filter_input(INPUT_POST, "name"));
$major = htmlspecialchars(filter_input(INPUT_POST, "major"));

if ($action == "insert_or_update" && $id != "0" && $name != "" && $major != "") {
    $insert_or_update = filter_input(INPUT_POST, 'insert_or_update');

    $student = new Student($id, $name, $major);

    if ($insert_or_update == "insert") {
        insert_student($student);
    } else if ($insert_or_update == "update") {
        update_student($student);
    }

    header("Location: students.php");
} else if ($action == "delete" && $id != "") {
    // name and current price don't matter for delete
    $student = new Student($id, "", 0);
    delete_student($student);
    header("Location: students.php");
} else if ($action != "") {
    $error_message = "An error occured, try something else!";
    include('views/error.php');
}


$students = list_students();

include('views/students.php');


?>

