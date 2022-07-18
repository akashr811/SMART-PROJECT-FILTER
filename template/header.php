    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html"> 
                <span>Smart Project Filter
		        </span></a>

            <!-- user dropdown starts -->
           
            <!-- user dropdown ends -->

            <!-- theme selector starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span
                        class="hidden-sm hidden-xs"> <?php echo $_SESSION["user"]["ur_name"]." - ".$_SESSION["user"]["group_number"]; ?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
				<?php if($_SESSION["user"]["user_role_id"]==ADMIN) { ?>
                    <li><a href="<?php echo getBaseUrl(); ?>profile.php?id=<?php echo $_SESSION["user"]["pg_id"]; ?>"><i class="whitespace"></i> Profile</a></li>
				<?php } ?>	
                    <li><a href="<?php echo getBaseUrl(); ?>logout.php"><i class="whitespace"></i> Logout</a></li>
                    
                </ul>
            </div>
            <!-- theme selector ends -->

            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                
                
            </ul>

        </div>
    </div>
	<script>
	var base_url="<?php echo getBaseUrl(); ?>";
	</script>
    <!-- topbar ends -->
<div class="ch-container">
<div class="row">	