<?php
require '../includes/connect.php';
$pdo = connect();
session_start();

// Assurez-vous que l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
  header('Location: profile.php');
  exit();
}

$email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Handle form submission
  $nom = $_POST['nom'];
  $telephone = $_POST['telephone'];
  $adresse = $_POST['adresse'];
  $id_professionnel = $_POST['id_professionnel']; // Correction : retirez l'espace après 'id_professionnel'

  try {
    // Update query
    $sql = "UPDATE professionnels SET nom = :nom,telephone = :telephone, adresse = :adresse WHERE id_professionnel = :id_professionnel"; // Correction : retirez l'espace après 'id_professionnel'
    $statement = $pdo->prepare($sql);
    $result = $statement->execute([
      ':nom' => $nom,
      ':telephone' => $telephone,
      ':adresse' => $adresse,
      ':id_professionnel' => $id_professionnel // Correction : retirez l'espace après 'id_professionnel'
    ]);

    if ($result) {
      // Redirect to profile page after successful update
      header('Location: profile.php');
      exit();
    } else {
      // Handle update failure
      echo "Échec de la mise à jour.";
      exit();
    }
  } catch (PDOException $e) {
    // Handle database errors
    echo "Erreur : " . $e->getMessage();
    exit();
  }
}

// If not a POST request, redirect to profile page
header('Location: profile.php');
exit();
?>
