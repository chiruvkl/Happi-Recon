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
					
					$sfdc_id = mysqli_real_escape_string($conn, $line[1]);
					$sfdc_id = str_replace($replace_str, "", strip_tags(trim($sfdc_id)));

					$application_id = mysqli_real_escape_string($conn, $line[2]);
					$application_id = str_replace($replace_str, "", strip_tags(trim($application_id)));

					$applicant_name = mysqli_real_escape_string($conn, $line[3]);
					$applicant_name = str_replace($replace_str, "", strip_tags(trim($applicant_name)));

					$tenure = mysqli_real_escape_string($conn, $line[4]);
					$tenure = str_replace($replace_str, "", strip_tags(trim($tenure)));

					$no_of_adv_emi = mysqli_real_escape_string($conn, $line[5]);
					$no_of_adv_emi = str_replace($replace_str, "", strip_tags(trim($no_of_adv_emi)));

					$emi_amount = mysqli_real_escape_string($conn, $line[6]);
					$emi_amount = str_replace($replace_str, "", strip_tags(trim($emi_amount)));
					$emi_amount = str_replace($replace_str2, "", strip_tags(trim($emi_amount)));

					$scheme_name = mysqli_real_escape_string($conn, $line[7]);
					$scheme_name = str_replace($replace_str, "", strip_tags(trim($scheme_name)));

					$disbursal_date = mysqli_real_escape_string($conn, $line[12]);
					$disbursal_date = str_replace($replace_str, "", strip_tags(trim($disbursal_date)));

					$invoice_date = mysqli_real_escape_string($conn, $line[14]);
					$invoice_date = str_replace($replace_str, "", strip_tags(trim($invoice_date)));

					$invoice_no = mysqli_real_escape_string($conn, $line[13]);
					$invoice_no = str_replace($replace_str, "", strip_tags(trim($invoice_no)));

					$city = mysqli_real_escape_string($conn, $line[10]);
					$city = str_replace($replace_str, "", strip_tags(trim($city)));

					$salespoint_name = mysqli_real_escape_string($conn, $line[15]);
					$salespoint_name = str_replace($replace_str, "", strip_tags(trim($salespoint_name)));

					$asset_cost = mysqli_real_escape_string($conn, $line[16]);
					$asset_cost = str_replace($replace_str, "", strip_tags(trim($asset_cost)));
					$asset_cost = str_replace($replace_str2, "", strip_tags(trim($asset_cost)));

					$loan_amount = mysqli_real_escape_string($conn, $line[18]);
					$loan_amount = str_replace($replace_str, "", strip_tags(trim($loan_amount)));
					$loan_amount = str_replace($replace_str2, "", strip_tags(trim($loan_amount)));
					
					$dbd_inlclude_gst = mysqli_real_escape_string($conn, $line[24]);
					$dbd_inlclude_gst = str_replace($replace_str, "", strip_tags(trim($dbd_inlclude_gst)));
					$dbd_inlclude_gst = str_replace($replace_str2, "", strip_tags(trim($dbd_inlclude_gst)));

					$net_disbursal_mount = mysqli_real_escape_string($conn, $line[27]);
					$net_disbursal_mount = str_replace($replace_str, "", strip_tags(trim($net_disbursal_mount)));
					$net_disbursal_mount = str_replace($replace_str2, "", strip_tags(trim($net_disbursal_mount)));

					$neft_utr_no = mysqli_real_escape_string($conn, $line[29]);
					$neft_utr_no = str_replace($replace_str, "", strip_tags(trim($neft_utr_no)));

					$transaction_date = mysqli_real_escape_string($conn, $line[30]);
					$transaction_date = str_replace($replace_str, "", strip_tags(trim($transaction_date)));

					$actual_amount_paid = mysqli_real_escape_string($conn, $line[31]);
					$actual_amount_paid = str_replace($replace_str, "", strip_tags(trim($actual_amount_paid)));
					$actual_amount_paid = str_replace($replace_str2, "", strip_tags(trim($actual_amount_paid)));


					
					
					/* $haystack1 = $disbursal_date;
					$needle1   = '-';

					if (strpos($haystack1, $needle1) !== false) {
						$stdate = explode('-',$disbursal_date); 
						$disbursal_date = $stdate[2].'-'.$stdate[1].'-'.$stdate[0];
						
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

					
					
					if($neft_utr_no != '' && $application_id != ''&& $sfdc_id != ''){			
						$date1 = DateTime::createFromFormat('d-M-y', $disbursal_date);
						$disbursal_date = $date1->format('Y-m-d');
						$date2 = DateTime::createFromFormat('d-M-y', $invoice_date);
						$invoice_date = $date2->format('Y-m-d');
						
						$date3 = DateTime::createFromFormat('d-M-y', $transaction_date);
						$transaction_date = $date3->format('Y-m-d');
						
						$sql = "SELECT id FROM happi_idfc_ta_transactions WHERE sfdc_id = '$sfdc_id' AND application_id = '$application_id' AND neft_utr_no = '$neft_utr_no'";				
						$qry = mysqli_query($conn, $sql);
						$res  = mysqli_fetch_assoc($qry);	
						
						if($res['id'] == ''){
					
							$qry = "INSERT INTO happi_idfc_ta_transactions ( sfdc_id, 
								application_id, 
								applicant_name, 
								tenure, 
								no_of_adv_emi, 
								emi_amount, 
								scheme_name, 
								disbursal_date, 
								invoice_date, 
								invoice_no, 
								city, 
								salespoint_name, 
								asset_cost, 
								loan_amount, 
								net_disbursal_mount, 
								neft_utr_no, 
								transaction_date, 
								actual_amount_paid,dbd_inlclude_gst
							) VALUES (
								'$sfdc_id', 
								'$application_id', 
								'$applicant_name', 
								'$tenure', 
								'$no_of_adv_emi', 
								'$emi_amount', 
								'$scheme_name', 
								'$disbursal_date', 
								'$invoice_date', 
								'$invoice_no', 
								'$city', 
								'$salespoint_name', 
								'$asset_cost', 
								'$loan_amount', 
								'$net_disbursal_mount', 
								'$neft_utr_no', 
								'$transaction_date', 
								'$actual_amount_paid', 
								'$dbd_inlclude_gst'
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
