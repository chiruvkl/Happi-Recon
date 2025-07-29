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
                    <li class="breadcrumb-item"><a href="bajaj_fn.php">Home</a></li>
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
          <div class="row"><h4 class="page-title text-center">Bajaj Finance Uploads</h4><br/><br/>
		<div class="col-md-2 col-lg-2 col-xlg-3"></div>
				<div class="row"><div class="col-md-2 col-lg-2 col-xlg-3"></div>
				  <div class="col-md-2 col-lg-2 col-xlg-3">
					  <div class="card card-hover">
						<div class="box bg-warning text-center">
						  <a class="badge rounded-pill " href="upload_bajaj_apx.php"" data-toggle="tooltip" title="Bajaj APX transaction sheet" data-original-title="Bajaj APX transaction sheet" >
						  <h6 class="text-white">Bajaj APX Transactions</h6></a>
						</div>
					  </div>
					</div>
				
					<!-- Column -->
					<div class="col-md-2 col-lg-2 col-xlg-3">
					  <div class="card card-hover">
						<div class="box bg-danger text-center">
						  <a class="badge rounded-pill" href="upload_bajaj_ta.php" data-toggle="tooltip" title="Bajaj TA Bank Data" data-original-title="Bajaj TA Bank Data">
						  <h6 class="text-white">Bajaj TA Bank Data</h6></a>
						</div>
					  </div>
					</div>
					<div class="col-md-2 col-lg-2 col-xlg-3">
					  <div class="card card-hover">
						<div class="box bg-primary text-center">
						  <a class="badge rounded-pill" href="upload_bajaj_do.php" data-toggle="tooltip" title="Bajaj DO ID data" data-original-title="Bajaj DO ID data">
						  <h6 class="text-white">Bajaj DO ID Data</h6></a>
						</div>
					  </div>
					</div>
					<div class="col-md-2 col-lg-2 col-xlg-3">
					  <div class="card card-hover">
						<div class="box bg-success text-center">
						  <a class="badge rounded-pill" href="upload_dbd_master.php" data-toggle="tooltip" title="DBD MASTER DATA" data-original-title="DBD MASTER DATA">
						  <h6 class="text-white">DBD MASTER DATA</h6></a>
						</div>
					  </div>
					</div>
				</div>
			<!--<div class="col-md-2 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-info text-center">
                  <a class="badge rounded-pill " href="upload_sbi.php" data-toggle="tooltip" title="SBI MPR Report" data-original-title="SBI MPR Report">
                  <h6 class="text-white">SBI MPR Report</h6></a>
                </div>
              </div>
            </div>-->
			
			
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
			<div class="row"><h4 class="page-title text-center">IDFC Finance Uploads</h4><br/><br/><div class="col-md-2 col-lg-2 col-xlg-3"></div>
			  <div class="col-md-2 col-lg-2 col-xlg-3">
				  <div class="card card-hover">
					<div class="box bg-warning text-center">
					  <a class="badge rounded-pill " href="upload_idfc_apx.php"" data-toggle="tooltip" title="IDFC APX Transactions sheet" data-original-title="IDFC APX Transactions sheet" >
					  <h6 class="text-white">IDFC APX Transactions</h6></a>
					</div>
				  </div>
				</div>
			
				<!-- Column -->
				<div class="col-md-2 col-lg-2 col-xlg-3">
				  <div class="card card-hover">
					<div class="box bg-danger text-center">
					  <a class="badge rounded-pill" href="upload_idfc_ta.php" data-toggle="tooltip" title="IDFC Finance Data" data-original-title="IDFC Finance Data">
					  <h6 class="text-white">IDFC Finance Data</h6></a>
					</div>
				  </div>
				</div>
				<div class="col-md-2 col-lg-2 col-xlg-3">
				  <div class="card card-hover">
					<div class="box bg-primary text-center">
					  <a class="badge rounded-pill" href="upload_idfc_kvb_data.php" data-toggle="tooltip" title="IDFC Finance KVB Data" data-original-title="IDFC Finance KVB Data">
					  <h6 class="text-white">IDFC Finance KVB Data</h6></a>
					</div>
				  </div>
				</div>
			</div>
			<div class="row"><h4 class="page-title text-center">TVS Finance Uploads</h4><br/><br/><div class="col-md-2 col-lg-2 col-xlg-3"></div>
			  <div class="col-md-2 col-lg-2 col-xlg-3">
				  <div class="card card-hover">
					<div class="box bg-warning text-center">
					  <a class="badge rounded-pill " href="upload_tvs_apx.php"" data-toggle="tooltip" title="TVS APX Transactions sheet" data-original-title="TVS APX Transactions sheet" >
					  <h6 class="text-white">TVS APX Transactions</h6></a>
					</div>
				  </div>
				</div>
			
				<!-- Column -->
				<div class="col-md-2 col-lg-2 col-xlg-3">
				  <div class="card card-hover">
					<div class="box bg-danger text-center">
					  <a class="badge rounded-pill" href="upload_tvs_ta.php" data-toggle="tooltip" title="TVS Finance Data" data-original-title="TVS Finance Data">
					  <h6 class="text-white">TVS Finance Data</h6></a>
					</div>
				  </div>
				</div>
				<div class="col-md-2 col-lg-2 col-xlg-3">
				  <div class="card card-hover">
					<div class="box bg-primary text-center">
					  <a class="badge rounded-pill" href="upload_tvs_kvb_data.php" data-toggle="tooltip" title="TVS Finance KVB Data" data-original-title="TVS Finance KVB Data">
					  <h6 class="text-white">TVS Finance KVB Data</h6></a>
					</div>
				  </div>
				</div>
			</div>
			<div class="row"><h4 class="page-title text-center">HDB Finance Uploads</h4><br/><br/><div class="col-md-2 col-lg-2 col-xlg-3"></div>
			  <div class="col-md-2 col-lg-2 col-xlg-3">
				  <div class="card card-hover">
					<div class="box bg-warning text-center">
					  <a class="badge rounded-pill " href="upload_hdb_apx.php"" data-toggle="tooltip" title="HDB APX Transactions sheet" data-original-title="HDB APX Transactions sheet" >
					  <h6 class="text-white">HDB APX Transactions</h6></a>
					</div>
				  </div>
				</div>
			
				<!-- Column -->
				<div class="col-md-2 col-lg-2 col-xlg-3">
				  <div class="card card-hover">
					<div class="box bg-danger text-center">
					  <a class="badge rounded-pill" href="upload_hdb_ta.php" data-toggle="tooltip" title="HDB Finance Data" data-original-title="HDB Finance Data">
					  <h6 class="text-white">HDB Finance Data</h6></a>
					</div>
				  </div>
				</div>
				<div class="col-md-2 col-lg-2 col-xlg-3">
				  <div class="card card-hover">
					<div class="box bg-primary text-center">
					  <a class="badge rounded-pill" href="upload_hdb_kvb_data.php" data-toggle="tooltip" title="HDB Finance KVB Data" data-original-title="HDB Finance KVB Data">
					  <h6 class="text-white">HDB Finance KVB Data</h6></a>
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
		<div class="text-center"><a type="button" class="btn btn-warning" href="bajaj_fn.php"><i class="fa fa-repeat"></i>&nbsp;Back</a></div><br/>
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
