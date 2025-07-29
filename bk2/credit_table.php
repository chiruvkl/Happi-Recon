 <?php 
//$pine_total_query = "SELECT id, SUM(amount) AS pine_total FROM happi_all_transactions where datetime = '$get_date'";  
$pine_total_query = "SELECT COUNT(*) AS total_rows, SUM(amount) AS pine_total FROM happi_all_transactions WHERE datetime = '$get_date'";
$pine_total_res = mysqli_query($conn, $pine_total_query);
//$pine_total_cnt = mysqli_num_rows($pine_total_res);
$pine_total = 0;
$pine_total_cnt = 0;
if($pine_total_res){
	$pine_total_assoc = mysqli_fetch_assoc($pine_total_res);
	$pine_total = $pine_total_assoc['pine_total'];
	$pine_total_cnt = $pine_total_assoc['total_rows'];
}

$pine_matched_query1 = "SELECT a.id FROM happi_all_transactions a JOIN happi_apx_transactions b ON (a.approval_code = b.apr_no) WHERE a.datetime = '$get_date'
					ORDER BY a.id ASC";				
$pine_matched_res1 = mysqli_query($conn, $pine_matched_query1);
$pine_matched_count1 = mysqli_num_rows($pine_matched_res1);

$pine_matched_query2 = "SELECT a.id FROM happi_all_transactions a JOIN happi_apx_transactions b ON (a.transaction_id = b.card_no) WHERE a.datetime = '$get_date'
					ORDER BY a.id ASC";				
$pine_matched_res2 = mysqli_query($conn, $pine_matched_query2);
$pine_matched_count2 = mysqli_num_rows($pine_matched_res2);

$pine_matched_count = $pine_matched_count1 + $pine_matched_count2;
/* $pine_matched_query = "
    SELECT a.id 
    FROM happi_all_transactions a 
    JOIN happi_apx_transactions b ON a.approval_code = b.apr_no 
    WHERE a.datetime = '$get_date'

    UNION

    SELECT a.id 
    FROM happi_all_transactions a 
    JOIN happi_apx_transactions b ON a.transaction_id = b.apr_no 
    WHERE a.datetime = '$get_date'
";		
$pine_matched_res = mysqli_query($conn, $pine_matched_query);
$pine_matched_count = mysqli_num_rows($pine_matched_res); */

/* $sbi_total_query = "SELECT id FROM happi_sbi_transactions where tran_date = '$get_date'";  
$sbi_total_res = mysqli_query($conn, $sbi_total_query);
$sbi_total_cnt = mysqli_num_rows($sbi_total_res);  */

$sbi_total_query = "SELECT COUNT(*) AS total_rows, SUM(txn_amount) AS sbi_total, SUM(mdr_amount) AS mdr_amount FROM happi_sbi_transactions WHERE tran_date = '$get_date'";
$sbi_total_res = mysqli_query($conn, $sbi_total_query);
$sbi_total = 0;
$sbi_total_cnt = 0;
$sbi_mdr_amount = 0;
if($sbi_total_res){
	$sbi_total_assoc = mysqli_fetch_assoc($sbi_total_res);
	$sbi_total = $sbi_total_assoc['sbi_total'];
	$sbi_mdr_amount = $sbi_total_assoc['mdr_amount'];
	$sbi_total_cnt = $sbi_total_assoc['total_rows'];
}

$sbi_matched_query = "SELECT a.id FROM happi_sbi_transactions a JOIN (
						SELECT approval_code, MIN(id) AS id
						FROM happi_all_transactions
						WHERE acquirer = 'SBI87'
						GROUP BY approval_code
					) b ON b.approval_code = a.auth_code
					JOIN (
						SELECT apr_no, MIN(id) AS id
						FROM happi_apx_transactions
						GROUP BY apr_no
					) c ON c.apr_no = a.auth_code
					WHERE a.tran_date = '$get_date'
					ORDER BY a.id ASC";
				
$sbi_matched_res = mysqli_query($conn, $sbi_matched_query);
$sbi_matched_count = mysqli_num_rows($sbi_matched_res);

$sbi_notmatched_query = "SELECT a.id FROM  happi_sbi_transactions a LEFT JOIN 
    happi_all_transactions b  ON (b.approval_code = a.auth_code AND b.acquirer = 'SBI87') LEFT JOIN happi_apx_transactions c ON (c.apr_no = b.approval_code) WHERE  a.tran_date = '$get_date' AND c.apr_no IS NULL  AND c.id IS NULL  ORDER BY a.id ASC"; 
$sbi_notmatched_res = mysqli_query($conn, $sbi_notmatched_query);
$sbi_notmatched_count = mysqli_num_rows($sbi_notmatched_res);

/* $hdfc_total_query = "SELECT id FROM happi_hdfc_transactions where trans_date = '$get_date'";  
$hdfc_total_res = mysqli_query($conn, $hdfc_total_query);
$hdfc_total_cnt = mysqli_num_rows($hdfc_total_res);  */

$hdfc_total_query = "SELECT COUNT(*) AS total_rows, SUM(domestic_amt) AS hdfc_total, SUM(msf) AS msf_amt, SUM(igst_amt) AS igst_amt FROM happi_hdfc_transactions WHERE trans_date = '$get_date'";
$hdfc_total_res = mysqli_query($conn, $hdfc_total_query);
$hdfc_total = 0;
$hdfc_total_cnt = 0;
$hdfc_mdr_amount = 0;
$hdfc_igst_amount = 0;
if($hdfc_total_res){
	$hdfc_total_assoc = mysqli_fetch_assoc($hdfc_total_res);
	$hdfc_total = $hdfc_total_assoc['hdfc_total'];
	$hdfc_mdr_amount = $hdfc_total_assoc['msf_amt'];
	$hdfc_igst_amount = $hdfc_total_assoc['igst_amt'];
	$hdfc_total_cnt = $hdfc_total_assoc['total_rows'];
}

$hdfc_matched_query = "SELECT a.id FROM happi_hdfc_transactions a JOIN (
						SELECT approval_code, MIN(id) AS id
						FROM happi_all_transactions
						WHERE acquirer = 'HDFC'
						GROUP BY approval_code
					) b ON b.approval_code = a.approve_code
					JOIN (
						SELECT apr_no, MIN(id) AS id
						FROM happi_apx_transactions
						GROUP BY apr_no
					) c ON c.apr_no = a.approve_code
					WHERE a.trans_date = '$get_date'
					ORDER BY a.id ASC";
	
$hdfc_matched_res = mysqli_query($conn, $hdfc_matched_query);
$hdfc_matched_count = mysqli_num_rows($hdfc_matched_res);

$hdfc_notmatched_query = "SELECT  a.id FROM  happi_hdfc_transactions a LEFT JOIN happi_all_transactions b ON (b.approval_code = a.approve_code AND b.acquirer = 'HDFC') 
LEFT JOIN  happi_apx_transactions c ON c.apr_no = a.approve_code WHERE a.trans_date = '$get_date' AND (b.id IS NULL OR c.id IS NULL) ORDER BY a.id ASC";
$hdfc_notmatched_res = mysqli_query($conn, $hdfc_notmatched_query);
$hdfc_notmatched_count = mysqli_num_rows($hdfc_notmatched_res);


/* $phonepay_total_query = "SELECT id FROM happi_all_transactions where datetime = '$get_date' AND acquirer = 'PHONEPE'";  
$phonepay_total_res = mysqli_query($conn, $phonepay_total_query);
$phonepay_total_cnt = mysqli_num_rows($phonepay_total_res);  */

$phonepay_total_query = "SELECT COUNT(*) AS total_rows, SUM(amount) AS phonepay_total FROM happi_all_transactions WHERE datetime = '$get_date' AND acquirer = 'PHONEPE'";
$phonepay_total_res = mysqli_query($conn, $phonepay_total_query);
$phonepay_total = 0;
$phonepay_total_cnt = 0;
if($phonepay_total_res){
	$phonepay_total_assoc = mysqli_fetch_assoc($phonepay_total_res);
	$phonepay_total = $phonepay_total_assoc['phonepay_total'];
	$phonepay_total_cnt = $phonepay_total_assoc['total_rows'];
}



$phonepay_matched_query = "SELECT a.id
				FROM happi_all_transactions a 
				JOIN happi_apx_transactions c ON(c.card_no = a.bill_invoice) 
				where a.datetime = '$get_date' AND a.acquirer = 'PHONEPE' 
				ORDER BY a.id ASC";

$phonepay_matched_res = mysqli_query($conn, $phonepay_matched_query);
$phonepay_matched_count = mysqli_num_rows($phonepay_matched_res);

$phonepay_notmatched_query = "SELECT a.id
			FROM happi_all_transactions a
			LEFT JOIN happi_apx_transactions c ON c.card_no = a.bill_invoice
			WHERE a.datetime = '$get_date'  AND a.acquirer = 'PHONEPE'  AND c.card_no IS NULL ORDER BY a.id ASC";

$phonepay_notmatched_res = mysqli_query($conn, $phonepay_notmatched_query);
$phonepay_notmatched_count = mysqli_num_rows($phonepay_notmatched_res);

/* $other_total_query = "SELECT id FROM happi_all_transactions where datetime = '$get_date' AND acquirer NOT IN ('PHONEPE','HDFC','SBI87')";  
$other_total_res = mysqli_query($conn, $other_total_query);
$other_total_cnt = mysqli_num_rows($other_total_res);  */

$other_total_query = "SELECT COUNT(*) AS total_rows, SUM(amount) AS other_total FROM happi_all_transactions WHERE datetime = '$get_date' AND acquirer NOT IN ('PHONEPE','HDFC','SBI87')";
$other_total_res = mysqli_query($conn, $other_total_query);
$other_total = 0;
$other_total_cnt = 0;
if($other_total_res){
	$other_total_assoc = mysqli_fetch_assoc($other_total_res);
	$other_total = $other_total_assoc['other_total'];
	$other_total_cnt = $other_total_assoc['total_rows'];
}


$other_matched_query = "SELECT a.id
				FROM happi_all_transactions a 
				JOIN happi_apx_transactions c ON(c.card_no = a.transaction_id) 
				where a.datetime = '$get_date' AND a.acquirer NOT IN ('PHONEPE','HDFC','SBI87') 
				ORDER BY a.id ASC";

$other_matched_res = mysqli_query($conn, $other_matched_query);
$other_matched_count = mysqli_num_rows($other_matched_res);

$other_notmatched_query = "SELECT a.id
			FROM happi_all_transactions a
			LEFT JOIN happi_apx_transactions c ON c.card_no = a.transaction_id
			WHERE a.datetime = '$get_date'  AND a.acquirer NOT IN ('PHONEPE','HDFC','SBI87')  AND c.card_no IS NULL ORDER BY a.id ASC";

$other_notmatched_res = mysqli_query($conn, $other_notmatched_query);
$other_notmatched_count = mysqli_num_rows($other_notmatched_res);

$apx_total_query = "SELECT id FROM happi_apx_transactions where trn_date = '$get_date'";  
$apx_total_res = mysqli_query($conn, $apx_total_query);
$apx_total_cnt = mysqli_num_rows($apx_total_res); 

$apx_total_query = "SELECT COUNT(*) AS total_rows, SUM(amount) AS apx_total FROM happi_apx_transactions WHERE trn_date = '$get_date'";
$apx_total_res = mysqli_query($conn, $apx_total_query);
$apx_total = 0;
$apx_total_cnt = 0;
if($apx_total_res){
	$apx_total_assoc = mysqli_fetch_assoc($apx_total_res);
	$apx_total = $apx_total_assoc['apx_total'];
	$apx_total_cnt = $apx_total_assoc['total_rows'];
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
 
 if($action == 'dashboard.php'){
	 $heading = 'HDFC';
	 $dwd_matched = 'dwd_hdfc.php';
	 $dwd_notmatched = 'dwd_notm_hdfc.php';
 }else if($action == 'sbi_dashboard.php'){
	 $heading = 'SBI';
	 $dwd_matched = 'dwd_sbi.php';
	 $dwd_notmatched = 'dwd_notm_sbi.php';
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
              <h4 class="page-title w-100 text-center">Credit Card <?php echo $heading;?> Transactions</h4>
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
					  
					  <a href="dashboard.php" class="link-a btn <?php echo ($action == 'dashboard.php') ? 'btn-default' : 'btn-secondary'; ?>">HDFC Transactions</a> 
					  <a href="sbi_dashboard.php" class="link-a btn <?php echo ($action == 'sbi_dashboard.php') ? 'btn-default' : 'btn-secondary'; ?>">SBI Transactions</a>
					  <a href="phonepe_dashboard.php" class="link-a btn <?php echo ($action == 'phonepe_dashboard.php') ? 'btn-default' : 'btn-secondary'; ?>">Phonepe Transactions</a>
					  </div>
					<div class="col-lg-5 col-md-5 col-sm-5 text-end">
					  
					 <a href="<?php echo $dwd_matched;?>?get_date=<?php echo $get_date;?>" class="btn btn-danger">Download Matched</a> 
					 <a href="<?php echo $dwd_notmatched;?>?get_date=<?php echo $get_date;?>" class="btn btn-warning">Download Not Matched</a> 
					 <a href="uploads.php" class="btn btn-success">Uploads</a>
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
					 <div class="margin-top-10">
					 
					 <table border="1" class="table result-table" cellspacing="0" style=" text-align: center;width:100%;">
						<thead style="background-color: yellow; color: black; font-weight: bold;">
							<tr>
								<th><strong>Particulars</strong></th>
								<th><strong>Total Count</strong></th>
								<th><strong>Matched Count</strong></th>
								<th><strong>Un-Matched Count</strong></th>
								<th><strong>Txn Amount</strong></th>
								<th><strong>Deducted MDR</strong></th>
							</tr>
						</thead>
						<tbody style="background-color: #d3d3d3;">
							<tr>
								<td><strong>Pine labs</strong></td>
								<td><strong><?php echo $pine_total_cnt ;?></strong></td>
								<td><strong><a href="dwd_pine.php?get_date=<?php echo $get_date;?>"><?php echo $pine_matched_count;?></a></strong></td>
								<td><strong><a href="dwd_notm_pine.php?get_date=<?php echo $get_date;?>"><?php echo $pine_total_cnt - $pine_matched_count;?></a></strong></td>
								<td><strong><?php echo formatIndianCurrency($pine_total);?></strong></td>
								<td><strong>0.00</strong></td>
							</tr>
							<tr>
								<td>SBI</td>
								<td><?php echo $sbi_total_cnt;?></td>
								<td><a href="dwd_sbi.php?get_date=<?php echo $get_date;?>"><?php echo $sbi_matched_count;?></a></td>
								<td><a href="dwd_notm_sbi.php?get_date=<?php echo $get_date;?>"><?php echo $sbi_notmatched_count;?></a></td>
								<td><?php echo formatIndianCurrency($sbi_total);?></td>
								<td><?php echo formatIndianCurrency($sbi_mdr_amount);?></td>
							</tr>
							<tr>
								<td>HDFC</td>
								<td><?php echo $hdfc_total_cnt;?></td>
								<td><a href="dwd_hdfc.php?get_date=<?php echo $get_date;?>"><?php echo $hdfc_matched_count;?></a></td>
								<td><a href="dwd_notm_hdfc.php?get_date=<?php echo $get_date;?>"><?php echo $hdfc_notmatched_count;?></a></td>
								<td><?php echo formatIndianCurrency($hdfc_total);?></td>
								<td><?php echo formatIndianCurrency($hdfc_mdr_amount);?></td>
							</tr>
							<tr>
								<td>Phone-pe</td>
								<td><?php echo $phonepay_total_cnt;?></td>
								<td><a href="dwd_phonepay.php?get_date=<?php echo $get_date;?>"><?php echo $phonepay_matched_count;?></a></td>
								<td><a href="dwd_notm_phonepay.php?get_date=<?php echo $get_date;?>"><?php echo $phonepay_notmatched_count;?></a></td>
								<td><?php echo formatIndianCurrency($phonepay_total);?></td>
								<td>0.00</td>
							</tr>
							<tr>
								<td>Others</td>
								<td><?php echo $other_total_cnt;?></td>
								<td><a href="dwd_other.php?get_date=<?php echo $get_date;?>"><?php echo $other_matched_count;?></a></td>
								<td><a href="dwd_notm_other.php?get_date=<?php echo $get_date;?>"><?php echo $other_notmatched_count;?></a></td>
								<td><?php echo formatIndianCurrency($other_total);?></td>
								<td>0.00</td>
							</tr>
							<tr>
								<td><strong>Apx Report</strong></td>
								<td><strong><?php echo $apx_total_cnt;?></strong></td>
								<td><strong><a href="dwd_apx.php?get_date=<?php echo $get_date;?>"><?php echo ($sbi_matched_count + $hdfc_matched_count + $phonepay_matched_count + $other_matched_count);?></a></strong></td>
								<td><strong><a href="dwd_notm_apx.php?get_date=<?php echo $get_date;?>"><?php echo ($apx_total_cnt - ($sbi_matched_count + $hdfc_matched_count + $phonepay_matched_count + $other_matched_count));?></a></strong></td>
								<td><strong><?php echo formatIndianCurrency($apx_total);?></strong></td>
								<td><strong>0.00</strong></td>
							</tr>
						</tbody>
					</table>

					 
					 
					 </div>
				 </div>