<?php
var_dump($_POST);
$email = $_POST['email'];
$password = $_POST['password'];
// connect to the database and select the publisher
require '../includes/connect.php';
$pdo = connect();
$sql = 'SELECT * FROM user  WHERE email= :email AND password= :password';

$statement = $pdo->prepare($sql);
$statement->bindParam(':email', $email, PDO::PARAM_INT);
$statement->bindParam(':password', $password, PDO::PARAM_STR);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);



if($user){
   session_start();
   $_SESSION=$user;
   var_dump($_SESSION);
echo $user['role'];

if($user['role'] == "patient"){
    
    
   header("Location: ../patient/dashboard.php");
   exit();
}elseif($user['role'] == "medecin"){

    
   header("Location: ../dashboard/medecin/dashboard.php");
   exit();
}elseif($user['role'] == "infirmier"){
  
    

    
   header("Location: ../dashboard/infirmier/dashboard.php");
   exit();
}elseif($user['role'] == "pharmacie"){
   
    

    
   header("Location: ../dashboard/pharmacie/dashboard.php");
   exit();
}elseif($user['role'] == "labo"){
   
    
   header("Location: ../dashboard/laboratoire/dashboard.php");
   exit();
}
}else{
   //traitement d'erreur
}