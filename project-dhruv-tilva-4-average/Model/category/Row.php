<?php
require_once 'Model/Core/Table/Row.php';


class Model_Category_Row extends Model_Core_Table_Row
{
	// protected $tableName = 'category';
	// protected $primaryKey = 'category_id';
	protected $tableClass = 'Model_Category';

	public function getParentCategories()
	{					
		$query="SELECT `category_id`,`path`
		FROM `{$this->getTable()->getTableName()}`
		ORDER BY `path` ASC;";
		$categories=$this->getTable()->getAdapter()->fetchPairs($query);
		return $categories;
	}




	public function updatePath()
	{
		if (!$this->getId()) {
			return false;
		}
		$parent=Ccc::getModel('Category')->load($this->parent_id);
		if (!$parent) {
			$this->path=$this->getId();
		}
		else{
			$this->path=$parent->path.'='.$this->getId();
		}
	}

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