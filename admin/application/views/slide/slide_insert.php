
<style type="text/css">
	#sizeTest{
		text-align: center;
		position: relative;
		color: #d0d0d0;
		top:80px;
		margin-top: 0px !important;
	}

	#titleShow{
		margin-top: 0px !important;
		position: relative;
		top: -20px;
		text-align: center;
		color:white;
	}
	#descripShow{
		margin-top: 0px !important;
		position: relative;
		text-align: center;
		top: 70px;
		color:white;
	}

	#show{
		position: absolute;
	}

	img{
		margin-left: 70px;
	}


</style>

<script type="text/javascript">
	// change imge
	var LoadFile = function( event ){
		var output = document.getElementById("show");
		output.src = URL.createObjectURL(event.target.files[0]);
	}

// descriptio
	function changeDescription( desc ){
		document.getElementById("descripShow").innerHTML = '';
		document.getElementById("descripShow").innerHTML = desc;
	}

// title
function changeTitle( title ){
	document.getElementById("titleShow").innerHTML = '';
	document.getElementById("titleShow").innerHTML = title;
}

</script>

<aside class="right-side">
    <section class="content-header">
        <h1>Slide Settings<small>Control panel</small></h1>
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Slide Settings</li>
        </ol>
    </section>
	
	<section class="content">
		<div class="panel panel-success">
			<div class="panel-body" style="min-height:500px;">

				<div class="col-md-12">
					<img src="" name="show" id="show" class="img-thumbnail" height="200" width="900" style="height:200px;width:900px;" >
					<h2 id="sizeTest">200 x 900</h2>
					<h1 id="titleShow">Title</h1>
					<h3 id="descripShow">Description</h3>
				</div>

				<div class="col-md-12" style="top:150px;">
					<form action="index.php/slide_settings/image_upload" class="form-inline" role="form" method="post" enctype="multipart/form-data">
						<table class="table">
							<thead style="background:#99A5A8;">
								<tr>
									<th>Choose Image</th>
									<th>Title</th>
									<th>Description</th>
									<th>Sequence</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><input type="file" name="image" id="image" class="form-control" onchange="LoadFile( event )" accept="image/*" /></td>
									<td><input type="text" name="title" id="title" class="form-control" onkeyup="changeTitle(this.value)" /></td>
									<td>
										<textarea name="description" id="description" style="white-space: nowrap;" class="form-control" onkeyup="changeDescription(this.value)" ></textarea>
									</td>
									<td><input type="text" name="sequence" id="sequence" class="form-control" /></td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td></td>
									<td colspan="3">
										<button type="submit" id="upload" name="upload" class="btn btn-primary" style="width:250px;position:relative;left:50px;top:10px;" >Upload</button>
									</td>
								</tr>
							</tfoot>
						</table>
					</form>	
				</div>
			</div>
		</div>
	</section>
</aside>