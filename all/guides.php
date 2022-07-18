<?php
//INCLUDING CONFIGURATION FILE
include_once("../config/config.php");	
//INCLUDING SECURITY CLASS
include_once(getFolderPath()."classes/security.php");	
$security=new security();
//LOGIN CHECK
$security->checkLogin();
//USER CHECK
if($_SESSION["user"]["user_role_id"]!=ADMIN){
	setMsg("Sorry, You are not authorised to view that page!", "danger");
	redirect(getBaseUrl()."all/projects.php");
}
//INCLUDING CLASSES
include_once(getFolderPath()."classes/admin.php");	
//INCLUDING STYLES
include_once(getFolderPath()."template/styles.php"); 
//INCLUDING HEADER & LEFT MENU
include_once(getFolderPath()."template/header.php"); 
include_once(getFolderPath()."template/left_menu.php"); 
$admin=new admin();
$group_set=$admin->getAllgroups();
?>
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
	<?php displayMsg(); ?>
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-list"></i> Guides</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
    
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="project_groups">
    <thead>
    <tr>
        <th>SI No</th>
        <th>Guide Number</th>
		<th>Branch Name</th>
		<th>Email Id</th>
		<th>Phone</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
	<?php 
	$i=1;
	while($group_row=$group_set->fetch_assoc())		{ 
	if($group_row["user_role_id"]!=GD)
		continue;
	?>
    <tr id="<?php echo $group_row["pg_id"]; ?>">
        <td><?php echo $i; ?></td>
		<td class="center"><?php echo $group_row["group_number"]; ?></td>
		<td class="center"><?php echo $group_row["b_name"]; ?></td>
		<td class="center"><?php echo $group_row["email_id"]; ?></td>
		<td class="center"><?php echo $group_row["phone"]; ?></td>
        <td class="center">
			<a class="btn btn-info" href="<?php echo getBaseUrl(); ?>add_edit/guide.php?id=<?php echo $group_row["pg_id"]; ?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                
            </a>
            <a class="btn btn-danger delete" href="#">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                
            </a>
        </td>
		    <div class="modal fade" id="view_pg_modal_<?php echo $group_row["pg_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Project Group <?php echo $group_row["group_number"]; ?></h3>
                </div>
                <div class="modal-body">
				<div class="row"><h4>
                    <div class="col-md-4">Guide Number</div> <div class="col-md-8">: <?php echo $group_row["group_number"]; ?></div>					
					<div class="col-md-4">Branch</div> <div class="col-md-8">: <?php echo $group_row["b_name"]; ?></div>
					<div class="col-md-4">Email Id</div> <div class="col-md-8">: <?php echo $group_row["email_id"]; ?></div>
					<div class="col-md-4">Phone Number </div> <div class="col-md-8">: <?php echo $group_row["phone"]; ?></div>
					<div class="col-md-4">Member 1 </div> <div class="col-md-8">: <?php echo $group_row["member_1"]; ?></div>
					<div class="col-md-4">Member 2 </div> <div class="col-md-8">: <?php echo $group_row["member_2"]; ?></div>
					<div class="col-md-4">Member 3 </div> <div class="col-md-8">: <?php echo $group_row["member_3"]; ?></div>
					<div class="col-md-4">Member 4 </div> <div class="col-md-8">: <?php echo $group_row["member_4"]; ?></div>
					</h4>
					</div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
    </tr>
	<?php $i++; } ?>
    </tbody>
    </table>
    </div>
    </div>
    </div>
    <!--/span-->

    </div><!--/row--



    

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
    <hr>
<?php 
//INCLUDING FOOTER
include_once(getFolderPath()."template/footer.php"); ?>	