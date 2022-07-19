 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{'/home'}}" class="brand-link">
      <img src="../../dist/img/index.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Karavya Soltions</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
         
        </div>
      </div>

      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{'/home'}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
               
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-user" aria-hidden="true"></i>
              <p>
                User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('user')}}" class="nav-link">
                  <i class="nav-icon fa fa-list" aria-hidden="true"></i>
                  <p>List users</p>
                </a>
              </li>
              <li class="nav-item" >
               <a href="{{route('add')}}" class="nav-link">
                  <i class="nav-icon fa fa-user-plus" aria-hidden="true"></i>
                  <p>Add user</p>
                </a>
              </li>
              
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-briefcase" aria-hidden="true"></i>
              <p>
                Project
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('listing_project')}}" class="nav-link">
                  <i class="nav-icon fa fa-list" aria-hidden="true"></i>
                  <p>List projects</p>
                </a>
              </li>
              <li class="nav-item" >
                <a href="{{route('add_project')}}" class="nav-link">
                  <i class="nav-icon fa fa-plus-circle" aria-hidden="true"></i>

                  <p>Add project</p>
                </a>
              </li>
              
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
             <i class="nav-icon fa fa-tasks" aria-hidden="true"></i>
              <p>
                Tasks
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{route('listing_task')}}" class="nav-link">
                  <i class="nav-icon fa fa-list" aria-hidden="true"></i>
                  <p>List task</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{route('add_task')}}" class="nav-link">
                  <i class="nav-icon fa fa-plus-circle" aria-hidden="true"></i>
                  <p>Add task</p>
                </a> 
              </li>
              
              </ul>
          </li>

          <li class="nav-item">
            <a href='{{route('change_password')}}' class="nav-link">
            <i class="nav-icon fa fa-key" aria-hidden="true"></i>
              <p>
                Change password
                
              </p>
            </a>
          </li>
         
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>