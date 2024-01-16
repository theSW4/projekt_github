<?php
// Datenzugriff herstellen
include_once("datenzugriff.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["newPassword"]) AND isset($_POST["confirmPassword"]) AND !empty("newPassword") AND !empty("confirmPassword")){
        if($_POST["newPassword"] == $_POST["confirmPassword"]){

            $passwort_benutzer  =  "UPDATE ".$tbl_user." SET "; 
            $passwort_benutzer .=   $tbl_user.".passwort = '".$_POST["newPassword"]."'";
            $passwort_benutzer .= " WHERE ".$tbl_user.".user_id = '".$_SESSION["user_id"]."'";
            mysqli_query($datalink1,$passwort_benutzer);
            
            $passwort_benutzer_pi  =  "UPDATE ".$tbl_benutzer." SET "; 
            $passwort_benutzer_pi .=   $tbl_benutzer.".passwort = '".$_POST["newPassword"]."'";
            $passwort_benutzer_pi .= " WHERE ".$tbl_benutzer.".user_id = '".$_SESSION["user_id"]."'";
            mysqli_query($datalink1,$passwort_benutzer_pi);
        }else{
            echo "Die angegebenen Passwörter stimmen nicht überein";
        }
    }

    // Nach erfolgreicher Passwortänderung kannst du den Benutzer zum Dashboard weiterleiten
    header("Location: dashboard.php?user_id=".$_SESSION["user_id"]);
    exit();
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_dashboard.css">
    <title>Passwort ändern</title>
</head>
<body>

<nav>
    <ul>
        <li><a href="dashboard.php?user_id=<?=$_SESSION["user_id"]?>">Dashboard</a></li>
    </ul>
</nav>

<h2>Passwort ändern</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="newPassword">Neues Passwort:</label>
    <input type="password" name="newPassword" required>

    <label for="confirmPassword">Passwort bestätigen:</label>
    <input type="password" name="confirmPassword" required>
    <br/>

    <button style="width:20%; margin-left: 125px;" type="submit">Passwort ändern</button>
</form>

</body>
</html>
