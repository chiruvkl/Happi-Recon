<?php 
error_reporting(E_ALL ^E_NOTICE ^E_WARNING);
include ('includes/database.php');
date_default_timezone_set('Asia/Kolkata');

$csvMimes = array('application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/vnd.ms-excel');

$replace_str  = array("'", "");
$replace_str2 = array(",", "");

if (!empty($_FILES['csvfile2']['name']) && in_array($_FILES['csvfile2']['type'], $csvMimes)) {
    if (is_uploaded_file($_FILES['csvfile2']['tmp_name'])) {
        $csvFile = fopen($_FILES['csvfile2']['tmp_name'], 'r');

        fgetcsv($csvFile); // skip header

        while (($line = fgetcsv($csvFile)) !== FALSE) {

            // map CSV columns here:
            $store_name      = clean($conn, $line[0], $replace_str);
            $pos_id          = clean($conn, $line[1], $replace_str);
            $acquirer        = clean($conn, $line[2], $replace_str);
            $tid             = clean($conn, $line[3], $replace_str);
            $host_txn_id     = clean($conn, $line[6], $replace_str);
            $transaction_id  = clean($conn, $line[7], $replace_str);
            $txn_amt         = clean($conn, $line[14], $replace_str2);
            $icb             = clean($conn, $line[16], $replace_str2);
            $authorized_amt  = clean($conn, $line[17], $replace_str2);
            $txn_date        = clean($conn, $line[19], $replace_str);
            $txn_status      = clean($conn, $line[22], $replace_str);
            $bill_ref_no     = clean($conn, $line[32], $replace_str);
            $qr_txn_id     = clean($conn, $line[47], $replace_str);

            $txn_date = normalize_date($txn_date); 
			if(strtolower($txn_status) == 'success'){

				if ($host_txn_id != '' && $acquirer != '' && $txn_date != '') {
					// check for duplicates
					$check = mysqli_query($conn, "SELECT id FROM happi_upi_transactions 
						WHERE host_txn_id = '$host_txn_id' AND txn_date = '$txn_date'");
					$found = mysqli_fetch_assoc($check);

					if (empty($found['id'])) {
						$sql = "
						INSERT INTO happi_upi_transactions
						(store_name, pos_id, acquirer, tid, host_txn_id, transaction_id, txn_amt, icb, authorized_transaction_amount, txn_date, txn_status, bill_reference_no,qr_txn_id) 
						VALUES
						('$store_name', '$pos_id', '$acquirer', '$tid', '$host_txn_id', '$transaction_id', '$txn_amt', '$icb', '$authorized_amt', '$txn_date', '$txn_status', '$bill_ref_no', '$qr_txn_id')
						";
						mysqli_query($conn, $sql);
					}
				}
			}
        }

        fclose($csvFile);

        echo 'Data uploaded successfully';
        exit;

    } else {
        echo 'File not uploaded';
        exit;
    }
}

// helper to clean
function clean($conn, $val, $replace) {
    $val = mysqli_real_escape_string($conn, $val);
    return str_replace($replace, "", strip_tags(trim($val)));
}

// helper to normalize dates (DD/MM/YYYY → YYYY-MM-DD)
function normalize_date($input) {
    $input = trim($input);
    if (empty($input)) return '';
    if (strpos($input, '-') !== false) {
        $parts = explode('-', $input);
    } else {
		$input1 = explode(' ',$input);
        $parts = explode('/', $input1[0]);
    }
    if (count($parts) === 3) {
        return $parts[2] . '-' . $parts[1] . '-' . $parts[0];
    } else {
        return $input;
    }
}
?>