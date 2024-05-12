<?php

require_once '../includes/connect.php';

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$password = $_POST['password'];
$telephone = $_POST['telephone'];
$adresse = $_POST['adresse'];
$type_utilisateur = $_POST['type_utilisateur'];

var_dump($_POST);

$pdo = connect();
//creation de id unique 
//$id_user = uniqid();
$sql = "INSERT INTO users (id_user,nom, prenom, email, password, telephone, adresse, type_utilisateur) VALUES (:id_user,:nom, :prenom, :email, :password, :telephone, :adresse, :type_utilisateur)";
$statment = $pdo->prepare($sql);
$statment->execute([
    ':id_user' => $id_user,
    ':nom' => $nom,
    ':prenom' => $prenom,
    ':email' => $email,
    ':password' => $password,
    ':telephone' => $telephone,
    ':adresse' => $adresse,
    ':type_utilisateur' => $type_utilisateur,
]);
 
if($type_utilisateur == "patient"){
    $sql = "INSERT INTO patients (id_patient,nom, prenom, email, password, telephone,image, adresse, type_utilisateur) VALUES (:id_patient,:nom, :prenom, :email, :password, :telephone,:image, :adresse, :type_utilisateur)";
    $statment = $pdo->prepare($sql);
    $statment->execute([
    ':id_patient' => $id_user,
    ':nom' => $nom,
    ':prenom' => $prenom,
    ':email' => $email,
    ':password' => $password,
    ':telephone' => $telephone,
    'image'=> null,
    ':adresse' => $adresse,
    ':type_utilisateur' => $type_utilisateur,
    ]);
}else{
    $sql = "INSERT INTO professionnels (id_professionnel,nom, prenom, email, password, telephone,image, adresse, type_professionnel) VALUES (:id_professionnel,:nom, :prenom, :email, :password, :telephone,:image, :adresse, :type_professionnel)";
    $statment = $pdo->prepare($sql);
    $statment->execute([
    ':id_professionnel' => $id_user,
    ':nom' => $nom,
    ':prenom' => $prenom,
    ':email' => $email,
    ':password' => $password,
    ':telephone' => $telephone,
    'image'=> null,
    ':adresse' => $adresse,
    ':type_professionnel' => $type_utilisateur,
    ]);
}

if($type_utilisateur == "patient"){
    
     // Redirection vers la page d'accueil
    header("Location: ../patient/dashboard.php");
    exit();
}elseif($type_utilisateur == "medecin"){
    
     

     // Redirection vers la page d'accueil
    header("Location: ../medecin/dashboard.php");
    exit();
}elseif($type_utilisateur == "infirmier"){
   
     

     // Redirection vers la page d'accueil
    header("Location: ../infirmier/dashboard.php");
    exit();
}elseif($type_utilisateur == "pharmacie"){
    
     

     // Redirection vers la page d'accueil
    header("Location: ../pharmacie/dashboard.php");
    exit();
}elseif($type_utilisateur == "labo"){
    
     // Redirection vers la page d'accueil
    header("Location: ../laboratoire/dashboard.php");
    exit();
}