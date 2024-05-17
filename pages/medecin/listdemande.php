
<?php
require '../includes/protect.php';
require '../includes/connect.php';
$pdo = connect();

session_start();
$email = $_SESSION['email'];

// Récupérer l'ID du professionnel
$requete_professionnel = "SELECT * FROM professionnels WHERE email='$email'";
$statement_professionnel = $pdo->query($requete_professionnel);
$professionnel = $statement_professionnel->fetch(PDO::FETCH_ASSOC);
$id_professionnel = $professionnel['id_professionnel'];

// Récupérer toutes les demandes de ce professionnel
$requete_demandes = "SELECT demandes.*, patients.* 
                    FROM demandes 
                    INNER JOIN patients ON demandes.id_patient = patients.id_patient
                    WHERE demandes.id_professionnel=$id_professionnel";
$statement_demandes = $pdo->query($requete_demandes);
$demandes = $statement_demandes->fetchAll(PDO::FETCH_ASSOC);

// Afficher les données des demandes et des patients associés
foreach ($demandes as $demande) {
    // Données de la demande
    //var_dump($demande);

    // Données du patient associé à la demande
    $id_patient = $demande['id_patient'];
    $requete_patient = "SELECT * FROM patients WHERE id_patient=$id_patient";
    $statement_patient = $pdo->query($requete_patient);
    $patient = $statement_patient->fetch(PDO::FETCH_ASSOC);
    //var_dump($patient);
}
?>

<!DOCTYPE html>
<html lang="en"> 

<head>
<?php 
      require '../includes/professionnel/header.php'; 
  ?>
  <title>
    meddemandelist
  </title>

</head>

<body class="g-sidenav-show   bg-gray-100">
<?php 
     require '../includes/professionnel/medecin/aside.php';
  ?>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">liste demande</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">liste demande</h6>
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
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom et Prenom de patient</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lieu</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date & Heure</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Etat</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Reponse</th>
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
                      
                        echo '
                          <p class="text-xs font-weight-bold mb-0">'.$patient['nom'].' '.$patient['prenom'].'</p>';
                        
                        echo '</div>
                        </td>
                        
                        <td >
                        <div class="d-flex flex-column justify-content-center">
                          <span class="text-secondary text-xs font-weight-bold">'.$d['lieu_demande'].'</span>
                        </div>
                        </td>
                        <td >
                        <p class="text-xs font-weight-bold mb-0">'.$d['date_souhaitee'].' '.$d['heure_souhaitee'].'</p>
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
                        </td>
                        <td >';
                        if($d['etat_demande']=="refuse"){
                          echo '<a href="accepterdemande.php?id='.$id.'" class="btn btn-success">Accepter</a>';
                        }else if($d['etat_demande']=="accepte") {
                          echo '<a href="refuserdemande.php?id='.$id.'"  class="btn btn-danger">Refuser</a>';
                        }else{
                          echo '<a href="accepterdemande.php?id='.$id.'" class="btn btn-success">Accepter</a>
                          <a href="refuserdemande.php?id='.$id.'"  class="btn btn-danger">Refuser</a>';
                        }
                        echo '
                        </td>
                        <td class="align-middle">
                        <div class="d-flex flex-column justify-content-center">
                          <a href="demandedetails.php?id='.$id.'" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
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