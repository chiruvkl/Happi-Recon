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

				// skip header
				fgetcsv($csvFile);

				$i = 0;

				while (($line = fgetcsv($csvFile)) !== FALSE) {
					$timestamp = date("Y-m-d H:i:s");

					// read & clean values
					$payment_type       = mysqli_real_escape_string($conn, $line[0]);
					$phonepe_referenceId= mysqli_real_escape_string($conn, $line[2]);
					$store_name         = mysqli_real_escape_string($conn, $line[4]);
					$instrument         = mysqli_real_escape_string($conn, $line[8]);
					$transaction_date   = mysqli_real_escape_string($conn, $line[10]);
					$settlement_date    = mysqli_real_escape_string($conn, $line[11]);
					$bank_reference_no  = mysqli_real_escape_string($conn, $line[12]);
					$ph_amount          = mysqli_real_escape_string($conn, $line[13]);
					$fee                = mysqli_real_escape_string($conn, $line[14]);
					$igst               = mysqli_real_escape_string($conn, $line[15]);
					$cgst               = mysqli_real_escape_string($conn, $line[16]);
					$sgst               = mysqli_real_escape_string($conn, $line[17]);

					// strip unwanted chars
					$payment_type       = str_replace($replace_str, "", strip_tags(trim($payment_type)));
					$phonepe_referenceId= str_replace($replace_str, "", strip_tags(trim($phonepe_referenceId)));
					$store_name         = str_replace($replace_str, "", strip_tags(trim($store_name)));
					$instrument         = str_replace($replace_str, "", strip_tags(trim($instrument)));
					$transaction_date   = str_replace($replace_str, "", strip_tags(trim($transaction_date)));
					$settlement_date    = str_replace($replace_str, "", strip_tags(trim($settlement_date)));
					$bank_reference_no  = str_replace($replace_str, "", strip_tags(trim($bank_reference_no)));
					$ph_amount          = str_replace($replace_str2, "", strip_tags(trim($ph_amount)));
					$fee                = str_replace($replace_str2, "", strip_tags(trim($fee)));
					$igst               = str_replace($replace_str2, "", strip_tags(trim($igst)));
					$cgst               = str_replace($replace_str2, "", strip_tags(trim($cgst)));
					$sgst               = str_replace($replace_str2, "", strip_tags(trim($sgst)));

					// convert transaction_date & settlement_date if needed (DD/MM/YYYY → YYYY-MM-DD)
					/* if (strpos($transaction_date, '/') !== false) {
						$stdate = explode('/', $transaction_date);
						$transaction_date = $stdate[2] . '-' . $stdate[1] . '-' . $stdate[0];
					}

					if (strpos($settlement_date, '/') !== false) {
						$stdate2 = explode('/', $settlement_date);
						$settlement_date = $stdate2[2] . '-' . $stdate2[1] . '-' . $stdate2[0];
					} */
					
					$transaction_date = normalize_date($transaction_date);
					$settlement_date = normalize_date($settlement_date);
					if($transaction_date  != '' && $phonepe_referenceId != '' && $store_name != ''){

						// prevent duplicates — example check on phonepe_referenceId + transaction_date
						$sql_check = "SELECT id FROM happi_phonepe_transactions 
									  WHERE phonepe_referenceId = '$phonepe_referenceId' 
										AND transaction_date = '$transaction_date'";
						$qry_check = mysqli_query($conn, $sql_check);
						$res_check = mysqli_fetch_assoc($qry_check);

						if (empty($res_check['id'])) {
							// insert
							$sql_insert = "
								INSERT INTO happi_phonepe_transactions
								(payment_type, phonepe_referenceId, store_name, instrument, transaction_date, settlement_date, bank_reference_no, ph_amount, fee, igst, cgst, sgst)
								VALUES
								('$payment_type', '$phonepe_referenceId', '$store_name', '$instrument', '$transaction_date', '$settlement_date', '$bank_reference_no', '$ph_amount', '$fee', '$igst', '$cgst', '$sgst')
							"; //echo $sql_insert; echo ';<br>';

							mysqli_query($conn, $sql_insert);
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
