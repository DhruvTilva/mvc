<?php

require_once "Model/Core/Table.php";

class Model_Cart extends Model_Core_Table
{
	public $tableName = null;
	public $primaryKey = null;

	
	public function setTableName($tableName)
	{
		$this->tableName = $tableName;
		
	}
	
    public function getTableName()
	{
		if($this->tableName){
			return $this->tableName;
		}
			
		$tableName ='cart_item';
		$this->setTableName($tableName);
		return $tableName;
	}

	public function setPrimaryKey($primaryKey)
	{
		$this->primaryKey = $primaryKey;
		
	}
	
    public function getPrimaryKey()
	{
		if($this->primaryKey){
			return $this->primaryKey;
		}
		$primaryKey ='cart_item_id';
		$this->setPrimaryKey($primaryKey);
		return $primaryKey;
	}
}

 ?>