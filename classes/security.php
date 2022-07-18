<?php
class security
{
	function __construct()
	{
		$this->mysqli=getDBConn();
	}
	function login()
	{
		$login_id=$_POST["login_id"];
		$password=$_POST["password"];
		$sql_query="SELECT *, pg.id AS pg_id, ur.id AS ur_id, ur.name AS ur_name FROM project_groups pg, user_roles ur 
				WHERE group_number='".$login_id."' AND password='".$password."' AND pg.user_role_id=ur.id LIMIT 1";
		$res=$this->mysqli->query($sql_query);
		if($res->num_rows){
			$data_row=$res->fetch_assoc();
			$_SESSION["logged_in"]=1;
			$_SESSION["user"]=$data_row;
			setMsg("You are logged in.", "success");
			if($data_row["user_role_id"]==ADMIN)
				redirect(getBaseUrl()."all/groups.php");
			else
				redirect(getBaseUrl()."all/projects.php");
		}
		else
		{
			setMsg("Sorry, Invalid Credentials.", "danger");
			redirect(getBaseUrl());
		}
	}
	function logout()
	{
		unset($_SESSION["logged_in"]);
		unset($_SESSION["user"]);
		setMsg("You have logged out successfully", "success");
		redirect(getBaseUrl());
	}
	function checkLogin()
	{
		if(!isset($_SESSION["logged_in"]))
		{
			setMsg("You are not logged in.", "danger");
			redirect(getBaseUrl());
		}
	}
}
?>