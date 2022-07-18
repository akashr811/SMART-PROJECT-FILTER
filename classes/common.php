<?php
if(file_exists("../config/config.php"))
	include_once("../config/config.php");
else
	include_once("config/config.php");
if(isset($_POST["task"]))
{
	$ajax_obj=new common();
	if($_POST["task"]=="delete")
	{
		$data["status"]=$ajax_obj->delete($_POST["tbl_name"], $_POST["id"]);
		echo json_encode($data);
	}
}
class common
{
	function __construct()
	{
		$this->mysqli=getDBConn();
	}
	function delete($tbl_name, $id)
	{
		$sql="DELETE FROM $tbl_name WHERE id='".$id."'";
		$res=$this->mysqli->query($sql);
		if($res)
			return 1;
		else
			return 0;
	}
	function uploadFile($target_file, $field_name)
	{
		$file_name=$_FILES[$field_name]["name"];
		$uploadOk = 1;
		$msg="";
		$imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
		// Allow Only images
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "docx"
		&& $imageFileType != "txt" && $imageFileType != "xlsx" && $imageFileType != "csv"
		&& $imageFileType != "xls" && $imageFileType != "doc" && $imageFileType != "pptx"
		&& $imageFileType != "ppt") {
			$msg.= $file_name." - Only Image & Text documents are allowed.<br>";
			$uploadOk = 0;
		}
		//print_r($_FILES); exit;
		// Check file size
		if ($_FILES[$field_name]["size"] > 5000000) {
			$msg.= $file_name." - Your file is too large.<br>";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			$msg.= $file_name." - Your file was not uploaded.<br>";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES[$field_name]["tmp_name"], $target_file.".".$imageFileType)) {
				$msg.="The file ".$file_name. " has been uploaded.<br>";
			} else {
				$msg.=$file_name." - There was an error uploading your file.<br>";
			}
		}
		return array("status"=>$uploadOk, "ext"=>$imageFileType, "msg"=>$msg);
	}
	function getProjectById($id)
	{
		$sql_query="SELECT *, pg.id AS pg_id, p.id AS p_id, p.is_approve AS p_approve, b.id AS b_id, b.name AS b_name 
				FROM projects p, project_groups pg, branches b WHERE p.project_group_id=pg.id AND pg.branch_id=b.id
				AND p.id='".$id."'";
		$res=$this->mysqli->query($sql_query);
		return $res->fetch_assoc();
	}
	function getAllProjects()
	{
		$sql_query="SELECT *, pg.id AS pg_id, p.id AS p_id, p.is_approve AS p_approve, b.id AS b_id, b.name AS b_name 
				FROM projects p, project_groups pg, branches b WHERE p.project_group_id=pg.id AND pg.branch_id=b.id";
		$res=$this->mysqli->query($sql_query);
		return $res;
	}
	function getTagsByProjectId($project_id)
	{
		$sql_query="SELECT *, t.id AS t_id, ptm.id AS ptm_id FROM tags t, projects_tags_map ptm 
					WHERE ptm.tag_id=t.id AND ptm.project_id=".$project_id;
		$res=$this->mysqli->query($sql_query);
		return $res;
	}
	function getAllTags()
	{
		$sql_query="SELECT * FROM tags";
		$res=$this->mysqli->query($sql_query);
		return $res;
	}
	function tagNDescBasedSearch($desc_array, $min_match)
	{
		$pma=array();
		foreach($_POST["tag_ids"] as $tag_id)
		{
			$sql_query1="SELECT * FROM projects_tags_map WHERE tag_id='".$tag_id."'";
			$res1=$this->mysqli->query($sql_query1);
			while($tag_row=$res1->fetch_assoc())
			{
				$project_id=$tag_row["project_id"];
				$project_row=$this->getProjectById($project_id);
				$pdb_desc=$project_row["title"]." ".$project_row["desc"];
				$pdb_desc_array=explode(" ", $pdb_desc);
				$i=1;
				$inserted=0;
				foreach($pdb_desc_array as $pdb_kw)
				{
					$match=0;											
					if($inserted)
						continue;
					
					foreach($desc_array as $kw)
					{
						if(strtolower($pdb_kw)==strtolower($kw))
						{
							$match=1;
							if($i==$min_match)
							{
								$pma[]=$project_row;
								$inserted=1;								
							}							
						}
					}
					if($match)
						$i++;
				}
			}
		}
		return $pma;
	}
	function descBasedSearch($desc_array, $min_match)
	{
		$pma=array();
		$res=$this->getAllProjects();
		while($project_row=$res->fetch_assoc())
		{
			$pdb_desc=$project_row["title"]." ".$project_row["desc"];
			$pdb_desc_array=explode(" ", $pdb_desc);
			$i=1;
			$inserted=0;
			foreach($pdb_desc_array as $pdb_kw)
			{
				$match=0;											
				if($inserted)
					continue;
				
				foreach($desc_array as $kw)
				{
					if(strtolower($pdb_kw)==strtolower($kw))
					{
						$match=1;
						if($i==$min_match)
						{
							$pma[]=$project_row;
							$inserted=1;
						}							
					}
				}
				if($match)
					$i++;
			}
		}
		return $pma;
	}
	function searchProjects()
	{
		//Settings - Min X word in desc should match
		$min_match=1;
		
		$desc=$_POST["desc"];
		$hva=array("for", "of", "has", "had", "is", "it", "the", "if", "to", "on");
		$desc_array=explode(" ", $desc);
		
		foreach($hva as $hv){
			if (($key = array_search($hv, $desc_array)) !== false) {
				unset($desc_array[$key]);
			}
		}
		//When Both Tag N Title are submitted
		if(isset($_POST["desc"]) && isset($_POST["tag_ids"]))
			$pma=$this->tagNDescBasedSearch($desc_array, $min_match);
		
		//When Only Title are submitted
		if(isset($_POST["desc"]) && !isset($_POST["tag_ids"]))
			$pma=$this->descBasedSearch($desc_array, $min_match);
		
		$pma=array_map("unserialize", array_unique(array_map("serialize", $pma)));
		
		return $pma;
	}
}
?>