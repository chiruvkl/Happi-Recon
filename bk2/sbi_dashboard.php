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
	$where .= " AND b.acquirer = '$trans_type' ";
}
if($store_name != ''){
	$where .= " AND b.store_name = '$store_name' ";
}

// AND DATE(datetime) = '$get_date'

//$u_query = "SELECT a.*, b.trn_date, b.amount AS apx_amt FROM happi_all_transactions a JOIN happi_apx_transactions b ON(b.apr_no = a.approval_code) where b.trn_date = '$get_date' AND a.acquirer IN ('SBI87', 'HDFC') ".$where." ORDER BY a.id DESC"; //echo $u_query ;
$u_query = "SELECT a.*, b.store_name, b.city, b.pos, b.acquirer, b.tid, b.payment_mode, b.transaction_id, b.approval_code, b.amount, b.datetime, b.txn_status, b.rrn as allrrn, b.card_network, b.card_colour, b.emi_txn, b.emi_month, b.card_type_trns, c.voucher_no, c.apr_no, c.invoice_no, c.trn_date, c.amount AS apx_amt
				FROM happi_sbi_transactions a 
				LEFT JOIN happi_all_transactions b ON(b.approval_code = a.auth_code AND a.tran_date = b.datetime ) 
				LEFT JOIN happi_apx_transactions c ON(c.apr_no = a.auth_code AND a.tran_date = c.trn_date) 
				where a.tran_date = '$get_date' AND b.acquirer = 'SBI87' ".$where."
				ORDER BY a.id ASC";
/* $u_query = "SELECT a.*, b.voucher_no, b.apr_no, b.invoice_no, b.trn_date, b.amount AS apx_amt, h.name_loc, h.card_type, h.tran_date, h.stl_date, h.auth_code, h.txn_amount, h.net_amount 
				FROM happi_all_transactions a 
				JOIN happi_sbi_transactions h ON(h.auth_code = a.approval_code) 
				LEFT JOIN happi_apx_transactions b ON(b.apr_no = a.approval_code) 
				
				where a.datetime = '$get_date' AND a.acquirer = 'SBI87' ".$where."
				ORDER BY a.id DESC"; */ //echo $u_query ;
//echo $u_query;
//echo $user_type.'-'.$u_query;
$u_res = mysqli_query($conn, $u_query);
$u_count = mysqli_num_rows($u_res);
while($u_res_res = mysqli_fetch_assoc($u_res)){
	$u_res_data[] = $u_res_res;
}

$acquirer_query = "SELECT store_name FROM happi_all_transactions where datetime = '$get_date' AND acquirer = 'SBI87' GROUP BY store_name ORDER BY store_name ASC";  
$acquirer_res = mysqli_query($conn, $acquirer_query);
$acquirer_rows = mysqli_num_rows($acquirer_res); 
$acquirer_data = [];
if($acquirer_rows != 0){
	while($acquirer_3 = mysqli_fetch_assoc($acquirer_res)){
		$acquirer_data[] = $acquirer_3;
	}
}

/* $apx_query = "SELECT id FROM happi_apx_transactions where trn_date = '$get_date'";  
$apx_res = mysqli_query($conn, $apx_query);
$apx_cnt = mysqli_num_rows($apx_res); 

$pine_query = "SELECT id FROM happi_all_transactions where datetime = '$get_date'";  
$pine_res = mysqli_query($conn, $pine_query);
$pine_cnt = mysqli_num_rows($pine_res); 

$sbi_query = "SELECT id FROM happi_sbi_transactions where tran_date = '$get_date'";  
$sbi_res = mysqli_query($conn, $sbi_query);
$sbi_cnt = mysqli_num_rows($sbi_res); 

$hdfc_query = "SELECT id FROM happi_hdfc_transactions where trans_date = '$get_date'"; 
$hdfc_res = mysqli_query($conn, $hdfc_query);
$hdfc_cnt = mysqli_num_rows($hdfc_res); 

$phonepay_query = "SELECT id FROM happi_all_transactions where datetime = '$get_date' AND acquirer = 'PHONEPE'";  
$phonepay_res = mysqli_query($conn, $phonepay_query);
$phonepay_cnt = mysqli_num_rows($phonepay_res);

$amex_query = "SELECT id FROM happi_all_transactions where datetime = '$get_date' AND acquirer = 'AMEX'";  
$amex_res = mysqli_query($conn, $amex_query);
$amex_cnt = mysqli_num_rows($amex_res);

$SBI87_query = "SELECT id FROM happi_all_transactions where datetime = '$get_date' AND acquirer = 'SBI87'"; 
$SBI87_res = mysqli_query($conn, $SBI87_query);
$SBI87_cnt = mysqli_num_rows($SBI87_res);

$hdfcpine_query = "SELECT id FROM happi_all_transactions where datetime = '$get_date' AND acquirer = 'HDFC'"; 
$hdfcpine_res = mysqli_query($conn, $hdfcpine_query);
$hdfcpine_cnt = mysqli_num_rows($hdfcpine_res); */

//include("credit_queries.php");


?>    
     
							 
							 
							 <?php include('credit_table.php');?>
							  
							  <div class="row">
								<div class="card">
			 
			  
					<div class="table-responsive">
					<table class="table table-bordered" id="zero_config">
					  <thead>
						<tr style="background-color:#d4d7dd;">
						  <th scope="col"><strong>S.No.</strong></th>
						  <th scope="col"><strong>POS ID</strong></th>
							<th scope="col"><strong>TID</strong></th>
							<th scope="col"><strong>NAME AND LOC</strong></th>
							<th scope="col"><strong>Tran Date</strong></th>
							<th scope="col"><strong>Stl Date</strong></th>
							<th scope="col"><strong>TXN ID</strong></th>
							<th scope="col"><strong>RRN</strong></th>
							<th scope="col"><strong>Auth Code</strong></th>
							<th scope="col"><strong>Txn Amount</strong></th>
							<th scope="col"><strong>Net Amount</strong></th>
							<th scope="col"><strong>CardType1</strong></th>
							<th scope="col"><strong>Apx Approval</strong></th>
							<th scope="col"><strong>Apx Invoice</strong></th>
							<th scope="col"><strong>Apx amt</strong></th>
							<th scope="col"><strong>Apx Date</strong></th>
							<th scope="col"><strong>Diff amt</strong></th>
							<th scope="col"><strong>MDR Charges</strong></th>
							<th scope="col"><strong>MDR%</strong></th>
							<th scope="col"><strong>Receipt No</strong></th>
							<th scope="col"><strong>dsdsd</strong></th>
							<th scope="col"><strong>TXN Rate</strong></th>
							<th scope="col"><strong>Deducted MDR</strong></th>
							<th scope="col"><strong>Debited MDR%</strong></th>
							<th scope="col"><strong>Actual Charges</strong></th>
							<th scope="col"><strong>Actuall MDR Amt</strong></th>
							<th scope="col"><strong>Diff %</strong></th>
							<th scope="col"><strong>Card Network</strong></th>
							<th scope="col"><strong>Card Colour</strong></th>

						  
						</tr>
						
						
					  </thead>
					  <tbody>
					  <?php if($u_count > 0){ 
					  $j = 0;
					 
					  $l = 1;
					 // while($mp_row22 = mysqli_fetch_assoc($u_res)){
					foreach($u_res_data as $row){
						$approval_code = $row['approval_code'];
						$acquirer = $row['acquirer'];
						$datetime = $row['datetime']; //echo $datetime;
						$trn_date = $row['trn_date']; //echo $datetime;
						$apx_amt = $row['apx_amt']; //echo $datetime;
						$txn_amount = $row['net_amount'];
						$diffamt = $apx_amt - $txn_amount;
						$perc = ($diffamt / $apx_amt) * 100;
						$mdrper = '0.89';
						if($apx_amt > 2000){
							
							$TXN_Rate = 'ABOVE 2K';
							if($row['card_type'] == 'Credit'){
								$mdrper = '0.89';
							}else{
								$mdrper = '0.89';
							}
						}else{
							$TXN_Rate = 'BELOW 2K';
							if($row['card_type'] == 'Credit'){
								$mdrper = '0.89';
							}else{
								$mdrper = '0.40';
							}
						}
						
						//if($apx_amt != ''){
						  ?>
						  <tr >
							
						  <th><label class="labelclass"><strong><?php echo $l;?></strong></label></th>
						  <td><div class="form-group col-md-12"><strong><?php echo $row['pos']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['tid']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['name_loc']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['tran_date']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['stl_date']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['transaction_id']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['rrn']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['auth_code']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['txn_amount']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['net_amount']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['card_type']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['apr_no']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['invoice_no']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['apx_amt']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['trn_date']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo ($row['apx_amt'] - $row['txn_amount']); ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo ($row['txn_amount'] - $row['net_amount']); ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo round((($row['txn_amount'] - $row['net_amount']) / $row['txn_amount']) * 100 , 2); ?>%</strong></div></td>
							<td><div class="form-group col-md-12"><strong></strong></div></td>
							<td><div class="form-group col-md-12"><strong>PINE LABS-POS</strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $TXN_Rate; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php $debutedmdr = ($row['txn_amount'] - $row['net_amount']); echo round($debutedmdr, 2); ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo round((($row['txn_amount'] - $row['net_amount']) / $row['txn_amount']) * 100 , 2); ?>%</strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $mdrper;?>%</strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php $actual_mdr = round( ($mdrper / 100) * $row['txn_amount'], 2); echo $actual_mdr; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo round(($actual_mdr - $debutedmdr) ,2);?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['card_network']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['card_colour']; ?></strong></div></td>


						  
						  
						  
						  
						  
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
