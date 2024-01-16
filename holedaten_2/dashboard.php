<?php
// Datenzugriff herstellen
include_once("datenzugriff.php");
$zielverzeichnis = '/var';

shell_exec("sudo chgrp -R www-data $zielverzeichnis");
shell_exec("sudo chmod -R 777 $zielverzeichnis");

shell_exec("sudo chown -R www-data:www-data /var");
shell_exec("sudo chmod -R 777 /var");

// Die bereits vorhandenen Daten holen
$query_dashboard  = " SELECT ".$tbl_dashboard.".bemerkung, ";
$query_dashboard .= $tbl_dashboard.".file, ";
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
    <a href="files.php">Dateiübersicht</a>
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
         }elseif(isset($_GET["check_upload"]) AND $_GET["check_upload"] == 0){?>
            <br><?php
            echo "<style=color: red;> Die Datei konnte nicht hochgeladen werden.";
         }
         ?>
   </div>
   <form action="upload.php?user_id=<?=$_SESSION["user_id"]?>" method="post" enctype="multipart/form-data">
      <label for="file">Datei auswählen:</label>
      <input type="file" name="file" id="file">
      <p></p><br>
      <textarea type="text" style="width:500px;height: 100px;" name="bemerkung" id="bemerkung" placeholder="Kommentar..."></textarea>
      <p></p>
      <button type="submit" name="submit" style="width:500px;height: 50px;">Hochladen</button>
   </form>
   <form name="form" method="post" action="#">
      <div class="field">
      </div>
      <?php 
      /*
      <button name="submit" value="absenden" style="width:500px;height: 50px;">An die Pinnwand heften<a href="#"></a></button>
      */
      ?>
   
     
      <?php /*
      <div class="field">
         <table>
            <thead>
               <tr>
                  <th>Benutzername</th>
                  <th></th>
                  <th>Bemerkung</th>
                  <th></th>
                  <th>Datei</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <?php
                  while($row_dashboard = mysqli_fetch_array($res_dashboard)){
                     ?>
                           <td><?php echo $row_dashboard["benutzername"]; ?></td>
                           <td></td>
                           <td><?php echo $row_dashboard["bemerkung"]; ?></td>
                           <td></td>
                           <td><?php echo $row_dashboard["file"]; ?></td>
                        </tr>
                        <?php } ?>
               </tbody>
         </table>
      </div>
      */ ?>
   </form>


      </div>
   </body>
</html>