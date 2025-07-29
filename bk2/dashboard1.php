<?php 
include("includes/loginheader.php");
?>
      <!-- ============================================================== -->
      <!-- End Topbar header -->
      <!-- ============================================================== -->
 <?php 
include("includes/leftMenu.php");

$trans_type = (isset($_REQUEST['trans_type']) && $_REQUEST['trans_type'] != '')?trim($_REQUEST['trans_type']):'';
$store_name = (isset($_REQUEST['store_name']) && $_REQUEST['store_name'] != '')?trim($_REQUEST['store_name']):'';
$get_date = (isset($_REQUEST['get_date']) && $_REQUEST['get_date'] != '')?trim($_REQUEST['get_date']): date('Y-m-d');

$where = " ";
if($trans_type != ''){
	$where .= " AND acquirer = '$trans_type' ";
}
if($store_name != ''){
	$where .= " AND store_name = '$store_name' ";
}

// AND DATE(datetime) = '$get_date'

$u_query = "SELECT a.*, b.trn_date, b.amount AS apx_amt FROM happi_all_transactions a JOIN happi_apx_transactions b ON(b.apr_no = a.approval_code) where b.trn_date = '$get_date' AND a.acquirer IN ('SBI87', 'HDFC') ".$where." ORDER BY a.id DESC"; //echo $u_query ;
//echo $u_query;
//echo $user_type.'-'.$u_query;
$u_res = mysqli_query($conn, $u_query);
$u_count = mysqli_num_rows($u_res);
while($u_res_res = mysqli_fetch_assoc($u_res)){
	$u_res_data[] = $u_res_res;
}

$acquirer_query = "SELECT store_name FROM happi_all_transactions where datetime = '$get_date' GROUP BY store_name ORDER BY store_name ASC";  
$acquirer_res = mysqli_query($conn, $acquirer_query);
$acquirer_rows = mysqli_num_rows($acquirer_res); 
$acquirer_data = [];
if($acquirer_rows != 0){
	while($acquirer_3 = mysqli_fetch_assoc($acquirer_res)){
		$acquirer_data[] = $acquirer_3;
	}
}


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
              <h4 class="page-title">All Transactions</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                  <li><a href="dwd_hdfc.php?get_date=<?php echo $get_date;?>" class="btn btn-info">Download HDFC</a><li>
                  <li>&nbsp;<li>
                  <li><a href="dwd_sbi.php?get_date=<?php echo $get_date;?>" class="btn btn-danger">Download SBI</a><li>
                  <li>&nbsp;<li>
                  <li><a href="uploads.php" class="btn btn-success">Uploads</a><li>
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
        <div class="container-fluid1">
          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
          <div class="row">
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
				
				
				<!--<div><a href="site_reports_abs.php?site_id=<?php echo $site_id;?>" title="Go To ABS" class="badge rounded-pill bg-secondary">ABS</a> | <a href="site_reports_shutter.php?site_id=<?php echo $site_id;?>" class="badge rounded-pill bg-dark">Shuttering Areas</a> | <a href="site_reports_str.php?site_id=<?php echo $site_id;?>"  class="badge rounded-pill bg-secondary">Reports</a>
				</div>
				<br/>-->
                 <!-- <h5 class="card-title">Basic Datatable</h5>-->
                  <div class="row">
							 <div class="margin-top-10">
							  <form class="form-horizontal" name="frmadd" id="frmadd" method="get"  action="dashboard.php" enctype="multipart/form-data"  >
							 
								
							   <table class="table table-striped table-hover table-bordered" >
									  <thead>								  
									  </thead>
									  <tbody>								 
									 
										<tr>
										<th>Transaction Type </th>
										<th  >
											<select name="trans_type" id="trans_type" class="form-select shadow-none" style="width: auto;">
												<option value="">All</option>
												<option value="HDFC" <?php echo ($trans_type == 'HDFC')?'selected' : '';?>>HDFC</option>
												<option value="SBI87" <?php echo ($trans_type == 'SBI87')?'selected' : '';?>>SBI</option>
															 
											</select>
										  </th>
										 <th>Store Name</th>
										  <th colspan="" style="">
											<select name="store_name" id="store_name" class="form-select shadow-none" style="width: auto;">
												<option value="">All</option>
												<?php
												foreach($acquirer_data as $store){ ?>
												<option value="<?php echo $store['store_name'];?>" <?php echo ($store_name == $store['store_name'])?'selected' : '';?>><?php echo $store['store_name'];?></option>
												<?php } ?>
															 
											</select>
										  </th>
										  <th>Date</th>
										  <th colspan="" style="">
											<input type="text" id="datepicker" name="get_date" value="<?php echo $get_date;?>" autocomplete="off"> &nbsp; 
										  </th> 
										  <th colspan="" style="">
											<button type="submit" name="sbtn" class="btn btn-danger" >Filter</button>
										  </th>
										  <th colspan="" style="">
											<a href="dashboard.php" class="btn btn-warning" >Clear</a>
										  </th>
										  
									  </tr>
									  
												
									 </tbody>
								  </table>
							  
							  
							  
							  
							  
							 
							  </form>
							  
							  
							  
							  
							  </div>
							 
							 
							  
							  <div class="row">
								<div class="card">
			 
			  
					<div class="table-responsive">
					<table class="table table-bordered" id="zero_config">
					  <thead>
						<tr style="background-color:#d4d7dd;">
						  <th scope="col"><strong>S.No.</strong></th>
						  <th scope="col"><strong>Store Name</strong></th>
						  <th scope="col"><strong>City</strong></th>
						  <th scope="col"><strong>Acquirer</strong></th>
						  <th scope="col"><strong>Payment Mode</strong></th>
						  <th scope="col"><strong>Approval Code</strong></th>
						  <th scope="col"><strong>APX Net Amount</strong></th>
						  <th scope="col"><strong>Bank Amount</strong></th>
						  <th scope="col"><strong>Amount Deff</strong></th>
						  <th scope="col"><strong>Txn Status</strong></th>
						  <th scope="col"><strong>Txn Date</strong></th>
						  
						</tr>
						
						
					  </thead>
					  <tbody>
					  <?php if($u_count > 0){ 
					  $j = 0;
					 
					  $l = 1;
					 // while($mp_row22 = mysqli_fetch_assoc($u_res)){
					foreach($u_res_data as $mp_row22){
						$approval_code = $mp_row22['approval_code'];
						$acquirer = $mp_row22['acquirer'];
						$datetime = $mp_row22['datetime']; //echo $datetime;
						$trn_date = $mp_row22['trn_date']; //echo $datetime;
						$apx_amt = $mp_row22['apx_amt']; //echo $datetime;
						$txn_amount = '';
						
						if($acquirer == 'HDFC'){
							$approval_code1 = str_replace("'", "", $approval_code);
							$u_query1 = "SELECT * FROM happi_hdfc_transactions where approve_code = '$approval_code' AND trans_date = '$trn_date' ORDER BY id DESC LIMIT 0,1";
							
							//echo $user_type.'-'.$u_query1;
							$u_res1 = mysqli_query($conn, $u_query1);
							$bankdata = mysqli_fetch_assoc($u_res1);
							$txn_amount = $bankdata['net_amount'];
							
						} else{
							$approval_code1 = str_replace("'", "", $approval_code);
							
							$u_query = "SELECT * FROM happi_sbi_transactions where auth_code = '$approval_code1' AND tran_date = '$trn_date' ORDER BY id DESC LIMIT 0,1"; 
							$u_res = mysqli_query($conn, $u_query);
							$bankdata = mysqli_fetch_assoc($u_res);
							$txn_amount = $bankdata['net_amount'];
						} 
						if($mp_row22['apx_amt'] != $txn_amount){
							$style= "style='color: red;'";
						}else{
							$style= "";
						}
						
						$diffamt = $apx_amt - $txn_amount;
						$perc = ($diffamt / $apx_amt) * 100;
						  ?>
						  <tr >
							
						  <th><label class="labelclass"><strong><?php echo $l;?></strong></label></th>
						  <th><label class="labelclass"><strong><?php echo $mp_row22['store_name'];?></strong></label></th>
						  <th><label class="labelclass"><strong><?php echo $mp_row22['city'];?></strong></label></th>
						 
						 
						  <td><div class="form-group col-md-12"><strong><?php echo $mp_row22['acquirer'];?></strong></div></td>	
						  <td><div class="form-group col-md-12"><strong><?php echo $mp_row22['payment_mode'];?></strong></div></td>
						  <td><div class="form-group col-md-12"><strong><?php echo $mp_row22['approval_code'];?></strong></div></td>
						  <td <?php echo $style;?>><div class="form-group col-md-12"><strong><?php echo $mp_row22['apx_amt'];?></strong></div></td>
						  <td <?php echo $style;?>><div class="form-group col-md-12"><strong><?php echo $txn_amount;?></strong></div></td>
						  <td <?php echo $style;?>><div class="form-group col-md-12"><strong><?php echo round($diffamt,2) .' ('.round($perc,2).'%)';?></strong></div></td>
						  <td><div class="form-group col-md-12"><strong><?php echo $mp_row22['txn_status'];?></strong></div></td>
						  <td><div class="form-group col-md-12"><strong><?php echo $mp_row22['datetime'];?></strong></div></td>
						  
						  
						  
						  
							</tr>
							<?php 
						$l++;  //}
					  } ?>
					  
					 <?php } ?>
						
					  </tbody>
					</table>
					</div>
					<br/>
					
				
              </div>
								
								 
							</div> 
								  
								  
								  
								  
								  
								  
								  
								  
								  
								  
								  
								  
								  
								  
								  
								  
								  
							  <br/>
							  <br/>
							  </div>
							  
							  <div style="margin:10px;"></div>
						
						  
							  
                </div>
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
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
   
    <script>
      /****************************************
       *       Basic Table                   *
       ****************************************/
	   $(document).ready(function() {
			$('#zero_config').DataTable( {
				 "lengthMenu": [[200, 300, 500, -1], [200, 300, 500, "All"]]
			});
		} );
      
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
