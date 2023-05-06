<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex overflow-hidden">
      <div class="image">
        @php
          $userPhoto = Auth::user()->photo_path ? asset(Auth::user()->photo_path) : "https://ui-avatars.com/api/?name=" . Auth::user()->name . "&background=random"
        @endphp
        <img src="{{ $userPhoto }}" class="img-circle" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ route('admin.profile') }}" class="d-block">
          {{ Auth::user()->name }}
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
      @if(Auth::user()->role_id == 1)
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-folder-open"></i>
            <p>
              Data Management
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item ml-3">
              <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">
                <i class="fas fa-users mr-2"></i>
                <p>User Management</p>
              </a>
            </li>
            <li class="nav-item ml-3">
              <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->is('admin/roles') ? 'active' : '' }}">
                <i class="fas fa-users mr-2"></i>
                <p>Roles Management</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.activity.index') }}" class="nav-link {{ Route::is('admin.activity.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-solid fa-file-contract"></i>
            <p>
              Activity (Kegiatan)
            </p>
          </a>
        </li>
        <li class="nav-header">PROFILE SECTION</li>
        <li class="nav-item">
          <a href="{{ route('admin.profile') }}" class="nav-link {{ request()->is('admin/profile') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-alt"></i>
            <p>
              Profile
            </p>
          </a>
        </li>
        @else
        <li class="nav-item">
          <a href="{{ route('user.dashboard') }}" class="nav-link {{ request()->is('user/dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('user.activity.index') }}" class="nav-link {{ Route::is('user.activity.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-solid fa-file-contract"></i>
            <p>
              Activity (Kegiatan)
            </p>
          </a>
        </li>
        <li class="nav-header">PROFILE SECTION</li>
        <li class="nav-item">
          <a href="{{ route('user.profile') }}" class="nav-link {{ request()->is('user/profile') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-alt"></i>
            <p>
              Profile
            </p>
          </a>
        </li>
        @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>