<?php
 $query_dashboard  = " SELECT ".$tbl_dashboard.".antwort, ".$tbl_user.".benutzername ";
 $query_dashboard .= " FROM ".$tbl_dashboard;
 $query_dashboard .= " LEFT JOIN ".$tbl_user." ON ".$tbl_user.".user_id =".$tbl_dashboard.".user_id"  
 $res_dashboard = mysqli_query($conn,$query_dashboard); 
 $row_dashboard = mysqli_fetch_array($res_dashboard);
?>
<html lang="de" dir="ltr">
<head>
   <meta charset="utf-8">
   <!-- <link rel="stylesheet" href="style.css"> -->
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/> -->
</head>
<body>
   <div class="kommentar-form">
    <div>
        <?php$row_dashboard["antwort"];?>
        <?php$row_dashboard["benutzername"];?>
    </div>
      <div class="text">
            Hier können Sie Ihren Pinnwandeintrag eingeben:
      </div>
      <form name="form" method="post" action="#">
         <div class="field">
            <textarea type="text" name="kommentar" id="kommentar" placeholder="kommentar"></textarea>
         </div>
         <button name="submit" value="absenden">An die Pinnwand heften<a href="#"></a></button>
      </form>
   </div>
</body>
</html>
<?php 
?>