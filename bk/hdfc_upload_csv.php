<?php 
error_reporting(E_ALL ^E_NOTICE ^E_WARNING);
	include ('includes/database.php');
	 date_default_timezone_set('Asia/Kolkata');
		$csvMimes = array('application/x-csv', 'text/x-csv', 'text/csv', 'application/csv','application/vnd.ms-excel',);
		
		
		$replace_str = array("'", "");
		
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
					
					$merchant_code = mysqli_real_escape_string($conn, $line[0]);
					$merchant_code = str_replace($replace_str,"", strip_tags(trim($merchant_code)));
					$terminal_number = mysqli_real_escape_string($conn, $line[1]);
					$terminal_number = str_replace($replace_str,"", strip_tags(trim($terminal_number)));
					$trans_date = mysqli_real_escape_string($conn, $line[6]);
					$trans_date = str_replace($replace_str,"", strip_tags(trim($trans_date)));
					$settle_date = mysqli_real_escape_string($conn, $line[7]);
					$settle_date = str_replace($replace_str,"", strip_tags(trim($settle_date)));
					$approve_code = $line[8];
					$approve_code = str_replace($replace_str,"", strip_tags(trim($approve_code)));
					$domestic_amt = mysqli_real_escape_string($conn, $line[10]);
					$domestic_amt = str_replace($replace_str,"", strip_tags(trim($domestic_amt)));
					$intl_amt = mysqli_real_escape_string($conn, $line[9]);
					$intl_amt = str_replace($replace_str,"", strip_tags(trim($intl_amt)));
					
					$msf = mysqli_real_escape_string($conn, $line[14]);
					$msf = str_replace($replace_str,"", strip_tags(trim($msf)));
					$igst_amt = mysqli_real_escape_string($conn, $line[20]);
					$igst_amt = str_replace($replace_str,"", strip_tags(trim($igst_amt)));
					$ugst_amt = mysqli_real_escape_string($conn, $line[21]);
					$ugst_amt = str_replace($replace_str,"", strip_tags(trim($ugst_amt)));
					$net_amount = mysqli_real_escape_string($conn, $line[22]);
					$net_amount = str_replace($replace_str,"", strip_tags(trim($net_amount)));
					$arn_no = mysqli_real_escape_string($conn, $line[24]);
					$arn_no = str_replace($replace_str,"", strip_tags(trim($arn_no)));
					$gst_transaction_id = mysqli_real_escape_string($conn, $line[26]);
					$gst_transaction_id = str_replace($replace_str,"", strip_tags(trim($gst_transaction_id)));
					$card_type = mysqli_real_escape_string($conn, $line[4]);
					$card_type = str_replace($replace_str,"", strip_tags(trim($card_type)));
					$suquence_no = $line[32];
					$suquence_no = str_replace($replace_str,"", strip_tags(trim($suquence_no)));
					
					
					$haystack1 = $trans_date;
					$needle1   = '/';
					$date1 = DateTime::createFromFormat('d-M-y', $trans_date);
					$trans_date = $date1->format('Y-m-d');
					$date2 = DateTime::createFromFormat('d-M-y', $settle_date);
					$settle_date = $date2->format('Y-m-d');

					
					
					if($approve_code != '' && $trans_date != ''){					
						
						
						$sql = "SELECT id FROM happi_hdfc_transactions WHERE approve_code = '$approve_code' AND trans_date = '$trans_date' AND suquence_no = '$suquence_no'";				
						$qry = mysqli_query($conn, $sql);
						$res  = mysqli_fetch_assoc($qry);	
						
						if($res['id'] == ''){
					
							$qry = "INSERT INTO happi_hdfc_transactions (merchant_code, terminal_number, trans_date, settle_date, approve_code, domestic_amt, msf, igst_amt, ugst_amt, net_amount, arn_no, gst_transaction_id,card_type,suquence_no,intl_amt) 
							VALUES ('$merchant_code', '$terminal_number','$trans_date', '$settle_date', '$approve_code','$domestic_amt','$msf','$igst_amt','$ugst_amt','$net_amount','$arn_no','$gst_transaction_id','$card_type','$suquence_no','$intl_amt')";
							

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
