<?php

var_dump($_POST);

require_once '../includes/connect.php';

$pdo = connect();
$sql = "INSERT INTO demandes (id_patient, id_professionnel, ordonnance, description) VALUES (:id_patient, :id_professionnel, :ordonnance, :description)";
$statment = $pdo->prepare($sql);
$statment->execute([
    ':id_patient' => $_POST['id_patient'],
    ':id_professionnel' => $_POST['id_professionnel'],
    ':ordonnance' => $_POST['ordonnance'],
    ':description' => $_POST['description']
]);

//header("Location: pharmacielistdemande.php");