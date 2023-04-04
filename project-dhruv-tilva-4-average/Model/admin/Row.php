<?php
require_once 'Model/Core/Table/Row.php';

/**
 * 
 */
class Model_Admin_Row extends Model_Core_Table_Row
{
	function __construct(){
        $this->setTableClass('Model_Admin');
    }

    public function getStatusText()
    {
        $statues = $this->getTable()->getStatusOptions();
        if(array_key_exists($this->$status,$statuses)){
            return $statuses[$this->$status];
        }
        return $statuses[Model_Admin::STATUS_DEFAULT];
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }
        return MOdel_Admin::STATUS_DEFAULT;
    }

}

 ?>