<?php
require '../includes/protect.php';
require '../includes/connect.php';
$pdo = connect();
session_start();

// Assurez-vous que l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
  header('Location: ../connexion/connexion.html');
  exit();
}

$email = $_SESSION['email'];

$sql = "SELECT * FROM patients WHERE email = :email";
$statement = $pdo->prepare($sql);
$statement->execute([':email' => $email]);
$patient = $statement->fetch(PDO::FETCH_ASSOC);

if (!$patient) {
  echo "Patient non trouvé.";
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require '../includes/patient/header.php';
  ?>
  <title>Profile du Patient</title>
</head>

<body class="g-sidenav-show bg-gray-100">
  <?php
  require '../includes/patient/aside.php';
  ?>
  <main class="main-content position-relative border-radius-lg ">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Profile</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Profile</h6>
        </nav>
      </div>
    </nav>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <form method="post" class="shadow p-3 mt-5 form-w" action="profile_patient.php">
              <h3>Edit Profile</h3>
              <hr>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" value="<?= $patient['email'] ?>" name="email">
              </div>
              <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" class="form-control" value="<?= $patient['nom'] ?>" name="nom">
              </div>
              <div class="mb-3">
                <label class="form-label">Prénom</label>
                <input type="text" class="form-control" value="<?= $patient['prenom'] ?>" name="prenom">
              </div>
              <div class="mb-3">
                <label class="form-label">telephone</label>
                <input type="text" class="form-control" value="<?= $patient['telephone'] ?>" name="telephone">
              </div>
              <div class="mb-3">
                <label class="form-label">adresse</label>
                <input type="text" class="form-control" value="<?= $patient['adresse'] ?>" name="adresse">
              </div>
              <input type="hidden" value="<?php echo $patient['id_patient']; ?>" name="id_patient">
              <button type="submit" class="btn btn-primary">
                Update</button>
            </form>
          </div>
        </div>
      </div>
      <?php require '../includes/footer.php'; ?>
    </div>
  </main>

  <!-- Core JS Files -->
  <script src="../../dashboard/assets/js/core/popper.min.js"></script>
  <script src="../../dashboard/assets/js/core/bootstrap.min.js"></script>
  <script src="../../dashboard/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../../dashboard/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="../../dashboard/assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>

