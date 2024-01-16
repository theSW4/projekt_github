<!DOCTYPE html>
<?php
// Datenzugriff herstellen
include_once("datenzugriff.php");

// Was passiert, wenn submit gedrueckt wird
if($_SERVER['REQUEST_METHOD'] == 'POST'){
   if(isset($_POST["submit"]) AND $_POST["submit"] == "login"){
       // Pruefen, ob das Passwort identisch ist - nur dann fortfahren
       if((isset($_POST["passwort"]) AND !empty($_POST["passwort"])) AND (isset($_POST["benutzername"]) AND !empty($_POST["benutzername"]))){
   
           // Pruefen, ob der Benutzername schon vorhanden ist
           if(!empty($_POST["benutzername"])){
               $query_fremd_benutzer  = " SELECT benutzername ";
               $query_fremd_benutzer .= " FROM ".$tbl_user;
               $query_fremd_benutzer .= " WHERE ".$tbl_user.".benutzername = '".$_POST["benutzername"]."'";
               $query_fremd_benutzer .= " AND ".$tbl_user.".passwort = '".$_POST["passwort"]."'";
               $res_fremd_benutzer    = mysqli_query($datalink1,$query_fremd_benutzer); 
               $fremd_benutzer        = mysqli_num_rows($res_fremd_benutzer);
               
               $query_pi_benutzer  = " SELECT benutzername ";
               $query_pi_benutzer .= " FROM ".$tbl_benutzer;
               $query_pi_benutzer .= " WHERE ".$tbl_benutzer.".benutzername = '".$_POST["benutzername"]."'";
               $query_pi_benutzer .= " AND ".$tbl_benutzer.".passwort = '".$_POST["passwort"]."'";
               $res_pi_benutzer    = mysqli_query($datalink1,$query_pi_benutzer); 
               $pi_benutzer        = mysqli_num_rows($res_pi_benutzer);
   
               $pi_user = authenticateUser($_POST["benutzername"], $_POST["passwort"]);
   
               if($fremd_benutzer == 1 OR $pi_benutzer == 1){

                  $query_user_id  = " SELECT user_id ";
                  $query_user_id .= " FROM ".$tbl_user;
                  $query_user_id .= " WHERE ".$tbl_user.".benutzername = '".$_POST["benutzername"]."'";
                  $res_user_id    = mysqli_query($datalink1,$query_user_id); 
                  $user_id        = mysqli_fetch_array($res_user_id);

                  $_SESSION["user_id"] = $user_id[0];
   
                  // Leite zur dashboard.php weiter
                  header("Location: dashboard.php?user_id=".$_SESSION['user_id']);
                  exit();
               }else{
                  echo "Die eingegebenen Benutzerdaten stimmen nicht überein!";
               }
           }
       }else{?>
           <script text="type/javascript">
               alert("Die eingegebenen Benutzerdaten stimmen nicht überein. Bitte erneut eingeben!");
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
            LOGIN
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
            <button name="submit" value="login">LOGIN</button>
            <div class="link">
               Noch kein Konto?
               <a href="register.php">Jetzt Registrieren</a>
            </div>
         </form>
      </div>
   </body>
</html>