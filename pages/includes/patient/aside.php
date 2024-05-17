<div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <h1 class="logo me-auto"><a href="index.html">Medilab</a></h1>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link " href="dashboard.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="profile.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item" id="accordionRental">
                    <a class=" nav-link " data-bs-toggle="collapse" data-bs-target="#collapseOne"
                        aria-expanded="false" aria-controls="collapseOne">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-collection text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Service demander</span>
                    </a>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                        data-bs-parent="#accordionRental" style="">
                        <a class="nav-link " href="labolistdemande.php">

                            <span class="nav-link-text ms-4 text-dark">Laboratoire demandes</span>
                        </a>
                        <a class="nav-link " href="pharmacielistdemande.php">

                            <span class="nav-link-text ms-4 text-dark">Pharmacie demandes</span>
                        </a>
                        <a class="nav-link " href="medecinlistdemande.php">

                            <span class="nav-link-text ms-4 text-dark">Médecin demandes</span>
                        </a>
                        <a class="nav-link " href="infirmierlistdemande.php">

                            <span class="nav-link-text ms-4 text-dark">Infirmier demandes</span>
                        </a>
                    </div>
                </li>
        <li class="nav-item">
          <a class="nav-link " href="medecin.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-app text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Médecins</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="infirmier.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Infirmiers</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="pharmacie.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-app text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Pharmacies</span>
          </a>
        </li>
      
        <li class="nav-item">
          <a class="nav-link " href="labo.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-app text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Laboratoires Médicaux</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
      <div class="card card-plain shadow-none" id="sidenavCard">
        
        <div class="card-body text-center p-3 w-100 pt-0">
          <div class="docs-info">
            
          </div>
        </div>
      </div>
     
      <a class="btn btn-primary btn-sm mb-0 w-100" href="../connexion/deconnexion.php" type="button">Se déconnecter</a>
    </div>
  </aside>