<?php
//INCLUDING CONFIGURATION FILE
include_once("../config/config.php");	
//INCLUDING SECURITY CLASS
include_once(getFolderPath()."classes/security.php");	
$security=new security();
//LOGIN CHECK
$security->checkLogin();
//USER CHECK
if($_SESSION["user"]["user_role_id"]==ADMIN){
	setMsg("Sorry, You are not authorised to view that page!", "danger");
	redirect(getBaseUrl()."all/projects.php");
}
//INCLUDING CLASSES
include_once(getFolderPath()."classes/project_group.php");	
//INCLUDING STYLES
include_once(getFolderPath()."template/styles.php"); 
//INCLUDING HEADER & LEFT MENU
include_once(getFolderPath()."template/header.php"); 
include_once(getFolderPath()."template/left_menu.php"); 
$project_group=new project_group();
if(isset($_POST["save_project_btn"]))
{
	$project_group->updateProject($_GET["id"]);
}
if(isset($_POST["add_project_btn"]))
{
	$project_group->addProject();
}
if(isset($_GET["id"]))
{
	$id=$_GET["id"]; //This is getting branch id by get method
	$project_row=$project_group->getProjectById($id);
	$heading="Edit Project";
	$title=$project_row["title"];
	$desc=$project_row["desc"];
	$doc=$project_row["doc"];
	$project_tag_set=$project_group->getTagsByProjectId($id);
	$sbmt_btn_name="save_project_btn";
	$doc_required="";
}
else
{
	$heading="Add Project";
	$title="";
	$desc="";
	$doc=false;
	$sbmt_btn_name="add_project_btn";
	$doc_required="required";
}
$tag_set=$project_group->getAllTags();
?>
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
	<?php displayMsg(); ?>
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-list"></i> <?php echo $heading; ?></h2>

        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
		<form class="form_center" method="post" enctype="multipart/form-data">
			<div class="form-group row">
				<label class="control-label col-md-2">Title</label>
				<div class="col-md-5">
				<input type="text" class="form-control" name="title" value="<?php echo $title; ?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-md-2">Description</label>
				<div class="col-md-5">
				<textarea class="form-control" name="desc" required><?php echo trim($desc, " "); ?></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-md-2">Tags</label>
				<div class="col-md-5">
				<select class="form-control" name="tag_ids[]" data-rel="chosen" multiple required>
				<?php 
				while($tag_row=$tag_set->fetch_assoc()) {
					$selected="";
					if(isset($project_tag_set)){
						while($project_tag_row=$project_tag_set->fetch_assoc()) {
							if($project_tag_row["t_id"]==$tag_row["id"])
								$selected="selected";
						}
						$project_tag_set->data_seek(0);
					}
				?>
					<option value="<?php echo $tag_row["id"]; ?>" <?php echo $selected; ?>><?php echo $tag_row["name"]; ?></option>
				<?php } ?>
				</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-md-2">Document</label>
				<div class="col-md-5">
				<input type="file" class="form-control" name="document" 
				<?php echo $doc_required; ?>>
				<?php if($doc){ ?>
					<a href="<?php echo getBaseUrl(); ?>assets/documents/<?php echo $doc; ?>" target="_blank">
					<br>&nbsp;View Project Document
					</a>
				<?php } ?>
				</div>
			</div>
			<div class="form-group row">
			<div class="col-md-5">
				<input type="submit" class="btn btn-primary pull-right" name="<?php echo $sbmt_btn_name; ?>" value="Save Project">
			</div>
			</div>
		</form>
    </div>
    </div>
    </div>
    <!--/span-->
    </div><!--/row-->
    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
    <hr>
<?php 
//INCLUDING FOOTER
include_once(getFolderPath()."template/footer.php"); ?>	