<?php

class course {

    private $code, $name, $description, $credits;

    public function __construct($code, $name, $description, $credits) {
        $this->set_code($code);
        $this->set_name($name);
        $this->set_description($description);
        $this->set_credits($credits);
    }

    public function set_code($code) {
        $this->code = $code;
    }

    public function get_code() {
        return $this->code;
    }

    public function get_name() {
        return $this->name;
    }

    public function get_description() {
        return $this->description;
    }


    public function set_name($name) {
        $this->name = $name;
    }

    public function set_description($description) {
        $this->description = $description;
    }

    public function get_credits() {
        return $this->credits;
    }


    public function set_credits($credits) {
        $this->credits = $credits;
    }
}

function get_course($code){
    global $database;

    $query = 'SELECT code, name, description, credits FROM course WHERE code = :code';

    // prepare the query please
    $statement = $database->prepare($query);
    
    $statement->bindValue(":code", $code);

    // run the query please
    $statement->execute();

    // this might be risky if you have HUGE amounts of data
    $course = $statement->fetch();

    $statement->closeCursor();
   
    return new course($course['code'], $course['name'], $course['description'], $course['credits']);
}

function list_course() {
    global $database;

    $query = 'SELECT code, name, description, credits FROM course';

    // prepare the query please
    $statement = $database->prepare($query);

    // run the query please
    $statement->execute();

    // this might be risky if you have HUGE amounts of data
    $course = $statement->fetchAll();

    $statement->closeCursor();

    $course_array = array();

    foreach ($course as $course) {
        $course_array[] = new course($course['code'], $course['name'], $course['description'], $course['credits']);
    }

    return $course_array;
}

function insert_course($course) {
    global $database;

    // DANGER DANGER DANGER - SQL Injection risk
    // Don't ever just plug values into a query!
    //$query = "INSERT INTO course (symbol, name, current_price) "
    //        . "VALUES ($symbol, $name, $current_price)";
    // instead, use substitutions
    $query = "INSERT INTO course (code, name, description, credits) "
            . "VALUES (:code, :name, :description, :credits)";

    // value binding in PDO protects against sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":code", $course->get_code());
    $statement->bindValue(":name", $course->get_name());
    $statement->bindValue(":description", $course->get_description());
    $statement->bindValue(":credits", $course->get_credits());

    $statement->execute();

    $statement->closeCursor();
}

function update_course($course) {
    global $database;

    $query = "update course set name = :name, description = :description, credits = :credits"
            . " where code = :code";

    // value binding in PDO protects against sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":code", $course->get_code());
    $statement->bindValue(":name", $course->get_name());
    $statement->bindValue(":description", $course->get_description());
    $statement->bindValue(":credits", $course->get_credits());

    $statement->execute();

    $statement->closeCursor();
}

function delete_course($course) {
    global $database;

    $query = "delete from course "
            . " where code = :code";

    // value binding in PDO protects against sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":code", $course->get_code());

    $statement->execute();

    $statement->closeCursor();
}