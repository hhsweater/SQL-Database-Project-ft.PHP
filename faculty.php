<?php

require_once 'models/database.php';
require_once 'models/faculty.php';

$action = htmlspecialchars(filter_input(INPUT_POST, "action"));
$id = htmlspecialchars(filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT));
$name = htmlspecialchars(filter_input(INPUT_POST, "name"));
$email = htmlspecialchars(filter_input(INPUT_POST, "email"));

if ($action == "insert_or_update" && $id != "0" && $name != "" && $email != "") {
    $insert_or_update = filter_input(INPUT_POST, 'insert_or_update');

    $faculty = new Faculty($id, $name, $email);

    if ($insert_or_update == "insert") {
        insert_faculty($faculty);
    } else if ($insert_or_update == "update") {
        update_faculty($faculty);
    }

    header("Location: faculty.php");
} else if ($action == "delete" && $id != "") {
    // name and current price don't matter for delete
    $faculty = new Faculty($id, "", 0);
    delete_faculty($faculty);
    header("Location: faculty.php");
} else if ($action != "") {
    $error_message = "An error occured, try something else!";
    include('views/error.php');
}


$faculties = list_faculty();

include('views/faculty.php');


?>
