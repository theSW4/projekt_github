<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploadDir = '/var/www/html/projekt_github/holedaten_2/uploads/'; // Hier das Zielverzeichnis anpassen

    $uploadedFile = $uploadDir . basename($_FILES['file']['name']);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFile)) {
        echo 'Datei wurde erfolgreich hochgeladen.';
        $check_upload = 1;
        header("Location: dashboard.php?check_upload=".$check_upload);
    } else {
        echo 'Fehler beim Hochladen der Datei.';
        $check_upload = 0;
        header("Location: dashboard.php?check_upload=".$check_upload);
    }
}

?>
