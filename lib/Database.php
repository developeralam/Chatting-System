<?php
	
	$filepath = realpath(dirname(__FILE__));
	include_once $filepath.'/../config/config.php';
/**
 * Database Class
 */
class Database
{
	public $host = DB_HOST;
	public $user = DB_USER;
	public $pass = DB_PASS;
	public $name = DB_NAME;
	public $link;
	public $error;
	function __construct()
	{
		$this->connectDB();
	}
	public function connectDB()
	{
		$this->link = new mysqli($this->host, $this->user, $this->pass, $this->name);
		if (!$this->link) {
			$this->error = "Connection Failed".$this->link->conncec_error;
			return false;
		}

	}
	public function select($query)
	{
		$selected_row = $this->link->query($query) or die($this->link->error.__LINE__);
		if ($selected_row->num_rows > 0) {
			return $selected_row;
		}else{
			die();
		}

	}
	public function insert($query)
	{
		$inserted_row = $this->link->query($query) or die($this->link->error.__LINE__);
		if ($inserted_row) {
			return $inserted_row;
		}else{
			return false;
		}
	}
}