<?php
require '../includes/protect.php';
$iddemande=$_GET['id'];
require '../includes/connect.php';
$pdo = connect() ;
$sql_demande = "SELECT * FROM demandes WHERE id_demande=$iddemande ";
$statement_demande = $pdo->query($sql_demande);
$demande = $statement_demande->fetch(PDO::FETCH_ASSOC);
//var_dump($demande);

$id_patient = $demande['id_patient'];
$sql_patient = "SELECT * FROM patients WHERE id_patient=$id_patient ";
$statement_patient = $pdo->query($sql_patient); 
$patient = $statement_patient->fetch(PDO::FETCH_ASSOC);
//var_dump($patient);


?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php 
    require '../includes/professionnel/header.php'; 
  ?>
  <title>
    meddemandedetails
  </title>
  
</head>

<body class="g-sidenav-show bg-gray-100">
  <div class="position-absolute w-100 min-height-300 top-0" style="background-image: url('../../assets/img/hero-bg.jpg'); background-position-y: 50%;">
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
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg bg-transparent shadow-none position-absolute px-4 w-100 z-index-2 mt-n11">
      <div class="container-fluid py-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-white opacity-5" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">demande details</li>
          </ol>
          <h6 class="text-white font-weight-bolder ms-2">demande details</h6>
        </nav>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="card shadow-lg mx-4 card-profile-bottom">
      <div class="card-body p-3">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="../../images/medecin.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div> 
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?php 
                  echo $patient['nom'].' '.$patient['prenom'];
                ?>
              </h5>
              
            </div>
          </div>
        
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">INFORMATIONS SUR LA DEMANDE</p>

              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nom et prenom de patient</label>
                    <p class="mb-0 font-weight-bold text-sm"><?php echo $patient['nom'].' '.$patient['prenom']; ?></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Adresse e-mail</label>
                    <p class="mb-0 font-weight-bold text-sm"><?php echo $patient['email']; ?></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Telephone</label>
                    <p class="mb-0 font-weight-bold text-sm"><?php echo $patient['telephone']; ?></p>
                  </div>
                </div> 
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Adresse</label>
                    <p class="mb-0 font-weight-bold text-sm"><?php echo $patient['adresse']; ?></p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">lieu</label>
                    <p class="mb-0 font-weight-bold text-sm"><?php echo $demande['lieu_demande']; ?></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Date & Heure</label>
                    <p class="mb-0 font-weight-bold text-sm"><?php echo $demande['date_souhaitee'].'   '.$demande['heure_souhaitee']; ?></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Description</label>
                    <p class="mb-0 font-weight-bold text-sm"><?php echo $demande['description']; ?></p>
                  </div>
                </div>
              </div>
            </div>
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
