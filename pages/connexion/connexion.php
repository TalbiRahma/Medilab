<?php
var_dump($_POST);
$email = $_POST['email'];
$password = $_POST['password'];
// connect to the database and select the publisher
require '../includes/connect.php';
$pdo = connect();
$sql = 'SELECT * FROM users  WHERE email= :email AND password= :password';

$statement = $pdo->prepare($sql);
$statement->bindParam(':email', $email, PDO::PARAM_INT);
$statement->bindParam(':password', $password, PDO::PARAM_STR);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);



if($user){
   session_start();
   $_SESSION=$user;
   var_dump($_SESSION);
echo $user['type_utilisateur'];

if($user['type_utilisateur'] == "patient"){
    
    
   header("Location: ../patient/dashboard.php");
   exit();
}elseif($user['type_utilisateur'] == "medecin"){

    
   header("Location: ../dashboard/medecin/dashboard.php");
   exit();
}elseif($user['type_utilisateur'] == "infirmier"){
  
    

    
   header("Location: ../dashboard/infirmier/dashboard.php");
   exit();
}elseif($user['type_utilisateur'] == "pharmacie"){
   
    

    
   header("Location: ../dashboard/pharmacie/dashboard.php");
   exit();
}elseif($user['type_utilisateur'] == "labo"){
   
    
   header("Location: ../dashboard/laboratoire/dashboard.php");
   exit();
}
}else{
   //traitement d'erreur
}