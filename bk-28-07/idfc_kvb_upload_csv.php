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
					
					$value_date = mysqli_real_escape_string($conn, $line[0]);
					$value_date = str_replace($replace_str, "", strip_tags(trim($value_date)));
					
					$description = mysqli_real_escape_string($conn, $line[1]);
					$description = str_replace($replace_str, "", strip_tags(trim($description)));

					$credit_amount = mysqli_real_escape_string($conn, $line[2]);
					$credit_amount = str_replace($replace_str, "", strip_tags(trim($credit_amount)));
					$credit_amount = str_replace($replace_str2, "", strip_tags(trim($credit_amount)));

					
					
					$haystack1 = $value_date;
					$needle1   = '-';

					if (strpos($haystack1, $needle1) !== false) {
						$stdate = explode('-',$value_date); 
						$value_date = $stdate[2].'-'.$stdate[1].'-'.$stdate[0];
						
					}else{
						$stdate = explode('/',$value_date);
						$value_date = $stdate[2].'-'.$stdate[1].'-'.$stdate[0];
					}
					$haystack2 = $actuval_txn_date;
					$needle1   = '-';

					/*if (strpos($haystack2, $needle1) !== false) {
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

					
					
					if($credit_amount != '' && $description != ''&& $value_date != ''){			
						/* $date1 = DateTime::createFromFormat('d-M-y', $value_date);
						$value_date = $date1->format('Y-m-d'); */
						$description_val = explode('-',$description);
						$utr_no_dec = $description_val[1];
						
						$sql = "SELECT id FROM happi_idfc_kvb_transactions WHERE credit_amount = '$credit_amount' AND description = '$description' AND value_date = '$value_date'";				
						$qry = mysqli_query($conn, $sql);
						$res  = mysqli_fetch_assoc($qry);	
						$id = $res['id'];
						if($res['id'] == ''){
					
							$qry = "INSERT INTO happi_idfc_kvb_transactions ( credit_amount, 
								description, 
								value_date, 
								utr_no_dec,upload_date 
							) VALUES (
								'$credit_amount', 
								'$description', 
								'$value_date', 
								'$utr_no_dec', 
								'$upload_date'
							)";
							

							//echo $qry; exit;
							
							$r = mysqli_query($conn, $qry);
							//echo $qry;
						}else{
							$qry = "UPDATE happi_idfc_kvb_transactions SET 
								credit_amount = '$credit_amount', 
								description = '$description', 
								value_date = '$value_date' 
							WHERE utr_no_dec = '$utr_no_dec' AND id = '$id' ";
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
	
									
	/* $deb_query = "SELECT * FROM pio_categories WHERE status = 1 ORDER BY cat_name ASC";
	$deb_res = mysqli_query($conn, $deb_query);
	
	$r_query = "SELECT * FROM pio_regions ORDER BY region_name ASC";
	$r_res = mysqli_query($conn, $r_query); */
?>
