<?php

require_once 'models/database.php';
require_once 'models/enrollment.php';

$action = htmlspecialchars(filter_input(INPUT_POST, "action"));
$id = htmlspecialchars(filter_input(INPUT_POST, "id"), FILTER_VALIDATE_INT);
$student_id = htmlspecialchars(filter_input(INPUT_POST, "student_id"), FILTER_VALIDATE_INT);
$section_id = htmlspecialchars(filter_input(INPUT_POST, "section_id"), FILTER_VALIDATE_INT);
$grade = htmlspecialchars(filter_input(INPUT_POST, "grade"));

if ($action == "insert_or_update" && $id != "0" && $student_id != "" && $section_id != "") {
    $insert_or_update = filter_input(INPUT_POST, 'insert_or_update');

    $enrollment = new enrollment($id, $student_id, $section_id, $grade);

    if ($insert_or_update == "insert") {
        insert_enrollment($enrollment);
    } else if ($insert_or_update == "update") {
        update_enrollment($enrollment);
    }

    header("Location: enrollment.php");
} else if ($action == "delete" && $id != "") {
    // student_id and current price don't matter for delete
    $enrollment = new enrollment("", "", "", 0);
    delete_enrollment($enrollment);
    header("Location: enrollment.php");
} else if ($action != "") {
    $error_message = "An error occured, try something else!";
    include('views/error.php');
}


$enrollments = list_enrollment();

include('views/enrollment.php');


?>