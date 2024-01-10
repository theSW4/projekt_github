<?php
$mysqli_data = Array("server"=>'127.0.0.1',"user"=>"root","password"=>"","projekt_github");
$datalink1   = mysqli_connect($mysqli_data['server'],$mysqli_data['user'],$mysqli_data['password'], "") OR die("Die Verbindung mit der Datenbank ist fehlgeschlagen!");

// Überprüfen, ob die Verbindung erfolgreich hergestellt wurde
if ($datalink1->connect_error) {
    die("Verbindung fehlgeschlagen: " . $datalink1->connect_error);
}

// SQL-Anweisung zur Erstellung der Datenbank
$sql = "CREATE DATABASE IF NOT EXISTS projekt_github";

// Definition des Datenbanknamens
$database = "projekt_github";

// Überprüfen, ob die Datenbank erfolgreich erstellt wurde
if ($datalink1->query($sql) === FALSE) {
    echo "Fehler bei der Erstellung der Datenbank: " . $datalink1->error;
}

###################################################################
$query = "CREATE TABLE IF NOT EXISTS `tbl_user` (
    `user_id`      int(11)      NOT NULL auto_increment,
    `benutzername` varchar(255) NOT NULL default '',
    `passwort`     varchar(255) NOT NULL default '',
    PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;";

mysqli_select_db($datalink1,$database) or die(mysqli_error($datalink1));
mysqli_query($datalink1,$query);
###################################################################
$query = "CREATE TABLE IF NOT EXISTS `tbl_dashboard` (
    `dashboard_id`      int(11)      NOT NULL auto_increment,
    `user_id`           int(11)      NOT NULL default 0,
    `bemerkung`         varchar(255) NOT NULL default '',
    PRIMARY KEY (`dashboard_id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;";
    
mysqli_select_db($datalink1,$database) or die(mysqli_error($datalink1));
mysqli_query($datalink1,$query);
###################################################################

// Tabellen definieren
$tbl_user      = $database.'.tbl_user';
$tbl_dashboard = $database.'.tbl_dashboard';

// Herausfinden ob es den user pi schon gibt
$pi_user  = "SELECT ";
$pi_user .= $tbl_user.".user_id,";
$pi_user .= $tbl_user.".benutzername";
$pi_user .= " FROM ".$tbl_user;
$pi_user .= " WHERE ".$tbl_user.".benutzername = 'pi'";
$res_pi_user = mysqli_query($datalink1,$pi_user);
$pi_user     = mysqli_num_rows($res_pi_user);

if($pi_user == 0){
    // Wenn leer, dann benutzer neu anlegen
    $insert_pi  = "INSERT INTO ".$tbl_user." SET ";
    $insert_pi .= $tbl_user.".benutzername = 'pi',";
    $insert_pi .= $tbl_user.".passwort = 'pi'";
    mysqli_query($datalink1,$insert_pi);
}

function authenticateUser($username, $password){
    $usersDirectory = '/Users/';

    $userFolders = array_diff(scandir($usersDirectory), array('..', '.'));
    echo "Benutzer im System: " . implode(', ', $userFolders) . "<br>";

    $users = array(
        'benutzer1' => 'passwort1',
        'benutzer2' => 'passwort2',
        'benutzer3' => 'passwort3'
    );


    $validUser = array_key_exists($username, $users) && $users[$username] === $password;

    return $validUser;
}

/*
// Benutzer des raspberry pis herausfinden
$command = 'cut -d: -f1 /etc/passwd | grep -v -E "nobody|nogroup"';
$output  = shell_exec($command);

$command = 'sudo awk -F: \'{print $1 ":" $2}\' /etc/shadow | grep -v -E "nobody|nogroup"';
$output  = shell_exec($command);

$userinfoarray = explode("\n", trim($output));

foreach($userinfoarray as $userinfo){
    list($username, $encryptedPassword) = explode(":",$userinfo);

    if(!empty($username) && !empty($encryptedPassword)){
        $insert_pi  = "INSERT INTO ".$tbl_user." SET ";
        $insert_pi .= $tbl_user.".benutzername = '".$username."',";
        $insert_pi .= $tbl_user.".passwort = '".$encryptedPassword."'";
        mysqli_query($datalink1,$insert_pi);
    }
}
*/

?>