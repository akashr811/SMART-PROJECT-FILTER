<?php
if(file_exists("common.php"))
	include_once("common.php");
else
	include_once("../classes/common.php");
class guide extends common
{
	function __construct()
	{
		$this->mysqli=getDBConn();
	}
	function getTagsByProjectId($project_id)
	{
		$sql_query="SELECT *, t.id AS t_id, ptm.id AS ptm_id FROM tags t, projects_tags_map ptm 
					WHERE ptm.tag_id=t.id AND ptm.project_id=".$project_id;
		$res=$this->mysqli->query($sql_query);
		return $res;
	}
   function getTagById($id)
   {
	   $sql_query="SELECT * FROM tags WHERE id='".$id."' LIMIT 1";
		$res=$this->mysqli->query($sql_query);
		return $res->fetch_assoc();
   }
   function saveTag($id)
   {
	   $sql_query="UPDATE tags SET name='".$_POST["tag_name"]."' WHERE id='".$id."' LIMIT 1";
		$res=$this->mysqli->query($sql_query);
		if($res)
			setMsg("Tag Saved successfully.", "success");
		else
			setMsg("Something went wrong, please try again.", "danger");
   }
   function addtag()
   {
	   $sql_query="INSERT INTO tags(name) VALUES('".$_POST["tag_name"]."')";
		//exit($sql_query);
		$res=$this->mysqli->query($sql_query);
		if($res)
			setMsg("Tag Added successfully.", "success");
		else
			setMsg("Something went wrong, please try again.", "danger");
   }
}
?>