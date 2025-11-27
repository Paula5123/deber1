<?php
interface CrudInterface {
    public function create($name, $email, $grade);
    public function readOne($id);
    public function readAll();
    public function update($id, $name, $email, $grade);
    public function delete($id);
}
?>