
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

$sql = "SELECT * FROM professionnels WHERE email = :email";
$statement = $pdo->prepare($sql);
$statement->execute([':email' => $email]);
$pharmacie = $statement->fetch(PDO::FETCH_ASSOC);

if (!$pharmacie) {
  echo "pharmacie non trouvé.";
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php 
    require '../includes/professionnel/header.php'; 
  ?>
  <title>
    Profile
  </title>
 
</head>

<body class="g-sidenav-show bg-gray-100">
<div class="position-absolute w-100 min-height-300 top-0" style="background-image:url('../../assets/img/hero-bg.jpg'); background-position-y: 50%;">
    <span class="mask bg-primary opacity-6"></span>
  </div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
        <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Argon Dashboard 2</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <?php 
    require '../includes/professionnel/medecin/aside.php';
  ?>
    <div class="sidenav-footer mx-3 ">
      <div class="card card-plain shadow-none" id="sidenavCard">
        <img class="w-50 mx-auto" src="../assets/img/illustrations/icon-documentation.svg" alt="sidebar_illustration">
        <div class="card-body text-center p-3 w-100 pt-0">
          <div class="docs-info">
            <h6 class="mb-0">Need help?</h6>
            <p class="text-xs font-weight-bold mb-0">Please check our docs</p>
          </div>
        </div>
      </div>
      <a href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard" target="_blank" class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
      <a class="btn btn-primary btn-sm mb-0 w-100" href="https://www.creative-tim.com/product/argon-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a>
    </div>
  </aside>
  <div class="main-content position-relative max-height-vh-100 h-100">
    
    <div class="card shadow-lg mx-4 card-profile-bottom">
      <div class="card-body p-3">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="../../images/pharmacie.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
            <form method="post" class="shadow p-3 mt-5 form-w" action="profile_pharmacie.php">
              <h3>Edit Profile</h3>
              <hr>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" value="<?= $pharmacie['email'] ?>" name="email">
              </div>
              <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" class="form-control" value="<?= $pharmacie['nom'] ?>" name="nom">
              </div>
              <div class="mb-3">
                <label class="form-label">telephone</label>
                <input type="text" class="form-control" value="<?= $pharmacie['telephone'] ?>" name="telephone">
              </div>
              <div class="mb-3">
                <label class="form-label">adresse</label>
                <input type="text" class="form-control" value="<?= $pharmacie['adresse'] ?>" name="adresse">
              </div>
              <input type="hidden" value="<?php echo $pharmacie['id_professionnel']; ?>" name="id_professionnel">


              <button type="submit" class="btn btn-primary">
                Update</button>
            </form>
          </div>
        </div>
        
      </div>
      <?php require '../includes/footer.php'; ?>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>