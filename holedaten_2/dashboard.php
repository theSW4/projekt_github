<?php
// Datenzugriff herstellen
include_once("datenzugriff.php");

// Die Kommentare und Dateien abspeichern
if(isset($_POST["submit"]) AND $_POST["submit"] == "absenden"){
   if(!empty($_POST["bemerkung"])){
      $insert_bemerkung  = "INSERT INTO ".$tbl_dashboard." SET ";
      $insert_bemerkung .= $tbl_dashboard.".bemerkung = '".$_POST["bemerkung"]."'";
      mysqli_query($datalink1,$insert_bemerkung);
   }
}

// Die bereits vorhandenen Daten holen
$query_dashboard  = " SELECT ".$tbl_dashboard.".bemerkung, ".$tbl_user.".benutzername ";
$query_dashboard .= " FROM ".$tbl_dashboard;
$query_dashboard .= " LEFT JOIN ".$tbl_user." ON ".$tbl_user.".user_id =".$tbl_dashboard.".user_id"; 
$res_dashboard = mysqli_query($datalink1,$query_dashboard); 
$row_dashboard = mysqli_fetch_array($res_dashboard);
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
    <a href="#about">Über uns</a>
    <a href="#contact">Logout</a>
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
      </form>

      <div>
         
      </div>
   </div>
</body>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
         <label for="file">Datei auswählen:</label>
         <input type="file" name="file" id="file">
         <p></p>
         <button type="submit" name="submit" style="width:500px;height: 50px;">Hochladen</button>
    </form>
</body>
</html>
<?php 
?>