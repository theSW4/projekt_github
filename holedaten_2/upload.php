<?php

$uploadDirectory = "uploads/";

// Überprüfen, ob der Ordner existiert, andernfalls erstellen
if (!is_dir($uploadDirectory)) {
    if (!mkdir($uploadDirectory, 0777, true)) {
        die('Fehler beim Erstellen des Upload-Ordners...');
    }
}

if (isset($_POST['submit'])) {
    $uploadDirectory = "uploads/"; // Ordner, in dem die Datei gespeichert wird

    $uploadedFile = $uploadDirectory . basename($_FILES['file']['name']);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFile)) {
        echo "Datei wurde erfolgreich hochgeladen. Upload Ordner";
    } else {
        echo "Fehler beim Hochladen der Datei. Upload Ordner";
    }
}


// $host = 'deine_raspberry_pi_ip_adresse';
// $port = 22;
// $username = 'dein_raspberry_pi_benutzername';
// $password = 'dein_raspberry_pi_passwort';
// $localFilePath = 'lokaler_pfad/zur/datei.txt';
// $remoteDirectory = 'zielverzeichnis/auf/raspberry_pi';

// // Verbindung herstellen
// $connection = ssh2_connect($host, $port);
// if (!$connection) {
//     die('Verbindung fehlgeschlagen.');
// }

// // Authentifizierung
// if (!ssh2_auth_password($connection, $username, $password)) {
//     die('Authentifizierung fehlgeschlagen.');
// }

// // SFTP-Verbindung erstellen
// $sftp = ssh2_sftp($connection);

// // Datei hochladen
// $remoteFilePath = "ssh2.sftp://$sftp/$remoteDirectory/" . basename($localFilePath);
// if (ssh2_scp_send($connection, $localFilePath, $remoteFilePath, 0644)) {
//     echo 'Die Datei wurde erfolgreich hochgeladen.';
// } else {
//     echo 'Fehler beim Hochladen der Datei.';
// }

// // Verbindung schließen
// ssh2_disconnect($connection);

$uploadDirectory = '/pfad/auf/deinem/raspberry_pi/'; // Ändere dies entsprechend deinem Verzeichnis

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $uploadedFile = $_FILES['file'];

    // Überprüfe, ob kein Fehler beim Upload aufgetreten ist
    if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
        $destination = $uploadDirectory . basename($uploadedFile['name']);

        // Verschiebe die hochgeladene Datei an den endgültigen Speicherort
        if (move_uploaded_file($uploadedFile['tmp_name'], $destination)) {
            echo 'Die Datei wurde erfolgreich hochgeladen. Pi Ordner';
        } else {
            echo 'Fehler beim Verschieben der Datei. Pi Ordner';
        }
    } else {
        echo 'Fehler beim Hochladen der Datei. Pi Ordner Fehlercode: ' . $uploadedFile['error'];
    }
} else {
    echo 'Ungültige Anfrage.';
}

?>
