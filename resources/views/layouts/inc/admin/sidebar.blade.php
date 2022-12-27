@include('layouts.inc.admin.navbar')

<nav class="sidebar sidebar-offcanvas nav-pills sidebar-fill bg-dark shadow-lg" id="sidebar">
    <ul class="nav mt-4 text-light">
      <li class="nav-item border-0">
        <a class="nav-link" href="{{url('/home')}}">
          <i class="mdi mdi-home menu-icon" style="color:white"></i>
          <span class="menu-title text-light">Dashboard</span>
        </a>
      </li>
@role('admin')
      <li class="nav-item border-0">
        <a class="nav-item nav-link " href="{{url('/admin/categories')}}">
            <i class="bi bi-calendar3"></i>
          <span class="menu-title text-light ms-4">Cakes</span>
        </a>
      </li>
      @endrole
      <li class="nav-item border-0">
        <a class="nav-link" href="{{url('/orders')}}">
            <i class="bi bi-bag-plus"></i>
          <span class="menu-title text-light ms-4">Cake Orders</span>
        </a>
      </li>
      <hr>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end bg-dark shadow-lg">
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src={{asset("/admin/images/faces/face10.jpg")}} class="rounded-pill" alt="profile"/>
              <span class="nav-profile-name text-light">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
               <i class="mdi mdi-logout text-primary"></i>{{ __('Logout') }}
               </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </ul>
  </nav>
