<?php

class Faculty {

    private $id, $name, $email;

    public function __construct($id, $name, $email) {
        $this->set_id($id);
        $this->set_name($name);
        $this->set_email($email);
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

    public function get_email() {
        return $this->email;
    }


    public function set_name($name) {
        $this->name = $name;
    }

    public function set_email($email) {
        $this->email = $email;
    }

}

function get_faculty($id){
    global $database;

    $query = 'SELECT id, name, email FROM stocks WHERE id = :id';

    // prepare the query please
    $statement = $database->prepare($query);
    
    $statement->bindValue(":id", $id);

    // run the query please
    $statement->execute();

    // this might be risky if you have HUGE amounts of data
    $faculty = $statement->fetch();

    $statement->closeCursor();
   
    return new Faculty($faculty['id'], $faculty['name'], $faculty['email']);
}

function list_faculty() {
    global $database;

    $query = 'SELECT id, name, email FROM faculty';

    // prepare the query please
    $statement = $database->prepare($query);

    // run the query please
    $statement->execute();

    // this might be risky if you have HUGE amounts of data
    $faculties = $statement->fetchAll();

    $statement->closeCursor();

    $faculty_array = array();

    foreach ($faculties as $faculty) {
        $faculty_array[] = new Faculty($faculty['id'], $faculty['name'], $faculty['email']);
    }

    return $faculty_array;
}

function insert_faculty($faculty) {
    global $database;

    // DANGER DANGER DANGER - SQL Injection risk
    // Don't ever just plug values into a query!
    //$query = "INSERT INTO stocks (symbol, name, current_price) "
    //        . "VALUES ($symbol, $name, $current_price)";
    // instead, use substitutions
    $query = "INSERT INTO faculty (id, name, email) "
            . "VALUES (:id, :name, :email)";

    // value binding in PDO protects against sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":id", $faculty->get_id());
    $statement->bindValue(":name", $faculty->get_name());
    $statement->bindValue(":email", $faculty->get_email());

    $statement->execute();

    $statement->closeCursor();
}

function update_faculty($faculty) {
    global $database;

    $query = "update faculty set name = :name, email = :email "
            . " where id = :id";

    // value binding in PDO protects against sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":id", $faculty->get_id());
    $statement->bindValue(":name", $faculty->get_name());
    $statement->bindValue(":email", $faculty->get_email());

    $statement->execute();

    $statement->closeCursor();
}

function delete_faculty($faculty) {
    global $database;

    $query = "delete from faculty "
            . " where id = :id";

    // value binding in PDO protects against sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":id", $faculty->get_id());

    $statement->execute();

    $statement->closeCursor();
}