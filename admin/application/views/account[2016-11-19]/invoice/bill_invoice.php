<style>
	 .error{ border:1px solid red;}	 
	 table tr{line-height:8px;}
	 table.purpose input{border:1px solid #ddd;width:230px;}
	 table.purpose td{padding:0px;}
	 select{width:150px;}
	 td.right{text-align:right;}
	 a#print{
	 color:white;padding:6px 15px;background:green;font-size:25px;
	 position:relative;
	 top:250px;
	 left:250px;
	 }
	 input#dakhil{
	 background:green;
	 color:white;
	 width:150px;
	 font-size:16px;
	 }
	 </style>
 <head>
	<meta charset="utf-8"/>
 </head>
<script type="text/javascript">
//for popup window
$(document).ready(function(){
 $("#print").hide();
	$('.daily').submit(function() {
	$.post(
            "index.php/admin/moneyRcpt",
            $(".daily").serialize(),
            function(data){
			if(data=="1"){
			 $("#print").show();
			alert("আপনার রশিদটি প্রিন্ট করুন ");
			
			}
			else {alert(data);}
		});
	return false;
	});
	});
$(function() {
    $("#cdate").datepicker();
  });
</script>

<style>
input{height:25px;}
#office{
height:auto;
width:400px;
float:left;
border-right:1px solid #000;
margin-top:10px;
}
#student{
height:auto;
width:400px;
float:right;
border-left:1px solid #000;
margin-top:10px;
}
#main_content{
min-height:1150px;
width:825px;
background:#FFFFFF;
border:1px solid #000;
}
.bold{
font-weight:bold;
}
.table_style{
width:350px; 
min-height:100px; 
margin:5px auto;
border-color:lightgray;
}
.table_style tr td {
padding-left:2px;
}
.text_center{
text-align:center;
}
.table_style_item{
width:350px; 
min-height:250px; 
margin:0px auto;
border-color:lightgray;
}
<?php $sql=$this->db->query("SELECT * FROM sprofile WHERE id='1'")->row();?>
</style>
		<!-- Content (Right Column) -->
		<div id="main_content">
		<div id="office">
			<table style="margin-top:10px;">
			<tr>
			<td>
				<img src="<?php echo base_url()?><?php echo $row->logo?>" height="80px;" width="100px;" style="margin-top:0px;"/>
			</td>
			<td>
			<p style="text-align:center;font-size:25px;font-weight:bold;line-height:0px;">Bill Payment Receipt</p>	
			<p style="text-align:center;font-size:20px;font-weight:bold;line-height:0px;">(Office Copy)</p>	
			<p style="text-align:center;font-size:16px;font-weight:bold;line-height:5px;"><?php echo $sql->schoolN?></p>	
			<p style="text-align:center;font-size:12px;font-weight:bold;line-height:5px;"><?php echo $sql->address?></p>
			<p style="text-align:center;font-size:12px;font-weight:bold;line-height:5px;">Phone :<?php echo $sql->phone,$sql->mobile?></p>
			</td>
			</tr>
			</table>
			
				<table  class="table_style" class="table">
					<tr>
						<td class="bold">Receipt No</td>
						<td class="bold">:</td>
						<td><?php echo $payamount;?></td>
						<td class="bold">Print Date</td>
						<td class="bold">:</td>
						<td><?php echo date('M-d-Y')?></td>
					</tr>
					<tr>
						<td class="bold">Name</td>
						<td class="bold">:</td>
						<td colspan="4">Mehedi Hasan Shamim</td>
					</tr>
					<tr>
						<td class="bold">ID</td>
						<td class="bold">:</td>
						<td>654646434</td>
						<td class="bold">Roll</td>
						<td class="bold">:</td>
						<td>484126</td>
					</tr>
					<tr>
						<td class="bold">Class</td>
						<td class="bold">:</td>
						<td>Eight</td>
						<td class="bold">Seciton</td>
						<td class="bold">:</td>
						<td>B</td>
					</tr>
					<tr>
						<td class="bold">Shift</td>
						<td class="bold">:</td>
						<td colspan="4">Morning</td>
					</tr>
					
					
				</table>
				<table cellpadding="0" cellspacing="0" border="1" class="table_style_item" align="center" class="table">
				
					<tr>
						<th>No</th>
						<th>Itme</th>
						<th>Amount</th>
					</tr>
				
					<tr>
						<td class="text_center">1</td>
						<td>Courese Fee</td>
						<td>12000</td>
					</tr>
					<tr>
						<td class="text_center">2</td>
						<td>Certificate Fee</td>
						<td>300</td>
					</tr>
					<tr>
						<td class="text_center">3</td>
						<td>Jamanot Fee</td>
						<td>500</td>
					</tr>
					<tr>
						<td class="text_center">4</td>
						<td>Scaout Fee</td>
						<td>150</td>
					</tr>
					<tr>
						<td class="text_center">5</td>
						<td>Medical</td>
						<td>100</td>
					</tr>
					<tr>
						<td class="text_center">6</td>
						<td>Daly Sports</td>
						<td>400</td>
					</tr>
					<tr>
						<td class="text_center">7</td>
						<td>Litarater</td>
						<td>2000</td>
					</tr>
					<tr>
						<td class="text_center">8</td>
						<td>Cultural</td>
						<td>130</td>
					</tr>
					<tr>
						<td class="text_center">9</td>
						<td>Month Bill</td>
						<td>1200</td>
					</tr>
					<tr>
						<td class="text_center">10</td>
						<td>Electric</td>
						<td>140</td>
					</tr>
					<tr>
						<td class="text_center">11</td>
						<td>Electric</td>
						<td>140</td>
					</tr>
					<tr>
						<td class="text_center">12</td>
						<td>Electric</td>
						<td>140</td>
					</tr>
					<tr>
						<td class="text_center">13</td>
						<td>Electric</td>
						<td>140</td>
					</tr>
					<tr>
						<td class="text_center">14</td>
						<td>Electric</td>
						<td>140</td>
					</tr>
					<tr>
						<td class="text_center">15</td>
						<td>Electric</td>
						<td>140</td>
					</tr>
					<tr>
					<th colspan="2">
						Total:
					</th>
					<th >
						5,3015
					</th>
					</tr>
				</table>
				<table align="center" style="margin-top:10px;margin-left:20px;">
					<tr>
					<td class="bold">In Word:Five Handred Forty five taka Only</td>
				</tr>
				</table>
				<p style="text-align:left;padding-left:20px;"><i style="font-weight:bold;"><u>Principle Sign</u></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="font-weight:bold;"> <u>Ricived By</u></i></p>
					<p style="text-align:left;padding-left:20px;line-height:0px;">Mobarok Hossain  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mehedi</p>
					
		</div>

		<div id="student">
			<table style="margin-top:10px;">
			<tr>
			<td>
				<img src="../../../../img/schoolslogo.jpg" height="80px;" width="100px;" style="margin-top:0px;"/>
			</td>
			<td>
				<p style="text-align:center;font-size:25px;font-weight:bold;line-height:0px;">Bill Payment Recipt</p>	
			<p style="text-align:center;font-size:20px;font-weight:bold;line-height:0px;">(Student Copy)</p>	
			<p style="text-align:center;font-size:16px;font-weight:bold;line-height:5px;">Golden Valley School</p>	
			<p style="text-align:center;font-size:12px;font-weight:bold;line-height:5px;">2010/Iqbal Road, Mohammad ,Dhaka</p>
			</td>
			</tr>
			</table>
			
				<table  class="table_style" class="table">
					<tr>
						<td class="bold">Recipt No</td>
						<td class="bold">:</td>
						<td>6546464</td>
						<td class="bold">Date</td>
						<td class="bold">:</td>
						<td>31-12-1994</td>
					</tr>
					<tr>
						<td class="bold">Name</td>
						<td class="bold">:</td>
						<td colspan="4">Mehedi Hasan Shamim</td>
					</tr>
					<tr>
						<td class="bold">ID</td>
						<td class="bold">:</td>
						<td>654646434</td>
						<td class="bold">Roll</td>
						<td class="bold">:</td>
						<td>484126</td>
					</tr>
					<tr>
						<td class="bold">Class</td>
						<td class="bold">:</td>
						<td>Eight</td>
						<td class="bold">Seciton</td>
						<td class="bold">:</td>
						<td>B</td>
					</tr>
					<tr>
						<td class="bold">Shift</td>
						<td class="bold">:</td>
						<td colspan="4">Morning</td>
					</tr>
					
					
				</table>
				<table cellpadding="0" cellspacing="0" border="1" class="table_style_item" align="center" class="table">
				
					<tr>
						<th>No</th>
						<th>Itme</th>
						<th>Amount</th>
					</tr>
				
					<tr>
						<td class="text_center">1</td>
						<td>Courese Fee</td>
						<td>12000</td>
					</tr>
					<tr>
						<td class="text_center">2</td>
						<td>Certificate Fee</td>
						<td>300</td>
					</tr>
					<tr>
						<td class="text_center">3</td>
						<td>Jamanot Fee</td>
						<td>500</td>
					</tr>
					<tr>
						<td class="text_center">4</td>
						<td>Scaout Fee</td>
						<td>150</td>
					</tr>
					<tr>
						<td class="text_center">5</td>
						<td>Medical</td>
						<td>100</td>
					</tr>
					<tr>
						<td class="text_center">6</td>
						<td>Daly Sports</td>
						<td>400</td>
					</tr>
					<tr>
						<td class="text_center">7</td>
						<td>Litarater</td>
						<td>2000</td>
					</tr>
					<tr>
						<td class="text_center">8</td>
						<td>Cultural</td>
						<td>130</td>
					</tr>
					<tr>
						<td class="text_center">9</td>
						<td>Month Bill</td>
						<td>1200</td>
					</tr>
					<tr>
						<td class="text_center">10</td>
						<td>Electric</td>
						<td>140</td>
					</tr>
					<tr>
						<td class="text_center">11</td>
						<td>Electric</td>
						<td>140</td>
					</tr>
					<tr>
						<td class="text_center">12</td>
						<td>Electric</td>
						<td>140</td>
					</tr>
					<tr>
						<td class="text_center">13</td>
						<td>Electric</td>
						<td>140</td>
					</tr>
					<tr>
						<td class="text_center">14</td>
						<td>Electric</td>
						<td>140</td>
					</tr>
					<tr>
						<td class="text_center">15</td>
						<td>Electric</td>
						<td>140</td>
					</tr>
					<tr>
					<th colspan="2">
						Total:
					</th>
					<th >
						5,3015
					</th>
					</tr>
				</table>
				<table align="center" style="margin-top:10px;margin-left:20px;">
					<tr>
					<td class="bold">In Word:Five Handred Forty five taka Only</td>
				</tr>
				</table>
				<p style="text-align:left;padding-left:20px;"><i style="font-weight:bold;"><u>Principle Sign</u></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="font-weight:bold;"> <u>Ricived By</u></i></p>
					<p style="text-align:left;padding-left:20px;line-height:0px;">Mobarok Hossain  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mehedi</p>
					
		</div>
		


