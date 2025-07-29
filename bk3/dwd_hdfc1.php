<?php	error_reporting(E_ALL ^E_NOTICE ^E_WARNING);
	include 'includes/database.php';	$get_date = (isset($_REQUEST['get_date']) && $_REQUEST['get_date'] != '')?trim($_REQUEST['get_date']): date('Y-m-d');
	$output = '';
	$u_query = "SELECT a.*, b.store_name, b.city, b.pos, b.acquirer, b.tid, b.payment_mode, b.transaction_id, b.approval_code, b.amount, b.datetime, b.txn_status, b.rrn, b.card_network, b.card_colour, b.emi_txn, b.emi_month, b.card_type_trns, c.voucher_no, c.apr_no, c.invoice_no, c.trn_date, c.amount AS apx_amt				FROM happi_hdfc_transactions a 				JOIN happi_all_transactions b ON(b.approval_code = a.approve_code AND b.acquirer = 'HDFC') 				LEFT JOIN happi_apx_transactions c ON(c.apr_no = a.approve_code) 				where a.trans_date = '$get_date'				ORDER BY a.id ASC";// echo $u_query ;exit;	//echo $u_query;	//echo $user_type.'-'.$u_query;	$u_res = mysqli_query($conn, $u_query);	$u_count = mysqli_num_rows($u_res);	while($u_res_res = mysqli_fetch_assoc($u_res)){		$u_res_data[] = $u_res_res;	}
	
	 $delimiter = ",";
	 $filename = 'HDFC-BULK-'. date('Y-m-d:H:i:s').'.csv';
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    /* $fields1 = array('HDFC Transactions');
    fputcsv($f, $fields1, $delimiter); */
		$fields = array(    'POS NO', 'TID Number', 'Store Name', 'CARD TYPE', 'TRANS DATE', 'SETTLE DATE',    'TXN Id', 'RRN No', 'APPROV CODE', 'DOMESTIC AMT', 'Net amount', 'APX approval',    'Apx Invoice', 'Apx amt', 'Apx date', 'Diff', 'MDR Charges', 'MDR%',    'Receipt No', 'enty type', 'TXN Rate', 'Debuted MDR', 'Debited MDR%',    'Actual Charges', 'Actuall MDR Amt', 'Diff %', 'Card Network', 'Card Colour');
	//$fields = array('S.No', 'Date', 'Name', 'Email','Phone','Message','Type','Utm Source','Utm Campaign','Utm Medium', 'Rating', 'Comments');
    fputcsv($f, $fields, $delimiter);
    $i = 1;
    //output each row of the data, format line as csv and write to file pointer	if($u_count > 0){
		foreach($u_res_data as $row){
			$approval_code = $row['approval_code'];			$acquirer = $row['acquirer'];			$datetime = $row['datetime']; //echo $datetime;			$trn_date = $row['trn_date']; //echo $datetime;			$apx_amt = $row['apx_amt']; //echo $datetime;			$txn_amount = $row['net_amount'];			$diffamt = $apx_amt - $txn_amount;			$perc = ($diffamt / $apx_amt) * 100;			$mdrper = '1.53';			if($apx_amt > 2000){				$TXN_Rate = 'ABOVE 2K';				if($row['card_type_trns'] == 'CREDIT'){					$mdrper = '1.53';				}else{					$mdrper = '1.06';				}			}else{				$TXN_Rate = 'BELOW 2K';				if($row['card_type_trns'] == 'CREDIT'){					$mdrper = '1.53';				}else{					$mdrper = '0.40';				}			}			$abc1 = round((($row['domestic_amt'] - $row['net_amount']) / $row['domestic_amt']) * 100 , 2);			$debutedmdr = ($row['domestic_amt'] - $row['net_amount']);			$abc2 = round((($row['domestic_amt'] - $row['net_amount']) / $row['domestic_amt']) * 100 , 2);			$actual_mdr = round( ($mdrper / 100) * $row['domestic_amt'], 2);			$lineData = array($row['pos'], $row['tid'], $row['store_name'], $row['card_type_trns'],$row['trans_date'],$row['settle_date'],$row['transaction_id'],  "'".$row['rrn'],$row['approve_code'],$row['domestic_amt'], $row['net_amount'],$row['apr_no'],$row['invoice_no'],$row['apx_amt'], $row['trn_date'], ($row['apx_amt'] - $row['domestic_amt']), ($row['domestic_amt'] - $row['net_amount']), $abc1.'%', '', 'PINE LABS-POS', $TXN_Rate, round($debutedmdr, 2), $abc2.'%', $mdrper.'%', $actual_mdr, ($actual_mdr - $debutedmdr), $row['card_network'], $row['card_colour']);
			fputcsv($f, $lineData, $delimiter);
		$i++; }	}
   
    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
	
	exit;
	
	
?>
