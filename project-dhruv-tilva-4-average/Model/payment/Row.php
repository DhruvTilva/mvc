<?php
require_once 'Model/Core/Table/Row.php';


class Model_Payment_Row extends Model_Core_Table_Row
{
	// protected $tableName = 'payment';
	// protected $primaryKey = 'payment_id';
	protected $tableClass = 'Model_Payment';

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