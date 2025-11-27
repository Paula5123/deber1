<?php
require_once 'Person.php';
require_once 'CrudInterface.php';

class Student extends Person implements CrudInterface {
    private $table = "students";

    // Create (Insert)
    public function create($name, $email, $grade) {
        $query = "INSERT INTO " . $this->table . " (name, email, grade) VALUES (:name, :email, :grade)";
        $stmt = $this->db->prepare($query);

        // Sanitize
        $name = htmlspecialchars(strip_tags($name));
        $email = htmlspecialchars(strip_tags($email));
        $grade = htmlspecialchars(strip_tags($grade));

        // Bind parameters (Prevents SQL Injection)
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":grade", $grade);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Read only one student
    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Read (Select All)
    public function readAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Update
    public function update($id, $name, $email, $grade) {
        $query = "UPDATE " . $this->table . " SET name = :name, email = :email, grade = :grade WHERE id = :id";
        $stmt = $this->db->prepare($query);

        // Bind
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":grade", $grade);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    // Delete
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>