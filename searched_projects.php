<?php
include_once("config/config.php");	
include_once(getFolderPath()."classes/security.php");	
$security=new security();
$security->checkLogin();
//USER CHECK
if($_SESSION["user"]["user_role_id"]==ADMIN){
	setMsg("Sorry, You are not authorised to view that page!", "danger");
	redirect(getBaseUrl()."all/groups.php");
}
include_once(getFolderPath()."classes/common.php");	
include_once(getFolderPath()."template/styles.php"); 
include_once(getFolderPath()."template/header.php"); 
include_once(getFolderPath()."template/left_menu.php"); 
$common=new common();
if(isset($_POST["search_project_btn"]))
{
	$pa=$common->searchProjects();
}
?>
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
	<?php displayMsg(); ?>
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-list"></i> Search Results</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
    
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="projects">
    <thead>
    <tr>
        <th>SI No</th>
        <th>Group Number</th>
		<th>Branch</th>
        <th>Project Name</th>
        <th>Tags</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
	<?php 
	$i=1;
	foreach($pa as $project_row){
	$tag_set=$common->getTagsByProjectId($project_row["p_id"]);
	?>
    <tr id="<?php echo $project_row["p_id"]; ?>">
        <td><?php echo $i; ?></td>
		<td class="center"><?php echo $project_row["group_number"]; ?></td>
		<td class="center"><?php echo $project_row["b_name"]; ?></td>
        <td class="center"><?php echo $project_row["title"]; ?></td>
        <td class="center">
		<?php
			while($tag_row=$tag_set->fetch_assoc()) { ?>
            <span class="label-success label label-default"><?php echo $tag_row["name"]; ?></span>
			<?php } ?>
        </td>
        <td class="center">
            <a class="btn btn-success" href="#">
                <i class="glyphicon glyphicon-eye-open icon-white"></i>
                
            </a>
			<?php if($_SESSION["user"]["user_role_id"]!=PG){ ?>
            <a class="btn btn-info" href="<?php echo getBaseUrl(); ?>add_edit/project.php?id=
			<?php echo $project_row["p_id"]; ?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                
            </a>
            <a class="btn btn-danger delete" href="#">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                
            </a>
			<?php } ?>
        </td>
    </tr>
	<?php $i++; } ?>
    </tbody>
    </table>
    </div>
    </div>
    </div>
    <!--/span-->

    </div><!--/row-->
    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
    <hr>
<?php include_once(getFolderPath()."template/footer.php"); ?>	