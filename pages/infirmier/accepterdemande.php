<?php
//var_dump($_GET);

$id_demande = $_GET['id'];
require '../includes/connect.php';
$pdo = connect();
$requete = "UPDATE demandes SET etat_demande = 'accepte' WHERE id_demande='$id_demande'";
//echo $requete;
$pdo->exec($requete);
session_start();
$_SESSION['message'] = "Demande acceptée avec succès";
header("Location: historiquedemande.php");
exit();
