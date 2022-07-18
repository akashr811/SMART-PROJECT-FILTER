<?php
//INCLUDING CONFIGURATION FILE
include_once("config/config.php");	
//INCLUDING SECURITY CLASS
include_once(getFolderPath()."classes/security.php");	
$security=new security();
//LOGIN CHECK
$security->checkLogin();
//USER CHECK
if($_SESSION["user"]["user_role_id"]==ADMIN){
	setMsg("Sorry, You are not authorised to view that page!", "danger");
	redirect(getBaseUrl()."projects.php");
}
//INCLUDING CLASSES
include_once(getFolderPath()."classes/project_group.php");	
//INCLUDING STYLES
include_once(getFolderPath()."template/styles.php"); 
//INCLUDING HEADER & LEFT MENU
include_once(getFolderPath()."template/header.php"); 
include_once(getFolderPath()."template/left_menu.php"); 
$project_group=new project_group();
$tag_set=$project_group->getAllTags();
?>
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
	<?php displayMsg(); ?>
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-list"></i> Search Project</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
		<form class="form_center" method="post" action="<?php echo getBaseUrl(); ?>searched_projects.php">
			<div class="form-group row">
				<label class="control-label col-md-2">Title / Description</label>
				<div class="col-md-5">
				<input type="text" class="form-control" name="desc">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-md-2">Tags</label>
				<div class="col-md-5">
				<select class="form-control" name="tag_ids[]" data-rel="chosen" multiple>
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
			<div class="col-md-5">
				<input type="submit" class="btn btn-primary pull-right" name="search_project_btn" value="Search Project">
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