<?php
// Datenzugriff herstellen
include_once("datenzugriff.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploadDir = '/var/www/html/projekt_github/holedaten_2/uploads/';

    $uploadedFile = $uploadDir . basename($_FILES['file']['name']);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFile)) {   
        $insert_file  = "INSERT INTO ".$tbl_dashboard." SET ";
        $insert_file .= $tbl_dashboard.".file = '".$_FILES['file']['name']."',";
        $insert_file .= $tbl_dashboard.".user_id = '".$_GET["user_id"]."'";
        mysqli_query($datalink1,$insert_file);

        $insert_bemerkung  = "INSERT INTO ".$tbl_dashboard." SET ";
        $insert_bemerkung .= $tbl_dashboard.".bemerkung = '".$_POST["bemerkung"]."',";
        $insert_bemerkung .= $tbl_dashboard.".user_id = '".$_GET["user_id"]."'";
        mysqli_query($datalink1,$insert_bemerkung);
    
        echo 'Datei wurde erfolgreich hochgeladen.';
        $check_upload = 1;
        header("Location: dashboard.php?user_id=".$_GET["user_id"]."&check_upload=".$check_upload);
    } else {
        echo 'Fehler beim Hochladen der Datei.';
        $check_upload = 0;
        header("Location: dashboard.php?user_id=".$_GET["user_id"]."check_upload=".$check_upload);
    }
}
?>
