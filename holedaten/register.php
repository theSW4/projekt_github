<!doctype html>
<?php
// Die Datenbankverbindung herstellen
$conn = new mysqli("localhost", "root", "", "projekt_github");

$tables = "SHOW TABLES";
$res_tables = $conn->query($tables);
$row_tables = mysqli_fetch_array($res_tables);

$tbl_user = $row_tables[0];

// Datenverbindung wird ueberprueft
// if($conn->connect_error){
//     die("Die Verbindung zur Datenbank ist fehlgeschlagen:".$conn->connect_error);
// }else{
//     echo "Die Verbindung war erfolgreich";
// }

// Was passiert, wenn submit gedrueckt wird

if(isset($_POST["submit"]) AND $_POST["submit"] == "Registrieren"){

  
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
                $conn->close();
            }
        }
    }else{?>
        <script text="type/javascript">
            alert("Die Passwörter stimmen nicht überein. Bitte erneut eingeben!");
        </script>
    <?php }
}

?>

<html lang="en"> 

 <head> 

  <meta charset="UTF-8">  

  <link rel="stylesheet" href="style.css"> 

 </head> 

 <body> <!-- partial:index.partial.html --> 

    <form name="form" method="post" action="">

        <section> 

        <div class="signin"> 

            <div class="content"> 

            <h2>Registrieren</h2> 

            <div class="form"> 

            <div class="inputBox"> 

            <input name="benutzername" type="text" required id="benutzername"> <i>Benutzername</i> 

            </div> 

            <div class="inputBox"> 

            <input name="passwort" type="password" required id="passwort"> <i>Passwort</i> 

            </div> 
            <div class="inputBox"> 

            <input name="passwort_erneut" type="password" required id="passwort_erneut"> <i>Password erneut</i> 

            </div>

            <div class="links"> <a href="#">Passwort vergessen</a> <a href="login_index.php">Login</a> 

            </div> 

            <div class="inputBox"> 

            <input type="submit" name="submit" id="submit" value="Registrieren"> 

            </div> 

            </div> 

            </div> 

        </div> 

        </section> <!-- partial --> 
    </form>

 </body>

</html>