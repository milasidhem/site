
<html>
    <head>
        <meta charset="utf-8">
        
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="gestionusercss.css" media="screen" type="text/css" />
        <style>
  #grad1 {
  
  background: rgb(146,145,154);
background: linear-gradient(90deg, rgba(146,145,154,1) 10%, rgba(0,212,255,1) 59%);
}          

</style>
    </head>
    <body id='grad1'>
                    <?php


    // connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'testing';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
            ?>  
 
<div class="form-style-6">
<h1>ajouter user</h1>
 <form action="gestionuser.php" method="POST">
                  
                <label><b>prenom</b></label>
                <input type="text" placeholder=" nom" name="nom" required>
                <label><b>prenom</b></label>
                <input type="text" placeholder="prenom" name="prenom"required >   
                <label><b>date naissance</b></label>
                <input type="date" placeholder="date naissance" name="daten"required >  
                <label><b>adress</b></label>
                <input type="text" placeholder="adress" name="adress"required > 
                <label><b>phone</b></label>
                <input type="number" placeholder="phone"  min="0" max="9999999999" onkeyup="if(parseInt(this.value)>999999999){ this.value =9999999999; return false; }" name="phone"required >  
                <label><b>email</b></label>
                <input type="email" placeholder="email" name="email"required > 
                <label><b>username</b></label>
                <input type="text" placeholder="username" name="newuser"required > 
                <label><b>password</b></label>
                <input type="text" placeholder="passwor" name="password"required > 
                <label><b></b></label>
                <input type="number" placeholder="type"  min="-1" max="3" onkeyup="if(parseInt(this.value)>3){ this.value =0; return false; }" name="type"required >  
                 
                <input type="submit" id='submit' value='ajouter' name='ajouter' >
                </form>
                </div>
                <?php
 if(isset($_POST['ajouter'])){ 

$nom = mysqli_real_escape_string($db,htmlspecialchars($_POST['nom'])); 
$prenom = mysqli_real_escape_string($db,htmlspecialchars($_POST['prenom'])); 
$daten = mysqli_real_escape_string($db,htmlspecialchars($_POST['daten'])); 
$adress = mysqli_real_escape_string($db,htmlspecialchars($_POST['adress'])); 
$phone = mysqli_real_escape_string($db,htmlspecialchars($_POST['phone'])); 
$email = mysqli_real_escape_string($db,htmlspecialchars($_POST['email'])); 
$nusername = mysqli_real_escape_string($db,htmlspecialchars($_POST['newuser'])); 
$password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
$type = mysqli_real_escape_string($db,htmlspecialchars($_POST['type']));  
$requete = "insert into user(id, nom, prenom, dateN, adress, phone, email, username, password, type, visible)";
			$requete .= "values (NULL,\"$nom\", \"$prenom\", \"$daten\", \"$adress\", \"$phone\",  \"$email\",\"$nusername\",\"$password\",\"$type\",1)";
               $exec_requete = mysqli_query($db,$requete);  }           
?> 

    </body>
</html>



