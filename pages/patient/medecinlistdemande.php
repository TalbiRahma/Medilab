
<?php
require '../includes/connect.php';
$pdo = connect();

session_start();
$email = $_SESSION['email'];

// Récupérer l'ID du patient
$requete_patient = "SELECT * FROM patients WHERE email='$email'";
$statement_patient = $pdo->query($requete_patient);
$user = $statement_patient->fetch(PDO::FETCH_ASSOC);
//var_dump($user);
$id_patient = $user['id_patient'];

// Récupérer toutes les demandes de l'utilisateur avec le type de professionnel "laboratoire"
$requete_demandes = "SELECT demandes.*, professionnels.* 
                    FROM demandes 
                    INNER JOIN professionnels ON demandes.id_professionnel = professionnels.id_professionnel 
                    WHERE demandes.id_patient=$id_patient 
                    AND professionnels.type_professionnel='medecin'";
$statement_demandes = $pdo->query($requete_demandes);
$demandes = $statement_demandes->fetchAll(PDO::FETCH_ASSOC);

// Parcourir chaque demande et afficher les données du professionnel
foreach ($demandes as $demande) {
    // Données de la demande
    $id_pro = $demande['id_professionnel'];
    $requete_professionnel = "SELECT * FROM professionnels WHERE id_professionnel=$id_pro  AND type_professionnel='medecin' " ;
    $statement_professionnel = $pdo->query($requete_professionnel);
    $professionnels = $statement_professionnel->fetchAll(PDO::FETCH_ASSOC);
   // var_dump($professionnels);
}

?>

<!DOCTYPE html>
<html lang="en"> 

<head>
<?php 
    require '../includes/patient/header.php'; 
  ?>
  <title>
    meddemandelist
  </title>

</head>

<body class="g-sidenav-show   bg-gray-100">
<?php 
    require '../includes/patient/aside.php';
  ?>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">medecin liste demande</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">medecin liste demande</h6>
        </nav>
       
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Medecins demandes</h6>
              
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Image</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom et Prenom Medecin</th>
                      
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Adresse</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Etat Demande</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Voir plus</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach($demandes as $index =>$d){
                      $index++;
                      $id=$d['id_demande'];
                     
                      echo '<tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            
                            <div class="d-flex flex-column justify-content-center">
                              '.$index.'
                            </div>
                          </div>
                        </td>
                        <td>
                        <div>
                              <img src="../../images/medecin.jpg" class="avatar avatar-sm me-3" alt="user1">
                            </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <div class="d-flex flex-column justify-content-center">';
                        foreach($professionnels as $pro){
                        echo '
                          <p class="text-xs font-weight-bold mb-0">'.$pro['nom'].' '.$pro['prenom'].'</p>';
                        } 
                        echo '</div>
                        </td>
                        
                        <td >
                        <div class="d-flex flex-column justify-content-center">
                          <span class="text-secondary text-xs font-weight-bold">'.$user['adresse'].'</span>
                        </div>
                        </td>
                        <td >';
                        if($d['etat_demande']=="refuse"){
                          echo ' <span class="badge bg-gradient-danger">'.$d['etat_demande'].'</span>';
                        }else if($d['etat_demande']=="accepte") {
                          echo '  <span class="badge bg-gradient-success">'.$d['etat_demande'].'</span>';
                        }else{
                          echo '<span class="badge bg-gradient-info">'.$d['etat_demande'].'</span>';
                        }
                        echo '
                        <td class="align-middle">
                        <div class="d-flex flex-column justify-content-center">
                          <a href="medecindemandedetails.php?id='.$id.'" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Voir plus
                          </a>
                        </div>
                        </td>
                      </tr>';
                      
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
     
      <?php require '../includes/footer.php'; ?>
    </div>
  </main>

  <!--   Core JS Files   -->
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
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../../dashboard/assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>