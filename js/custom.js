$(document).ready(function(){
	function isConfirm()
	{
		var yes=confirm('Are you sure?');
		if(yes)
			return true;
		else
			return false;
	}
	$(".view_pg").click(function(){
		var tr_id=$(this).closest("tr").attr("id");
		$("#view_pg_modal_"+tr_id).modal("show");
	});
	$(".delete").click(function(){
		if(!isConfirm())
			return false;
		
		var tbl_name=$(this).closest("table").attr("id");
		var id=$(this).closest("tr").attr("id");
		var data="task=delete&tbl_name="+tbl_name+"&id="+id;
		$.ajax({
			type: "post",
			url: base_url+"classes/common.php",
			data: data,
			dataType: "json",
			success: function(data){
				if(data.status){
					$("#"+id).remove().draw();
					alert("Deleted successfully.");
				}
			}
		});
	});
});