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
					//$timestamp = "2019-01-10 20:10:10";
					//check whether member already exists in database with same email $line[6]
					
					$supplier_id = mysqli_real_escape_string($conn, $line[0]);
					$supplier_id = str_replace($replace_str, "", strip_tags(trim($supplier_id)));

					$suplier_name = mysqli_real_escape_string($conn, $line[1]);
					$suplier_name = str_replace($replace_str, "", strip_tags(trim($suplier_name)));

					$branch_name = mysqli_real_escape_string($conn, $line[3]);
					$branch_name = str_replace($replace_str, "", strip_tags(trim($branch_name)));

					$deal_id = mysqli_real_escape_string($conn, $line[4]);
					$deal_id = str_replace($replace_str, "", strip_tags(trim($deal_id)));

					$do_id = mysqli_real_escape_string($conn, $line[5]);
					$do_id = str_replace($replace_str, "", strip_tags(trim($do_id)));

					$app_cas_id = mysqli_real_escape_string($conn, $line[6]);
					$app_cas_id = str_replace($replace_str, "", strip_tags(trim($app_cas_id)));

					$gross_tenure = mysqli_real_escape_string($conn, $line[12]);
					$gross_tenure = str_replace($replace_str, "", strip_tags(trim($gross_tenure)));

					$loan_fn_amount = mysqli_real_escape_string($conn, $line[15]);
					$loan_fn_amount = str_replace($replace_str, "", strip_tags(trim($loan_fn_amount)));

					$advance_emi_amount = mysqli_real_escape_string($conn, $line[16]);
					$advance_emi_amount = str_replace($replace_str, "", strip_tags(trim($advance_emi_amount)));

					$dis_val = mysqli_real_escape_string($conn, $line[17]);
					$dis_val = str_replace($replace_str, "", strip_tags(trim($dis_val)));

					$emi_card_charges = mysqli_real_escape_string($conn, $line[18]);
					$emi_card_charges = str_replace($replace_str, "", strip_tags(trim($emi_card_charges)));

					$actual_transaction_date = mysqli_real_escape_string($conn, $line[42]);
					$actual_transaction_date = str_replace($replace_str, "", strip_tags(trim($actual_transaction_date)));

					$payment_date = mysqli_real_escape_string($conn, $line[43]);
					$payment_date = str_replace($replace_str, "", strip_tags(trim($payment_date)));

					$invoice_no = mysqli_real_escape_string($conn, $line[57]);
					$invoice_no = str_replace($replace_str, "", strip_tags(trim($invoice_no)));

					$invoice_date = mysqli_real_escape_string($conn, $line[58]);
					$invoice_date = str_replace($replace_str, "", strip_tags(trim($invoice_date)));

					$invoice_amount = mysqli_real_escape_string($conn, $line[59]);
					$invoice_amount = str_replace($replace_str, "", strip_tags(trim($invoice_amount)));


					
					
					$haystack1 = $actual_transaction_date;
					$needle1   = '-';

					if (strpos($haystack1, $needle1) !== false) {
						$stdate = explode('-',$actual_transaction_date); 
						$actual_transaction_date = $stdate[2].'-'.$stdate[1].'-'.$stdate[0];
						
					}else{
						$stdate = explode('/',$actual_transaction_date);
						$actual_transaction_date = $stdate[2].'-'.$stdate[1].'-'.$stdate[0];
					}
					$haystack2 = $payment_date;
					$needle1   = '-';

					if (strpos($haystack2, $needle1) !== false) {
						$stdate2 = explode('-',$payment_date); 
						$payment_date = $stdate2[2].'-'.$stdate2[1].'-'.$stdate2[0];
						
					}else{
						$stdate2 = explode('/',$payment_date);
						$payment_date = $stdate2[2].'-'.$stdate2[1].'-'.$stdate2[0];
					}
					$haystack3 = $invoice_date;
					$needle1   = '-';

					if (strpos($haystack3, $needle1) !== false) {
						$stdate3 = explode('-',$invoice_date); 
						$invoice_date = $stdate3[2].'-'.$stdate3[1].'-'.$stdate3[0];
						
					}else{
						$stdate3 = explode('/',$invoice_date);
						$invoice_date = $stdate3[2].'-'.$stdate3[1].'-'.$stdate3[0];
					}

					
					
					if($supplier_id != '' && $actual_transaction_date != ''&& $app_cas_id != ''){			
						/* $date1 = DateTime::createFromFormat('d-M-y', $trans_date);
						$trans_date = $date1->format('Y-m-d');
						$date2 = DateTime::createFromFormat('d-M-y', $actuval_txn_date);
						$actuval_txn_date = $date2->format('Y-m-d');
						
						$date3 = DateTime::createFromFormat('d-M-y', $invoice_date);
						$invoice_date = $date3->format('Y-m-d'); */
						
						$sql = "SELECT id FROM happi_bajaj_do_transactions WHERE app_cas_id = '$app_cas_id' AND actual_transaction_date = '$actual_transaction_date' AND supplier_id = '$supplier_id'";				
						$qry = mysqli_query($conn, $sql);
						$res  = mysqli_fetch_assoc($qry);	
						
						if($res['id'] == ''){
					
							$qry = "INSERT INTO happi_bajaj_do_transactions (
								supplier_id, suplier_name, branch_name, deal_id, do_id, app_cas_id, 
								gross_tenure, loan_fn_amount, advance_emi_amount, dis_val, emi_card_charges, 
								actual_transaction_date, payment_date, invoice_no, invoice_date, invoice_amount
							) VALUES (
								'$supplier_id', '$suplier_name', '$branch_name', '$deal_id', '$do_id', '$app_cas_id', 
								'$gross_tenure', '$loan_fn_amount', '$advance_emi_amount', '$dis_val', '$emi_card_charges', 
								'$actual_transaction_date', '$payment_date', '$invoice_no', '$invoice_date', '$invoice_amount'
							)";
							

							//echo $qry; exit;
							
							$r = mysqli_query($conn, $qry);
							//echo $qry;
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
	
									
	/* $deb_query = "SELECT * FROM pio_categories WHERE status = 1 ORDER BY cat_name ASC";
	$deb_res = mysqli_query($conn, $deb_query);
	
	$r_query = "SELECT * FROM pio_regions ORDER BY region_name ASC";
	$r_res = mysqli_query($conn, $r_query); */
?>
