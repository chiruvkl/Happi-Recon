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
					
					$additions = mysqli_real_escape_string($conn, $line[0]);
					$additions = str_replace($replace_str,"", strip_tags(trim($additions)));
					$invoice_no = mysqli_real_escape_string($conn, $line[3]);
					$invoice_no = str_replace($replace_str,"", strip_tags(trim($invoice_no)));
					$doc_value = mysqli_real_escape_string($conn, $line[1]);
					$doc_value = str_replace($replace_str,"", strip_tags(trim($doc_value)));
					$doc_value = str_replace($replace_str2, "", strip_tags(trim($doc_value)));
					$dbd_amt = mysqli_real_escape_string($conn, $line[2]);
					$dbd_amt = str_replace($replace_str,"", strip_tags(trim($dbd_amt)));;
					$dbd_amt = str_replace($replace_str2, "", strip_tags(trim($dbd_amt)));
					$doc_date = mysqli_real_escape_string($conn, $line[4]);
					$doc_date = str_replace($replace_str,"", strip_tags(trim($doc_date)));
					$party_name = mysqli_real_escape_string($conn, $line[5]);
					$party_name = str_replace($replace_str,"", strip_tags(trim($party_name)));
					
					
					$haystack1 = $doc_date;
					$needle1   = '-';

					if (strpos($haystack1, $needle1) !== false) {
						$stdate = explode('-',$doc_date); 
						$doc_date = $stdate[2].'-'.$stdate[1].'-'.$stdate[0];
						
					}else{
						$stdate = explode('/',$doc_date);
						$doc_date = $stdate[2].'-'.$stdate[1].'-'.$stdate[0];
					}
					
					
					if($doc_value != '' && $doc_date != '' && $invoice_no != ''){					
						
						
						$sql = "SELECT id FROM happi_dbd_master_data WHERE doc_value = '$doc_value' AND doc_date = '$doc_date' AND invoice_no = '$invoice_no'";				
						$qry = mysqli_query($conn, $sql);
						$res  = mysqli_fetch_assoc($qry);	
						if($i > 2){		
						$id = $res['id'];
							if($res['id'] == ''){
						
								$qry = "INSERT INTO happi_dbd_master_data (additions,invoice_no,doc_value,dbd_amt, doc_date, party_name, created_on) 
								VALUES ('$additions', '$invoice_no','$doc_value', '$dbd_amt', '$doc_date','$party_name','$timestamp')";
								

								//echo $qry; exit;
								
								$r = mysqli_query($conn, $qry);
								//echo $qry;
							}else{
								$qry = "
									UPDATE happi_dbd_master_data 
									SET 
										additions = '$additions',
										doc_value = '$doc_value',
										dbd_amt = '$dbd_amt',
										doc_date = '$doc_date',
										party_name = '$party_name',
										invoice_no = '$invoice_no',
										created_on = '$timestamp'
									WHERE id = '$id'
									";
									$r = mysqli_query($conn, $qry);
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
