<?php 
require_once 'Model/Core/Request.php';

class Model_Core_Url
{
	public function getCurrentUrl()
	{
		 return $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}

// ----
	public function getUrl($controller=null,$action=null,$params=[],$reset=false)
	{	$request= new Model_Core_Request();
		$final=$request->getParams();

		if($reset){
			$final=[];
		}

		if($controller){
			$final['c']=$controller;
		}
		else{
			$final['c']=$request->getControllerName();

		}
		if($action){
			$final['a']=$action;
		}
		else{
			$final['a']=$action->getActionName();

		}
		if($params){
			$final=array_merge($final,$params);
		}

		
		$queryString= http_build_query($final);

		$url=$this->getCurrentUrl();
		// print_r($url."<br>");
	    $string=$_SERVER['QUERY_STRING'];


	    $requesthalfUri=trim($url,$string);
	    $requestUri=$requesthalfUri.$queryString;

		return $requestUri;
	}
}

?>