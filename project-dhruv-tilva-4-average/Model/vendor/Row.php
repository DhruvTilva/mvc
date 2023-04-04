<?php
require_once 'Model/Core/Table/Row.php';


class Model_Vendor_Row extends Model_Core_Table_Row
{
	// protected $tableName = 'vendor';
	// protected $primaryKey = 'vendor_id';
	protected $tableClass = 'Model_Vendor';

	public function getStatusText()
    {
        $statues = $this->getTable()->getStatusOptions();
        if(array_key_exists($this->status,$statues)){
            return $statues[$this->status];
        }
        return $statues[Model_Admin::STATUS_DEFAULT];
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }
        return Model_Admin::STATUS_DEFAULT;
    }

}


?>