<?php

require_once 'models/database.php';
require_once 'models/course.php';

$action = htmlspecialchars(filter_input(INPUT_POST, "action"));
$code = htmlspecialchars(filter_input(INPUT_POST, "code"));
$name = htmlspecialchars(filter_input(INPUT_POST, "name"));
$description = htmlspecialchars(filter_input(INPUT_POST, "description"));
$credits = htmlspecialchars(filter_input(INPUT_POST, "credits", FILTER_VALIDATE_INT));

if ($action == "insert_or_update" && $code != "0" && $name != "" && $description != "") {
    $insert_or_update = filter_input(INPUT_POST, 'insert_or_update');

    $course = new course($code, $name, $description, $credits);

    if ($insert_or_update == "insert") {
        insert_course($course);
    } else if ($insert_or_update == "update") {
        update_course($course);
    }

    header("Location: course.php");
} else if ($action == "delete" && $code != "") {
    // name and current price don't matter for delete
    $course = new course("", "", "", 0);
    delete_course($course);
    header("Location: course.php");
} else if ($action != "") {
    $error_message = "An error occured, try something else!";
    include('views/error.php');
}


$courses = list_course();

include('views/course.php');


?>