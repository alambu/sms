<?php
	$id=$_GET['id'];
	
	$edit=$this->db->select("*")
					->from("contact_admission")
					->where("id",$id)
					->get()
					->row();
?>

	



            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Book Category Form
                         <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Book Category Form</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
			
				<div class="row">
				<div class="col-md-10">
				  
<table align="right" width="800px" cellpadding="0" cellspacing="0" style=" margin-top:20px;" >
						<tr>
							<td><input type="button" value="Edit Contact Admission" style="width:220px; height:30px; font-size:22px;  color:#357CA5; border-radius:5px; font-weight:bold; border:none; text-align:center; text-decoration:underline; "/></td>
							
						</tr>
					  </table>

<form action="index.php/welcome/edit_contact_admission" method="post">
                      <table align="center" cellpadding="0" cellspacing="0" width="600px"  height="220px" border="0px" style="border-color:1px solid gray; margin-top:70px;" >
					  
					      <tr height="40px">
							   <td width="150px" style="font-size:25px; align:center;">Title</td>
							   <td><input type="text" name="contact_title" style="width:530px; height:35px; font-size:25px;" value="<?php echo $edit->title; ?>" /></td>
						  </tr>
						  
						  <input type="hidden" name="id" value="<?php echo $id; ?>" />
						  <tr height="130px">
							   <td width="150px" style="font-size:25px; align:center; vertical-align:top;">Details</td>
							   <td><textarea cols="54" rows="8" name="contact_details" style="font-size:20px;"> <?php echo $edit->details; ?> </textarea></td>
						  </tr>
						  <tr height="20px"></tr>
						  
					      <tr height="20px">
						  
							   <td colspan="2" style="text-align:center;">
							     <input type="submit" value="Submit" name="data_send" style="width:120px; height:40px; font-size:22px; background-color:#357CA5; color:white; border-radius:5px; font-weight:bold; border:none;"/>
							   </td>
							   
						  </tr>
						  
						  
					  </table>  
</form>
				</div>
				<div class="col-md-2">
				
				</div>
				
				</div>

				</section>
                                                            

                <!-- /.content -->
            </aside><!-- /.right-side -->
			
			

<?php 
if(isset($_POST['data_send'])){
	
$title=$_POST['contact_title'];
$details=$_POST['contact_details'];
$id=$_POST['id'];

$update=mysql_query("update contact_admission set title='$title',details='$details' where id='$id'");
if($update){
	redirect('welcome/contact_admission','location');
	
}
else{
	
	redirect('welcome/edit_contact_admission','location');
}

}
 ?>
 