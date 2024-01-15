<?php
// Datenzugriff herstellen
include_once("datenzugriff.php");
$zielverzeichnis = '/var';

shell_exec("sudo chgrp -R www-data $zielverzeichnis");
shell_exec("sudo chmod -R 777 $zielverzeichnis");

shell_exec("sudo chown -R www-data:www-data /var");
shell_exec("sudo chmod -R 777 /var");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   // Die Kommentare und Dateien abspeichern
   if(isset($_POST["submit"]) AND $_POST["submit"] == "absenden"){
      if(!empty($_POST["bemerkung"])){
         $insert_bemerkung  = "INSERT INTO ".$tbl_dashboard." SET ";
         $insert_bemerkung .= $tbl_dashboard.".bemerkung = '".$_POST["bemerkung"]."',";
         $insert_bemerkung .= $tbl_dashboard.".user_id = '".$_GET["user_id"]."'";
         mysqli_query($datalink1,$insert_bemerkung);
      }
   }


   //www-data ALL=(ALL) NOPASSWD: ALL
}

// Die bereits vorhandenen Daten holen
$query_dashboard  = " SELECT ".$tbl_dashboard.".bemerkung, ";
$query_dashboard .= $tbl_user.".benutzername ";
$query_dashboard .= " FROM ".$tbl_dashboard;
$query_dashboard .= " LEFT JOIN ".$tbl_user." ON ".$tbl_user.".user_id =".$tbl_dashboard.".user_id"; 
$res_dashboard = mysqli_query($datalink1,$query_dashboard); 
?>

<html lang="de" dir="ltr">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style_dashboard.css">
</head>
<body>

<!-- Navigationsleiste -->
<nav>
    <a href="#home">Home</a>
    <a href="changepw.php">Passwort ändern</a>
    <a href="login.php">Logout</a>
</nav>
<div class="bemerkung-form">
   <div class="text-dashboard">
         Hier können Sie Ihre Dateien hochladen:
         <?php
         if(isset($_GET["check_upload"]) AND $_GET["check_upload"] == 1){?>
            <br><?php
            echo "<style=color: green;> Die Datei wurde erfolgreich hochgeladen.";
         }elseif(isset($_GET["check_upload"]) AND $_GEt["check_upload"] == 0){?>
            <br><?php
            echo "<style=color: red;> Die Datei konnte nicht hochgeladen werden.";
         }
         ?>
   </div>
   <form action="upload.php" method="post" enctype="multipart/form-data">
         <label for="file">Datei auswählen:</label>
         <input type="file" name="file" id="file">
         <p></p>
         <button type="submit" name="submit" style="width:500px;height: 50px;">Hochladen</button>
   </form>
   <form name="form" method="post" action="#">
      <div class="field">
         <textarea type="text" style="width:500px;height: 100px;" name="bemerkung" id="bemerkung" placeholder="Kommentar..."></textarea>
      </div>
      <button name="submit" value="absenden" style="width:500px;height: 50px;">An die Pinnwand heften<a href="#"></a></button>
      
      <?php
      /*
      while($row_dashboard = mysqli_fetch_array($res_dashboard)){?>
         <div class="field">
            <tr>
               <td height="5"></td>
            </tr>
            <tr>
               <td name="benutzername" id="benutzername"><?=$row_dashboard["benutzername"]?></td>
               <td name="test" id="test"><?=$row_dashboard["bemerkung"]?></td>
            </tr>
         </div>
      <?php }
      */
      ?>
   </form>


   </div>
</body>
<body>
    
</body>
</html>