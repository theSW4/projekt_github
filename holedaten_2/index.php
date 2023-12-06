<?php
// Die Datenbankverbindung herstellen
$conn = new mysqli("localhost", "root", "", "projekt_github");

$tables = "SHOW TABLES";
$res_tables = $conn->query($tables);
$row_tables = mysqli_fetch_array($res_tables);

$tbl_user = $row_tables[0];

?>