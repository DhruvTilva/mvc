<?php

class Model_Core_Session
{
	//to get session id
	public function getId()
	{
		return session_id();
	}
	
	//to start session
	public function start()
	{
	   session_start();
	   return $this;
	}


	//to destroy session
	public function destroy()
	{
		return session_destroy();
	}


	//to set a values in session array
	public function set($key,$value)
	{
		$_SESSION[$key]=$value;
		return $this;
	}


	//to get a value from seted array
	public function get($key){
		if (!array_key_exists($key,$_SESSION)) {
			return null;
		}
		return $_SESSION[$key];
	}


	//clear seted array
	public function unset($key)
	{
		if(array_key_exists($key,$_SESSION)){
			unset($_SESSION[$key]);
		}
		return $this;
	}

	//check key exist or not
	public function has($key){
		if(array_key_exists($key,$_SESSION)){
			return true;
		}
		return false;

	}


}


?>