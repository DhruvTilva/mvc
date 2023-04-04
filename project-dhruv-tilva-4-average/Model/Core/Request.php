<?php 
class Model_Core_Request
{
	//to pass parameter in url
	public function getParams($key=null,$value=null)
	{
		if(array_key_exists($key, $_GET)){
			return $_GET[$key];
		}
		return $value;
		
	}

	//to  collect data from form
	public function getPost($key=null,$value=null)
	{
		if(array_key_exists($key,$_POST)){
			return $_POST[$key];
		}
		if($key=null){
			return $_POST;
		}
		return $_POST;
	}

	//to check data is posted or not
	public function isPost()
   {
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
         return true;
      }

      return False;
   }

   //to get controller name
   public function getControllerName()
   {
   	return $this->getParams('c','index');
   }
   //to get action name
   public function getActionName()
   {
   	return $this->getParams('a','index');
   }

}

?>