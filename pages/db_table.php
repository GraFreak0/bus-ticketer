<?php
// Include database connection file
include("conn.php");

// Function to execute SQL queries and handle errors
function executeQuery($query, $conn) {
    if ($conn->query($query) !== TRUE) {
        echo "Error executing query: " . $conn->error . "<br>";
        return false;
    }
    return true;
}

// SQL statements to drop and create the tables
$sql_backup_copy_codes = "INSERT INTO codes_bkp (serial_no, name, code, date_time)
                          SELECT serial_no, name, code, date_time FROM codes";

$sql_backup_copy_lakowe = "INSERT INTO codes_lakowe_bkp (serial_no, name, code, date_time)
                           SELECT serial_no, name, code, date_time FROM codes_lakowe";

$sql_truncate_codes = "TRUNCATE TABLE codes;";

$sql_truncate_codes_lakowe = "TRUNCATE TABLE codes_lakowe;";

// Execute backup table query for codes_bkp
if (!executeQuery($sql_backup_copy_codes, $conn)) {
    echo "Error copying data to codes_bkp table.<br>";
}

// Execute backup table query for codes_lakowe_bkp
if (!executeQuery($sql_backup_copy_lakowe, $conn)) {
    echo "Error copying data to codes_lakowe_bkp table.<br>";
}

// Execute truncate table query
if (!executeQuery($sql_truncate_codes, $conn)) {
    echo "Error truncating main tables.<br>";
}

if (!executeQuery($sql_truncate_codes_lakowe, $conn)) {
    echo "Error truncating main tables.<br>";
}

// Close connection
$conn->close();
?>
