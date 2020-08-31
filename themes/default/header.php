<?php
//count pending vouchers
    $no_of_pending_voucher=$main->CountDataCondition("status","vouchers","Pending");
?>

<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo BASE_URL ?>index.php?dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Voucher System</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo BASE_URL ?>index.php?dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span> <span class="badge badge-danger right"><?php echo $no_of_pending_voucher;?></span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      
      
      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>
     
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#NavReport" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-clipboard "></i>
          <span>Reports</span>
        </a>
        <div id="NavReport" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item " href="<?php echo BASE_URL ?>index.php?VoucherSummery">Voucher Summery</a>
          </div>
        </div>
      </li>
        <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Setting</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item " href="<?php echo BASE_URL ?>index.php?partylist">Party List</a>
            <a class="collapse-item " href="<?php echo BASE_URL ?>index.php?partyname">Party Name</a>
            <a class="collapse-item " href="<?php echo BASE_URL ?>index.php?buildinglist">Building</a>
            <a class="collapse-item " href="<?php echo BASE_URL ?>index.php?apartmentlist">Apartment</a>
            <a class="collapse-item " href="<?php echo BASE_URL ?>index.php?partyapartmentlist">Party Apartments</a>
            
                 <?php
      if(isSuperAdmin()):
          ?>
            <a class="collapse-item " href="<?php echo BASE_URL ?>index.php?voucheraccount">Voucher Account</a>
            <a class="collapse-item " href="<?php echo BASE_URL ?>index.php?amounttype">Amount Type</a>
            <a class="collapse-item " href="<?php echo BASE_URL ?>index.php?setting">Setting</a>
            <a class="collapse-item " href="<?php echo BASE_URL ?>index.php?users">Users</a>
        <?php
      endif;
      ?>     
          </div>
        </div>
      </li>
        <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
     

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
    
    
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        
         <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo (isset($_SESSION['userName']))?$_SESSION['userName']:"";?></span>
                <img class="img-profile rounded-circle" src="<?php echo BASE_URL ?>/uploads/profile.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo BASE_URL; ?>logout.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
      
        