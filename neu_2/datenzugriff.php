<?php

$database    = "projekt_github";
$mysqli_data = Array("server"=>'127.0.0.1',"user"=>"root","password"=>"","projekt_github");
$datalink1   = mysqli_connect($mysqli_data['server'],$mysqli_data['user'],$mysqli_data['password'], "") OR die("Die Verbindung mit der Datenbank ist fehlgeschlagen!");

########################
## Tabellen erstellen ##
########################
###################################################################
$query = "CREATE TABLE IF NOT EXISTS 'tbl_user' (
    'user_id'      int(11)      NOT NULL auto_increment,
    'benutzername' varchar(255) NOT NULL default '',
    'passwort'     varchar(255) NOT NULL default '',
    PRIMARY KEY ('user_id')
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;";
    
mysqli_select_db($datalink1,$database) or die(mysqli_error($datalink1));
mysqli_query($datalink1,$query);
###################################################################
$query = "CREATE TABLE IF NOT EXISTS 'tbl_dashboard' (
    'dashboard_id'      int(11)      NOT NULL auto_increment,
    'user_id'           int(11)      NOT NULL default 0,
    'bemerkung'         varchar(255) NOT NULL default '',
    PRIMARY KEY ('dashboard_id')
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;";
    
mysqli_select_db($datalink1,$database) or die(mysqli_error($datalink1));
mysqli_query($datalink1,$query);
###################################################################
// Tabellen definieren
$tbl_user      = $database.'.tbl_user';
$tbl_dashboard = $database.'.tbl_dashboard';

?>