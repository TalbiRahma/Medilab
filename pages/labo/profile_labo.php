<?php
require '../includes/connect.php';
$pdo = connect();
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: profile.php');
    exit();
}

$email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $id_professionnel = $_POST['id_professionnel'];
    
    try {
        // Mise à jour dans la table professionnels
        $sql_prof = "UPDATE professionnels SET nom = :nom, telephone = :telephone, adresse = :adresse WHERE id_professionnel = :id_professionnel";
        $stmt_prof = $pdo->prepare($sql_prof);
        $result_prof = $stmt_prof->execute([
            ':nom' => $nom,
            ':telephone' => $telephone,
            ':adresse' => $adresse,
            ':id_professionnel' => $id_professionnel
        ]);

        // Récupérer l'id_user à partir de l'email
        $req_user = "SELECT id_user FROM users WHERE email = :email";
        $stmt_user = $pdo->prepare($req_user);
        $stmt_user->execute([':email' => $email]);
        $user = $stmt_user->fetch(PDO::FETCH_ASSOC);
        $id_user = $user['id_user'];

        $sql_user = "UPDATE users SET nom = :nom, telephone = :telephone, adresse = :adresse WHERE id_user = :id_user AND type_utilisateur = 'laboratoire'";
        $stmt_user_update = $pdo->prepare($sql_user);
        $result_user = $stmt_user_update->execute([
            ':nom' => $nom,
            ':telephone' => $telephone,
            ':adresse' => $adresse,
            ':id_user' => $id_user
        ]);

        if ($result_prof && $result_user) {
            header('Location: profile.php');
            exit();
        } else {
            echo "Échec de la mise à jour.";
            exit();
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        exit();
    }
}

header('Location: profile.php');
exit();
?>
