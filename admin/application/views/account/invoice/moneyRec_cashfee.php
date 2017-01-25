<html>
	<head>
	<base url="<?php echo base_url()?>"></base>
	<script type="text/javascript" language="javascript" src="<?php echo base_url()?>js/update_jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){				
				$(function() {
				$( "#content").window.print();
			  });
			});
		</script>
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

	input{height:25px;}
	#content{
	height:auto;
	width:700px;
	}
	#table_style{
	width:650px;
	margin:10px; auto;
	}
	#table_style tr td{
	text-align:left;
	font-size:20px;
	font-weight:bold;
	line-height:0px;
	}

</style>
	</head>
	<body onload="window.print();">
<?php $schols=$this->db->query("SELECT * FROM sprofile WHERE id='1'")->row();?>
		<!-- Content (Right Column) -->
		<div id="content" class="box" style="border:1px solid #000;margin:0 auto;">
			<div style="width:700px;border:0px solid red;min-height:105px; margin-top:20px;margin-bottom:15px;">
					<div style="width:200px;border:0px solid green;float:left;">						
						<img src="<?php echo base_url()?><?php echo $schols->logo?>" height="100px;" width="120px;" style="float:right;"/>
					</div>
					<div style="width:300px;border:0px solid green;float:left;margin-left:10px;font-style:italic;">
						<p style="font-size:20px;text-align:center;margin:1px 0px 0px 0px;"><?php echo $schols->schoolN;?></p>
						<p style="font-size:15px;font-family:Times New Roman, Georgia, Serif;text-align:center;margin:1px 0px 0px 0px;">Address :<?php echo $schols->address;?></p>
						<p style="font-size:14px;font-family:Times New Roman, Georgia, Serif;text-align:center;margin:1px 0px 0px 0px;">Phone :<?php echo $schols->phone.','.$schols->mobile;?></p>	
						
					</div>
					<div style="width:150px;border:0px solid green;float:left;">						
						<p style="font-size:20px;text-align:center;margin:1px 0px 0px 0px;">(Office Copy)</p>
					</div>
				</div>
					<div style="width:700px;border:0px solid red;height:80px;">
						<div style="width:400px;float:left;">
						<?php 
							 $invos=$this->session->userdata('moneyinv');
							 $this->session->unset_userdata('moneyinv');						
							$appsql=$this->db->query("select * from app_fees where invoice_no='$invos'")->row();
						?>
									<table style="margin-left:15px;">
										<tr height="25px;">
											<td>Application ID</td>
											<td>:</td>
											<td><?php echo $appids=$appsql->appid;?></td>
										</tr>
										<tr height="25px;">
											<td>Student Name</td>
											<td>:</td>
											<td>
												<?php $appname=$this->db->select('name,e_date')->from('application_tbl')->where('appid',$appids)->get()->row();?>
											<?php echo $stuname=$appname->name;?>											
											</td>
										</tr>
										<tr height="25px;">
											<td>Application for Class</td>
											<td>:</td>
											<td><?php $sapp=$appsql->purpose; $appCls=explode('|',$sapp); echo $appcl=$appCls[1];?></td>
										</tr>
									</table>
						</div>
						<div style="width:250px;float:right;">
						
									<table>
										<tr height="25px;">
											<td>Money Receipt No</td>
											<td>:</td>
											<td><?php echo $appsql->invoice_no	;?></td>
										</tr>
										<tr height="25px;">
											<td>Payment Date</td>
											<td>:</td>
											<td>
												<?php echo date('M-d-Y',strtotime($appsql->e_date))?>
											</td>
										</tr>
										
									</table>
						</div>
					</div>
					
					<p style="margin-left:15px;">Revived with thanks From <input type="text" value="<?php echo $appname->name;?>" style="width:479px;border:none;border-bottom:1px dotted black;text-align:center;"/></p>
					<p style="margin-left:15px;">Taka (In Words)<input type="text" name="numbers" id="numbers" value="<?php echo $word=$this->numbershow->convertToWord($appsql->amount).'only';?>" style="width:549px;border:none;border-bottom:1px dotted black;text-align:center;text-transform: capitalize;"/></p>
					<p style="margin-left:15px;">Taka (In Figures)  <input type="text" name="fignumber" value="<?php echo $appsql->amount.'/=';?>" style="min-width:150px;border:1px solid black;text-align:center;"/> &nbsp;By Cash.</p>
					
					
					<div style="width:700px;border:0px solid red;height:70px; margin-bottom:20px;">
						<div style="width:250px;float:left;margin:0px 10px 0px 10px;">
								<br/>					
								<br/>	<hr/>			
						<p style="text-align:center;margin:1px 0px 1px 0px;"><i style="font-weight:bold;">Student Sign</i></p>
						</div>
						<div style="width:280px;float:right;margin:0px 10px 0px 10px;">
						<br/>					
						<br/>
						<hr/>		
						<p style="text-align:center;margin:1px 0px 1px 0px;"><i style="font-weight:bold;">Received By</i></p>
						</div>
					</div>
		<hr style="border:1px dotted green;margin-bottom:42px;margin-top:42px;">			
				<div style="width:700px;border:0px solid red;min-height:105px; margin-top:20px;margin-bottom:15px;">
					<div style="width:200px;border:0px solid green;float:left;">
						<!--<img src="<?php// echo $schols->logo?>" height="80px;" width="100px;" style="text-align:center;"/>-->
						<img src="<?php echo base_url()?>img/schoolslogo.jpg" height="100px;" width="120px;" style="float:right;"/>
					</div>
					<div style="width:300px;border:0px solid green;float:left;margin-left:10px;font-style:italic;">
						<p style="font-size:20px;text-align:center;margin:1px 0px 0px 0px;"><?php echo $schols->schoolN;?></p>
						<p style="font-size:15px;font-family:Times New Roman, Georgia, Serif;text-align:center;margin:1px 0px 0px 0px;">Address :<?php echo $schols->address;?></p>
						<p style="font-size:14px;font-family:Times New Roman, Georgia, Serif;text-align:center;margin:1px 0px 0px 0px;">Phone :<?php echo $schols->phone.','.$schols->mobile;?></p>	
						
					</div>
					<div style="width:150px;border:0px solid green;float:left;">						
						<p style="font-size:20px;text-align:center;margin:1px 0px 0px 0px;">(Student Copy)</p>
					</div>
				</div>
					<div style="width:700px;border:0px solid red;height:80px;">
						<div style="width:400px;float:left;">
									<table style="margin-left:15px;">
										<tr height="25px;">
											<td>Application ID</td>
											<td>:</td>
											<td><?php echo $appids=$appsql->appid;?></td>
										</tr>
										<tr height="25px;">
											<td>Student Name</td>
											<td>:</td>
											<td>												
											<?php echo $stuname;?>
											</td>
										</tr>
										<tr height="25px;">
											<td>Application for Class</td>
											<td>:</td>
											<td><?php echo $appcl;?></td>
										</tr>
									</table>
						</div>
						<div style="width:250px;float:right;">
						<table>
										<tr height="25px;">
											<td>Money Receipt No</td>
											<td>:</td>
											<td><?php echo $appsql->invoice_no	;?></td>
										</tr>
										<tr height="25px;">
											<td>Payment Date</td>
											<td>:</td>
											<td>
												<?php echo date('M-d-Y',strtotime($appsql->e_date))?>
											</td>
										</tr>
										
									</table>
						</div>
					</div>
					
					<p style="margin-left:15px;">Revived with thanks From <input type="text" value="<?php echo $appname->name;?>" style="width:479px;border:none;border-bottom:1px dotted black;text-align:center;"/></p>
					<p style="margin-left:15px;">Taka (In Words)<input type="text" name="numbers" id="numbers" value="<?php echo $word;?>" style="width:549px;border:none;border-bottom:1px dotted black;text-align:center;text-transform: capitalize;"/></p>
					<p style="margin-left:15px;">Taka (In Figures)  <input type="text" name="fignumber" value="<?php echo $appsql->amount.'/=';?>" style="min-width:150px;border:1px solid black;text-align:center;"/> &nbsp;By Cash.</p>
					
					<div style="width:700px;border:0px solid red;height:70px; margin-bottom:20px;">
						<div style="width:250px;float:left;margin:0px 10px 0px 10px;">
								<br/>					
								<br/>	<hr/>			
						<p style="text-align:center;margin:1px 0px 1px 0px;"><i style="font-weight:bold;">Student Sign</i></p>
						</div>
						<div style="width:280px;float:right;margin:0px 10px 0px 10px;">
						<br/>					
						<br/>
						<hr/>		
						<p style="text-align:center;margin:1px 0px 1px 0px;"><i style="font-weight:bold;">Received By</i></p>
						</div>
					</div>
					
		</div> <!-- /content -->

	</div> <!-- /cols -->
			
	</body>
	
</html>