<?php
if(file_exists("common.php"))
	include_once("common.php");
else if(file_exists("../classes/common.php"))
	include_once("../classes/common.php");
else
	include_once("classes/common.php");
class project_group extends common
{
	function __construct()
	{
		$this->mysqli=getDBConn();
	}
	function deleteTagsByProjectId($project_id)
	{
		$sql_query="DELETE FROM projects_tags_map WHERE project_id='".$project_id."'";
		$res=$this->mysqli->query($sql_query);		
		return $res;
	}
	function addTagsForProject($project_id)
	{
		 foreach ($_POST['tag_ids'] as $tag_id){
			$sql_query="INSERT INTO projects_tags_map(project_id, tag_id) VALUES('".$project_id."', '".$tag_id."')";
			$res=$this->mysqli->query($sql_query);
		}
		return $res;
	}
	function addProject()
	{
	   $date=date("Y-m-d");
	   $sql_query1="INSERT INTO projects(project_group_id, title, `desc`, date) 
					VALUES('".$_SESSION["user"]["pg_id"]."', '".$_POST["title"]."', '".$_POST["desc"]."', '".$date."')";
		
		$this->mysqli->autocommit(false);
		$res1=$this->mysqli->query($sql_query1);
		$project_id=$this->mysqli->insert_id;
		if(isset($_POST['tag_ids']))
			 $res2=$this->addTagsForProject($project_id);
		else
		{			
			setMsg("Please select at least one tag.", "danger");
		}
		
		$file_name_without_ext="project_".$project_id;
		$target_file=getFolderPath()."assets/documents/".$file_name_without_ext;
		$us=$this->uploadFile($target_file, "document");
		$ext=$us["ext"];
		$file_name_with_ext=$file_name_without_ext.".".$ext;
		if($us["status"])
		{
			$sql_query="UPDATE projects SET doc='".$file_name_with_ext."' WHERE id='".$project_id."'";	
			$res3=$this->mysqli->query($sql_query);
		}			

		if($res1 && $res2 && $res3)
		{
			$this->mysqli->commit();
			setMsg("Added successfully.", "success");
		}
		else
		{
			unlink($target_file.".".$ext);
			$this->mysqli->rollback();
			setMsg("Something went wrong, please try again.", "danger");
		}
	}
	function updateProject($project_id)
	{
	   $sql_query1="UPDATE projects SET title='".$_POST["title"]."', `desc`='".$_POST["desc"]."' 
					WHERE id='".$project_id."'";
		$this->mysqli->autocommit(false);
		$res1=$this->mysqli->query($sql_query1);
		$res2=$this->deleteTagsByProjectId($project_id);
		if(isset($_POST['tag_ids']))
			 $res3=$this->addTagsForProject($project_id);
		else
		{			
			setMsg("Please select at least one tag.", "danger");
		}
		$project_row=$this->getProjectById($project_id);
		$file_del_status=0;
		if(!empty($_FILES['document']['name']))
		{
			unlink(getFolderPath()."assets/documents/".$project_row["doc"]);
			$file_name_without_ext="project_".$project_id;
			$target_file=getFolderPath()."assets/documents/".$file_name_without_ext;
			$us["status"]=0;
			$file_del_status=1;
		}
		else
			$res4=1;
		
		if($file_del_status)
		{
			$us=$this->uploadFile($target_file, "document");
			$ext=$us["ext"];
			$file_name_with_ext=$file_name_without_ext.".".$ext;
			if($us["status"])
			{
				$sql_query="UPDATE projects SET doc='".$file_name_with_ext."' WHERE id='".$project_id."'";	
				$res4=$this->mysqli->query($sql_query);
			}	
		}

		if($res1 && $res2 && $res3 && $res4)
		{
			$this->mysqli->commit();
			setMsg("Updated successfully.", "success");
		}
		else
		{
			$this->mysqli->rollback();
			setMsg("Something went wrong, please try again.", "danger");
		}
	}
}
?>