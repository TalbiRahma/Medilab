<?php

require_once '../includes/connect.php';

$target_dir = "../../ordonnances/";
$target_file = $target_dir . basename($_FILES["ordonnance"]["name"]);
if (move_uploaded_file($_FILES["ordonnance"]["tmp_name"], $target_file)) {
    $odronnance =$_FILES["ordonnance"]["tmp_name"];
}else {
    echo "Sorry, there was an error uploading your file.";
  }

$pdo = connect();
$sql = "INSERT INTO demandes (id_patient, id_professionnel, date_souhaitee, heure_souhaitee, lieu_demande, description, ordonnance) VALUES (:id_patient, :id_professionnel, :date_souhaitee, :heure_souhaitee, :lieu_demande, :description, :ordonnance)";
$statment = $pdo->prepare($sql);
$statment->execute([
    ':id_patient' => $_POST['id_patient'],
    ':id_professionnel' => $_POST['id_professionnel'],
    ':date_souhaitee' => $_POST['date_souhaitee'],
    ':heure_souhaitee' => $_POST['heure_souhaitee'],
    ':lieu_demande' => $_POST['lieu_demande'],
    ':ordonnance' => $odronnance,
    ':description' => $_POST['description']
]); 

header("Location: labolistdemande.php");



