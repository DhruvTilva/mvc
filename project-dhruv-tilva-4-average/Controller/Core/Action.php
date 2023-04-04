<?php
require_once 'Model/Core/Adapter.php';
require_once 'Model/Core/Request.php';

class Controller_Core_Action
{

	public $adapter=null;
	public $request=null;
	protected $view=null;


	public function setView(Model_Core_View $view){
		$this->view=$view;
		return $this;
	}

	public function getView()
	{
		if ($this->view) {
			return $this->view;
		}
		$view=new  Model_Core_View();
		$this->setView($view);
		return $view;
	}
	

	public function render(){
		 $this->getView()->render();
	}




	protected function setRequest(Model_Core_Request $request)
	{
		$this->request=$request;
		return $this;
	}

	public function getRequest()
	{
		if($this->request){
			return $this->request;
		}
		$request=new Model_Core_Request();
		$this->setRequest($request);
		return $request;
	}



	protected function setAdapter(Model_Core_Adapter $adapter)
	{
		$this->adapter=$adapter;
		return $this;
	}

	public function getAdapter()
	{
		if ($this->adapter) {
			return $this->adapter;
		}
		$adapter=new Model_Core_Adapter();
		$this->setAdapter($adapter);
		return $adapter;
	}




	public function getTemplate($templatePath)
	{
		require "view".DS.$templatePath;
	}




	public function redirect($c,$a,$id=null)
   {
      if($id){
      	header("Location: Index.php?c={$c}&a={$a}&id={$id}");
        exit();
   	}
   	else{
   		header("Location: Index.php?c={$c}&a={$a}");
   		exit();
   	}
   }

	

}




?>