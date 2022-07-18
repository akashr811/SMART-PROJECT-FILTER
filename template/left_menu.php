        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
					<?php if($_SESSION["user"]["user_role_id"]!=ADMIN) { ?>
                        <li class="nav-header">Projects</li>
                        </li>
                        <li><a class="ajax-link" href="<?php echo getBaseUrl(); ?>all/projects.php"><i class="glyphicon glyphicon-eye-open"></i><span> All projects</span></a>
                        </li>
						<li><a class="ajax-link" href="<?php echo getBaseUrl(); ?>project_filter.php"><i class="glyphicon glyphicon-list"></i><span> Project filter</span></a>
                        </li>
						<?php } ?>
						<?php if($_SESSION["user"]["user_role_id"]==PG) { ?>
                        <li><a class="ajax-link" href="<?php echo getBaseUrl(); ?>add_edit/project.php"><i
                                    class="glyphicon glyphicon-plus"></i><span> Add project</span></a></li>
						<?php } ?>
						<?php if($_SESSION["user"]["user_role_id"]==GD) { ?>
                        <li class="nav-header">Tags</li>
                        <li><a href="<?php echo getBaseUrl(); ?>all/tags.php"><i class="glyphicon glyphicon-tags"></i><span> All Tags</span></a>
                        </li>
                        <li><a href="<?php echo getBaseUrl(); ?>add_edit/tag.php"><i class="glyphicon glyphicon-plus"></i><span> Add Tags</span></a>
                        </li>
						<?php } ?>
						<?php if($_SESSION["user"]["user_role_id"]==ADMIN) { ?>
						<li class="nav-header">Project Groups</li>
                        <li><a href="<?php echo getBaseUrl(); ?>all/groups.php"><i class="glyphicon glyphicon-user"></i><span> All Groups</span></a>
                        </li>
                        <li><a href="<?php echo getBaseUrl(); ?>add_edit/group.php"><i class="glyphicon glyphicon-plus"></i><span> Add Group</span></a>
                        </li>
						<li class="nav-header">Project Guides</li>
                        <li><a href="<?php echo getBaseUrl(); ?>all/guides.php"><i class="glyphicon glyphicon-user"></i><span> All Guides</span></a>
                        </li>
                        <li><a href="<?php echo getBaseUrl(); ?>add_edit/guide.php"><i class="glyphicon glyphicon-plus"></i><span> Add Guide</span></a>
                        </li>
						<li class="nav-header">Branches</li>
                        <li><a href="<?php echo getBaseUrl(); ?>all/branches.php"><i class="glyphicon glyphicon-filter"></i><span> All Branches</span></a>
                        </li>
                        <li><a href="<?php echo getBaseUrl(); ?>add_edit/branch.php"><i class="glyphicon glyphicon-plus"></i><span> Add Branch</span></a>
                        </li>
						<?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->