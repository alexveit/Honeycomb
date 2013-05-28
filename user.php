<?php

class User
{
	private $id;
	private $first;
	private $last;
	private $email;
	private $pw;
	private $user_type;
	private $verified;
	
	public function get_id() { return $this->id; }
	
	public function get_first() { return $this->first; }
	
	public function get_last() { return $this->last; }
	
	public function get_email() { return $this->email; }
	
	public function get_pw() { return $this->pw; }
	
	public function get_type() { return $this->user_type; }
	
	public function get_verified() { return $this->verified; }
	
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
		$this->verified = true;
	}
	
	private function connect_to_db()
	{
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
			return false;
		}
		
		return $con;
	}
	
	public function add_to_db()
	{
		$con = $this->connect_to_db();
		if($con)
		{
			$fields = "first, last, email, pw, user_type, verified";
			
			$vals = "'" . $this->first . "', '" . $this->last . "', '" . $this->email . "', '" . $this->pw . "', " . $this->user_type . ", " . $this->verified;
			
			$ins = "INSERT INTO users (" . $fields . ") VALUES (" . $vals . ");";
			
			//echo $ins;
			
			$result = mysqli_query($con,$ins);
			
			
			/*if ($result)
				echo "User has been added to db";
			else
				echo "Error:";*/

			mysqli_close($con);
		}
	}
	
	public function contains_in_db()
	{
		$con = $this->connect_to_db();
		$contains = false;
		if($con)
		{
			$query = "SELECT * FROM users WHERE email='" . $this->email . "';";
			$result = mysqli_query($con,$query);
			if ($result && $result->num_rows == 1)
			{
				$contains = true;
			}
			mysqli_close($con);
		}
		return $contains;
	}
	
	public function get_first_last()
	{
		return $this->first . " " . $this->last;
	}
};
?>