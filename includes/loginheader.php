<?php
	header('Content-Type: text/html; charset=ISO-8859-1');
	error_reporting(E_ALL ^E_NOTICE ^E_WARNING);
	ob_start();
	session_start();
	
	global $happi_admin_loggedin;
	global $admin_id;
	global $error;
	global $success;
	global $message;
	global $rUrl;
	global $cUrl;
	global $host;
	global $base_url;
	global $db;
	global $session_expire_time;
	global $session_remember_expire_time;
	
	$session_expire_time = 60 * 60 * 24 * 2;//2 days
	$session_remember_expire_time = 60 * 60 * 24 * 2;//2 days
	$host = $_SERVER['HTTP_HOST'];
	
	if(strpos($_SERVER['SERVER_NAME'], '13.233.114.60') !== false)
		$base_url = 'http://' . $host . '/happi-admin/';
	else
		$base_url = 'http://' . $host . '/websites/happi/admin/';
	
	//echo $base_url;exit;
	
	$cUrl = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	
	include('includes/database.php');
	$happi_admin_loggedin = (isset($_SESSION['happi_admin_loggedin']['id']) && $_SESSION['happi_admin_loggedin']['id'] != '') ? TRUE : FALSE;
	
	//echo $happi_admin_loggedin;
	if($happi_admin_loggedin)
	{
		
		if(isset($_SESSION['session_expire_time']))
			$session_expire_time = $_SESSION['session_expire_time'];	
			
		if(isset($_SESSION['last_activity']) && ((time() - $_SESSION['last_activity']) > $session_expire_time))
		{
			unset($_SESSION['happi_admin_loggedin']);	
				
		    //last request was more than 30 minutes ago
		    session_unset();     // unset $_SESSION variable for the run-time 
		    session_destroy();   // destroy session data in storage
		    
		    header("Location:index.php");
			exit;
		}
		
		$_SESSION['last_activity'] = time(); // update last activity time stamp	
			
		$admin_id = $_SESSION['happi_admin_loggedin']['id'];
		$user_type = $_SESSION['happi_admin_loggedin']['user_type'];
		
	}else{
		header("Location:index.php");
			exit;
	}
	
	$error = (isset($_SESSION['error']) && $_SESSION['error'] != '') ? $_SESSION['error'] : '';
	$success = (isset($_SESSION['success']) && $_SESSION['success'] != '') ? $_SESSION['success'] : '';
	$message = (isset($_SESSION['message']) && $_SESSION['message'] != '') ? $_SESSION['message'] : '';
	
	if(isset($_SESSION['error']))
		unset($_SESSION['error']);
	if(isset($_SESSION['success']))
		unset($_SESSION['success']);
	if(isset($_SESSION['message']))
		unset($_SESSION['message']);
	
	if(isset($_GET['rUrl']) && $_GET['rUrl'] != '')
	{
		$rUrl = $_GET['rUrl'];
		$_SESSION['rUrl'] = $rUrl;
	}
	else if(isset($_SESSION['rUrl']) && $_SESSION['rUrl'] != '')
	{
		$rUrl = $_SESSION['rUrl'];
		unset($_SESSION['rUrl']);
	}
	
	if(strpos($rUrl,'http://') === false)
	{
		$rUrl = 'http://' . $rUrl;
	}
	
	if(isset($_GET['msg']) && $_GET['msg'] != '')
	{
		if($_GET['msg'] == 'logout')
		{
			$message = 'You are loggedout successfully';
		}
		else if($_GET['msg'] == 'expire')
		{
			$message = 'Your session was expired. Please login again to continue.';
		}
	}
	
	
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="<?php echo $base_url;?>images/images1.jpg" type="image/x-icon">
    <title>Happi Dashboard</title>
    <!-- Favicon icon -->
  
    <!-- Custom CSS -->
    <link
      rel="stylesheet"
      type="text/css"
      href="<?php echo $base_url;?>assets/extra-libs/multicheck/multicheck.css"
    />
    <link
      href="<?php echo $base_url;?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css"
      rel="stylesheet"
    />
    <link href="<?php echo $base_url;?>dist/css/style.min.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	 <script src="<?php echo $base_url;?>assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo $base_url;?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo $base_url;?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo $base_url;?>assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo $base_url;?>dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo $base_url;?>dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo $base_url;?>dist/js/custom.min.js"></script>
    <!-- this page js -->
    <script src="<?php echo $base_url;?>assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="<?php echo $base_url;?>assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="<?php echo $base_url;?>assets/extra-libs/DataTables/datatables.min.js"></script>
  </head>

  <body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div
      id="main-wrapper"
      data-layout="vertical"
      data-navbarbg="skin5"
      data-sidebartype="full"
      data-sidebar-position="absolute"
      data-header-position="absolute"
      data-boxed-layout="full"
    >
      <!-- ============================================================== -->
      <!-- Topbar header - style you can find in pages.scss -->
      <!-- ============================================================== -->
      <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
         <div class="navbar-header" data-logobg="skin5">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="<?php echo $base_url;?>dashboard.php">
              <!-- Logo icon -->
             
              <!--End Logo icon -->
              <!-- Logo text -->
              <span class="logo-text ms-2">
                <!-- dark Logo text -->
                <img
                  src="<?php echo $base_url;?>images/images.jpg"
                  alt="homepage"
                  class="light-logo" style="width:25%;"
                />
              </span>
              <!-- Logo icon -->
              <!-- <b class="logo-icon"> -->
              <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
              <!-- Dark Logo icon -->
              <!-- <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

              <!-- </b> -->
              <!--End Logo icon -->
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a
              class="nav-toggler waves-effect waves-light d-block d-md-none"
              href="javascript:void(0)"
              ><i class="ti-menu ti-close"></i
            ></a>
          </div>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <div
            class="navbar-collapse collapse"
            id="navbarSupportedContent"
            data-navbarbg="skin5"
          >
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-start me-auto">
              <!--<li class="nav-item d-none d-lg-block">
                <a
                  class="nav-link sidebartoggler waves-effect waves-light"
                  href="javascript:void(0)"
                  data-sidebartype="mini-sidebar"
                  ><i class="mdi mdi-menu font-24"></i
                ></a>
              </li>-->
			
			 
            </ul>
			<ul class="navbar-nav">
			<li class="nav-item " style="color:#fff;"><?php echo date('d-m-Y');?>
			</li>
			</ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-end">
              <!-- ============================================================== -->
              <!-- Comment -->
              <!-- ============================================================== -->
             <!-- <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i class="mdi mdi-bell font-24"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider" /></li>
                  <li>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </li>
                </ul>
              </li>
             
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle waves-effect waves-dark"
                  href="#"
                  id="2"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i class="font-24 mdi mdi-comment-processing"></i>
                </a>
                <ul
                  class="
                    dropdown-menu dropdown-menu-end
                    mailbox
                    animated
                    bounceInDown
                  "
                  aria-labelledby="2"
                >
                  <ul class="list-style-none">
                    <li>
                      <div class="">
                        
                        <a href="javascript:void(0)" class="link border-top">
                          <div class="d-flex no-block align-items-center p-10">
                            <span
                              class="
                                btn btn-success btn-circle
                                d-flex
                                align-items-center
                                justify-content-center
                              "
                              ><i class="mdi mdi-calendar text-white fs-4"></i
                            ></span>
                            <div class="ms-2">
                              <h5 class="mb-0">Event today</h5>
                              <span class="mail-desc"
                                >Just a reminder that event</span
                              >
                            </div>
                          </div>
                        </a>
                        
                       
                        
                       
                      </div>
                    </li>
                  </ul>
                </ul>
              </li>-->
              <!-- ============================================================== -->
              <!-- End Messages -->
              <!-- ============================================================== -->

              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
              <li class="nav-item dropdown">
                <a
                  class="
                    nav-link
                    dropdown-toggle
                    text-muted
                    waves-effect waves-dark
                    pro-pic
                  "
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <img
                    src="<?php echo $base_url;?>images/images1.jpg"
                    alt="Admin"
                    class="rounded-circle"
                    width="31"
                  />
                </a>
                <ul
                  class="dropdown-menu dropdown-menu-end user-dd animated"
                  aria-labelledby="navbarDropdown"
                >
                  <a class="dropdown-item" href="dashboard.php"
                    ><i class="mdi mdi-wallet me-1 ms-1"></i> Credit Card</a
                  >
                  <a class="dropdown-item" href="bajaj_fn.php"
                    ><i class="mdi mdi-wallet me-1 ms-1"></i> Finance</a
                  >
                  <!--<a class="dropdown-item" href="javascript:void(0)"
                    ><i class="mdi mdi-email me-1 ms-1"></i> Inbox</a
                  >
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="javascript:void(0)"
                    ><i class="mdi mdi-settings me-1 ms-1"></i> Account
                    Setting</a
                  >
                  <div class="dropdown-divider"></div>-->
                  <a class="dropdown-item" href="<?php echo $base_url;?>logout.php"
                    ><i class="fa fa-power-off me-1 ms-1"></i> Logout</a
                  >
                  <div class="dropdown-divider"></div>
                  <!--<div class="ps-4 p-10">
                    <a
                      href="javascript:void(0)"
                      class="btn btn-sm btn-success btn-rounded text-white"
                      >View Profile</a
                    >
                  </div>-->
                </ul>
              </li>
              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
            </ul>
          </div>
        </nav>
      </header>
<style>
.page-wrapper{
	margin-left: 0px !important;
}
.msg-login{
	text-align: center;
}
.has-error{
	color: red;
}
.has-success{
	color: green;
}
.page-wrapper{ background: #fff;}
</style>

		