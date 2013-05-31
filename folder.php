<?php
session_start();
require_once ('connection.php');

class Folder
{
	public $id;
	public $user_id;
	public $level;
	public $parent_id;
	
	public function __construct($row)
	{
		$this->id = $row['id'];
		$this->user_id = $row['user_id'];
		$this->level = $row['level'];
		$this->parent_id = $row['parent_id'];
	}
	
};

function get_folder_array($user_id)
{
	$arr = array();
	
	$con = get_db_connection();
	$select = "SELECT * FROM folders WHERE user_id=" . $user_id . " ORDER BY level;";
	
	//echo $select;
	
	$result = mysqli_query($con,$select);

	while($row = mysqli_fetch_array($result))
	{
		array_push($arr, new Folder($row));
	}
	
	mysqli_close($con);
	
	return $arr;
}

function get_folder_depth($user_id)
{
	
	$con = get_db_connection();

	$select = "SELECT level FROM folders WHERE user_id=" . $user_id . " ORDER BY level DESC LIMIT 1;";
	
	$depth = 0;
	//echo $select;
	
	$result = mysqli_query($con,$select);

	if($row = mysqli_fetch_array($result))
	{
		$depth = $row['level'];
	}
	
	mysqli_close($con);
	
	return $depth;
}


?>