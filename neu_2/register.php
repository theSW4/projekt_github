<!DOCTYPE html>
<?php
// Die Datenbankverbindung herstellen
$conn = new mysqli("localhost", "root", "", "projekt_github");

$tables = "SHOW TABLES";
$res_tables = $conn->query($tables);
$row_tables = mysqli_fetch_array($res_tables);

$tbl_user = $row_tables[0];

## Datenverbindung wird ueberprueft
// if($conn->connect_error){
//     die("Die Verbindung zur Datenbank ist fehlgeschlagen:".$conn->connect_error);
// }else{
//     echo "Die Verbindung war erfolgreich";
// }

// Was passiert, wenn submit gedrueckt wird

if(isset($_POST["submit"]) AND $_POST["submit"] == "register"){

  
    // Pruefen, ob das Passwort identisch ist - nur dann fortfahren
    if((!empty($_POST["passwort"]) AND !empty($_POST["passwort_erneut"])) AND (($_POST["passwort"]) == ($_POST["passwort_erneut"]))){
        // Pruefen, ob der Benutzername schon vorhanden ist
        if(!empty($_POST["benutzername"])){
            $query_benutzername  = " SELECT benutzername ";
            $query_benutzername .= " FROM ".$tbl_user;
            $res_benutzername = mysqli_query($conn,$query_benutzername); 
            $row_benutzername = mysqli_fetch_array($res_benutzername);

            if($row_benutzername["benutzername"] <> $_POST["benutzername"]){
                $insert  = "INSERT INTO ".$tbl_user." SET ";
                $insert .= $tbl_user.".benutzername = '".$_POST["benutzername"]."',";
                $insert .= $tbl_user.".passwort = '".$_POST["passwort"]."'";
                mysqli_query($conn,$insert);
            }
        }
    }else{?>
        <script text="type/javascript">
            alert("Die Passwörter stimmen nicht überein. Bitte erneut eingeben!");
        </script>
    <?php }
}

?>
<html lang="de" dir="ltr">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="style.css">
      <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/> -->
   </head>
   <body>
      <div class="login-form">
         <div class="text">
            Registrieren
         </div>
         <form name="form" method="post" action="dashboard.php">
            <div class="field">
               <div class="fas fa-envelope"></div>
               <input type="text" name="benutzername" id="benutzername" placeholder="Benutzername">
            </div>
            <div class="field">
               <div class="fas fa-lock"></div>
               <input type="password" name="passwort" placeholder="Passwort">
            </div>
            <div class="field">
               <div class="fas fa-lock"></div>
               <input type="password" name="passwort_erneut" placeholder="Passwort erneut">
            </div>
            <div class="link">
               <button name="submit"  value="register">Registrieren</button>
               <!-- <a href="dashboard.php"></a> -->
            </div>
            <div class="link">
               Schon ein Konto vorhanden?
               <p></p>
               <a href="login.php">Jetzt anmelden</a>
            </div>
         </form>
      </div>
   </body>
</html>