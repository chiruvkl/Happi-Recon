<?php 
error_reporting(E_ALL ^E_NOTICE ^E_WARNING);
	include ('includes/database.php');
	 date_default_timezone_set('Asia/Kolkata');
		$csvMimes = array('application/x-csv', 'text/x-csv', 'text/csv', 'application/csv','application/vnd.ms-excel',);
		
		
		$replace_str = array("'", "");
		$replace_str2 = array(",", "");

		if (!empty($_FILES['csvfile2']['name']) && in_array($_FILES['csvfile2']['type'], $csvMimes)) {
			if (is_uploaded_file($_FILES['csvfile2']['tmp_name'])) {
				$csvFile = fopen($_FILES['csvfile2']['tmp_name'], 'r');
				fgetcsv($csvFile); // skip header
				$i = 0;

				while (($line = fgetcsv($csvFile)) !== FALSE) {
					$timestamp = date("Y-m-d H:i:s");

					$prospect_id = strtolower(str_replace($replace_str, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[0])))));
					$customer_name = str_replace($replace_str, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[1]))));
					$amount = str_replace($replace_str2, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[3]))));
					$uniquetranrefno = strtolower(str_replace($replace_str, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[5])))));
					$invref = str_replace($replace_str, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[11]))));
					$tenure = str_replace($replace_str, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[22]))));
					$emi_amount = str_replace($replace_str2, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[23]))));
					$asset_cost = str_replace($replace_str2, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[25]))));
					$finance_amt = str_replace($replace_str2, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[26]))));
					$advance_amt = str_replace($replace_str2, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[28]))));
					$processing_fee = str_replace($replace_str2, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[29]))));
					$other_charges = str_replace($replace_str2, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[30]))));
					$down_pay_amt = str_replace($replace_str2, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[31]))));
					$dealer_sub_amt = str_replace($replace_str2, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[32]))));
					$net_disb_amt = str_replace($replace_str2, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[33]))));
					$invoice_date = str_replace($replace_str, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[35]))));
					$invoce_no = str_replace($replace_str, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[36]))));
					$loan_disb_date = str_replace($replace_str, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[37]))));
					//echo $invoice_date;exit;
					// Format dates
					/* $date1 = DateTime::createFromFormat('Y-M-d H:i:s', $invoice_date);
					$invoice_date = $date1->format('Y-m-d'); 
					$date2 = DateTime::createFromFormat('d-M-y', $loan_disb_date);
					$loan_disb_date = $date2->format('Y-m-d');  */
					
					if ($prospect_id != '' && $uniquetranrefno != '' && $customer_name != '') {
						
						$invoice_date1 = explode(' ',$invoice_date);
						$invoice_date2 = $invoice_date1[0];
						
						$haystack1 = $invoice_date2;
						$invoice_date = $invoice_date2;
						$haystack2 = $loan_disb_date;
						$needle1   = '-';
						$needle2   = '-';

						/* if (strpos($haystack1, $needle1) !== false) {
							$stdate = explode('-',$invoice_date2); 
							$invoice_date = $stdate[2].'-'.$stdate[1].'-'.$stdate[0];
							
						}else{
							$stdate = explode('/',$invoice_date2);
							$invoice_date = $stdate[2].'-'.$stdate[1].'-'.$stdate[0];
						} */
						//echo $invoice_date;exit;
						if (strpos($haystack2, $needle2) !== false) {
							$stdate2 = explode('-',$loan_disb_date); 
							$loan_disb_date = $stdate2[2].'-'.$stdate2[1].'-'.$stdate2[0];
							
						}else{
							$stdate2 = explode('/',$loan_disb_date);
							$loan_disb_date = $stdate2[2].'-'.$stdate2[1].'-'.$stdate2[0];
						}
						
						
						$check_sql = "SELECT id FROM happi_tvs_ta_transactions WHERE prospect_id = '$prospect_id' AND uniquetranrefno = '$uniquetranrefno' AND invoce_no = '$invoce_no' AND invoice_date = '$invoice_date'";
						$check_res = mysqli_query($conn, $check_sql);
						$check_data = mysqli_fetch_assoc($check_res);

						if (!$check_data) {
							$qry = "INSERT INTO happi_tvs_ta_transactions (
								prospect_id, customer_name, amount, uniquetranrefno, invref, tenure,
								emi_amount, asset_cost, finance_amt, advance_amt, processing_fee,
								other_charges, down_pay_amt, dealer_sub_amt, net_disb_amt, invoice_date,
								invoce_no, loan_disb_date
							) VALUES (
								'$prospect_id', '$customer_name', '$amount', '$uniquetranrefno', '$invref', '$tenure',
								'$emi_amount', '$asset_cost', '$finance_amt', '$advance_amt', '$processing_fee',
								'$other_charges', '$down_pay_amt', '$dealer_sub_amt', '$net_disb_amt', '$invoice_date',
								'$invoce_no', '$loan_disb_date'
							)";

							mysqli_query($conn, $qry);
						}
					}

					$i++;
				}

				fclose($csvFile);
				echo 'Data uploaded successfully';
				exit;
			} else {
				echo 'File not uploaded';
				exit;
			}
		}
	
									
	/* $deb_query = "SELECT * FROM pio_categories WHERE status = 1 ORDER BY cat_name ASC";
	$deb_res = mysqli_query($conn, $deb_query);
	
	$r_query = "SELECT * FROM pio_regions ORDER BY region_name ASC";
	$r_res = mysqli_query($conn, $r_query); */
?>
