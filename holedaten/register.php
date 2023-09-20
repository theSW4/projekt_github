<!doctype html>

<?php

$conn = new mysqli("localhost", "root", "", "projekt_github");

if($conn->connect_error){
    die("Die Verbindung zur Datenbank ist fehlgeschlagen:".$conn->connect_error);
}else{
    echo "Die Verbindung war erfolgreich";
}

if(!empty($_POST["benutzername"])){
    
}


if((!empty($_POST["passwort"]) AND !empty($_POST["passwort_erneut"])) AND (($_POST["passwort"]) == ($_POST["passwort_erneut"]))){
    
    
}else{?>
    <script text="type/javascript">
        alert("Die Passwörter stimmen nicht überein. Bitte erneut eingeben!");
    </script>
<?php }

?>

<html lang="en"> 

 <head> 

  <meta charset="UTF-8">  

  <!-- <link rel="stylesheet" href="style.css">  -->

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

            <input type="submit" value="Login"> 

            </div> 

            </div> 

            </div> 

        </div> 

        </section> <!-- partial --> 
    </form>

 </body>

</html>