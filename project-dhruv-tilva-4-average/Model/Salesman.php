<?php

require_once "Model/Core/Table.php";

class Model_Salesman extends Model_Core_Table
{
	public $tableName ='salesman';
	public $primaryKey ='salesman_id';


	const STATUS_ACTIVE = 1;
    const STATUS_ACTIVE_LBL = 'Active';
    const STATUS_INACTIVE = 2;
    const STATUS_INACTIVE_LBL = 'Inactive';
    const STATUS_DEFAULT = 2;

    public function getStatusOptions()
    {
        return [
                    self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
                    self::STATUS_INACTIVE=>self::STATUS_INACTIVE_LBL
        ];
    }
	
	// public function setTableName($tableName)
	// {
	// 	$this->tableName = $tableName;
		
	// }
	
    // public function getTableName()
	// {
	// 	if($this->tableName){
	// 		return $this->tableName;
	// 	}
			
	// 	$tableName ='salesman';
	// 	$this->setTableName($tableName);
	// 	return $tableName;
	// }

	// public function setPrimaryKey($primaryKey)
	// {
	// 	$this->primaryKey = $primaryKey;
		
	// }
	
    // public function getPrimaryKey()
	// {
	// 	if($this->primaryKey){
	// 		return $this->primaryKey;
	// 	}
	// 	$primaryKey ='salesman_id';
	// 	$this->setPrimaryKey($primaryKey);
	// 	return $primaryKey;
	// }


}

 ?>