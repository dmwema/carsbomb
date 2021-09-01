       <!-- partial:partials/_sidebar.html -->
       <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-category">Menus</li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route("admin.joueurs") }}">
              <span class="icon-bg"><i class="mdi mdi-account-multiple-outline menu-icon"></i></span>
              <span class="menu-title">Joueurs</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route("admin.servers") }}">
              <span class="icon-bg"><i class="mdi mdi-server  menu-icon"></i></span>
              <span class="menu-title">Serveurs</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route("admin.codebombs") }}">
              <span class="icon-bg"><i class="mdi mdi-barcode-scan  menu-icon"></i></span>
              <span class="menu-title">Codes bomb</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route("admin.retraits") }}">
              <span class="icon-bg"><i class="mdi mdi-bell-ring-outline menu-icon"></i></span>
              <span class="menu-title">Demandes de retrait</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route("admin.cards") }}">
              <span class="icon-bg"><i class="mdi mdi-account-check menu-icon"></i></span>
              <span class="menu-title">Comptes à valider</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.depots') }}">
              <span class="icon-bg"><i class="mdi mdi-coin  menu-icon"></i></span>
              <span class="menu-title">Dépôts</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.transfers') }}">
              <span class="icon-bg"><i class="mdi mdi-coin  menu-icon"></i></span>
              <span class="menu-title">Transfers</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span class="icon-bg"><i class="mdi mdi-coin  menu-icon"></i></span>
              <span class="menu-title">Envoyer argent</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span class="icon-bg"><i class="mdi mdi-account-network menu-icon"></i></span>
              <span class="menu-title">Compte demo</span>
            </a>
          </li>
          <li class="nav-item sidebar-user-actions">
            <div class="sidebar-user-menu">
              <a href="#" class="nav-link"><i class="mdi mdi-logout menu-icon"></i>
                <span class="menu-title">Se déconnecter</span></a>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
              <div class="col-sm-12" style="display:none" id="download_message">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>Application en cours de développement.</strong><br>Merci de patienter
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>