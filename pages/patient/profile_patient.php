<?php
require '../includes/connect.php';
$pdo = connect();
session_start();

// Assurez-vous que l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
  header('Location: login.php');
  exit();
}

$email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Handle form submission
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $telephone = $_POST['telephone'];
  $adresse = $_POST['adresse'];
  $id_patient = $_POST['id_patient'];

  try {
    // Update query
    $sql = "UPDATE patients SET nom = :nom, prenom = :prenom, telephone = :telephone, adresse = :adresse WHERE id_patient = :id_patient";
    $statement = $pdo->prepare($sql);
    $result = $statement->execute([
      ':nom' => $nom,
      ':prenom' => $prenom,
      ':telephone' => $telephone,
      ':adresse' => $adresse,
      ':id_patient' => $id_patient
    ]);

    if ($result) {
      // Redirect to profile page after successful update
      header('Location: profile.php');
      exit();
    } else {
      // Handle update failure
      echo "Update failed.";
      exit();
    }
  } catch (PDOException $e) {
    // Handle database errors
    echo "Error: " . $e->getMessage();
    exit();
  }
}

// If not a POST request, redirect to profile page
header('Location: profile.php');
exit();
?>
