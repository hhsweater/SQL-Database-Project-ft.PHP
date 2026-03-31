<?php

class Enrollment {

    private $id, $student_id, $section_id, $grade;

    public function __construct($id, $student_id, $section_id, $grade) {
        $this->set_id($id);
        $this->set_student_id($student_id);
        $this->set_section_id($section_id);
        $this->set_grade($grade);
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_student_id() {
        return $this->student_id;
    }

    public function get_section_id() {
        return $this->section_id;
    }


    public function set_student_id($student_id) {
        $this->student_id = $student_id;
    }

    public function set_section_id($section_id) {
        $this->section_id = $section_id;
    }

    public function get_grade() {
        return $this->grade;
    }


    public function set_grade($grade) {
        $this->grade = $grade;
    }
}

function get_enrollment($id){
    global $database;

    $query = 'SELECT id, student_id, section_id, grade FROM enrollment WHERE id = :id';

    // prepare the query please
    $statement = $database->prepare($query);
    
    $statement->bindValue(":id", $id);

    // run the query please
    $statement->execute();

    // this might be risky if you have HUGE amounts of data
    $enrollment = $statement->fetch();

    $statement->closeCursor();
   
    return new enrollment($enrollment['id'], $enrollment['student_id'], $enrollment['section_id'], $enrollment['grade']);
}

function list_enrollment() {
    global $database;

    $query = 'SELECT id, student_id, section_id, grade FROM enrollment';

    // prepare the query please
    $statement = $database->prepare($query);

    // run the query please
    $statement->execute();

    // this might be risky if you have HUGE amounts of data
    $enrollment = $statement->fetchAll();

    $statement->closeCursor();

    $enrollment_array = array();

    foreach ($enrollment as $enrollment) {
        $enrollment_array[] = new enrollment($enrollment['id'], $enrollment['student_id'], $enrollment['section_id'], $enrollment['grade']);
    }

    return $enrollment_array;
}

function insert_enrollment($enrollment) {
    global $database;

    // DANGER DANGER DANGER - SQL Injection risk
    // Don't ever just plug values into a query!
    //$query = "INSERT INTO enrollment (symbol, student_id, current_price) "
    //        . "VALUES ($symbol, $student_id, $current_price)";
    // instead, use substitutions
    $query = "INSERT INTO enrollment (id, student_id, section_id, grade) "
            . "VALUES (:id, :student_id, :section_id, :grade)";

    // value binding in PDO protects against sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":id", $enrollment->get_id());
    $statement->bindValue(":student_id", $enrollment->get_student_id());
    $statement->bindValue(":section_id", $enrollment->get_section_id());
    $statement->bindValue(":grade", $enrollment->get_grade());

    $statement->execute();

    $statement->closeCursor();
}

function update_enrollment($enrollment) {
    global $database;

    $query = "update enrollment set student_id = :student_id, section_id = :section_id, grade = :grade"
            . " where id = :id";

    // value binding in PDO protects against sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":id", $enrollment->get_id());
    $statement->bindValue(":student_id", $enrollment->get_student_id());
    $statement->bindValue(":section_id", $enrollment->get_section_id());
    $statement->bindValue(":grade", $enrollment->get_grade());

    $statement->execute();

    $statement->closeCursor();
}

function delete_enrollment($enrollment) {
    global $database;

    $query = "delete from enrollment "
            . " where id = :id";

    // value binding in PDO protects against sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":id", $enrollment->get_id());

    $statement->execute();

    $statement->closeCursor();
}