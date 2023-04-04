<?php 
require_once 'Model/Core/Table.php';
require_once 'Model/Core/Request.php';
/**
 * 
 */


class Model_Core_Table_Row 
{
	// protected $tableName = null;
	// protected $primaryKey = null;
	protected $tableClass='Model_Core_Table';
	protected $data = [];
	protected $table=null;



	public function setId($id)
	{
		$this->data[$this->getTable()->getPrimaryKey()]=(int) $id;
		return $this;
	}

	public function getId()			
	{		
		$primaryKey= $this->getTable()->getPrimaryKey();
		return $this->$primaryKey;	
	}
	public function setTable($table)
	{
		$this->table=$table;
		return $this;
	}

	public function getTable(){
		if ($this->table){
			return $this->table;
		}
		$table = new ($this->tableClass)();
		$this->setTable($table);
		return $table;
	}

	public function setTableClass($tableClass)
	{	
		$this->tableClass=$tableClass;
		return $this;
	}


	public function getTableClass()
	{
		// $tableClass = $this->tableClass;
		if(!$this->tableClass){
			return $this->tableClass;
		}
		$tableClass = new  $this->tableClass;
		$this->setTableClass($tableClass);
		return $tableClass;
	}

		
	public function __get($key) {
    if (array_key_exists($key, $this->data)) {
      return $this->data[$key];
    } else {
      return null;
    }
  }

    public function __set($key, $value) {
    $this->data[$key] = $value;
    }

    public function __unset($key){
    	unset($this->data[$key]);
    	return $this;
    }

    public function setData($data){
    	$this->data=$data;
    	// array_merge($this->data,$data);
    	return $this;
    }


    public function getData($key=null){
    	if(!$key){
    		return $this->data;
    	}
    	if(!array_key_exists($key,$this->data)){
    		return null;
    	}
    	return $this->data[$key];
    }



   public function setTableName($tableName)
	{
		$this->tableName = $tableName;
		return $this;
	}


	public function getTableName()
	{
		// return $this->tableName;
		return $this->getTable()->getTableName();
		
	}
	

	// public function setPrimaryKey($primaryKey)
	// {
	// 	$this->primaryKey = $primaryKey;
	// 	return $this;
	// }


	public function getPrimaryKey()
	{
		// return $this->primaryKey;
		return $this->getTable()->getPrimaryKey();
 
	}

	public function addData($key,$value){
		$this->data[$key]=$value;
		return $this;
	}


	public function removeData($key){
		unset($this->data[$key]);
		return $this;
	}



	public function save()
	{
		// $table = new Model_Core_Table();
		$table= $this->getTableClass();
		$request= new Model_Core_Request();            
		if($request->getParams('id'))
		{
			$id = $request->getParams('id');
			$table->setTableName($this->getTableName());
			$table->setPrimaryKey($this->getPrimaryKey());
			$result=$table->update($this->data, $id);
			return $result;
		}
		else
		{
			$table->setTableName($this->getTableName());
			// $table->getTableName();
			$result = $table->insert($this->data);
			// print_r($this->data);
			// die();

			$this->load($result);
		  return $result;
		}

		// if ($id=$this->getId())
		// {
		// 	$condition=$id;
		// 	$result=$this->getTable()->insert($this->data);
		// 	if (!$result) {
		// 		return $this->load($this->data[$this->getPrimaryKey()]);
		// 	}
		// 	return true;
		// }
		// 	else{
		// 		$insertedId=$this->getTable()->insert($this->data);
		// 		if (!$insertedId) 
		// 		{
		// 			return $this->load($insertedId);
		// 		}
		// 		return true;
		// 	}
	}

	public function delete()
	{
		// $table= new Model_Core_Table();
		$table= $this->getTableClass();
		$id = $this->data[$this->getPrimaryKey()];
		if (!$id) {
			return false;
		}
		$table->setTableName($this->getTableName());
		$table->setPrimaryKey($this->getPrimaryKey());
		$table->delete($id);
		return $this;
	}


	public function fetchAll($query){
		// $table = new Model_Core_Table();
		$table=$this->getTableClass();
		$result = $table->fetchAll($query);


		if(!$result){
			return false;
		}
		foreach($result as &$row){
			$row = (new $this)->setData($row)->setTableClass($this->tableClass);
		}
		return $result; 
	}



	public function fetchRow($query){
		// $table = new Model_Core_Table();
		$table=$this->getTableClass();
		$result = $table->fetchRow($query);
		if($result){
		 $this->data = $result;
		 return $this;
		}
		return false;
	}




	public function load($id,$column=null)
	{
		if(!$column){
			$column = $this->getPrimaryKey();
		}
		$sql = "SELECT * FROM `{$this->getTableName()}` WHERE `{$column}`= '{$id}'";
		// $table = new Model_Core_Table();
		$table= $this->getTableClass();
		$result = $table->fetchRow($sql);
		if($result){
			$this->data = $result;
		  return $this;
		}
		return null;
	}


}



?>