<?php
require_once "Model/Core/Table.php";

class Model_Vendor extends Model_Core_Table
{
	public $tableName = 'vendor';
	public $primaryKey = 'vendor_id';

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

	// 	public function setTableName($tableName)
	// {
	// 	$this->tableName = $tableName;
	// }
	
    // public function getTableName()
	// {
	// 	if($this->tableName){
	// 		return $this->tableName;
	// 	}

	// 	$tableName = 'vendor';
	// 	$this->setTableName($tableName);
	// 	return $tableName;
	// }


	// public function setPrimaryKey($primaryKey)
	// {
	// 	if($this->primaryKey){
	// 		return $this->primaryKey;
	// 	}

	// 	$primaryKey = 'vendor_id';
	// 	$this->setPrimaryKey($primaryKey);
	// 	return $primaryKey;
	// }

	 
}
// class Model_Vendor_address extends Model_Core_Table
// {
// 	public $tableName='vendor_address';
// 	public $primaryKey='address_id';
// }
 ?>