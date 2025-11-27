<?php
require_once 'Person.php';

class Teacher extends Person {
    private $table = "teachers";

    // Login verification
    public function login($username, $password) {
        $query = "SELECT id, username, password FROM " . $this->table . " WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verify the Hashed Password
            if(password_verify($password, $row['password'])) {
                return true;
            }
        }
        return false;
    }

    // Register a new teacher (for setup purposes)
    public function register($username, $password) {
        $query = "INSERT INTO " . $this->table . " (username, password) VALUES (:username, :password)";
        $stmt = $this->db->prepare($query);

        // Hash the password before saving!
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password_hash);

        return $stmt->execute();
    }
}
?>