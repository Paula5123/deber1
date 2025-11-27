DROP DATABASE IF EXISTS school_db;
CREATE DATABASE school_db;
USE school_db;

-- 1. Table for Teachers
CREATE TABLE teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Stores the hash
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Table for Students
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    grade VARCHAR(10) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. DUMMY DATA: Teacher
-- The password hash below corresponds to: '12345'
INSERT INTO teachers (username, password) 
VALUES ('teacher1', '$2y$10$6tr8CI9iUFSjEtEx1PrLm.35ofzRS5Qd.QiBGF4C8LxMR5JXCVQiG');


-- 4. DUMMY DATA: Students
INSERT INTO students (name, email, grade) VALUES 
('Alice Johnson', 'alice@school.com', '10th'),
('Bob Smith', 'bob@school.com', '11th');