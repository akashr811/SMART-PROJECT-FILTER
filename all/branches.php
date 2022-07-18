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
$branch_set=$admin->getAllbranches();
?>
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
	<?php displayMsg(); ?>
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-list"></i> branches</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
    
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="branches">
    <thead>
    <tr>
        <th>SI No</th>
        <th>Branch Name</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
	<?php 
	$i=1;
	while($branch_row=$branch_set->fetch_assoc()) { 
	?>
    <tr id="<?php echo $branch_row["id"]; ?>">
        <td><?php echo $i; ?></td>
		<td class="center"><?php echo $branch_row["name"]; ?></td>
        <td class="center">
           
            <a class="btn btn-info" href="<?php echo getBaseUrl(); ?>add_edit/branch.php?id=<?php echo $branch_row["id"]; ?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                
            </a>
            <a class="btn btn-danger delete" href="#">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                
            </a>
        </td>
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

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here settings can be configured...</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                </div>
            </div>
        </div>
    </div>
<?php 
//INCLUDING FOOTER
include_once(getFolderPath()."template/footer.php"); ?>	