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
					
					$store_name = mysqli_real_escape_string($conn, $line[1]);
					$store_name = str_replace($replace_str,"", strip_tags(trim($store_name)));
					$city = mysqli_real_escape_string($conn, $line[2]);
					$city = str_replace($replace_str,"", strip_tags(trim($city)));
					$pos = mysqli_real_escape_string($conn, $line[3]);
					$pos = str_replace($replace_str,"", strip_tags(trim($pos)));
					$acquirer = mysqli_real_escape_string($conn, $line[6]);
					$acquirer = str_replace($replace_str,"", strip_tags(trim($acquirer)));
					$tid = mysqli_real_escape_string($conn, $line[7]);
					$tid = str_replace($replace_str,"", strip_tags(trim($tid)));
					$batch_no = mysqli_real_escape_string($conn, $line[9]);
					$batch_no = str_replace($replace_str,"", strip_tags(trim($batch_no)));
					
					$payment_mode = mysqli_real_escape_string($conn, $line[10]);
					$payment_mode = str_replace($replace_str,"", strip_tags(trim($payment_mode)));
					$card_type = mysqli_real_escape_string($conn, $line[14]);
					$card_type = str_replace($replace_str,"", strip_tags(trim($card_type)));
					$transaction_id = mysqli_real_escape_string($conn, $line[17]);
					$transaction_id = str_replace($replace_str,"", strip_tags(trim($transaction_id)));
					$approval_code = $line[19];
					$approval_code = str_replace($replace_str,"", trim($approval_code));
					$amount = mysqli_real_escape_string($conn, $line[21]);
					$amount = str_replace($replace_str,"", strip_tags(trim($amount)));
					$amount = str_replace($replace_str2,"", $amount);
					$datetime = mysqli_real_escape_string($conn, $line[24]);
					$datetime = str_replace($replace_str,"", strip_tags(trim($datetime)));
					$txn_status = mysqli_real_escape_string($conn, $line[26]);
					$txn_status = str_replace($replace_str,"", strip_tags(trim($txn_status)));
					$bill_invoice = mysqli_real_escape_string($conn, $line[28]);
					$bill_invoice = str_replace($replace_str,"", strip_tags(trim($bill_invoice)));
					$rrn = mysqli_real_escape_string($conn, $line[29]);
					$rrn = str_replace($replace_str,"", strip_tags(trim($rrn)));
					$card_network = mysqli_real_escape_string($conn, $line[15]);
					$card_network = str_replace($replace_str,"", strip_tags(trim($card_network)));
					$card_colour = mysqli_real_escape_string($conn, $line[16]);
					$card_colour = str_replace($replace_str,"", strip_tags(trim($card_colour)));
					$EMITxn = mysqli_real_escape_string($conn, $line[30]);
					$EMITxn = str_replace($replace_str,"", strip_tags(trim($EMITxn)));
					$EMIMonth = mysqli_real_escape_string($conn, $line[31]);
					$EMIMonth = str_replace($replace_str,"", strip_tags(trim($EMIMonth)));
					
					
					$haystack1 = $datetime;
					$needle1   = '/';

					if (strpos($haystack1, $needle1) !== false) {
						
						$stdate = explode(' ',$datetime);
						$stdate1 = explode('/',$stdate[0]);
						$datetime = $stdate1[2].'-'.$stdate1[1].'-'.$stdate1[0];
						
					}else{
						$stdate = explode(' ',$datetime);
						$stdate1 = explode('/',$stdate[0]);
						$datetime = $stdate1[2].'-'.$stdate1[1].'-'.$stdate1[0];
					}
					
					if(strtolower($txn_status) == 'success'){
						if($acquirer != '' && $store_name != '' && $transaction_id != '' ){					
							
							
							$sql = "SELECT id FROM happi_all_transactions WHERE acquirer = '$acquirer' AND store_name = '$store_name' AND datetime = '$datetime' AND rrn = '$rrn' AND transaction_id = '$transaction_id'";				
							$qry = mysqli_query($conn, $sql);
							$res  = mysqli_fetch_assoc($qry);	
							
							if($res['id'] == ''){ 
						
								$qry = "INSERT INTO happi_all_transactions (store_name,city,pos,acquirer,tid,batch_no,payment_mode,transaction_id,approval_code,amount,datetime,txn_status,rrn,card_network,card_colour, emi_txn, emi_month,card_type_trns,bill_invoice) 
								VALUES ('$store_name', '$city','$pos', '$acquirer', '$tid','$batch_no','$payment_mode','$transaction_id','$approval_code','$amount','$datetime','$txn_status','$rrn','$card_network','$card_colour','$EMITxn','$EMIMonth','$card_type','$bill_invoice')";
								

								//echo $qry; exit;
								
								$r = mysqli_query($conn, $qry);
								//echo $qry;
							}
							
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
