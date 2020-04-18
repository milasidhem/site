
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

$result = mysqli_query($db,"SELECT * FROM user WHERE visible=1");
 


  
while($row = mysqli_fetch_array($result))
{  
    echo '<div class="card">';
    echo  "<h1> id :". $row['id'] . "</h1>";
echo  '<p class="date">DATE NAISSANCE :' . $row['dateN'] . '</p>';
echo  "<h1>" . $row['email'] . "</h1>";
echo  '<p class="adress">ADRESS :' . $row['adress'] . '</p>';
echo  '<p class="username">username : '. $row['username'] . '</p>';
echo  '<p class="username">password : '. $row['password'] . '</p>';
echo '<form action="consultationuser.php" method="post">
<input type="hidden"  value="' . $row['id']  . '" name="hid">
<input type="hidden"  value="' . $row['email']  . '" name="mail">
            <input class="butt" type="submit" value="supprimer" name="supprimer">
        </form>';
echo '</div>';

 
} 

if(isset($_POST['supprimer'])){   
    $id=mysqli_real_escape_string($db,htmlspecialchars($_POST['hid'])); 
    $mailto=mysqli_real_escape_string($db,htmlspecialchars($_POST['mail'])); 
    $requete = "DELETE FROM user where 
    id = '".$id."'  ";
               $exec_requete = mysqli_query($db,$requete);   
               
           
              //require_once(dirname(__FILE__) . "/phpmailer/PHPMailerAutoload.php"); // Does not work with PHP 7.2.x (https://github.com/Jemt/SitemagicCMS/issues/24)
              
              require_once(dirname(__FILE__) . "/PHPMailer-5.2.28/class.smtp.php");
           require_once(dirname(__FILE__) . "/PHPMailer-5.2.28/class.phpmailer.php");
           
              $mail = new PHPMailer(true);
              $mail ->IsSmtp();
              $mail ->SMTPDebug = 3;
              $mail ->SMTPAuth = true;
              $mail ->SMTPSecure = 'ssl';
              $mail ->Host = "smtp.gmail.com";
              $mail ->Port = 465; // or 587  
              $mail ->IsHTML(true);
              $mail ->Username = "your mail";
              $mail ->Password = "your paswords";
              $mail ->SetFrom("milasidhem43@gmail.com");
              $mail ->Subject  = "NOTICE";
              $mail ->Body = "SORRY YOUR ACCIUNT HAS BEEN DELETED";
              $mail ->AddAddress($mailto);
           
              if(!$mail->Send())
              {
                  echo "Mail Not Sent";
              }
              else
              {
                  echo "Mail Sent";
              }
           
           
            }
           
           
              
           
           

            ?>  
            
</div>
                
 

    </body>
</html>



