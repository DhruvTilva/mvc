<?php

class Model_Core_Adapter
{
	public $servername="localhost";
	public $username="root";
	public $password="";
	public $dbname = "project-dhruv-tilva";


	//to make connection
	public function connect()
	{
		$conn = mysqli_connect($this->servername,$this->username,$this->password,$this->dbname);
		// print_r($conn);
		// die;
		return $conn;
	}

	//to run query
	public function query($query)
	{
		$connect=$this->connect();
		return $connect->query($query);
	}

	//to fetch all data from database
	public function fetchAll($query)
	{
		$fetchAll=$this->query($query);
		if(!$fetchAll){
			return False;
		}
		return $fetchAll->fetch_all(MYSQLI_ASSOC);
	}

	//to one  fetch row from database
	public function fetchRow($query)
	{
		$fetchRow=$this->query($query);
		if(!$fetchRow){
			return False;
		}
		return $fetchRow->fetch_assoc();
	}

	public function fetchOne()
	{
		$fetchOne=$this->query($query);
		if(!$fetchOne){
			return False;
		}
		$row= $fetchOne->fetch_array();
		return (array_key_exists(0,$row))?$row[0]:null;
	}


	public function fetchPairs($query)
	{
		$fetchPairs=$this->query($query);
		if(!$fetchPairs){
			return False;
		}
		return $fetchPairs->fetch_all();

		$column1=array_column($data, '0');
		$column2=array_column($data, '1');
		if (!$column2) {
			$column2=array_fill(0, count($column2), null);
		}
		return array_combine($column1,$column2);
	}

	//insert a data into table
	public function insert($query)
	{
		$connect = $this->connect(); 
        $insertRow = $connect->query($query);
        if(!$insertRow){
            return false;

        }
        return $connect->insert_id;
    }
    //update a existing data from table
    public function update($query)
    {
        $updateRow = $this->query($query);
        if(!$updateRow){
            return false;

        }
        return true;

    }
    //delet a data from table
    public function delete($query)
    {
        $deletRow = $this->query($query);
        if(!$deletRow){
            return false;

        }
        return true;
    }



}


 ?>