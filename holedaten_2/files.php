<?php
// Datenzugriff herstellen
include_once("datenzugriff.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /*
    if(isset($_POST["newPassword"]) AND isset($_POST["confirmPassword"]) AND !empty("newPassword") AND !empty("confirmPassword")){
        if($_POST["newPassword"] == $_POST["confirmPassword"]){
            

            $passwort_benutzer  =  "UPDATE ".$tbl_user." SET "; 
            $passwort_benutzer .=   $tbl_user.".passwort = '".$_POST["newPassword"]."'";
            $passwort_benutzer .= " WHERE ".$tbl_user.".user_id = '".$_SESSION["user_id"]."'";
            mysqli_query($datalink1,$passwort_benutzer);
            
            // $passwort_benutzer_pi  =  "UPDATE ".$tbl_benutzer." SET "; 
            // $passwort_benutzer_pi .=   $tbl_benutzer.".passwort = '".$_POST["newPassword"]."'";
            // $passwort_benutzer_pi .= " WHERE ".$tbl_benutzer.".user_id = '".$_SESSION["user_id"]."'";
            // mysqli_query($datalink1,$passwort_benutzer_pi);
        }else{
            echo "Die angegebenen Passwörter stimmen nicht überein";
        }
    }
    */

    // Nach erfolgreicher Passwortänderung kannst du den Benutzer zum Dashboard weiterleiten
    header("Location: dashboard.php?user_id=".$_SESSION["user_id"]);
    exit();
}


// array erstellen
$array_files = array();

// Die bereits vorhandenen Daten holen
$query_files  = " SELECT ".$tbl_dashboard.".bemerkung, ";
$query_files .= $tbl_dashboard.".file, ";
$query_files .= $tbl_user.".user_id, ";
$query_files .= $tbl_user.".benutzername ";
$query_files .= " FROM ".$tbl_dashboard;
$query_files .= " LEFT JOIN ".$tbl_user." ON ".$tbl_user.".user_id =".$tbl_dashboard.".user_id"; 
$res_files = mysqli_query($datalink1,$query_files);
while($row_files = mysqli_fetch_array($res_files)){
    $array_files[] = array(
                     'user_id'      => $row_files['user_id'],
                     'benutzername' => $row_files['benutzername'],
                     'bemerkung'    => $row_files['bemerkung'],
                     'file'         => $row_files['file']
    );
}

// echo "<pre>";
// print_r($array_files);echo "<<<<<";
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_dashboard.css">
    <title>Dateien</title>
</head>
<body>

<nav>
    <ul>
        <li><a href="dashboard.php?user_id=<?=$_SESSION["user_id"]?>">Dashboard</a></li>
    </ul>
</nav>

<h2>Dateienübersicht</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="field">
         <table>
            <thead>
               <tr>
                  <th>BenutzerID</th>
                  <th>Benutzername</th>
                  <th>Bemerkung</th>
                  <th>Datei</th>
               </tr>
            </thead>
            <tbody>
               
                    <?php
                    foreach($array_files as $row_files){ 
                        $user_id      = $row_files['user_id'];
                        $benutzername = $row_files['benutzername'];
                        $bemerkung    = $row_files['bemerkung'];
                        $file         = $row_files['file'];
                        ?>
                        <tr>
                            <td align="center" style="height:25px;"><?php echo $user_id; ?></td>
                            <td  style="height:25px;"><?php echo $benutzername; ?></td>
                            <td ><?php echo $bemerkung; ?></td>
                            <td ><?php echo $file; ?></td>
                        </tr>
                    <?php } ?>
                
            </tbody>
        </table>
    </div>
</form>

</body>
</html>
