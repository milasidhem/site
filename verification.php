<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
    // connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'testing';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
    
    
    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM user where 
              username = '".$username."' and password = '".$password."' ";
              $requete2 = "SELECT type FROM user where 
              username = '".$username."' and password = '".$password."' ";
        $exec_requete = mysqli_query($db,$requete);
        $exec_requete2 = mysqli_query($db,$requete2);
        $reponse      = mysqli_fetch_array($exec_requete);
        $reponse2     = mysqli_fetch_array($exec_requete2);
        $count = $reponse['count(*)'];
        $count2 = $reponse2['type'];

        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
         $_SESSION['db'] = $db;
         if($count2==0){
           $_SESSION['username'] = $username;
           header('Location: principale.php');}
           if($count2==-1){
            $_SESSION['username'] = $username;
            header('Location: admin.php');}
        }
        else
        {
           header('Location: log.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: log.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: log.php');
}
mysqli_close($db); // fermer la connexion
?>