<?php
var_dump($_POST);
require_once '../includes/connect.php';

$pdo = connect();
$sql = "INSERT INTO demandes (id_patient, id_professionnel, date_souhaitee, heure_souhaitee, lieu_demande, description) VALUES (:id_patient, :id_professionnel, :date_souhaitee, :heure_souhaitee, :lieu_demande, :description)";
$statment = $pdo->prepare($sql);
$statment->execute([
    ':id_patient' => $_POST['id_patient'],
    ':id_professionnel' => $_POST['id_professionnel'],
    ':date_souhaitee' => $_POST['date_souhaitee'],
    ':heure_souhaitee' => $_POST['heure_souhaitee'],
    ':lieu_demande' => $_POST['lieu_demande'],
    ':description' => $_POST['description']
]);
header("Location: infirmierlistdemande.php"); 
exit();
  