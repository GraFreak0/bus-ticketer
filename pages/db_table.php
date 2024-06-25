<?php
include("conn.php");

// SQL statements to drop and create the table
$sql_drop = "DROP TABLE IF EXISTS codes";

$sql_create = "CREATE TABLE codes (
    serial_no INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    code VARCHAR(10) NOT NULL,
    date_time DATETIME NOT NULL
)";

// Execute drop table query
if ($conn->query($sql_drop) === TRUE) {
    echo "Table 'codes' dropped successfully.<br>";
} else {
    echo "Error dropping table: " . $conn->error . "<br>";
}

// Execute create table query
if ($conn->query($sql_create) === TRUE) {
    echo "Table 'codes' created successfully.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Close connection
$conn->close();
?>
