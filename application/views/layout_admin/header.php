<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?=$page_title?></title>
    <!-- Favicons -->
  <link href="<?=base_url()?>assets/admin/assets/img/favicon-32x32.png" rel="icon">
  <link href="<?=base_url()?>assets/admin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?=base_url()?>assets/admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?=base_url()?>assets/admin/assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="<?=base_url()?>" class="logo d-flex align-items-center">
        <img src="<?=base_url()?>assets/admin/assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">RockNRoll Rentals</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-person"></i>
            <span class="d-none d-md-block dropdown-toggle ps-2"><?=$user['name']?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
         
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?=base_url('admin/Logout')?>">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="<?=base_url('admin/Dashboard')?>">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=base_url('admin/Booknew')?>">
          <i class="bi bi-card-list"></i>
          <span>Book New</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=base_url('admin/Availability')?>">
          <i class="bi bi-search"></i>
          <span>Availability</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=base_url('admin/Bookings')?>">
          <i class="bi bi-card-list"></i>
          <span>Bookings</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#" aria-expanded="true">
          <i class="bi bi-menu-button-wide"></i><span>Rentals</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?=base_url('admin/Bookings')?>">
              <i class="bi bi-card-list"></i><span>Online Bookings</span>
            </a>
          </li>
          <li>
            <a href="<?=base_url('admin/Payments')?>">
              <i class="bi bi-currency-rupee"></i><span>Payments</span>
            </a>
          </li>
          <li>
            <a href="<?=base_url('admin/Customers')?>">
              <i class="bi bi-people"></i><span>Customers</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Bikes-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Bikes</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Bikes-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?=base_url('admin/Bikes')?>">
              <i class="bi bi-bicycle"></i><span>Bikes</span>
            </a>
          </li>
          <li>
            <a href="<?=base_url('admin/Prices')?>">
              <i class="bi bi-list"></i><span>Prices</span>
            </a>
          </li>
          <li>
            <a href="<?=base_url('admin/Manufacturer')?>">
              <i class="bi bi-list"></i><span>Manufacturer</span>
            </a>
          </li>
          <li>
            <a href="<?=base_url('admin/Biketypes')?>">
              <i class="bi bi-list"></i><span>Bike Types</span>
            </a>
          </li>
          <li>
            <a href="<?=base_url('admin/Paymentmodes')?>">
              <i class="bi bi-list"></i><span>Payment Modes</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Admin</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?=base_url('admin/Users')?>">
              <i class="bi bi-people"></i><span>Users</span>
            </a>
          </li>
          <li>
            <a href="<?=base_url('admin/Holidays')?>">
              <i class="bi bi-calendar"></i><span>Holidays</span>
            </a>
          </li>
          <li>
            <a href="<?=base_url('admin/Publicholidays')?>">
              <i class="bi bi-calendar2-day"></i><span>Public Holidays</span>
            </a>
          </li>
          <li>
            <a href="<?=base_url('admin/Contact')?>">
              <i class="bi bi-person-lines-fill"></i><span>Contact</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->
    

    </ul>

  </aside><!-- End Sidebar-->