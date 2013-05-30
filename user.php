<?php

require_once ('connection.php');

class User
{
	public $id;
	public $first;
	public $last;
	public $email;
	public $pw;
	public $user_type;
	public $verified;
	public $code;
	
	public function get_id() { return $this->id; }
	
	public function get_first() { return $this->first; }
	
	public function get_last() { return $this->last; }
	
	public function get_email() { return $this->email; }
	
	public function get_pw() { return $this->pw; }
	
	public function get_type() { return $this->user_type; }
	
	public function get_verified() { return $this->verified; }
	
	public function get_code() { return $this->code; }
	
	public function good_code($code) { return $this->code == $code; }
	
	public function set_db_verified()
	{
		$con = get_db_connection();
		if($con)
		{
			$update = "UPDATE users SET verified=1 WHERE id=" . $this->id . ";";
			mysqli_query($con,$update);
			return true;
		}
		return false;
	}
	
	public function __construct($id,$fir,$lst,$eml,$pw,$type,$ver,$code)
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
		$this->verified = $ver;
		$this->code = $code;
	}
	
	public function add_to_db()
	{
		$con = get_db_connection();
		if($con)
		{
			
			$this->code = rand(10000,99999);
			$fields = "first, last, email, pw, user_type, verified, verify_code";
			
			$vals = "'" . $this->first . "', '" . $this->last . "', '" . $this->email;
			$vals .= "', '" . $this->pw . "', " . $this->user_type . ", " . $this->verified . ", '" . $this->code . "'";
			
			$ins = "INSERT INTO users (" . $fields . ") VALUES (" . $vals . ");";
			
			//echo $ins;
			
			$result = mysqli_query($con,$ins);
			
			if(!$result)
			{
				mysqli_close($con);
				return false;
			}
			
			$idsel = "SELECT id FROM users ORDER BY id DESC LIMIT 1;";
			
			$result = mysqli_query($con,$idsel);
			
			if(!$result)
			{
				mysqli_close($con);
				return false;
			}
			
			$row = mysqli_fetch_array($result);
			
			$this->id = $row['id'];
			
			mysqli_close($con);
			
			return true;
		}
		return false;
	}
	
	public function contains_in_db()
	{
		$con = get_db_connection();
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