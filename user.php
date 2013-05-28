<?php

class User
{
	private $id;
	private $first;
	private $last;
	private $email;
	private $pw;
	private $user_type;
	
	public function __construct($id,$fir,$lst,$eml,$pw,$type)
	{
		$this->id = $id;
		$this->first = $fir;
		$this->last = $lst;
		$this->email = $eml;
		$this->pw = $pw;
		
		switch($type)
		{
		case "1":
			$this->user_type = 1;
			break;
		case "2":
			$this->user_type = 2;
			break;
		case "3":
			$this->user_type = 3;
			break;
		}
		
	}
	
	public function add_to_db()
	{
		$fields = "first, last, email, pw, user_type";
		
		$vals = "'" . $this->first . "', '" . $this->last . "', '" . $this->email . "', '" . $this->pw . "', " . $this->user_type;
		
		$ins = "INSERT INTO users (" . $fields . ") VALUES (" . $vals . ");";
		
		$server = "localhost";
		$username = "root";
		//$password = "christelle11";
		$password = "al19862411ex";
		$database = "test";
		
		$con = mysqli_connect($server,$username,$password,$database);

		// Check connection
		if (mysqli_connect_errno($con))
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			return;
		}
		
		//echo $ins;
		
		$result = mysqli_query($con,$ins);
		
		
		/*if ($result)
			echo "User has been added to db";
		else
			echo "Error:";*/

		mysqli_close($con);
	}
	
	public function get_first_last()
	{
		return $this->first . " " . $this->last;
	}
};
?>