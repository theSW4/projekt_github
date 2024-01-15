<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploadDir = '/var/www/html/projekt_github/holedaten_2/uploads/'; // Hier das Zielverzeichnis anpassen

    $uploadedFile = $uploadDir . basename($_FILES['file']['name']);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFile)) {
        echo 'Datei wurde erfolgreich hochgeladen.';
     
        header("Location: dashboard.php");
    } else {
        echo 'Fehler beim Hochladen der Datei.';
        header("Location: dashboard.php");
    }
}

?>
