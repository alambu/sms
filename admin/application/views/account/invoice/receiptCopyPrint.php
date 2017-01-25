<?php 
function convert_number_to_words($number) {
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
 
//extract($postdata);

$schoolProfile = $this->db->order_by("id","DESC")->limit(1)->get("sprofile")->row();

// get transaction id
	$trans_id = $this->uri->segment(3);

	// get bill payment details
	$transInfo = $this->accmodone->billPaymentInfo( $trans_id );

	// transaction date
	$trans_d = explode(" ", $transInfo->e_date);
	$transDate = date("Y-m-d",strtotime($transInfo->e_date));

	// get invoice no
	$invoice = $transInfo->invoice_no;
//transaction info end

$invoiceInfo = $this->accmodone->getsingleInvoiceInfo($invoice);
foreach($invoiceInfo as $value) {
	$fmonth=$value->from_month;
}
$billmonth=$this->accmodone->getMonthName($fmonth);
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	
	<meta charset="UTF-8">
	<base href="<?php echo base_url(); ?>"></base>
	<title>Money Receipt</title>
	<link href="<?php echo base_url("css/all_print_copy/moneyRecipt.css"); ?>" rel="stylesheet" type="text/css"/>
</head>
<body>
	<?php 
	foreach($invoiceInfo as $value) {
	$stuid=$value->stu_id;
	$year=$value->years;
	
	$getProfileInfo = $this->db->query("SELECT r.stu_id,c.class_name,s.shift_N,p.section_name,rg.name,r.roll_no,rg.picture,sac.balance
	FROM re_admission r LEFT JOIN shift_catg s ON r.shiftid = s.shiftid LEFT JOIN class_catg c ON r.classid = c.classid
	LEFT JOIN section_tbl p ON r.section = p.sectionid LEFT JOIN regis_tbl rg ON rg.stu_id = r.stu_id
	LEFT JOIN student_account sac ON sac.stu_id = r.stu_id
	WHERE r.syear=$year and r.stu_id=$stuid")->row();
	
	//invoice description
	
	$invoiceDiscip = $this->accmodone->invoiceInfo( $value->invoice_no );
		
	// explode Waver Discount
	$discount=explode(",",$invoiceDiscip->discount);
	
	// explode Waver Category Discount
	$discountctg=explode(",",$invoiceDiscip->discount_ctg);
	
	// get fees category name
	$feesCategory = $this->accmodone->feesCategory( $invoiceDiscip->fee_catg );
	// print_r($feesCategory);
	
	$dueAmount = $this->accmodone->dueAmountOfStudent( $invoiceDiscip->stu_id );
	
	// get student information
	$studentInfo = $this->accmodone->studentInformation( $value->stu_id,$value->years );
	// print_r($studentInfo);
	
	// divide two part
	$feesPart = explode("+", $feesCategory);
	// explode fees name
	$feesName = explode(",", $feesPart[0]);
	// explode fees id
	$feesId = explode(",", $feesPart[1]);
	// explode Category id
	$feesctg = explode(",", $feesPart[2]);
	
	$tmonth = $invoiceDiscip->to_month - $invoiceDiscip->from_month + 1;
	
	// get waver information
	$waver = $this->accmodone->waverInformation( $studentInfo->shiftid,$studentInfo->classid,$studentInfo->section_name,$studentInfo->roll_no,$studentInfo->syear );
	
	$months = array(
		'1'  => 'January',
		'2'  => 'February',
		'3'  => 'March',
		'4'  => 'April',
		'5'  => 'May',
		'6'  => 'June',
		'7'  => 'July',
		'8'  => 'August',
		'9'  => 'September',
		'10' => 'October',
		'11' => 'November',
		'12' => 'December'
	);
	
	?>
	<div class="fix stracture wrapper"> 
		<div class="fix top-side">
			<div class="fix heading">
				<div class="heading-left floatleft">
					<div style="float:right;"> 
						<img src="<?php echo base_url("img/document/school_logo/$schoolProfile->logo"); ?>" alt="" style="height: 60px;width: 60px;" />
					</div>
				</div>
				<div class="heading-mid floatleft">
					<h2>Basurhat Academy</h2>
					<p class="small-font">T&T Road, Basurhat, Companigonj, Noakhali</p>
					<p>(An ideal educational Institute, Estd: 01.11.1994)</p>
					<p> 
						<span>Mobile :</span>
						<span>01700852032(office), 01818747155(principal)</span>
					</p>
					<p> 
						<span>web :</span>
						<span>basurhatacademy.com,</span>
						<span>e-mail :</span>
						<span>basurhatacademy@gmail.com</span>
					</p>
				</div>
				<div class="heading-right floatright">
					<img src="<?php echo base_url("img/print/qr_code.png"); ?>" alt="" style="" />
				</div>
			</div>
			<div class="fix mid-top">
				<div class="mid-top-left floatleft">
					<span>Invoice NO: </span><span><?php echo $value->invoice_no; ?></span><br />
					<span>Transaction NO: </span><span></span>
				</div>
				<div class="mid-top-mid floatleft">
					<p>Payment Receipt for Office</p>
					<span><?php echo $billmonth.'-'.$year; ?></span>
				</div>
				<div class="mid-top-right floatright">
					<p>
						<span>Generate Date: </span><span class="date-style"><?php echo date("Y-m-d",strtotime($value->e_date)); ?></span>
					</p>
					<p>
						<?php 
						$payday=$this->db->query("select e_date from stu_pay where invoice_no=$value->invoice_no")->row()->e_date;
						$paymentdate="YYYY-mm-dd";
						if(count($payday)>0){
						$paymentdate=date("Y-m-d",strtotime($payday));	
						}
						?>
						<span>Payment Date: </span><span class="date-style"><?php echo $paymentdate; ?></span>
					</p>
					<p>	
						<span>Received By: </span><span class="date-style"><?php echo $this->accmodone->getUserName($transInfo->e_user); ?></span>
					</p>
				</div>
			</div>
			<div class="fix mid-studentinfo">
				<div class="mid-studentinfo-left floatleft">
					<p> 
						<span class="span1">Student Id </span>
						<span class="span2"> <?php echo $getProfileInfo->stu_id; ?></span>
					</p>
					<p> 
						<span class="span1">Student's Name </span>
						<span class="span2"> <?php echo $getProfileInfo->name; ?></span>
					</p>
					<p> 
						<span class="span1">Shift </span>
						<span class="span3"> <?php echo $getProfileInfo->shift_N; ?></span>
					</p>
				</div>
				<div class="mid-studentinfo-right floatright">
					<p> 
						<span class="span1">Class </span>
						<span class="span3"> <?php echo $getProfileInfo->class_name; ?></span>
					</p>
					<p> 
						<span class="span1">Roll No </span>
						<span class="span3"> <?php echo $getProfileInfo->roll_no; ?></span>
					</p>
					<p> 
						<span class="span1">Section </span>
						<span class="span3"> <?php echo $getProfileInfo->section_name; ?></span>
					</p>
				</div>
			</div>
			<div class="fix mid-studentTaka">
				<table cellspacing="0" cellpadding="0">
					<tr> 
						<th style="width: 80%">Description</th>
						<th>Amount</th>
					</tr>
					<?php 
					for($i = 0;$i < count($feesName);$i++):
					echo "<tr>";
					$waver="";
					if(in_array($feesctg[$i],$discountctg)):
					$diskey = array_search ($feesctg[$i], $discountctg);
					$feesId[$i]=($feesId[$i]*($discount[$diskey]/100)).'.00';
					$waver="<span style='color:#DF3A01;'>Waver ( ".$discount[$diskey]."%)</span>";
					endif;
					
					$tbill += $feesId[$i];
					?>
					<td><?php echo $feesName[$i].' * '.$tmonth.' '.$waver; ?></td>
					<td><?php echo $feesId[$i]; ?></td>
					
					<?php echo "</tr>"; endfor; ?>
					<?php 
					//echo $value->vahicle_rent;
					if($value->vahicle_rent>0):
						echo "<tr>";
						echo "<td>Vahicales Rent * $tmonth</td>";
						echo "<td>$value->vahicle_rent</td>";
						echo "</tr>";
					endif;
					// end
					
					if($value->special_waver>0){
					echo "<tr>";
					echo "<td>Special Waver(-)</td>";
					echo "<td>$value->special_waver</td>";
					echo "</tr>";
					}
					?>
					<tr> 
						<td style="font-weight:bold;">Total</td>
						<td style="font-weight:bold;"><?php echo number_format($value->total_bill); ?>.00</td>
					</tr>
					<tr> 
						<td style="font-weight:bold;">Paid</td>
						<td style="font-weight:bold;"><?php echo number_format($transInfo->payment); ?>.00</td>
					</tr>
					<tr> 
						<td style="font-weight:bold;">Present Due</td>
						<td style="font-weight:bold;"><?php echo number_format(str_replace("-","",$dueAmount)); ?>.00</td>
					</tr>
				</table>
			</div>
			<div class="fix stracture inwords-div"> 
				<p>
						<span>In Words:</span>
						<span class="inwords"> <?php //echo $value->total_bill; 
						echo convert_number_to_words($value->total_bill); ?> taka only</span>
					</p>
			</div>
			<div class="fix footer">
				<div class="footer-left floatleft">
					<p><span>Class Teacher</span></p>
				</div>
				<div class="footer-right floatright">
					<p><span>Accounts Department</span></p>
				</div>
			</div>
		</div>
		<div class="dottet"></div>
		
<!-----------------------------------Student Copy Start--------------------------------------------------------->		
		<div class="fix stracture bottom-side">
			<div class="fix heading">
				<div class="heading-left floatleft">
					<div style="float:right;"> 
						<img src="<?php echo base_url("img/document/school_logo/$schoolProfile->logo"); ?>" alt="" style="height: 60px;width: 60px;" />
					</div>
				</div>
				<div class="heading-mid floatleft">
					<h2>Basurhat Academy</h2>
					<p class="small-font">T&T Road, Basurhat, Companigonj, Noakhali</p>
					<p>(An ideal educational Institute, Estd: 01.11.1994)</p>
					<p> 
						<span>Mobile :</span>
						<span>01700852032(office), 01818747155(principal)</span>
					</p>
					<p> 
						<span>web :</span>
						<span>basurhatacademy.com,</span>
						<span>e-mail :</span>
						<span>basurhatacademy@gmail.com</span>
					</p>
				</div>
				<div class="heading-right floatright">
					<img src="<?php echo base_url("img/print/qr_code.png"); ?>" alt="" style="" />
				</div>
			</div>
			<div class="fix mid-top">
				<div class="mid-top-left floatleft">
					<span>Invoice NO: </span><span><?php echo $value->invoice_no; ?></span><br />
					<span>Transaction NO: </span><span></span>
				</div>
				<div class="mid-top-mid floatleft">
					<p>Payment Receipt for Student</p>
					<span><?php echo $billmonth.'-'.$year; ?></span>
				</div>
				<div class="mid-top-right floatright">
					<p>
						<span>Generate Date: </span><span class="date-style"><?php echo date("Y-m-d",strtotime($value->e_date)); ?></span>
					</p>
					<p>
						<?php 
						$payday=$this->db->query("select e_date from stu_pay where invoice_no=$value->invoice_no")->row()->e_date;
						$paymentdate="YYYY-mm-dd";
						if(count($payday)>0){
						$paymentdate=date("Y-m-d",strtotime($payday));	
						}
						?>
						<span>Payment Date: </span><span class="date-style"><?php echo $paymentdate; ?></span>
					</p>
					<p>	
						<span>Received By: </span><span class="date-style"><?php echo $this->accmodone->getUserName($transInfo->e_user); ?></span>
					</p>
					
				</div>
			</div>
			<div class="fix mid-studentinfo">
				<div class="mid-studentinfo-left floatleft">
					<p> 
						<span class="span1">Student Id </span>
						<span class="span2"> <?php echo $getProfileInfo->stu_id; ?></span>
					</p>
					<p> 
						<span class="span1">Student's Name </span>
						<span class="span2"> <?php echo $getProfileInfo->name; ?></span>
					</p>
					<p> 
						<span class="span1">Shift </span>
						<span class="span3"> <?php echo $getProfileInfo->shift_N; ?></span>
					</p>
				</div>
				<div class="mid-studentinfo-right floatright">
					<p> 
						<span class="span1">Class </span>
						<span class="span3"> <?php echo $getProfileInfo->class_name; ?></span>
					</p>
					<p> 
						<span class="span1">Roll No </span>
						<span class="span3"> <?php echo $getProfileInfo->roll_no; ?></span>
					</p>
					<p> 
						<span class="span1">Section </span>
						<span class="span3"> <?php echo $getProfileInfo->section_name; ?></span>
					</p>
				</div>
			</div>
			<div class="fix mid-studentTaka">
				<table cellspacing="0" cellpadding="0">
					<tr> 
						<th style="width: 80%">Description</th>
						<th>Amount</th>
					</tr>
					<?php 
					//echo $waver;
					for($i = 0;$i < count($feesName);$i++):
					echo "<tr>";
					//$waver="";
					if(in_array($feesctg[$i],$discountctg)):
					$diskey = array_search ($feesctg[$i], $discountctg);
					endif;
					
					$tbill += $feesId[$i];
					?>
					<td><?php echo $feesName[$i].' * '.$tmonth.' '.$waver; ?></td>
					<td><?php echo $feesId[$i]; ?></td>
					
					<?php echo "</tr>"; endfor; ?>
					<?php 
					if($value->vahicle_rent>0):
						echo "<tr>";
						echo "<td>Vahicales Rent * $tmonth</td>";
						echo "<td>$value->vahicle_rent</td>";
						echo "</tr>";
					endif;
					// end
					
					if($value->special_waver>0){
					echo "<tr>";
					echo "<td>Special Waver(-)</td>";
					echo "<td>$value->special_waver</td>";
					echo "</tr>";
					}
					?>
					<tr> 
						<td style="font-weight:bold;">Total</td>
						<td style="font-weight:bold;"><?php echo number_format($value->total_bill); ?>.00</td>
					</tr>
					<tr> 
						<td style="font-weight:bold;">Paid</td>
						<td style="font-weight:bold;"><?php echo number_format($transInfo->payment); ?>.00</td>
					</tr>
					<tr> 
						<td style="font-weight:bold;">Present Due</td>
						<td style="font-weight:bold;"><?php echo number_format(str_replace("-","",$dueAmount)); ?>.00</td>
					</tr>
				</table>
			</div>
			<div class="fix stracture inwords-div"> 
				<p>
						<span>In Words:</span>
						<span class="inwords"> <?php echo convert_number_to_words($value->total_bill); ?> taka only</span>
					</p>
			</div>
			<div class="fix footer">
				<div class="footer-left floatleft">
					<p><span>Class Teacher</span></p>
				</div>
				<div class="footer-right floatright">
					<p><span>Accounts Department</span></p>
				</div>
			</div>
		</div>
	</div>
	<?php
	
	}
	?>	
	<!--- for print----->
		<div id="print-full-page" class="no-print">
			<div class="print-certificate">
				<a target="" href="javaScript:window.print();" title="প্রিন্ট করুন">
					<img src="<?php echo base_url("img/print/print_big.png"); ?>" alt="প্রিন্ট করুন" />
				</a>
			</div>
		</div>
		<!--- end for print------>
</body>
</html>