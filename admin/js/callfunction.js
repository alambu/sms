$(document).ready(function(){
		$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab', $(e.target).attr('href'));
		});
			var activeTab = localStorage.getItem('activeTab');
		if(activeTab){
			$('#myTab a[href="' + activeTab + '"]').tab('show');
		}
	});
function isNumber(evt){
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
   if (charCode > 31 && (charCode < 48 || charCode > 57) && event.keyCode != 46) {
        return false;
    }
    return true;
}
function isamountonly(evt){
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57) && event.keyCode != 46) {
        return false;
    }
    return true;
}
function checkaccnumber(evt){
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }
    return true;
}
function delete_data(id){
	var aa=confirm('Are you Sure Delete this recored ?');
	if(aa==true){
		$.ajax({
		url: "index.php/account_edit/scholarship_delete",
		type: 'GET',	
		data:{shipids:id},	
		success: function(data)
		{							
			if(data==1){
				//window.location='index.php/account/listof_scholarship';
				window.location='index.php/account/stu_scholarship';
			}
			else{
				alert("Sorry !Your record  not delete.");
			}
		}          
		});
	}
	else{
		return ;
	}
	
}
function showAjaxModal(url)
{
// SHOWING AJAX PRELOADER IMAGE
jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:100px;"><img src="img/loading.gif" /></div>');

// LOADING THE AJAX MODAL
jQuery('#modal_ajax').modal({backdrop: 'static'});

// SHOW AJAX RESPONSE ON REQUEST SUCCESS
$.ajax({
	url: url,
	success: function(response)
	{
		jQuery('#modal_ajax .modal-body').html(response);
	}
});
}
function showAjaxModal1(url)
{
// SHOWING AJAX PRELOADER IMAGE
jQuery('#modal_ajax1 .modal-body').html('<div style="text-align:center;margin-top:100px;"><img src="img/loading.gif" /></div>');

// LOADING THE AJAX MODAL
jQuery('#modal_ajax1').modal({backdrop: 'static'});

// SHOW AJAX RESPONSE ON REQUEST SUCCESS
$.ajax({
	url: url,
	success: function(response)
	{
		jQuery('#modal_ajax1 .modal-body').html(response);
	}
});
}
////////////// start library section ////////
function only_chareter(v){
 if((event.keyCode==32) && (v=='')){
	return false;
 }
 else if ((event.keyCode > 64 && event.keyCode < 91) || (event.keyCode > 96 && event.keyCode < 123) || (event.keyCode == 8 || event.keyCode==32))
 {
	return true;
 }	
else
   {
   return false;
}
}
function only_chareterNumber(v){
 if((event.keyCode==32) && (v=='')){
	return false;
 }
 else if ((event.keyCode > 64 && event.keyCode < 91) || (event.keyCode > 96 && event.keyCode < 123) || (event.keyCode == 8 || event.keyCode==32) || (event.keyCode>47 && event.keyCode<58))
 {
	return true;
 }	
else
   {
   return false;
}
}

function confirm_reset(){
	var con=confirm("Are You Sure ?");
	if(con==true){
		document.getElementById('img_div').style.display='none';
		document.getElementById("picture").disabled=false;
		return true;
		
	}
	else {
		return false;
	}
}
function block_space(v){
 if((event.keyCode==32) && (v=='')){
	return false;
 }
 else {
	return true;
 }
}
////////// end library section ////////////////
