<?php 
error_reporting(E_ALL ^E_NOTICE ^E_WARNING);
	include ('includes/database.php');
	 date_default_timezone_set('Asia/Kolkata');
		$csvMimes = array('application/x-csv', 'text/x-csv', 'text/csv', 'application/csv','application/vnd.ms-excel',);
		
		
		$replace_str = array("'", "");
		$replace_str2 = array(",", "");
		
		if(!empty($_FILES['csvfile2']['name']) && in_array($_FILES['csvfile2']['type'],$csvMimes)){
			if(is_uploaded_file($_FILES['csvfile2']['tmp_name'])){
				//open uploaded csv file with read only mode
				$csvFile = fopen($_FILES['csvfile2']['tmp_name'], 'r');
				//skip first line
				fgetcsv($csvFile);
				$i = 0;
				//parse data from csv file line by line
				while(($line = fgetcsv($csvFile)) !== FALSE){
					$timestamp = date("Y-m-d H:i:s");
					$upload_date = date("Y-m-d");
					//$timestamp = "2019-01-10 20:10:10";
					//check whether member already exists in database with same email $line[6]
					
					$branch_id = mysqli_real_escape_string($conn, $line[1]);
					$branch_id = str_replace($replace_str, "", strip_tags(trim($branch_id)));

					$branch_name = mysqli_real_escape_string($conn, $line[2]);
					$branch_name = str_replace($replace_str, "", strip_tags(trim($branch_name)));

					$supplier_id = mysqli_real_escape_string($conn, $line[3]);
					$supplier_id = str_replace($replace_str, "", strip_tags(trim($supplier_id)));

					$suplier_desc = mysqli_real_escape_string($conn, $line[4]);
					$suplier_desc = str_replace($replace_str, "", strip_tags(trim($suplier_desc)));

					$deal_id = mysqli_real_escape_string($conn, $line[5]);
					$deal_id = str_replace($replace_str, "", strip_tags(trim($deal_id)));

					$aggriment_no = mysqli_real_escape_string($conn, $line[6]);
					$aggriment_no = str_replace($replace_str, "", strip_tags(trim($aggriment_no)));

					$customer_name = mysqli_real_escape_string($conn, $line[7]);
					$customer_name = str_replace($replace_str, "", strip_tags(trim($customer_name)));

					$trans_date = mysqli_real_escape_string($conn, $line[8]);
					$trans_date = str_replace($replace_str, "", strip_tags(trim($trans_date)));

					$actuval_txn_date = mysqli_real_escape_string($conn, $line[9]);
					$actuval_txn_date = str_replace($replace_str, "", strip_tags(trim($actuval_txn_date)));

					$narration = mysqli_real_escape_string($conn, $line[10]);
					$narration = str_replace($replace_str, "", strip_tags(trim($narration)));

					$txn_id = mysqli_real_escape_string($conn, $line[11]);
					$txn_id = str_replace($replace_str, "", strip_tags(trim($txn_id)));

					$disb_amt = mysqli_real_escape_string($conn, $line[12]);
					$disb_amt = str_replace($replace_str2, "", strip_tags(trim($disb_amt)));

					$amt_fn = mysqli_real_escape_string($conn, $line[15]);
					$amt_fn = str_replace($replace_str2, "", strip_tags(trim($amt_fn)));

					$total_deductions = mysqli_real_escape_string($conn, $line[16]);
					$total_deductions = str_replace($replace_str, "", strip_tags(trim($total_deductions)));

					$deduction_breakup = mysqli_real_escape_string($conn, $line[17]);
					$deduction_breakup = str_replace($replace_str, "", strip_tags(trim($deduction_breakup)));

					$invoice_date = mysqli_real_escape_string($conn, $line[22]);
					$invoice_date = str_replace($replace_str, "", strip_tags(trim($invoice_date)));

					$invoice_no = mysqli_real_escape_string($conn, $line[23]);
					$invoice_no = str_replace($replace_str, "", strip_tags(trim($invoice_no)));

					if($total_deductions == ''){
						$total_deductions = 0;
					}
					
					$haystack1 = $trans_date;
					$needle1   = '-';

					/* if (strpos($haystack1, $needle1) !== false) {
						$stdate = explode('-',$trans_date); 
						$trans_date = $stdate[2].'-'.$stdate[1].'-'.$stdate[0];
						
					}else{
						$stdate = explode('/',$trans_date);
						$trans_date = $stdate[2].'-'.$stdate[1].'-'.$stdate[0];
					}
					$haystack2 = $actuval_txn_date;
					$needle1   = '-';

					if (strpos($haystack2, $needle1) !== false) {
						$stdate2 = explode('-',$actuval_txn_date); 
						$actuval_txn_date = $stdate2[2].'-'.$stdate2[1].'-'.$stdate2[0];
						
					}else{
						$stdate2 = explode('/',$actuval_txn_date);
						$actuval_txn_date = $stdate2[2].'-'.$stdate2[1].'-'.$stdate2[0];
					}
					$haystack3 = $invoice_date;
					$needle1   = '-';

					if (strpos($haystack3, $needle1) !== false) {
						$stdate3 = explode('-',$invoice_date); 
						$invoice_date = $stdate3[2].'-'.$stdate3[1].'-'.$stdate3[0];
						
					}else{
						$stdate3 = explode('/',$invoice_date);
						$invoice_date = $stdate3[2].'-'.$stdate3[1].'-'.$stdate3[0];
					} */

					$trans_date = normalize_date($trans_date);
					$actuval_txn_date = normalize_date($actuval_txn_date);
					$invoice_date = normalize_date($invoice_date);
					
					if($disb_amt != '' && $trans_date != ''&& $txn_id != ''){			
						/* $date1 = DateTime::createFromFormat('d-M-y', $trans_date);
						$trans_date = $date1->format('Y-m-d');
						$date2 = DateTime::createFromFormat('d-M-y', $actuval_txn_date);
						$actuval_txn_date = $date2->format('Y-m-d');
						
						$date3 = DateTime::createFromFormat('d-M-y', $invoice_date);
						$invoice_date = $date3->format('Y-m-d'); */
						
						$sql = "SELECT id FROM happi_bajaj_ta_transactions WHERE txn_id = '$txn_id' AND trans_date = '$trans_date' AND disb_amt = '$disb_amt'";				
						$qry = mysqli_query($conn, $sql);
						$res  = mysqli_fetch_assoc($qry);	
						$id = $res['id'];
						if($res['id'] == ''){
					
							$qry = "INSERT INTO happi_bajaj_ta_transactions (
										branch_id, branch_name, supplier_id, suplier_desc, deal_id, aggriment_no, 
										customer_name, trans_date, actuval_txn_date, narration, txn_id, disb_amt, 
										amt_fn, total_deductions, deduction_breakup, invoice_date, invoice_no,upload_date
									) VALUES (
										'$branch_id', '$branch_name', '$supplier_id', '$suplier_desc', '$deal_id', '$aggriment_no', 
										'$customer_name', '$trans_date', '$actuval_txn_date', '$narration', '$txn_id', '$disb_amt', 
										'$amt_fn', '$total_deductions', '$deduction_breakup', '$invoice_date', '$invoice_no', '$upload_date'
									)";
							

							//echo $qry; exit;
							
							$r = mysqli_query($conn, $qry);
							//echo $qry;
						}else{
							$qry = "UPDATE happi_bajaj_ta_transactions
								SET 
									branch_id = '$branch_id',
									branch_name = '$branch_name',
									supplier_id = '$supplier_id',
									suplier_desc = '$suplier_desc',
									deal_id = '$deal_id',
									aggriment_no = '$aggriment_no',
									customer_name = '$customer_name',
									trans_date = '$trans_date',
									actuval_txn_date = '$actuval_txn_date',
									narration = '$narration',
									txn_id = '$txn_id',
									disb_amt = '$disb_amt',
									amt_fn = '$amt_fn',
									total_deductions = '$total_deductions',
									deduction_breakup = '$deduction_breakup',
									invoice_date = '$invoice_date',
									invoice_no = '$invoice_no'
								WHERE id = '$id'";

							$r = mysqli_query($conn, $qry);
						}
						
					}
					
					$i++;
					
					//echo '<br/>';
				}
				
				//close opened csv file
				fclose($csvFile);
				echo 'Data uploaded successfully';
				/* $_SESSION['success'] = 'Data uploaded successfully';
				header("Location:liquid_week_data.php"); */
				exit ;
			}else{
				echo 'File not upload';
				/* $_SESSION['error'] = 'File not upload';
				header("Location:liquid_upload.php"); */
				exit ;
			}
		}
	
	function normalize_date($input)
	{
		$input = trim($input);
		if (strpos($input, '-') !== false) {
			$parts = explode('-', $input);
		} else {
			$parts = explode('/', $input);
		}
		return $parts[2] . '-' . $parts[1] . '-' . $parts[0];
	}										
	/* $deb_query = "SELECT * FROM pio_categories WHERE status = 1 ORDER BY cat_name ASC";
	$deb_res = mysqli_query($conn, $deb_query);
	
	$r_query = "SELECT * FROM pio_regions ORDER BY region_name ASC";
	$r_res = mysqli_query($conn, $r_query); */
?>
