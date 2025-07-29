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
$get_date = (isset($_REQUEST['get_date']) && $_REQUEST['get_date'] != '')?trim($_REQUEST['get_date']): date('Y-m-d', strtotime('-1 day'));

$where = " ";
if($trans_type != ''){
	$where .= " AND b.acquirer = '$trans_type' ";
}
if($store_name != ''){
	$where .= " AND a.branch_name = '$store_name' ";
}

// AND DATE(datetime) = '$get_date'

$u_query = "SELECT a.*, b.sfdc_id, b.application_id, b.applicant_name, b.city,b.invoice_no,b.asset_cost,b.loan_amount, b.dbd_inlclude_gst, b.net_disbursal_mount, b.neft_utr_no, b.actual_amount_paid,b.transaction_date, b.salespoint_name, c.voucher_no, c.apr_no, c.invoice_no AS apx_invoice_no, c.trn_date, c.amount AS apx_amt, d.dbd_amt, d.doc_value
				FROM happi_idfc_kvb_transactions a 
				LEFT JOIN happi_idfc_ta_transactions b ON(b.neft_utr_no = a.utr_no_dec) 
				LEFT JOIN happi_idfc_apx_transactions c ON(c.apr_no = b.sfdc_id) 
				LEFT JOIN happi_dbd_master_data d ON(d.invoice_no = c.invoice_no) 
				where a.value_date = '$get_date' ".$where."
				ORDER BY a.id ASC";
				

//echo $u_query;
//echo $user_type.'-'.$u_query;
$u_res = mysqli_query($conn, $u_query);
$u_count = mysqli_num_rows($u_res);
while($u_res_res = mysqli_fetch_assoc($u_res)){
	$u_res_data[] = $u_res_res;
}

$acquirer_query = "SELECT salespoint_name as branch_name FROM happi_idfc_ta_transactions where transaction_date = '$get_date' GROUP BY salespoint_name ORDER BY salespoint_name ASC";  
$acquirer_res = mysqli_query($conn, $acquirer_query);
$acquirer_rows = mysqli_num_rows($acquirer_res); 
$acquirer_data = [];
if($acquirer_rows != 0){
	while($acquirer_3 = mysqli_fetch_assoc($acquirer_res)){
		$acquirer_data[] = $acquirer_3;
	}
}


?>    
    
							
							 
							 <?php include('finance_table.php');?>
							  
							  <div class="row">
								<div class="card">
			 
			  
					<div class="table-responsive">
					<table class="table table-bordered" id="zero_config">
					  <thead>
						<tr style="background-color:#d4d7dd;">
						  <th scope="col"><strong>S.No.</strong></th>
						  <th scope="col"><strong>Branch Name</strong></th>
							<th scope="col"><strong>Customer Name</strong></th>
							<th scope="col"><strong>Value Date</strong></th>
							<th scope="col"><strong>UTR NO</strong></th>
							<th scope="col"><strong>Credit</strong></th>
							<th scope="col"><strong>SFDC ID</strong></th>
							<th scope="col"><strong>APX Invoice No</strong></th>
							<th scope="col"><strong>APX Approval No</strong></th>
							<th scope="col"><strong>APX Date</strong></th>
							<th scope="col"><strong>Asset Cost</strong></th>
							<th scope="col"><strong>APX TXN Amt</strong></th>
							<th scope="col"><strong>Net Disbursal Amount</strong></th>
							<th scope="col"><strong>IDFC DBD Charges</strong></th>
							<th scope="col"><strong>DBD%</strong></th>
							<th scope="col"><strong>Apx amt-Credit amt</strong></th>
							<th scope="col"><strong>Apx DBD Collected amt(taken from APX -additions)</strong></th>
							<th scope="col"><strong>Difference DBD Charges</strong></th>
							<!--<th scope="col"><strong>FF</strong></th>
							<th scope="col"><strong>Receipt No</strong></th>-->
						  
						</tr>
						
					  </thead>
					  <tbody>
					  <?php if($u_count > 0){ 
					  $j = 0;
					 
					  $l = 1;
					 // while($mp_row22 = mysqli_fetch_assoc($u_res)){
					foreach($u_res_data as $row){
						/* $approval_code = $row['approval_code'];
						$acquirer = $row['acquirer'];
						$datetime = $row['datetime']; //echo $datetime;
						$trn_date = $row['trn_date']; //echo $datetime;
						$apx_amt = $row['apx_amt']; //echo $datetime;
						$txn_amount = $row['net_amount'];
						$diffamt = $apx_amt - $txn_amount;
						$perc = ($diffamt / $apx_amt) * 100;
						if($apx_amt > 2000){
							$TXN_Rate = 'ABOVE 2K';
						}else{
							$TXN_Rate = 'BELOW 2K';
						}
						$mdrper = '1.53';
						if($apx_amt > 2000){
							
							$TXN_Rate = 'ABOVE 2K';
							if($row['card_type_trns'] == 'CREDIT'){
								$mdrper = '1.53';
							}else{
								$mdrper = '1.06';
							}
						}else{
							$TXN_Rate = 'BELOW 2K';
							if($row['card_type_trns'] == 'CREDIT'){
								$mdrper = '1.53';
							}else{
								$mdrper = '0.40';
							}
						}
						 */
						 $apx_amt = $row['apx_amt'];
						 $credit_amount = $row['credit_amount'];
						 if($apx_amt == '')
							 $apx_amt = 0;
						 $dbm_main = $apx_amt - $credit_amount;
						 $dbd_per = ($dbm_main / $apx_amt) * 100;
						 if($apx_amt == 0){
							 $dbd_per = '-';
						 }
						  ?>
						  <tr >
							
						  <th><label class="labelclass"><strong><?php echo $l;?></strong></label></th>
						  <td><div class="form-group col-md-12"><strong><?php echo $row['salespoint_name']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['applicant_name']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['value_date']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['utr_no_dec']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['credit_amount']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['sfdc_id']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['apx_invoice_no']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['apr_no']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['trn_date']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['asset_cost']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['apx_amt']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['net_disbursal_mount']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['dbd_inlclude_gst']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo round($dbd_per,2,2);?>%</strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $dbm_main; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $row['dbd_amt']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php echo $dbm_main - $dbd_amt; ?></strong></div></td>
							<!--<td><div class="form-group col-md-12"><strong><?php //echo $row['deduction_breakup']; ?></strong></div></td>
							<td><div class="form-group col-md-12"><strong><?php //echo $row['voucher_no']; ?></strong></div></td>-->
							

						  
						  
						  
						  
						  
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
