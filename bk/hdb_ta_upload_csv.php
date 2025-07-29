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
					$do_number = strtolower(trim($line[1], "|"));
					$do_number = strtolower(str_replace($replace_str, "", strip_tags(trim(mysqli_real_escape_string($conn, $do_number)))));
					$app_form_no = strtolower(trim($line[2], "|"));
					$app_form_no = str_replace($replace_str, "", strip_tags(trim(mysqli_real_escape_string($conn, $app_form_no))));
					$app_id_c = str_replace($replace_str, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[3]))));
					$utr_no = str_replace($replace_str, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[5]))));
					$branch_name = str_replace($replace_str, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[7]))));
					$state = str_replace($replace_str, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[8]))));
					$customer_name = str_replace($replace_str, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[10]))));
					$dealer_name = str_replace($replace_str, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[16]))));
					$dsa_id = str_replace($replace_str, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[17]))));
					$final_loan_amount = str_replace($replace_str2, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[19]))));
					$loan_amount = str_replace($replace_str2, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[20]))));
					$credit_amount = str_replace($replace_str2, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[21]))));
					$invoice_no = str_replace($replace_str, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[22]))));
					$invoice_date = str_replace($replace_str, "", strip_tags(trim(mysqli_real_escape_string($conn, $line[23]))));

					if ($do_number != '' && $utr_no != '' && $invoice_no != '') {
						$haystack1 = $invoice_date;
						$needle1   = '-';
/* 						if (strpos($haystack1, $needle1) !== false) {
							$stdate = explode('-', $invoice_date);
							$invoice_date = $stdate[2] . '-' . $stdate[1] . '-' . $stdate[0];
						} else {
							$stdate = explode('/', $invoice_date);
							$invoice_date = $stdate[2] . '-' . $stdate[1] . '-' . $stdate[0];
						} */
						$date1 = DateTime::createFromFormat('d-M-y', $invoice_date);
						$invoice_date = $date1->format('Y-m-d');

						$check_sql = "SELECT id FROM happi_hdb_ta_transactions WHERE do_number = '$do_number' AND utr_no = '$utr_no' AND invoice_no = '$invoice_no' AND invoice_date = '$invoice_date'";
						$check_res = mysqli_query($conn, $check_sql);
						$check_data = mysqli_fetch_assoc($check_res);

						if (!$check_data) {
							$qry = "INSERT INTO happi_hdb_ta_transactions (
								do_number, app_form_no, app_id_c, utr_no, branch_name, state, customer_name,
								dealer_name, dsa_id, final_loan_amount, loan_amount, credit_amount,
								invoice_no, invoice_date
							) VALUES (
								'$do_number', '$app_form_no', '$app_id_c', '$utr_no', '$branch_name', '$state', '$customer_name',
								'$dealer_name', '$dsa_id', '$final_loan_amount', '$loan_amount', '$credit_amount',
								'$invoice_no', '$invoice_date'
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
