<!DOCTYPE html>
<?php
// Datenzugriff herstellen
include_once("datenzugriff.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   // Was passiert, wenn submit gedrueckt wird
   if(isset($_POST["submit"]) AND $_POST["submit"] == "register"){
   
       // Pruefen, ob das Passwort identisch ist - nur dann fortfahren
       if((!empty($_POST["passwort"]) AND !empty($_POST["passwort_erneut"])) AND (($_POST["passwort"]) == ($_POST["passwort_erneut"]))){
           // Pruefen, ob der Benutzername schon vorhanden ist
           if(!empty($_POST["benutzername"])){
               $query_benutzername  = " SELECT benutzername ";
               $query_benutzername .= " FROM ".$tbl_user;
               $query_benutzername .= " WHERE ".$tbl_user.".benutzername = '".$_POST["benutzername"]."'";
               $res_benutzername = mysqli_query($datalink1,$query_benutzername); 
               $anzahl_benutzer  = mysqli_num_rows($res_benutzername);
               
               if($anzahl_benutzer == 0){
                   $insert  = "INSERT INTO ".$tbl_user." SET ";
                   $insert .= $tbl_user.".benutzername = '".$_POST["benutzername"]."',";
                   $insert .= $tbl_user.".passwort = '".$_POST["passwort"]."'";
                   mysqli_query($datalink1,$insert);
   
                  // Leite zur dashboard.php weiter
                  header("Location: dashboard.php");
                  exit();
               }else{
                  ?>
                  <script text="type/javascript">
                     alert("Der Benutzername ist bereits vorhanden!");
                  </script>
                  <?php
               }
           }
       }else{
         ?>
         <script text="type/javascript">
            alert("Die Passwörter stimmen nicht überein. Bitte erneut eingeben!");
         </script>
       <?php }
   }
}

?>

<html lang="de" dir="ltr">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="style.css">
   </head>
   <body>
      <div class="login-form">
         <div class="text">
            Registrieren
         </div>
         <form name="form" method="post">
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
               <button name="submit" value="register">Registrieren</button>
               <!-- <a href="dashboard.php" name="register" id="register">Jetzt registrieren</a> -->
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

