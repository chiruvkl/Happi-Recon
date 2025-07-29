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
					
					$mid = mysqli_real_escape_string($conn, $line[0]);
					$mid = str_replace($replace_str,"", strip_tags(trim($mid)));
					$tid = mysqli_real_escape_string($conn, $line[1]);
					$tid = str_replace($replace_str,"", strip_tags(trim($tid)));
					$name_loc = mysqli_real_escape_string($conn, $line[2]);
					$name_loc = str_replace($replace_str,"", strip_tags(trim($name_loc)));
					$tran_date = mysqli_real_escape_string($conn, $line[4]);
					$tran_date = str_replace($replace_str,"", strip_tags(trim($tran_date)));
					$stl_date = mysqli_real_escape_string($conn, $line[5]);
					$stl_date = str_replace($replace_str,"", strip_tags(trim($stl_date)));
					$rrn = $line[7];
					$rrn = str_replace($replace_str,"", strip_tags(trim($rrn)));
					
					$auth_code = mysqli_real_escape_string($conn, $line[8]);
					$auth_code = str_replace($replace_str,"", strip_tags(trim($auth_code)));
					$txn_amount = mysqli_real_escape_string($conn, $line[10]);
					$txn_amount = str_replace($replace_str,"", strip_tags(trim($txn_amount)));
					$txn_amount = str_replace($replace_str2,"", $txn_amount);
					$mdr_rate = mysqli_real_escape_string($conn, $line[11]);
					$mdr_rate = str_replace($replace_str,"", strip_tags(trim($mdr_rate)));
					$mdr_amount = mysqli_real_escape_string($conn, $line[12]);
					$mdr_amount = str_replace($replace_str,"", strip_tags(trim($mdr_amount)));
					$mdr_amount = str_replace($replace_str2,"", $mdr_amount);
					$net_amount = mysqli_real_escape_string($conn, $line[14]);
					$net_amount = str_replace($replace_str,"", strip_tags(trim($net_amount)));
					$net_amount = str_replace($replace_str2,"", $net_amount);
					$gst_amt = mysqli_real_escape_string($conn, $line[33]);
					$gst_amt = str_replace($replace_str,"", strip_tags(trim($gst_amt)));
					$gst_amt = str_replace($replace_str2,"", $gst_amt);
					$card_type = mysqli_real_escape_string($conn, $line[31]);
					$card_type = str_replace($replace_str,"", strip_tags(trim($card_type)));
					
					/* $date1 = new DateTime($tran_date);
					$tran_date = $date1->format('Y-m-d');
					$date2 = new DateTime($stl_date);
					$stl_date = $date2->format('Y-m-d'); */
					$haystack1 = $tran_date;
					$needle1   = '/';

					if (strpos($haystack1, $needle1) !== false) {
						
						$stdate = explode(' ',$tran_date);
						$stdate1 = explode('/',$stdate[0]);
						$tran_date = $stdate1[2].'-'.$stdate1[1].'-'.$stdate1[0];
						
					}else{
						$stdate = explode(' ',$tran_date);
						$stdate1 = explode('-',$stdate[0]);
						$tran_date = $stdate1[0].'-'.$stdate1[1].'-'.$stdate1[2];
					}
					$haystack2 = $stl_date;
					$needle2   = '/';

					if (strpos($haystack2, $needle2) !== false) {
						
						$stdate2 = explode(' ',$stl_date);
						$stdate3 = explode('/',$stdate2[0]);
						$stl_date = $stdate3[2].'-'.$stdate3[1].'-'.$stdate3[0];
						
					}else{
						$stdate2 = explode(' ',$stl_date);
						$stdate3 = explode('-',$stdate2[0]);
						$stl_date = $stdate3[0].'-'.$stdate3[1].'-'.$stdate3[2];
					}
					
					
					if($rrn != '' && $tid != '' && $auth_code != ''){					
						
						
						$sql = "SELECT id FROM happi_sbi_transactions WHERE auth_code = '$auth_code' AND tid = '$tid' AND tran_date = '$tran_date' AND rrn = '$rrn'";				
						$qry = mysqli_query($conn, $sql);
						$res  = mysqli_fetch_assoc($qry);	
						
						if($res['id'] == ''){
					
							$qry = "INSERT INTO happi_sbi_transactions (mid, tid, name_loc, tran_date, stl_date, rrn, auth_code, txn_amount, mdr_rate, mdr_amount, net_amount, gst_amt,card_type) 
							VALUES ('$mid', '$tid','$name_loc', '$tran_date', '$stl_date','$rrn','$auth_code','$txn_amount','$mdr_rate','$mdr_amount','$net_amount','$gst_amt','$card_type')";
							

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
