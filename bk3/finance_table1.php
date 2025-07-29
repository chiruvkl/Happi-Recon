 <?php 
//$bajaj_ta_total_query = "SELECT COUNT(*) AS total_rows, SUM(a.disb_amt) AS bajaj_ta_total, SUM(d.dis_val) AS bajaj_ta_mdr_amt FROM happi_bajaj_ta_transactions a LEFT JOIN happi_bajaj_do_transactions d ON(a.txn_id = d.app_cas_id) WHERE a.trans_date = '$get_date'";
$bajaj_ta_total_query = "SELECT COUNT(*) AS total_rows, SUM(disb_amt) AS bajaj_ta_total, SUM(amt_fn) AS amt_fn FROM happi_bajaj_ta_transactions WHERE trans_date = '$get_date'";
$bajaj_ta_total_res = mysqli_query($conn, $bajaj_ta_total_query);
//$pine_total_cnt = mysqli_num_rows($pine_total_res);
$bajaj_ta_total = 0;
$bajaj_ta_total_cnt = 0;
$bajaj_ta_mdr_amt = 0;
$bajaj_ta_amt_fn = 0;
if($bajaj_ta_total_res){
	$bajaj_ta_total_assoc = mysqli_fetch_assoc($bajaj_ta_total_res);
	$bajaj_ta_total = $bajaj_ta_total_assoc['bajaj_ta_total'];
	$bajaj_ta_total_cnt = $bajaj_ta_total_assoc['total_rows'];
	$bajaj_ta_amt_fn = $bajaj_ta_total_assoc['amt_fn'];
}

$bajaj_ta_matched_query2 = "SELECT SUM(c.amount) AS bajaj_ta_total, SUM(a.disb_amt) AS bajaj_ta_total3
				FROM happi_bajaj_ta_transactions a 
				JOIN happi_bajaj_do_transactions b ON(b.app_cas_id = a.txn_id) 
				JOIN happi_bajaj_apx_transactions c ON(c.apr_no = b.do_id) 
                JOIN happi_dbd_master_data d ON(d.invoice_no = c.invoice_no) 
				where a.trans_date = '$get_date' 
				";//echo $bajaj_ta_matched_query;
				
$bajaj_ta_matched_res2 = mysqli_query($conn, $bajaj_ta_matched_query2);
//$bajaj_ta_matched_count = mysqli_num_rows($bajaj_ta_matched_res2);

$bajaj_ta_total2 = 0;
$bajaj_ta_total3 = 0;

if($bajaj_ta_matched_res2){
	$bajaj_ta_total_assoc2 = mysqli_fetch_assoc($bajaj_ta_matched_res2);
	$bajaj_ta_total2 = $bajaj_ta_total_assoc2['bajaj_ta_total'];
	$bajaj_ta_total3 = $bajaj_ta_total_assoc2['bajaj_ta_total3'];
}

$bajaj_ta_matched_query = "SELECT a.id
				FROM happi_bajaj_ta_transactions a 
				JOIN happi_bajaj_do_transactions b ON(b.app_cas_id = a.txn_id) 
				JOIN happi_bajaj_apx_transactions c ON(c.apr_no = b.do_id) 
                JOIN happi_dbd_master_data d ON(d.invoice_no = c.invoice_no) 
				where a.trans_date = '$get_date' 
				ORDER BY a.id ASC";//echo $bajaj_ta_matched_query;
				
$bajaj_ta_matched_res = mysqli_query($conn, $bajaj_ta_matched_query);
$bajaj_ta_matched_count = mysqli_num_rows($bajaj_ta_matched_res);



$idfc_ta_total_query = "SELECT COUNT(*) AS total_rows, SUM(credit_amount) AS idfc_ta_total FROM happi_idfc_kvb_transactions WHERE value_date = '$get_date'";
$idfc_ta_total_res = mysqli_query($conn, $idfc_ta_total_query);
//$pine_total_cnt = mysqli_num_rows($pine_total_res);
$idfc_ta_total = 0;
$idfc_ta_total_cnt = 0;
$idfc_ta_mdr_amt = 0;
$idfc_ta_amt_fn = 0;
if($idfc_ta_total_res){
	$idfc_ta_total_assoc = mysqli_fetch_assoc($idfc_ta_total_res);
	$idfc_ta_total = $idfc_ta_total_assoc['idfc_ta_total'];
	$idfc_ta_total_cnt = $idfc_ta_total_assoc['total_rows'];
	//$idfc_ta_amt_fn = $idfc_ta_total_assoc['amt_fn'];
}

$idfc_fnamt_total_query = "SELECT SUM(dbd_inlclude_gst) AS amt_fn FROM happi_idfc_ta_transactions WHERE transaction_date = '$get_date'"; //echo $idfc_fnamt_total_query;
$idfc_fnamt_total_res = mysqli_query($conn, $idfc_fnamt_total_query);


$idfc_ta_matched_query2 = "
				SELECT SUM(c.amount) AS idfc_ta_total, SUM(a.credit_amount) AS idfc_ta_total3			
				FROM happi_idfc_kvb_transactions a 
				JOIN happi_idfc_ta_transactions b ON(b.neft_utr_no = a.utr_no_dec) 
				JOIN happi_idfc_apx_transactions c ON(c.apr_no = b.sfdc_id) 
				where a.value_date = '$get_date'"; 
$idfc_ta_matched_res2 = mysqli_query($conn, $idfc_ta_matched_query2);
//$bajaj_ta_matched_count = mysqli_num_rows($bajaj_ta_matched_res2);

$idfc_ta_total2 = 0;
$idfc_ta_total3 = 0;

if($idfc_ta_matched_res2){
	$idfc_ta_total_assoc2 = mysqli_fetch_assoc($idfc_ta_matched_res2);
	$idfc_ta_total2 = $idfc_ta_total_assoc2['idfc_ta_total'];
	$idfc_ta_total3 = $idfc_ta_total_assoc2['idfc_ta_total3'];
}


$idfc_ta_amt_fn = 0;
if($idfc_fnamt_total_res){
	$idfc_fnamt_total_assoc = mysqli_fetch_assoc($idfc_fnamt_total_res);
	$idfc_ta_amt_fn = $idfc_fnamt_total_assoc['amt_fn'];
}



$idfc_ta_matched_query = "SELECT a.id				
				FROM happi_idfc_kvb_transactions a 
				JOIN happi_idfc_ta_transactions b ON(b.neft_utr_no = a.utr_no_dec) 
				JOIN happi_idfc_apx_transactions c ON(c.apr_no = b.sfdc_id) 
				JOIN happi_dbd_master_data d ON(d.invoice_no = c.invoice_no) 
				where a.value_date = '$get_date' 
				ORDER BY a.id ASC";
				
$idfc_ta_matched_res = mysqli_query($conn, $idfc_ta_matched_query);
$idfc_ta_matched_count = mysqli_num_rows($idfc_ta_matched_res);


/* $sbi_notmatched_query = "SELECT a.id FROM  happi_sbi_transactions a LEFT JOIN 
    happi_all_transactions b  ON (b.approval_code = a.auth_code AND b.acquirer = 'SBI87') LEFT JOIN happi_apx_transactions c ON (c.apr_no = b.approval_code) WHERE  a.tran_date = '$get_date' AND c.apr_no IS NULL  AND c.id IS NULL  ORDER BY a.id ASC"; 
$sbi_notmatched_res = mysqli_query($conn, $sbi_notmatched_query);
$sbi_notmatched_count = mysqli_num_rows($sbi_notmatched_res); */







$apx_total_query = "SELECT id FROM happi_bajaj_apx_transactions where trn_date = '$get_date'";  
$apx_total_res = mysqli_query($conn, $apx_total_query);
$apx_total_cnt = mysqli_num_rows($apx_total_res); 

$apx_total_query = "SELECT COUNT(*) AS total_rows, SUM(amount) AS apx_total FROM happi_bajaj_apx_transactions WHERE trn_date = '$get_date'";
$apx_total_res = mysqli_query($conn, $apx_total_query);
$apx_total = 0;
$apx_total_cnt = 0;
if($apx_total_res){
	$apx_total_assoc = mysqli_fetch_assoc($apx_total_res);
	$apx_total = $apx_total_assoc['apx_total'];
	$apx_total_cnt = $apx_total_assoc['total_rows'];
}

$apx_bajaj_matched_query = "SELECT a.* FROM happi_bajaj_apx_transactions a join happi_bajaj_do_transactions c on (c.do_id = a.apr_no) join happi_bajaj_ta_transactions d on (d.txn_id = c.app_cas_id) join happi_dbd_master_data b on (b.invoice_no = a.invoice_no AND b.doc_date = a.trn_date) where a.trn_date = '$get_date'";
// echo $u_query;exit;
	
//echo $u_query;exit;
$apx_bajaj_matched_res = mysqli_query($conn, $apx_bajaj_matched_query);
$apx_bajaj_matched_count = mysqli_num_rows($apx_bajaj_matched_res);



$apx_idfc_matched_query = "SELECT * 
FROM happi_idfc_apx_transactions a
JOIN happi_idfc_ta_transactions d ON (d.sfdc_id = a.apr_no)
JOIN happi_dbd_master_data b ON (b.invoice_no = a.invoice_no AND b.doc_date = a.trn_date)
JOIN happi_idfc_kvb_transactions c ON (c.utr_no_dec = d.neft_utr_no  AND a.trn_date = c.value_date)
WHERE a.trn_date = '$get_date'";
// echo $u_query;exit;
	
//echo $u_query;exit;
$apx_idfc_matched_res = mysqli_query($conn, $apx_idfc_matched_query);
$apx_idfc_matched_count = mysqli_num_rows($apx_idfc_matched_res);

$apx_idfc_total_query = "SELECT id FROM happi_idfc_apx_transactions where trn_date = '$get_date'";  
$apx_idfc_total_res = mysqli_query($conn, $apx_idfc_total_query);
$apx_idfc_total_cnt = mysqli_num_rows($apx_idfc_total_res); 

$apx_idfc_total_query = "SELECT COUNT(*) AS total_rows, SUM(amount) AS apx_total FROM happi_idfc_apx_transactions WHERE trn_date = '$get_date'";
$apx_idfc_total_res = mysqli_query($conn, $apx_idfc_total_query);
$apx_idfc_total = 0;
$apx_idfc_total_cnt = 0;
if($apx_idfc_total_res){
	$apx_idfc_total_assoc = mysqli_fetch_assoc($apx_idfc_total_res);
	$apx_idfc_total = $apx_idfc_total_assoc['apx_total'];
	$apx_idfc_total_cnt = $apx_idfc_total_assoc['total_rows'];
}

function formatIndianCurrency($number) {
    $decimal = number_format((float)$number, 2, '.', '');
    $exploded = explode('.', $decimal);
    $rupees = $exploded[0];
    $paise = $exploded[1];

    // Format rupees part
    $lastThree = substr($rupees, -3);
    $restUnits = substr($rupees, 0, -3);
    if ($restUnits != '') {
        $restUnits = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $restUnits);
        $formatted = $restUnits . ',' . $lastThree;
    } else {
        $formatted = $lastThree;
    }

    return $formatted . '.' . $paise;
}

// Example usage:
//echo formatIndianCurrency(5847083.200); // Output: ₹58,47,083.20


 $action = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
 
 if($action == 'bajaj_fn.php'){
	 $heading = 'Bajaj';
	 $dwd_matched = 'dwd_bajaj.php';
	 $dwd_notmatched = 'dwd_notm_bajaj.php';
 }else if($action == 'idfc_dashboard.php'){
	 $heading = 'IDFC';
	 $dwd_matched = 'dwd_idfc.php';
	 $dwd_notmatched = 'dwd_notm_idfc.php';
 }else if($action == 'phonepe_dashboard.php'){
	 $heading = 'Phonepe';
	 $dwd_matched = 'dwd_phonepay.php';
	 $dwd_notmatched = 'dwd_notm_phonepay.php';
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
              <h4 class="page-title w-100 text-center">Finance <?php echo $heading;?> Transactions</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <!--<ol class="breadcrumb">
					  <li><a href="dwd_hdfc.php?get_date=<?php echo $get_date;?>" class="btn btn-info">Download HDFC</a></li>
					  <li>&nbsp;</li>
					  <li><a href="dwd_sbi.php?get_date=<?php echo $get_date;?>" class="btn btn-danger">Download SBI</a></li>
					  <li>&nbsp;</li>
					  <li><a href="uploads.php" class="btn btn-success">Uploads</a></li>
                  </ol>-->
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
				<div class="row">
				
					<div class="col-lg-7 col-md-7 col-sm-7">
					  
					  <a href="bajaj_fn.php" class="link-a btn <?php echo ($action == 'bajaj_fn.php') ? 'btn-default' : 'btn-secondary'; ?>">Bajaj Transactions</a> 
					  <a href="idfc_dashboard.php" class="link-a btn <?php echo ($action == 'idfc_dashboard.php') ? 'btn-default' : 'btn-secondary'; ?>">IDFC Transactions</a>
					  <!--<a href="phonepe_dashboard.php" class="link-a btn <?php echo ($action == 'phonepe_dashboard.php') ? 'btn-default' : 'btn-secondary'; ?>">Phonepe Transactions</a>-->
					  </div>
					<div class="col-lg-5 col-md-5 col-sm-5 text-end">
					  
					 <a href="<?php echo $dwd_matched;?>?get_date=<?php echo $get_date;?>" class="btn btn-danger">Download Matched</a> 
					 <a href="<?php echo $dwd_notmatched;?>?get_date=<?php echo $get_date;?>" class="btn btn-warning">Download Not Matched</a> 
					 <a href="fn_uploads.php" class="btn btn-success">Uploads</a>
					  </div>
					
				<div>&nbsp;</div>
			</div>
				
				<!--<div><a href="site_reports_abs.php?site_id=<?php echo $site_id;?>" title="Go To ABS" class="badge rounded-pill bg-secondary">ABS</a> | <a href="site_reports_shutter.php?site_id=<?php echo $site_id;?>" class="badge rounded-pill bg-dark">Shuttering Areas</a> | <a href="site_reports_str.php?site_id=<?php echo $site_id;?>"  class="badge rounded-pill bg-secondary">Reports</a>
				</div>
				<br/>-->
                 <!-- <h5 class="card-title">Basic Datatable</h5>-->
				 <!--<div class="row">
							 <div class="margin-top-10">
								<table class="table table-striped table-hover table-bordered" >
									  <thead>								  
									  </thead>
									  <tbody>								 
									 
										<tr>
										
										 <th>APX Count</th>
										  <th colspan="" style="">
											<?php echo $apx_cnt;?>
										  </th>
										  <th>Pine Labs Count <br/> SBI Count<br/> HDFC Count</th>
										  <th colspan="" style="">
											<?php echo $pine_cnt;?><br/>
											<?php echo $SBI87_cnt;?><br/>
											<?php echo $hdfcpine_cnt;?>
										  </th> 
										   <th>SBI Count</th>
										  <th colspan="" style="">
											<?php echo $sbi_cnt;?>
										  </th>
										  <th>HDFC Count</th>
										  <th colspan="" style="">
											<?php echo $hdfc_cnt; ?>
										  </th>
										  <th>Phonepay Count</th>
										  <th colspan="" style="">
											<?php echo $phonepay_cnt;?>
										  </th>
										  <th>Amex Count</th>
										  <th colspan="" style="">
											<?php echo $amex_cnt;?>
										  </th>
									  </tr>
									  
												
									 </tbody>
								  </table>
							 </div>
				 </div>-->
                  <div class="row">
 
 <style>
 .result-table td, .result-table th{
	 padding: 0.5rem 0.5rem;
 }
 </style>
 <div class="margin-top-10">
							  <form class="form-horizontal" name="frmadd" id="frmadd" method="get"  action="<?php echo $action;?>" enctype="multipart/form-data"  >
							 
								
							   <table class="table table-striped table-hover table-bordered" >
									  <thead>								  
									  </thead>
									  <tbody>								 
									 
										<tr>
										<!--<th>Transaction Type </th>
										<th  >
											<select name="trans_type" id="trans_type" class="form-select shadow-none" style="width: auto;">
												<option value="">All</option>
												<option value="HDFC" <?php echo ($trans_type == 'HDFC')?'selected' : '';?>>HDFC</option>
												<option value="SBI87" <?php echo ($trans_type == 'SBI87')?'selected' : '';?>>SBI</option>
															 
											</select>
										  </th>-->
										 <th>Store Name</th>
										  <th colspan="" style="">
											<select name="store_name" id="store_name" class="form-select shadow-none" style="width: auto;">
												<option value="">All</option>
												<?php
												foreach($acquirer_data as $store){ ?>
												<option value="<?php echo $store['branch_name'];?>" <?php echo ($store_name == $store['branch_name'])?'selected' : '';?>><?php echo $store['branch_name'];?></option>
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
											<a href="bajaj_fn.php" class="btn btn-warning" >Clear</a>
										  </th>
										  
									  </tr>
									  
												
									 </tbody>
								  </table>
							  
							  
							  
							  
							  
							 
							  </form>
							  
							  
							  
							  
							  </div>
 <div class="row">
					 <div class="margin-top-10">
					 
					 <table border="1" class="table result-table" cellspacing="0" style=" text-align: center;width:100%;">
						<thead style="background-color: yellow; color: black; font-weight: bold;">
							<tr>
								<th><strong>Particulars</strong></th>
								<th><strong>Total Count</strong></th>
								<th><strong>Matched Count</strong></th>
								<th><strong>Un-Matched Count</strong></th>
								<th><strong>Txn Amount</strong></th>
								<th><strong>Deducted DBD</strong></th>
							</tr>
						</thead>
						<tbody style="background-color: #d3d3d3;">
							<tr>
								<td><strong>Bajaj Finance</strong></td>
								<td><strong><?php echo $bajaj_ta_total_cnt ;?></strong></td>
								<td><strong><a href="dwd_bajaj.php?get_date=<?php echo $get_date;?>"><?php echo $bajaj_ta_matched_count;?></a></strong></td>
								<td><strong><a href="dwd_notm_bajaj.php?get_date=<?php echo $get_date;?>"><?php echo $bajaj_ta_total_cnt - $bajaj_ta_matched_count ;?></a></strong></td>
								<td><strong><?php echo formatIndianCurrency($bajaj_ta_total2);?></strong></td>
								<td><strong><?php $disbamtchange = formatIndianCurrency($bajaj_ta_total2 - $bajaj_ta_total3);
								$percentagechange = ($disbamtchange / $bajaj_ta_total2) ;
								//$percentagechange = number_format($percentagechange, 2);
								$adjusted = $percentagechange * 100000; // scale it
								$rounded = round($adjusted, 2);
								//$percentagechange = number_format($percentagechange, 2, '.', '');
								echo $disbamtchange. '( '.$rounded.'% )';
								?></strong></td>
							</tr>
							
							<tr>
								<td><strong>Bajaj Apx Report</strong></td>
								<td><strong><?php echo $apx_total_cnt;?></strong></td>
								<td><strong><a href="dwd_bajaj_apx.php?get_date=<?php echo $get_date;?>"><?php echo $bajaj_ta_matched_count ;?></a></strong></td>
								<td><strong><a href="dwd_notm_bajaj_apx.php?get_date=<?php echo $get_date;?>"><?php echo $apx_total_cnt - $bajaj_ta_matched_count ;?></a></strong></td>
								<td><strong><?php echo formatIndianCurrency($apx_total);?></strong></td>
								<td><strong>0.00</strong></td>
							</tr>
							<tr>
								<td><strong>IDFC Finance</strong></td>
								<td><strong><?php echo $idfc_ta_total_cnt ;?></strong></td>
								<td><strong><a href="dwd_idfc.php?get_date=<?php echo $get_date;?>"><?php echo $idfc_ta_matched_count;?></a></strong></td>
								<td><strong><a href="dwd_notm_idfc.php?get_date=<?php echo $get_date;?>"><?php echo $idfc_ta_total_cnt - $idfc_ta_matched_count ;?></a></strong></td>
								<td><strong><?php echo formatIndianCurrency($idfc_ta_total2);?></strong></td>
								<td><strong>
								<?php $disbamtchange_idfc = formatIndianCurrency($idfc_ta_total2 - $idfc_ta_total3);
								$percentagechange_idfc = ($disbamtchange_idfc / $idfc_ta_total2) ;
								$adjusted_idfc = $percentagechange_idfc * 100000; // scale it
								$rounded_idfc = round($adjusted_idfc, 2);
								//$percentagechange = number_format($percentagechange, 2, '.', '');
								echo $disbamtchange_idfc. '( '.$rounded_idfc.'% )';
								?>
								
								
								</strong></td>
							</tr>
							<tr>
								<td><strong>IDFC Apx Report</strong></td>
								<td><strong><?php echo $apx_idfc_total_cnt;?></strong></td>
								<td><strong><a href="dwd_idfc_apx.php?get_date=<?php echo $get_date;?>"><?php echo $idfc_ta_matched_count ;?></a></strong></td>
								<td><strong><a href="dwd_notm_idfc_apx.php?get_date=<?php echo $get_date;?>"><?php echo $apx_idfc_total_cnt - $idfc_ta_matched_count ;?></a></strong></td>
								<td><strong><?php echo formatIndianCurrency($apx_idfc_total);?></strong></td>
								<td><strong>0.00</strong></td>
							</tr>
						</tbody>
					</table>

					 
					 
					 </div>
				 </div>