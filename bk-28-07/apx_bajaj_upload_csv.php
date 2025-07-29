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
				$max_date = null; 
				//parse data from csv file line by line
				while(($line = fgetcsv($csvFile)) !== FALSE){
					$timestamp = date("Y-m-d H:i:s");
					$upload_date = date("Y-m-d");
					//$timestamp = "2019-01-10 20:10:10";
					//check whether member already exists in database with same email $line[6]
					
					$voucher_no = mysqli_real_escape_string($conn, $line[1]);
					$voucher_no = str_replace($replace_str,"", strip_tags(trim($voucher_no)));
					$card_no = mysqli_real_escape_string($conn, $line[2]);
					$card_no = str_replace($replace_str,"", strip_tags(trim($card_no)));
					$apr_no = mysqli_real_escape_string($conn, $line[3]);
					$apr_no = str_replace($replace_str,"", strip_tags(trim($apr_no)));;
					$invoice_no = mysqli_real_escape_string($conn, $line[4]);
					$invoice_no = str_replace($replace_str,"", strip_tags(trim($invoice_no)));
					$amount = mysqli_real_escape_string($conn, $line[5]);
					$amount = str_replace($replace_str,"", strip_tags(trim($amount)));
					$amount = str_replace($replace_str2,"", $amount);
					$trn_date = mysqli_real_escape_string($conn, $line[6]);
					$trn_date = str_replace($replace_str,"", strip_tags(trim($trn_date)));
					
					
					$haystack1 = $trn_date;
					$needle1   = '-';

					/* if (strpos($haystack1, $needle1) !== false) {
						$stdate = explode('-',$trn_date); 
						$trn_date = $stdate[2].'-'.$stdate[1].'-'.$stdate[0];
						
					}else{
						$stdate = explode('/',$trn_date);
						$trn_date = $stdate[2].'-'.$stdate[1].'-'.$stdate[0];
					}
					 */
					$trn_date = normalize_date($trn_date);
					if($voucher_no != '' && $apr_no != '' && $invoice_no != ''){					
						
						
						/* $sql = "SELECT id FROM happi_bajaj_apx_transactions WHERE upload_date = '$upload_date' AND trn_date = '$trn_date' AND invoice_no = '$invoice_no'  AND voucher_no = '$voucher_no' ";				
						$qry = mysqli_query($conn, $sql);
						$res  = mysqli_fetch_assoc($qry);	 */
						if($i > 3){		
						$id = $res['id'];
							//if($res['id'] == ''){
								if (!$max_date || strtotime($trn_date) > strtotime($max_date)) {
									$max_date = $trn_date;
								}
								//echo $max_date;exit;
								$qry = "INSERT INTO happi_bajaj_apx_transactions (voucher_no,card_no,apr_no,invoice_no, amount, trn_date, created_on, fin_type,upload_date) 
								VALUES ('$voucher_no', '$card_no','$apr_no', '$invoice_no', '$amount','$trn_date','$timestamp', 'Bajaj', '$upload_date')";
								

								//echo $qry; exit;
								
								$r = mysqli_query($conn, $qry);
								//echo $qry;
							/* }else{
								$qry = "UPDATE happi_bajaj_apx_transactions
									SET voucher_no = '$voucher_no',
										card_no = '$card_no',
										apr_no = '$apr_no',
										invoice_no = '$invoice_no',
										amount = '$amount',
										trn_date = '$trn_date',
										created_on = '$timestamp',
										fin_type = 'Bajaj'
									WHERE id = '$id'";
									$r = mysqli_query($conn, $qry);
							} */
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
