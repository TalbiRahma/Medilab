<?php
require '../includes/connect.php';
$pdo = connect() ;
$sql = 'SELECT * FROM professionnels WHERE type_professionnel="medecin" ';
$statement = $pdo->query($sql);
$medecins = $statement->fetchAll(PDO::FETCH_ASSOC);
// var_dump($medecins);
 session_start();
// var_dump($_SESSION);
 $email = $_SESSION['email'];

 $requette = "SELECT * FROM patients WHERE email='$email' ";
 $statmnt = $pdo->query($requette);
 $user = $statmnt->fetch(PDO::FETCH_ASSOC);
// var_dump($user);
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php 
    require '../includes/patient/header.php'; 
  ?>
  <title>
    medecin list
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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Medecins</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Medecins</h6>
        </nav>
        
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Médecin</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Image</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom & Prénom</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Spécialiter</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Adresse</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Demande Service</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Voir plus</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    foreach($medecins as $index =>$med){
                      $index++;
                      $id=$med['id_professionnel'];
                     
                      echo '
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          
                          <div class="d-flex flex-column justify-content-center">
                            
                          </div>
                        </div>
                      </td>
                      <td>
                      <div>
                            <img src="../../images/medecin.jpg" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-xs font-weight-bold mb-0">'.$med['nom'].' '.$med['prenom'].'</p>
                         
                      </div>
                      </td>
                      <td >
                      <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">'.$med['specialite'].'</h6>
                      </div>
                      </td>
                      <td >
                      <div class="d-flex flex-column justify-content-center">
                        <span class="text-secondary text-xs font-weight-bold">'.$med['adresse'].'</span>
                      </div>
                      </td>
                      <td >
                      
                      <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-form">Demander</button>
                      
                      </td>
                      <td class="align-middle">
                      <div class="d-flex flex-column justify-content-center">
                        <a href="medecindetails.php?id='.$id.'" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Voir Plus
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

<div class="col-md-4">
<?php
  foreach($medecins as $med){ 
    echo '
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card card-plain">
              <div class="card-header pb-0 text-left">
                <h3 class="font-weight-bolder text-info text-gradient">'.$med['nom'].' '.$med['prenom'].'</h3>
                <p class="mb-0">Remplir le formulaire de votre demande</p>
              </div> 
              <div class="card-body">
                <form role="form text-left" action="medecindemande.php" method="POST">
                <input type="hidden" name="id_patient" value="'.$user['id_patient'].'"/>
                        <input type="hidden" name="id_professionnel" value="'.$med['id_professionnel'].'"/>
                  <label>Nom</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="nom" placeholder="nom" aria-label="nom" aria-describedby="email-addon" value="'.$user['nom'].'">
                  </div>
                  <label>Prénom</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" 
                    name="prenom"
                    placeholder="Prenom" aria-label="prenom" aria-describedby="prenom" value="'.$user['prenom'].'">
                  </div>
                  <label>Numéro téléphone</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" 
                    name="telephone"
                    placeholder="telephone" aria-label="telephone" aria-describedby="telephone" value="'.$user['telephone'].'">
                  </div>
                  <label>Email</label>
                  <div class="input-group mb-3">
                    <input type="email" class="form-control" 
                    name="email"
                    placeholder="email" aria-label="email" aria-describedby="email" value="'.$user['email'].'">
                  </div>
                  
                  <div class="input-group mb-3">
                  <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="lieu_demande" id="customRadio1" value="domicile">
                    <label class="custom-control-label" for="customRadio1">à domicile</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="lieu_demande" id="customRadio2" value="cabinet">
                    <label class="custom-control-label" for="customRadio2">Cabinet</label>
                  </div>
                  </div>
                  <div class="form-group">
                      <label for="example-date-input" class="form-control-label">Date</label>
                      <input class="form-control" type="date" name="date_souhaitee"value="2018-11-23" id="example-date-input">
                  </div>
                  <div class="form-group">
                    <label for="example-time-input" class="form-control-label">Time</label>
                    <input class="form-control" type="time" name="heure_souhaitee"value="10:30:00" id="example-time-input">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Description</label>
                  <textarea name="description"class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Confirmer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
  ';
 }
?>
</div>

</html>

