<?php
// Datenzugriff herstellen
include_once("datenzugriff.php");

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

   $uploadDirectory = '/var/www/html/projekt_github'; 

   if (isset($_FILES['file'])) {
      $uploadedFile = $_FILES['file'];

      // Überprüfe, ob kein Fehler beim Upload aufgetreten ist
      if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
         $destination = $uploadDirectory . basename($uploadedFile['name']);

         // Verschiebe die hochgeladene Datei an den endgültigen Speicherort
         if (move_uploaded_file($uploadedFile['tmp_name'], $destination)) {
               echo 'Die Datei wurde erfolgreich hochgeladen. Pi Ordner';
         } else {
               echo 'Fehler beim Verschieben der Datei. Pi Ordner';
         }
      } else {
         echo 'Fehler beim Hochladen der Datei. Pi Ordner Fehlercode: ' . $uploadedFile['error'];
      }
   } else {
      echo 'Ungültige Anfrage.';
   }
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
    <a href="login.php">Logout</a>
</nav>
   <div class="bemerkung-form">
      <div class="text-dashboard">
            Hier können Sie Ihren Pinnwandeintrag eingeben:
      </div>
      <form name="form" method="post" action="#">
         <div class="field">
            <textarea type="text" style="width:500px;height: 150px;" name="bemerkung" id="bemerkung" placeholder="Kommentar..."></textarea>
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
    <form action="#" method="post" enctype="multipart/form-data">
         <label for="file">Datei auswählen:</label>
         <input type="file" name="file" id="file">
         <p></p>
         <button type="submit" name="submit" style="width:500px;height: 50px;">Hochladen</button>
    </form>
</body>
</html>