<?php
var_dump($_POST);
$email = $_POST['email'];
$password = $_POST['password']; 
// connect to the database and select the publisher
require '../includes/connect.php';
$pdo = connect();
$sql = 'SELECT email, password,type_utilisateur  FROM users  WHERE email= :email AND password= :password';

$statement = $pdo->prepare($sql);
$statement->bindParam(':email', $email, PDO::PARAM_STR);
$statement->bindParam(':password', $password, PDO::PARAM_STR);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);

var_dump($user);

session_start();
$_SESSION['email']=$user['email'];



if($user['type_utilisateur'] == "patient"){
  
   var_dump($user);
   header("Location: ../patient/dashboard.php");
   exit();
}elseif($user['type_utilisateur'] == "medecin"){

   var_dump($user);
   header("Location: ../medecin/dashboard.php");
   exit();
}elseif($user['type_utilisateur'] == "infirmier"){
  
   var_dump($user);
   header("Location: ../infirmier/dashboard.php");
   exit();
}elseif($user['type_utilisateur'] == "pharmacie"){
   
   var_dump($user);
   header("Location: ../pharmacie/dashboard.php");
   exit();
}elseif($user['type_utilisateur'] == "laboratoire"){
   
   var_dump($user);
   header("Location: ../labo/dashboard.php");
   exit();
}