<?php

var_dump($_POST);

require_once '../includes/connect.php';
$target_dir = "../../ordonnances/";
$target_file = $target_dir . basename($_FILES["ordonnance"]["name"]);
if (move_uploaded_file($_FILES["ordonnance"]["tmp_name"], $target_file)) {
    $odronnance =$_FILES["ordonnance"]["tmp_name"];
}else {
    echo "Sorry, there was an error uploading your file.";
  }

$pdo = connect();
$sql = "INSERT INTO demandes (id_patient, id_professionnel, ordonnance, description) VALUES (:id_patient, :id_professionnel, :ordonnance, :description)";
$statment = $pdo->prepare($sql);
$statment->execute([
    ':id_patient' => $_POST['id_patient'],
    ':id_professionnel' => $_POST['id_professionnel'],
    ':ordonnance' => $ordonnance,
    ':description' => $_POST['description']
]);

//header("Location: pharmacielistdemande.php");