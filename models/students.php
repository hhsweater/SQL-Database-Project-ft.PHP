<?php

class Student {

    private $id, $name, $major;

    public function __construct($id, $name, $major) {
        $this->set_id($id);
        $this->set_name($name);
        $this->set_major($major);
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_name() {
        return $this->name;
    }

    public function get_major() {
        return $this->major;
    }


    public function set_name($name) {
        $this->name = $name;
    }

    public function set_major($major) {
        $this->major = $major;
    }

}

function get_student($id){
    global $database;

    $query = 'SELECT id, name, major FROM stocks WHERE id = :id';

    // prepare the query please
    $statement = $database->prepare($query);
    
    $statement->bindValue(":id", $id);

    // run the query please
    $statement->execute();

    // this might be risky if you have HUGE amounts of data
    $student = $statement->fetch();

    $statement->closeCursor();
   
    return new Student($student['id'], $student['name'], $student['major']);
}

function list_students() {
    global $database;

    $query = 'SELECT id, name, major FROM students';

    // prepare the query please
    $statement = $database->prepare($query);

    // run the query please
    $statement->execute();

    // this might be risky if you have HUGE amounts of data
    $students = $statement->fetchAll();

    $statement->closeCursor();

    $students_array = array();

    foreach ($students as $student) {
        $students_array[] = new Student($student['id'], $student['name'], $student['major']);
    }

    return $students_array;
}

function insert_student($student) {
    global $database;

    // DANGER DANGER DANGER - SQL Injection risk
    // Don't ever just plug values into a query!
    //$query = "INSERT INTO stocks (symbol, name, current_price) "
    //        . "VALUES ($symbol, $name, $current_price)";
    // instead, use substitutions
    $query = "INSERT INTO students (id, name, major) "
            . "VALUES (:id, :name, :major)";

    // value binding in PDO protects against sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":id", $student->get_id());
    $statement->bindValue(":name", $student->get_name());
    $statement->bindValue(":major", $student->get_major());

    $statement->execute();

    $statement->closeCursor();
}

function update_student($student) {
    global $database;

    $query = "update students set name = :name, major = :major "
            . " where id = :id";

    // value binding in PDO protects against sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":id", $student->get_id());
    $statement->bindValue(":name", $student->get_name());
    $statement->bindValue(":major", $student->get_major());

    $statement->execute();

    $statement->closeCursor();
}

function delete_student($student) {
    global $database;

    $query = "delete from students "
            . " where id = :id";

    // value binding in PDO protects against sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":id", $student->get_id());

    $statement->execute();

    $statement->closeCursor();
}