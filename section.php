<?php

require_once 'models/database.php';
require_once 'models/section.php';

$action = htmlspecialchars(filter_input(INPUT_POST, "action"));
$id = htmlspecialchars(filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT));
$course_code = htmlspecialchars(filter_input(INPUT_POST, "course_code"));
$faculty_id = htmlspecialchars(filter_input(INPUT_POST, "faculty_id"));
$semester = htmlspecialchars(filter_input(INPUT_POST, "semester"));

if ($action == "insert_or_update" && $id != "0" && $course_code != "" && $faculty_id != "") {
    $insert_or_update = filter_input(INPUT_POST, 'insert_or_update');

    $section = new Section($id, $course_code, $faculty_id, $semester);

    if ($insert_or_update == "insert") {
        insert_section($section);
    } else if ($insert_or_update == "update") {
        update_section($section);
    }

    header("Location: section.php");
} else if ($action == "delete" && $id != "") {
    // name and current price don't matter for delete
    $section = new Section($id, "", 0, "");
    delete_section($section);
    header("Location: section.php");
} else if ($action != "") {
    $error_message = "An error occured, try something else!";
    include('views/error.php');
}


$sections = list_section();

include('views/section.php');


?>