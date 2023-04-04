<?php

/**
 * 
 */
class Model_Core_View 
{
	
	protected $template=null;
	protected $data=[];

	public function __get($key)
	{
		if (!array_key_exists($key,$this->data)) {
			return null;
		}
		return $this->data[$key];
	}

	public function __set($key,$value)
	{
		$this->data[$key]=$value;	
	}

	public function __unset($key)
	{
		unset($this->data[$key]);
	}

	public function setTemplate($template)
	{
		$this->template=$template;
		
		return $this;
	}

	public  function getTemplate(){
		if(!$this->template){
			return false;
		}
		// echo 111; die();
		return $this->template;
	} 

	public function setData($data){
		$this->data=array_merge($this->data,$data);
		// $data;
		return $this;
	}

	public function getData(){
		if(!$this->data){
			return false;
		}
		return $this->data;
	}

	public function render(){
		require_once "view".DS.$this->getTemplate();
	}
}

 


 ?>