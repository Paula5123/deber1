<?php
// Abstract class defining a generic person
abstract class Person {
    protected $db;
    protected $table_name;

    public function __construct($db) {
        $this->db = $db;
    }
}
?>