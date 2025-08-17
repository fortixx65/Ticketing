{{-- <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand">Le BonCube</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('catalogues.index')}}">Boutique</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Classement</a>
        </li>
      </ul>
      <span class="navbar-text">
        @auth
          {{ Auth::user()->name}}
        @endauth
        @guest
            <a href="{{ route('auth.login')}}">Se connecter</a>
        @endguest
      </span>
    </div>
  </div>
</nav> --}}
<nav class="top-app-bar navbar navbar-expand navbar-dark bg-dark">
  <div class="container-fluid px-4">
      <!-- Drawer toggle button-->
      <button class="btn btn-lg btn-icon order-1 order-lg-0" id="drawerToggle" href="javascript:void(0);"><i class="material-icons">menu</i></button>
      <!-- Navbar brand-->
      <a class="navbar-brand me-auto" href=""><div class="text-uppercase font-monospace">Ticket | Support</div></a>
      <!-- Navbar items-->
      <div class="d-flex align-items-center mx-3 me-lg-0">
          <!-- Navbar buttons-->
          <div class="d-flex">
             <!-- User profile dropdown-->
              <div class="dropdown">
                  <button class="btn btn-lg btn-icon dropdown-toggle" id="dropdownMenuProfile" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">person</i></button>
                  <ul class="dropdown-menu dropdown-menu-end mt-3" aria-labelledby="dropdownMenuProfile">
                      <li>
                          <a class="dropdown-item" href="#!">
                              <i class="material-icons leading-icon">person</i>
                              <div class="me-3">Profile</div>
                          </a>
                      </li>
                      <li>
                          <a class="dropdown-item" href="#!">
                              <i class="material-icons leading-icon">settings</i>
                              <div class="me-3">Settings</div>
                          </a>
                      </li>
                      <li>
                          <a class="dropdown-item" href="#!">
                              <i class="material-icons leading-icon">help</i>
                              <div class="me-3">Help</div>
                          </a>
                      </li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                          <a class="dropdown-item" href="#!">
                              <i class="material-icons leading-icon">logout</i>
                              <div class="me-3">Logout</div>
                          </a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</nav>