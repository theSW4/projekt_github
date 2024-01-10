<!DOCTYPE html>
<?php
// Datenzugriff herstellen
include_once("datenzugriff.php");

// Was passiert, wenn submit gedrueckt wird
if($_SERVER['REQUEST_METHOD'] == 'POST'){
   if(isset($_POST["submit"]) AND $_POST["submit"] == "login"){
       // Pruefen, ob das Passwort identisch ist - nur dann fortfahren

       echo "hallo";
       echo "<pre>";
       print_r($_POST);echo "<<<<<<";
       echo "</pre>";die();
       
       if((isset($_POST["passwort"]) AND !empty($_POST["passwort"])) AND (isset($_POST["benutzername"]) AND !empty($_POST["benutzername"]))){
   
           // Pruefen, ob der Benutzername schon vorhanden ist
           if(!empty($_POST["benutzername"])){
               $query_benutzername  = " SELECT benutzername ";
               $query_benutzername .= " FROM ".$tbl_user;
               $query_benutzername .= " WHERE ".$tbl_user.".benutzername = '".$_POST["benutzername"]."'";
               $res_benutzername = mysqli_query($datalink1,$query_benutzername); 
               $anzahl_benutzer  = mysqli_num_rows($res_benutzername);
   
               $pi_user = authenticateUser($_POST["benutzername"], $_POST["passwort"]);
   
               if($anzahl_benutzer == 1 OR !empty($pi_user)){
   
                  $query_user_id  = " SELECT user_id ";
                  $query_user_id .= " FROM ".$tbl_user;
                  $query_user_id .= " WHERE ".$tbl_user.".benutzername = '".$_POST["benutzername"]."'";
                  $res_user_id    = mysqli_query($datalink1,$query_user_id); 
                  $user_id        = mysqli_fetch_array($res_user_id);
   
                  $user_id = $user_id[0];
   
                  // Leite zur dashboard.php weiter
                  header("Location: dashboard.php?user_id=$user_id");
                  exit();
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