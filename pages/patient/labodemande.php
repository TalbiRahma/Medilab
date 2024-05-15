<?php

require_once '../includes/connect.php';

$pdo = connect();
$sql = "INSERT INTO demandes (id_patient, id_professionnel, date_souhaitee, heure_souhaitee, lieu_demande, description, ordonnance) VALUES (:id_patient, :id_professionnel, :date_souhaitee, :heure_souhaitee, :lieu_demande, :description, :ordonnance)";
$statment = $pdo->prepare($sql);
$statment->execute([
    ':id_patient' => $_POST['id_patient'],
    ':id_professionnel' => $_POST['id_professionnel'],
    ':date_souhaitee' => $_POST['date_souhaitee'],
    ':heure_souhaitee' => $_POST['heure_souhaitee'],
    ':lieu_demande' => $_POST['lieu_demande'],
    ':ordonnance' => $_POST['ordonnance'],
    ':description' => $_POST['description']
]);

//header("Location: labolistdemande.php");
 