
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
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 600px;
  margin: auto;
  text-align: center;
  font-family: arial;
  background-color: #BFEADC;
  box-shadow: -3px 3px #A1FFDF;
  
}

.username {
  color: grey;
  font-size: 22px;
}
.date {
  color: black;
  font-size: 18px;
}
.adress {
  color: black;
  font-size: 18px;
}

.card button {
    display: inline-block;
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 28px;
  padding: 20px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.card button:hover {
  opacity: 0.7;
}        
.card input[type=button], input[type=reset] {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
}
.butt{
width:250px;
height:45px;
border:none;
outline:none;

color:#fff;
font-size:12px;
text-shadow:0 1px rgba(0,0,0,0.4);
background-color:#FF0000;
font-weight:700;
box-shadow:-4px 4px 5px 0 #FF0000;

}
.butt:hover{
background-color:#FF6347;
cursor:pointer
}
.butt:active{
padding-top:2px;
box-shadow:none
}
.buttsub{
width:250px;
height:45px;
border:none;
outline:none;
box-shadow:-4px 4px 5px 0 #228B22;
color:#fff;
font-size:13px;

background-color:#228B22;
border-radius:3px;
font-weight:700
}
.buttsub:hover{
background-color:#00FF00;
cursor:pointer
}
.buttsub:active{
margin-left:-4px;
margin-bottom:-4px;
padding-top:2px;
box-shadow:none
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

$result = mysqli_query($db,"SELECT * FROM report WHERE visible=1");
 



while($row = mysqli_fetch_array($result))
{
    echo '<div class="card">';
    echo  "<h1> TITLE :". $row['title'] . "</h1>";
echo  '<img src="'.$row['image'].'"style="width:50%">';
echo  '<p class="date">DATE :' . $row['date1'] . '</p>';
echo  "<h1>" . $row['description'] . "</h1>";
echo  '<p class="adress">ADRESS :' . $row['adress'] . '</p>';
echo  '<p class="username">by : '. $row['username'] . '</p>';
echo '<form action="try.php" method="post">
<input type="hidden"  value="' . $row['id']  . '" name="hid">
            <input class="buttsub" type="submit" value="accepter" name="accepter">
        </form>';
        echo '<form action="try.php" method="post">
        <input type="hidden"  value="' . $row['id']  . '" name="hiden">
            <input class="butt" type="submit" value="supprimer" style="vertical-align:middle" name="supprimer">
        </form>';
         

echo '</div>';
 
} 
if(isset($_POST['accepter'])){   
    $id=mysqli_real_escape_string($db,htmlspecialchars($_POST['hid'])); 
    $requete = "UPDATE report SET visible=2  where id =\"$id\"";
               $exec_requete = mysqli_query($db,$requete);  } 
                if(isset($_POST['supprimer'])){   
                $idi=mysqli_real_escape_string($db,htmlspecialchars($_POST['hiden'])); 
                $requete = "UPDATE report SET visible=0  where id =\"$idi\"";
                           $exec_requete = mysqli_query($db,$requete);  } 

            ?>  
            
</div>
                
 

    </body>
</html>



