<?php 
include("includes/loginheader.php");
?>
      <!-- ============================================================== -->
      <!-- End Topbar header -->
      <!-- ============================================================== -->
 <?php 
include("includes/leftMenu.php");


?>    
      <!-- ============================================================== -->
      <!-- End Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title text-center"></h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Upload Documents
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
          <div class="row"><h4 class="page-title text-center">Credit Card Uploads</h4><br/><br/>
		<div class="col-md-2 col-lg-2 col-xlg-3"></div>
		  <div class="col-md-2 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-warning text-center">
                  <a class="badge rounded-pill " href="upload_apx.php"" data-toggle="tooltip" title="APX transaction sheet" data-original-title="APX transaction sheet" >
                  <h6 class="text-white">APX transaction sheet</h6></a>
                </div>
              </div>
            </div>
		
            <!-- Column -->
            <div class="col-md-2 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-danger text-center">
                  <a class="badge rounded-pill" href="upload_pine.php" data-toggle="tooltip" title="Pine Labs ledger" data-original-title="Pine Labs ledger">
                  <h6 class="text-white">Pine Labs ledger</h6></a>
                </div>
              </div>
            </div>
			<div class="col-md-2 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-primary text-center">
                  <a class="badge rounded-pill" href="upload_hdfc.php" data-toggle="tooltip" title="HDFC MPR Report" data-original-title="HDFC MPR Report">
                  <h6 class="text-white">HDFC MPR Report</h6></a>
                </div>
              </div>
            </div>
			<div class="col-md-2 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-info text-center">
                  <a class="badge rounded-pill " href="upload_sbi.php" data-toggle="tooltip" title="SBI MPR Report" data-original-title="SBI MPR Report">
                  <h6 class="text-white">SBI MPR Report</h6></a>
                </div>
              </div>
            </div>
			
			
			<!--<div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-dark text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-gamepad"></i>
                  </h1>
                  <a class="badge rounded-pill" href="meplist.php?site_id=<?php echo $row['site_id'];?>" data-toggle="tooltip" title="MEP" data-original-title="Sites"><h6 class="text-white">MEP</h6></a>
                </div>
              </div>
            </div>-->
		  <div class="row"><h4 class="page-title text-center">UPI Uploads</h4><br/><br/><div class="col-md-2 col-lg-2 col-xlg-3"></div>
			  <div class="col-md-2 col-lg-2 col-xlg-3">
				  <div class="card card-hover">
					
				  </div>
				</div>
			
				<!-- Column -->
				<div class="col-md-3 col-lg-3 col-xlg-3">
				  <div class="card card-hover">
					<div class="box bg-secondary text-center">
					  <a class="badge rounded-pill" href="upload_phonepe.php" data-toggle="tooltip" title="Phonepe Settlement Report" data-original-title="Phonepe Settlement Report">
					  <h6 class="text-white">Phonepe Settlement Report</h6></a>
					</div>
				  </div>
				</div>
				<div class="col-md-2 col-lg-2 col-xlg-3">
				  <div class="card card-hover">
					<div class="box bg-success text-center">
					  <a class="badge rounded-pill" href="upload_upi.php" data-toggle="tooltip" title="UPI Transactions Report" data-original-title="UPI Transactions Report">
					  <h6 class="text-white">UPI Transactions Report</h6></a>
					</div>
				  </div>
				</div>
			</div>
            <div class="col-12">
              <?php
			if($error != '')
				echo '<div class="has-error msg-login"><div class="input-group-addon">' . $error . '</div></div>';
			else if($success != '')
				echo '<div class="has-success msg-login"><div class="input-group-addon">' . $success . '</div></div>';
			else if($message != '')
				echo '<div class="has-success msg-login"><div class="input-group-addon">' . $message . '</div></div>';
			else
				echo '<div class="msg-login"></div>';
		?>		
              <div class="card">
                <div class="card-body">
			
                 <!-- <h5 class="card-title">Basic Datatable</h5>-->
                  
                </div>
              </div>
            
          </div>
          <!-- ============================================================== -->
          <!-- End PAge Content -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Right sidebar -->
          <!-- ============================================================== -->
          <!-- .right-sidebar -->
          <!-- ============================================================== -->
          <!-- End Right sidebar -->
          <!-- ============================================================== -->
        </div>
		<div class="text-center"><a type="button" class="btn btn-warning" href="dashboard.php"><i class="fa fa-repeat"></i>&nbsp;Back</a></div><br/>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
    </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
   
    <script>
      /****************************************
       *       Basic Table                   *
       ****************************************/
      $("#zero_config").DataTable();
    </script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script>
	$( function() {
		$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd', maxDate: 0 });
		$( "#todatepicker" ).datepicker({ dateFormat: 'yy-mm-dd', maxDate: 0 });
	} );
	$(document).ready(function() {
		/* $('#datepicker').change(function(e) {
			var get_date = $(this).val();
			var site_id = '<?php echo $site_id;?>';
			window.location.href="manpower_reports.php?site_id="+site_id+'&get_date='+get_date;
		}); */
	});
  </script>
  
  </body>
</html>
