<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
  
      <img src="{{ asset('src/img/logo.png')}}" alt="" width="60">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item " id="nav-dashboard">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item " id="nav-bencana">
        <a class="nav-link" href="{{ route('bencana') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Data Bencana</span></a>
    </li>

    <li class="nav-item  " id="nav-master">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Master</span>
        </a>
        <div id="collapseTwo" class="collapse " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" id="nav-kecamatan" href="{{ route('kecamatan.index') }}">Kecamatan</a>
                <a class="collapse-item" id="nav-kelurahan" href="{{ route('kelurahan.index') }}">Kelurahan</a>
                <a class="collapse-item" id="nav-jenis" href="{{ route('jenis.index') }}">Jenis Bencana</a>
            </div>
        </div>
    </li>

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>





</ul>