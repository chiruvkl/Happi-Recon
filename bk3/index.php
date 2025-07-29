<?php
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
	
	$session_expire_time = 60 * 60 * 2;//2 hours
	$session_remember_expire_time = 60 * 60 * 24 * 2;//2 days
	$host = $_SERVER['HTTP_HOST'];
	
	if(strpos($_SERVER['SERVER_NAME'], 'etwomensforum.com') !== false)
		$base_url = 'http://' . $host . '/admin/';
	else
		$base_url = 'http://' . $host . '/debates/admin/';
	
	$cUrl = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	
	$happi_admin_loggedin = (isset($_SESSION['happi_admin_loggedin']['id']) && $_SESSION['happi_admin_loggedin']['id'] != '') ? TRUE : FALSE;
	
	if($happi_admin_loggedin)
	{
		$admin_id = $_SESSION['happi_admin_loggedin']['id'];
		
		/* if(!class_exists('Database'))
		{
			require_once 'includes/db.php';
			$db = new Database();
		} */
	}
	include('includes/database.php');
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
	
	if($rUrl != '' && strpos($rUrl,'http://') === false)
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

if($happi_admin_loggedin)
	{
		header("Location:dashboard.php");
		exit ;
	}
	else if(isset($_POST['submit']))
	{
		$email = isset($_POST['txtemail']) ? trim($_POST['txtemail']) : '';
		$password = isset($_POST['txtpassword']) ? trim($_POST['txtpassword']) : '';
		if($email == '' OR $password == '')
		{
			$_SESSION['error'] = 'Email Id and Password fields are required';
			header("Location:index.php");
			exit ;
		}
		else
		{
			
			$query = "SELECT * FROM happi_admin WHERE uname = '" . $email . "' AND password = '" . $password . "' AND status = 1";           
			$row = mysqli_query($conn, $query);
			$user_row = mysqli_fetch_assoc($row);
			//print_r($user_row);exit;
			//$all_count2 = mysqli_num_rows($result2);
			
			if(empty($user_row))
			{
				$_SESSION['error'] = 'Invalid Email Id or Password Entered';
				header("Location:index.php");
				exit ;
			}
			
			$sess_arr = array('id' => $user_row['id'], 'name' => $user_row['name'], 'uname' => $user_row['uname'], 'user_type' => $user_row['user_type']);
			
			$_SESSION['happi_admin_loggedin'] = $sess_arr;
			
			
			
			/* if($rUrl != '')
				header("Location:$rUrl");
			else */
				header("Location:dashboard.php");
			
			//exit ;
		}
	}
?>

<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    
    <meta name="robots" content="noindex,nofollow" />
    <title>Happi Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16"  href="images/favicon.png"    />
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet" />
    <link href="dist/css/admin.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="main-wrapper">
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
      <!-- Preloader - style you can find in spinners.css -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Login box.scss -->
      <!-- ============================================================== -->
      <div class="auth-wrapper  no-block justify-content-center align-items-center bg-info " >
	  
	  
	  <div class="row">
		<div class="col-lg-4 col-md-2 col-sm-3 col-xs-2"></div>
		  <div class="col-lg-4 col-md-8 col-sm-6 col-xs-8">
		  <div class="auth-box bg-info border-top border-secondary">
          <div id="loginform">
		  <br/>
			<br/>
			<br/>
            <div class="text-center pt-3 pb-3">
              <span class="db"
                ><img src="images/untitled-7.webp" alt="logo" width="200"  /></span>
            </div>
			<?php
				if($error != '')
					echo '<div class="has-error msg"><div class="input-group-addon">' . $error . '</div></div>';
				else if($success != '')
					echo '<div class="has-success msg"><div class="input-group-addon">' . $success . '</div></div>';
				else if($message != '')
					echo '<div class="has-success msg"><div class="input-group-addon">' . $message . '</div></div>';
				else
					echo '<div class="msg"></div>';
			?>
			
            <!-- Form -->
			
            <form class="form-horizontal mt-3" id="loginform" action="" method="post" >
              <div class="row pb-4">
                <div class="col-12">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span
                        class="input-group-text bg-success text-white h-100"
                        id="basic-addon1"
                        ><i class="mdi mdi-account fs-4"></i
                      ></span>
                    </div>
                    <input type="email" class="form-control form-control-lg" placeholder="Email" id="txtemail" name="txtemail" required />
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span
                        class="input-group-text bg-warning text-white h-100"
                        id="basic-addon2"
                        ><i class="mdi mdi-lock fs-4"></i
                      ></span>
                    </div>
                    
					 <input type="password" placeholder="Password" id="txtpassword" name="txtpassword" class="form-control form-control-lg" required>
       
                  </div>
                </div>
              </div>
              <div class="row border-top border-secondary">
                <div class="col-12">
                  <div class="form-group">
                    <div class="pt-3">
                      
                     
					  <button class="btn btn-success float-end text-white" type="submit" name="submit" id="btn_login">Sign in</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          
        </div>
		  </div>
	  </div>
	  
	  
        
      </div>
      <!-- ============================================================== -->
      <!-- Login box.scss -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Page wrapper scss in scafholding.scss -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Page wrapper scss in scafholding.scss -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Right Sidebar -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Right Sidebar -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
      $(".preloader").fadeOut();
      // ==============================================================
      // Login and Recover Password
      // ==============================================================
      $("#to-recover").on("click", function () {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
      });
      $("#to-login").click(function () {
        $("#recoverform").hide();
        $("#loginform").fadeIn();
      });
    </script>
  </body>
</html>