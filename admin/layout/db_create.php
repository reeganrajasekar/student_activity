<?php 
require("./db.php");

//  Student
$sql = "CREATE TABLE IF NOT EXISTS student (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(125) NOT NULL,
    mail VARCHAR(125) NOT NULL,
    mob VARCHAR(20) NOT NULL,
    sid VARCHAR(125) NOT NULL,
    dob VARCHAR(20) NOT NULL,
    dept VARCHAR(125) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table student created successfully<br>";
}

//  Staff
$sql = "CREATE TABLE IF NOT EXISTS staff (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(125) NOT NULL,
    mail VARCHAR(125) NOT NULL,
    mob VARCHAR(20) NOT NULL,
    sid VARCHAR(125) NOT NULL,
    dob VARCHAR(20) NOT NULL,
    password VARCHAR(0) NOT NULL,
    dept VARCHAR(125) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table staff created successfully<br>";
}

//  Cert
$sql = "CREATE TABLE IF NOT EXISTS cert (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sid INT(6) UNSIGNED,
    title VARCHAR(500),
    date DATE,
    file VARCHAR(500),
    state VARCHAR(125),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY(sid) REFERENCES student(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Cert created successfully<br>";
}

//  Staff Cert
$sql = "CREATE TABLE IF NOT EXISTS scert (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sid INT(6) UNSIGNED,
    title VARCHAR(500),
    date DATE,
    file VARCHAR(500),
    state VARCHAR(125),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY(sid) REFERENCES staff(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Staff Cert created successfully<br>";
}


$conn->close();


?>