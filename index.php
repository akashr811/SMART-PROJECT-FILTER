<?php
include_once("config/config.php");	
include_once(getFolderPath()."template/styles.php");
include_once(getFolderPath()."classes/security.php");	
$security=new security();
if(isset($_SESSION["logged_in"]))
{
	setMsg("Sorry You are already logged in.", "danger");
	redirect(getBaseUrl()."all/projects.php");
}	
if(isset($_POST["login_btn"]))
{
	$security->login();
}
?>
<div class="ch-container" id="main_div">
<div class="row">
    <div class="row">
        <div class="col-md-12 center login-header">
            <h2 class="title">SMART PROJECT FILTER</h2>
        </div>
        <!--/span-->
    </div><!--/row-->

    <div class="row" id="login_row">
        <div class="well col-md-5 center login-box" id="login_div">
			<?php displayMsg(); ?>
            <div class="alert alert-info">
                Please login with your Username and Password.
            </div>
            <form class="form-horizontal" method="post">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" class="form-control" placeholder="Enter Your ID" name="login_id">
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" class="form-control" placeholder="Enter Your Password" name="password">
                    </div>
                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <input type="submit" class="btn btn-primary" value="Login" name="login_btn">
                    </p>
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->
<?php include(getFolderPath()."template/footer.php"); ?>	