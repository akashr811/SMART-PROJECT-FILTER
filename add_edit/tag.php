<?php
//INCLUDING CONFIGURATION FILE
include_once("../config/config.php");	
//INCLUDING SECURITY CLASS
include_once(getFolderPath()."classes/security.php");	
$security=new security();
//LOGIN CHECK
$security->checkLogin();
//USER CHECK
if($_SESSION["user"]["user_role_id"]!=GD){
	setMsg("Sorry, You are not authorised to view that page!", "danger");
	redirect(getBaseUrl()."all/projects.php");
}
//INCLUDING CLASSES
include_once(getFolderPath()."classes/guide.php");	
//INCLUDING STYLES
include_once(getFolderPath()."template/styles.php"); 
//INCLUDING HEADER & LEFT MENU
include_once(getFolderPath()."template/header.php"); 
include_once(getFolderPath()."template/left_menu.php"); 
$guide=new guide();
if(isset($_POST["save_tag_btn"]))
{
	$guide->savetag($_GET["id"]);
}
if(isset($_POST["add_tag_btn"]))
{
	$guide->addTag();
}
	if(isset($_GET["id"]))
{
	$heading="Edit tag";
	$id=$_GET["id"]; //This is getting branch id by get method
	$tag_row=$guide->gettagById($id);
	$name=$tag_row["name"];
	$sbmt_btn_name="save_tag_btn";
}
else{
	$heading="Add tag";
	$name="";
	$sbmt_btn_name="add_tag_btn";
    }
	


?>
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
	<?php displayMsg(); ?>
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-list"></i> <?php echo $heading;  ?></h2>

        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
		<form class="form_center" method="post">
			<div class="form-group row">
				<label class="control-label col-md-2">Tag Name</label>
				<div class="col-md-5">
				<input type="text" class="form-control" name="tag_name" placeholder="Enter Tag Name" 
				value="<?php echo $name; ?>">
				</div>
			</div>
			<div class="form-group row">
			<div class="col-md-5">
				<input type="submit" class="btn btn-primary pull-right" name="<?php echo $sbmt_btn_name; ?>" value="Save Tag">
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