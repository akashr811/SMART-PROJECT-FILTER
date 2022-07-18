<?php
if(file_exists("common.php"))
	include_once("common.php");
else if(file_exists("../classes/common.php"))
	include_once("../classes/common.php");
else
	include_once("classes/common.php");
class admin extends common
{
	function __construct()
	{
		$this->mysqli=getDBConn();
	}
	function generateUserNumber($id)
	{
		$pg_row=$this->getGroupById($id);
		$branch_row=$this->getBranchById($pg_row["branch_id"]);
		if($pg_row["user_role_id"]==GD)
			$pf=PGDP;
		else
			$pf=PGRP;
		return $branch_row["name"].$pf.$pg_row["pg_id"];
	}
	function getAllbranches()
	{
		$sql_query="SELECT * FROM branches";
		$res=$this->mysqli->query($sql_query);
		return $res;
	}
	function getAllgroups()
	{
		 $sql_query="SELECT *, b.id AS b_id, b.name AS b_name, pg.id AS pg_id FROM project_groups pg, branches b
				 WHERE pg.branch_id=b.id";
		 $res=$this->mysqli->query($sql_query);
		 return $res;
	}
   	function getAllGuides()
	{
		 $sql_query="SELECT *, b.id AS b_id, b.name AS b_name, pg.id AS pg_id FROM project_groups pg, branches b
				 WHERE pg.branch_id=b.id AND user_role_id='".GD."'";
		 $res=$this->mysqli->query($sql_query);
		 return $res;
    }
    function getAllMembers($group_id)
	{
		 $sql_query="SELECT * FROM group_members WHERE group_id='".$group_id."'";
		 $res=$this->mysqli->query($sql_query);
		 return $res;
	}
   function getBranchById($id)
   {
	   $sql_query="SELECT * FROM branches WHERE id='".$id."' LIMIT 1";
		$res=$this->mysqli->query($sql_query);
		return $res->fetch_assoc();
   }
   function saveBranch($id)
   {
	   $sql_query="UPDATE branches SET name='".$_POST["branch_name"]."' WHERE id='".$id."' LIMIT 1";
		$res=$this->mysqli->query($sql_query);
		if($res)
			setMsg("Branch Saved successfully.", "success");
		else
			setMsg("Something went wrong, please try again.", "danger");
   }
   function addBranch()
   {
	   $sql_query="INSERT INTO branches(name) VALUES('".$_POST["branch_name"]."')";
		//exit($sql_query);
		$res=$this->mysqli->query($sql_query);
		if($res)
			setMsg("Branch Added successfully.", "success");
		else
			setMsg("Something went wrong, please try again.", "danger");
   }
   function getGroupById($id)
   {
	   $sql_query="SELECT *, pg.id AS pg_id, b.id AS b_id, b.name AS b_name FROM project_groups pg, branches b 
				WHERE pg.branch_id=b.id AND pg.id='".$id."' LIMIT 1";
		$res=$this->mysqli->query($sql_query);
		return $res->fetch_assoc();
   }
   function saveGroup($id)
   {
	   $sql_query="UPDATE project_groups SET branch_id='".$_POST["branch_id"]."', password='".$_POST["password"]."',
					user_role_id='".$_POST["user_role"]."', phone='".$_POST["phone"]."', email_id='".$_POST["email_id"]."', 
					member_1='".$_POST["member_1"]."', member_2='".$_POST["member_2"]."', member_3='".$_POST["member_3"]."', 
					member_4='".$_POST["member_4"]."', guide_id='".$_POST["guide_id"]."' WHERE id='".$id."'";	
		$res=$this->mysqli->query($sql_query);
		if($res)
			setMsg("Saved successfully.", "success");
		else
			setMsg("Something went wrong, please try again.", "danger");
   }
   function updateUserNumber($id, $number)
   {
		$sql_query="UPDATE project_groups SET group_number='".$number."' WHERE id='".$id."'";	
		$this->mysqli->query($sql_query);
   }
   function addGroup()
   {
	   $date=date("Y-m-d");
	   $sql_query="INSERT INTO project_groups(branch_id, password, user_role_id, phone, email_id, member_1, member_2, member_3, member_4, guide_id, date) 
				VALUES('".$_POST["branch_id"]."', '".$_POST["password"]."', '".$_POST["user_role"]."', '".$_POST["phone"]."', '".$_POST["email_id"]."', 
				'".$_POST["member_1"]."', '".$_POST["member_2"]."', '".$_POST["member_3"]."', '".$_POST["member_4"]."', '".$_POST["guide_id"]."', 
				'".$date."')";
		$res=$this->mysqli->query($sql_query);
		if($res)
		{
			$insert_id=$this->mysqli->insert_id;
			$number=$this->generateUserNumber($insert_id);
			$this->updateUserNumber($insert_id, $number);
			setMsg("Added successfully.", "success");
		}
		else
			setMsg("Something went wrong, please try again.", "danger");
   }  
}
?>