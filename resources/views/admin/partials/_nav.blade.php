<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a style="color: #fff" class="navbar-brand brand-logo" href="{{ route('admin.home') }}">Cars Bomb</a>
      <a style="color: #fff" class="navbar-brand brand-logo-mini" href="{{ route('admin.home') }}">CB</a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
      </button>
      <div class="search-field d-none d-xl-block">
        <form class="d-flex align-items-center h-100" action="#" method="GET">
          <div class="input-group">
            <div class="input-group-prepend bg-transparent">
              <i class="input-group-text border-0 mdi mdi-magnify"></i>
            </div>
            <input type="hidden" name="page" value="{{ $page ?? '' }}">
            <input type="text" name="q" value="{{ $q ?? '' }}" class="form-control bg-transparent border-0" placeholder="Recherchez un truc ici">
          </div>
        </form>
      </div>
      <ul class="navbar-nav navbar-nav-right">

        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <div class="nav-profile-text">
              <p class="mb-1 text-black">!!! ADMIN NAME !!!</p>
            </div>
          </a>
          <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="profileDropdown" data-x-placement="bottom-end">
            <div class="p-2">
              <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                <span>Se deconnecter</span>
                <i class="mdi mdi-logout ml-1"></i>
              </a>
            </div>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>
  <!-- partial -->
<div class="container-fluid page-body-wrapper">