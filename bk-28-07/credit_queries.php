<?php 
//$pine_total_query = "SELECT id, SUM(amount) AS pine_total FROM happi_all_transactions where datetime = '$get_date'";  
$pine_total_query = "SELECT COUNT(*) AS total_rows, SUM(amount) AS pine_total FROM happi_all_transactions WHERE datetime = '$get_date'";
$pine_total_res = mysqli_query($conn, $pine_total_query);
//$pine_total_cnt = mysqli_num_rows($pine_total_res);
$pine_total = 0;
$pine_total_cnt = 0;
if($pine_total_res){
	$pine_total_assoc = mysqli_fetch_assoc($pine_total_res);
	$pine_total = $pine_total_assoc['pine_total'];
	$pine_total_cnt = $pine_total_assoc['total_rows'];
}


/* $sbi_total_query = "SELECT id FROM happi_sbi_transactions where tran_date = '$get_date'";  
$sbi_total_res = mysqli_query($conn, $sbi_total_query);
$sbi_total_cnt = mysqli_num_rows($sbi_total_res);  */

$sbi_total_query = "SELECT COUNT(*) AS total_rows, SUM(txn_amount) AS sbi_total, SUM(mdr_amount) AS mdr_amount FROM happi_sbi_transactions WHERE tran_date = '$get_date'";
$sbi_total_res = mysqli_query($conn, $sbi_total_query);
$sbi_total = 0;
$sbi_total_cnt = 0;
$sbi_mdr_amount = 0;
if($sbi_total_res){
	$sbi_total_assoc = mysqli_fetch_assoc($sbi_total_res);
	$sbi_total = $sbi_total_assoc['sbi_total'];
	$sbi_mdr_amount = $sbi_total_assoc['mdr_amount'];
	$sbi_total_cnt = $sbi_total_assoc['total_rows'];
}

$sbi_matched_query = "SELECT a.id FROM happi_sbi_transactions a JOIN (
						SELECT approval_code, MIN(id) AS id
						FROM happi_all_transactions
						WHERE acquirer = 'SBI87'
						GROUP BY approval_code
					) b ON b.approval_code = a.auth_code
					JOIN (
						SELECT apr_no, MIN(id) AS id
						FROM happi_apx_transactions
						GROUP BY apr_no
					) c ON c.apr_no = a.auth_code
					WHERE a.tran_date = '$get_date'
					ORDER BY a.id ASC";
				
$sbi_matched_res = mysqli_query($conn, $sbi_matched_query);
$sbi_matched_count = mysqli_num_rows($sbi_matched_res);

$sbi_notmatched_query = "SELECT a.id FROM  happi_sbi_transactions a LEFT JOIN 
    happi_all_transactions b  ON (b.approval_code = a.auth_code AND b.acquirer = 'SBI87') LEFT JOIN happi_apx_transactions c ON (c.apr_no = b.approval_code) WHERE  a.tran_date = '$get_date' AND c.apr_no IS NULL  AND c.id IS NULL  ORDER BY a.id ASC"; 
$sbi_notmatched_res = mysqli_query($conn, $sbi_notmatched_query);
$sbi_notmatched_count = mysqli_num_rows($sbi_notmatched_res);

/* $hdfc_total_query = "SELECT id FROM happi_hdfc_transactions where trans_date = '$get_date'";  
$hdfc_total_res = mysqli_query($conn, $hdfc_total_query);
$hdfc_total_cnt = mysqli_num_rows($hdfc_total_res);  */

$hdfc_total_query = "SELECT COUNT(*) AS total_rows, SUM(domestic_amt) AS hdfc_total, SUM(msf) AS msf_amt, SUM(igst_amt) AS igst_amt FROM happi_hdfc_transactions WHERE trans_date = '$get_date'";
$hdfc_total_res = mysqli_query($conn, $hdfc_total_query);
$hdfc_total = 0;
$hdfc_total_cnt = 0;
$hdfc_mdr_amount = 0;
$hdfc_igst_amount = 0;
if($hdfc_total_res){
	$hdfc_total_assoc = mysqli_fetch_assoc($hdfc_total_res);
	$hdfc_total = $hdfc_total_assoc['hdfc_total'];
	$hdfc_mdr_amount = $hdfc_total_assoc['msf_amt'];
	$hdfc_igst_amount = $hdfc_total_assoc['igst_amt'];
	$hdfc_total_cnt = $hdfc_total_assoc['total_rows'];
}

$hdfc_matched_query = "SELECT a.id FROM happi_hdfc_transactions a JOIN (
						SELECT approval_code, MIN(id) AS id
						FROM happi_all_transactions
						WHERE acquirer = 'HDFC'
						GROUP BY approval_code
					) b ON b.approval_code = a.approve_code
					JOIN (
						SELECT apr_no, MIN(id) AS id
						FROM happi_apx_transactions
						GROUP BY apr_no
					) c ON c.apr_no = a.approve_code
					WHERE a.trans_date = '$get_date'
					ORDER BY a.id ASC";
	
$hdfc_matched_res = mysqli_query($conn, $hdfc_matched_query);
$hdfc_matched_count = mysqli_num_rows($hdfc_matched_res);

$hdfc_notmatched_query = "SELECT  a.id FROM  happi_hdfc_transactions a LEFT JOIN happi_all_transactions b ON (b.approval_code = a.approve_code AND b.acquirer = 'HDFC') 
LEFT JOIN  happi_apx_transactions c ON c.apr_no = a.approve_code WHERE a.trans_date = '$get_date' AND (b.id IS NULL OR c.id IS NULL) ORDER BY a.id ASC";
$hdfc_notmatched_res = mysqli_query($conn, $hdfc_notmatched_query);
$hdfc_notmatched_count = mysqli_num_rows($hdfc_notmatched_res);


/* $phonepay_total_query = "SELECT id FROM happi_all_transactions where datetime = '$get_date' AND acquirer = 'PHONEPE'";  
$phonepay_total_res = mysqli_query($conn, $phonepay_total_query);
$phonepay_total_cnt = mysqli_num_rows($phonepay_total_res);  */

$phonepay_total_query = "SELECT COUNT(*) AS total_rows, SUM(amount) AS phonepay_total FROM happi_all_transactions WHERE datetime = '$get_date' AND acquirer = 'PHONEPE'";
$phonepay_total_res = mysqli_query($conn, $phonepay_total_query);
$phonepay_total = 0;
$phonepay_total_cnt = 0;
if($phonepay_total_res){
	$phonepay_total_assoc = mysqli_fetch_assoc($phonepay_total_res);
	$phonepay_total = $phonepay_total_assoc['phonepay_total'];
	$phonepay_total_cnt = $phonepay_total_assoc['total_rows'];
}



$phonepay_matched_query = "SELECT a.id
				FROM happi_all_transactions a 
				JOIN happi_apx_transactions c ON(c.card_no = a.bill_invoice) 
				where a.datetime = '$get_date' AND a.acquirer = 'PHONEPE' 
				ORDER BY a.id ASC";

$phonepay_matched_res = mysqli_query($conn, $phonepay_matched_query);
$phonepay_matched_count = mysqli_num_rows($phonepay_matched_res);

$phonepay_notmatched_query = "SELECT a.id
			FROM happi_all_transactions a
			LEFT JOIN happi_apx_transactions c ON c.card_no = a.bill_invoice
			WHERE a.datetime = '$get_date'  AND a.acquirer = 'PHONEPE'  AND c.card_no IS NULL ORDER BY a.id ASC";

$phonepay_notmatched_res = mysqli_query($conn, $phonepay_notmatched_query);
$phonepay_notmatched_count = mysqli_num_rows($phonepay_notmatched_res);

/* $other_total_query = "SELECT id FROM happi_all_transactions where datetime = '$get_date' AND acquirer NOT IN ('PHONEPE','HDFC','SBI87')";  
$other_total_res = mysqli_query($conn, $other_total_query);
$other_total_cnt = mysqli_num_rows($other_total_res);  */

$other_total_query = "SELECT COUNT(*) AS total_rows, SUM(amount) AS other_total FROM happi_all_transactions WHERE datetime = '$get_date' AND acquirer NOT IN ('PHONEPE','HDFC','SBI87')";
$other_total_res = mysqli_query($conn, $other_total_query);
$other_total = 0;
$other_total_cnt = 0;
if($other_total_res){
	$other_total_assoc = mysqli_fetch_assoc($other_total_res);
	$other_total = $other_total_assoc['other_total'];
	$other_total_cnt = $other_total_assoc['total_rows'];
}


$other_matched_query = "SELECT a.id
				FROM happi_all_transactions a 
				JOIN happi_apx_transactions c ON(c.card_no = a.transaction_id) 
				where a.datetime = '$get_date' AND a.acquirer NOT IN ('PHONEPE','HDFC','SBI87') 
				ORDER BY a.id ASC";

$other_matched_res = mysqli_query($conn, $other_matched_query);
$other_matched_count = mysqli_num_rows($other_matched_res);

$other_notmatched_query = "SELECT a.id
			FROM happi_all_transactions a
			LEFT JOIN happi_apx_transactions c ON c.card_no = a.transaction_id
			WHERE a.datetime = '$get_date'  AND a.acquirer NOT IN ('PHONEPE','HDFC','SBI87')  AND c.card_no IS NULL ORDER BY a.id ASC";

$other_notmatched_res = mysqli_query($conn, $other_notmatched_query);
$other_notmatched_count = mysqli_num_rows($other_notmatched_res);

$apx_total_query = "SELECT id FROM happi_apx_transactions where trn_date = '$get_date'";  
$apx_total_res = mysqli_query($conn, $apx_total_query);
$apx_total_cnt = mysqli_num_rows($apx_total_res); 

$apx_total_query = "SELECT COUNT(*) AS total_rows, SUM(amount) AS apx_total FROM happi_apx_transactions WHERE trn_date = '$get_date'";
$apx_total_res = mysqli_query($conn, $apx_total_query);
$apx_total = 0;
$apx_total_cnt = 0;
if($apx_total_res){
	$apx_total_assoc = mysqli_fetch_assoc($apx_total_res);
	$apx_total = $apx_total_assoc['apx_total'];
	$apx_total_cnt = $apx_total_assoc['total_rows'];
}


function formatIndianCurrency($number) {
    $decimal = number_format((float)$number, 2, '.', '');
    $exploded = explode('.', $decimal);
    $rupees = $exploded[0];
    $paise = $exploded[1];

    // Format rupees part
    $lastThree = substr($rupees, -3);
    $restUnits = substr($rupees, 0, -3);
    if ($restUnits != '') {
        $restUnits = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $restUnits);
        $formatted = $restUnits . ',' . $lastThree;
    } else {
        $formatted = $lastThree;
    }

    return $formatted . '.' . $paise;
}

// Example usage:
//echo formatIndianCurrency(5847083.200); // Output: ₹58,47,083.20


?>