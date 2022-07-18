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
if(isset($_POST["save_group_btn"]))
{
	$admin->saveGroup($_GET["id"]);
}
if(isset($_POST["add_group_btn"]))
{
	$admin->addGroup();
}
if(isset($_GET["id"]))
{
	$id=$_GET["id"]; //This is getting branch id by get method
	$group_row=$admin->getGroupById($id);
	$heading="Edit Group";
	$group_number=$group_row["group_number"];
	$phone=$group_row["phone"];
	$email_id=$group_row["email_id"];
	$branch_id=$group_row["branch_id"];
	$password=$group_row["password"];
	$member_1=$group_row["member_1"];
	$member_2=$group_row["member_2"];
	$member_3=$group_row["member_3"];
	$member_4=$group_row["member_4"];
	$sbmt_btn_name="save_group_btn";
}
else
{
	$heading="Add Group";
	$group_number="Auto Generated";
	$phone="";
	$email_id="";
	$branch_id=0;
	$password="";
	$member_1="";
	$member_2="";
	$member_3="";
	$member_4="";
	$sbmt_btn_name="add_group_btn";
}
$branch_set=$admin->getAllBranches();
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
		<form class="form_center" method="post">
			<div class="form-group row">
				<label class="control-label col-md-2">Guide Number</label>
				<div class="col-md-5">
				<input type="text" class="form-control" name="group_number" value="<?php echo $group_number; ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-md-2">Mobile Number</label>
				<div class="col-md-5">
				<input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-md-2">Email Id</label>
				<div class="col-md-5">
				<input type="text" class="form-control" name="email_id" value="<?php echo $email_id; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-md-2">Branch</label>
				<div class="col-md-5">
				<select class="form-control" name="branch_id">
				<?php while($branch_row=$branch_set->fetch_assoc()) { 
				$selected="";
				if($branch_row["id"]==$branch_id)
					$selected="selected";
				?>
					<option value="<?php echo $branch_row["id"]; ?>" <?php echo $selected; ?>><?php echo $branch_row["name"]; ?></option>
				<?php } ?>
				</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-md-2">Password</label>
				<div class="col-md-5">
				<input type="password" class="form-control" name="password" value="<?php echo $password; ?>" required>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-5">
				<input type="hidden" class="form-control" name="guide_id" value="0">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-5">
				<input type="hidden" class="form-control" name="member_1" value="<?php echo $member_1; ?>">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-5">
				<input type="hidden" class="form-control" name="member_2" value="<?php echo $member_2; ?>">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-5">
				<input type="hidden" class="form-control" name="member_3" value="<?php echo $member_3; ?>">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-5">
				<input type="hidden" class="form-control" name="member_4" value="<?php echo $member_4; ?>">
				</div>
			</div>
			<input type="hidden" class="form-control" name="user_role" value="2">
			<div class="form-group row">
			<div class="col-md-5">
				<input type="submit" class="btn btn-primary pull-right" name="<?php echo $sbmt_btn_name; ?>" value="Save Guide">
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