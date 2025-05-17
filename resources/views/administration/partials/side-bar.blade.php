<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
    <div class="logo-header" data-background-color="">
  <a href="{{ route('administration.dashboard') }}" class="logo">
    <img
      src="{{ asset('administration/assets/img/logo_gestion_stock.png') }}"
      alt="Logo gestion stock"
      class="navbar-brand"
      height="100"
    />
  </a>

        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right"></i>
          </button>
          <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
          </button>
        </div>

        <button class="topbar-toggler more">
          <i class="gg-more-vertical-alt"></i>
        </button>
      </div>
      <!-- End Logo Header -->
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-secondary">
          <li class="nav-item {{ Route::is('administration.dashboard') ? 'active' : '' }}">
            <a href="{{ route('administration.dashboard') }}">
              <i class="fas fa-home"></i>
              <p>Tableau de bord</p>
            </a>
          </li>

          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Menu</h4>
          </li>

   <li class="nav-item {{ Route::is('produits.index') ? 'active' : '' }}">
    <a href="{{ route('produits.index') }}">
        <i class="fas fa-box-open"></i>
        <p>Produits</p>
    </a>
</li>

<li class="nav-item {{ Route::currentRouteName() == 'approvisionnement.index' ? 'active' : '' }}">
    <a href="{{ route('approvisionnement.index') }}">
        <i class="icon-briefcase"></i>
        <p>Approvisionnements</p>
    </a>
</li>

<li class="nav-item {{ Route::is('ventes.index') ? 'active' : '' }}">
    <a href="{{ route('ventes.index') }}">
        <i class="fas fa-cash-register"></i>
        <p>Ventes</p>
    </a>
</li>




<li class="nav-item {{ Route::is('approvisionnement.index') ? 'active' : '' }}">
    <a href="{{ route('approvisionnement.index') }}">
    <i class="fas fa-warehouse"></i>
        <p>Etat de Stock</p>
    </a>
</li>

<li class="nav-item {{ Route::is('approvisionnement.index') ? 'active' : '' }}">
    <a href="{{ route('approvisionnement.index') }}">
    <i class="fas fa-receipt"></i>
        <p>Gestion des Reçus</p>
    </a>
</li>
          </li>
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">
                  <i class="icon-logout"></i>
                  <p class="btn btn-danger text-light">Se deconnecter</p>
                </button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- End Sidebar -->
