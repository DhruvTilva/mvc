<?php

require_once 'Model/Core/Session.php';


class Model_Core_Message
{

 	protected $session = null;
    const SUCCESS='success';
    const FAILURE='failure';
    const NOTICE='notice';


    public function __construct()
    {
        $this->getSession();
    }


    //getter setter for session obj
 	public function setSession(Model_Core_Session $session)
 	{
 		$this->session = $session;
		return $this;
 	}


 	public function getSession()
 	{
 		if($this->session){
			return $this->session;
		}
		$session = new Model_Core_Session();
		$this->setSession($session);
		return $session;
  	}


        //add message with type(succcess,failed,notice)
  	public function addMessage($message,$type=null)
  	{
        if(!$type){
            $type=self::SUCCESS;
        }

        if (!$this->getSession()->has('message')) {
            $this->getSession()->set('message',[]);
        }
        $messages=$this->getMessages();
        $messages[$type]=$message;
        
        $this->getSession()->set('message',$messages);
        return $this;
    }


    //remove messages with unset func
  	public function clearMessage()
  	{
        $session=$this->getSession();
        $session->unset('message');
        return $this;
  	}



    //get message from added message
    public function getMessages()
    {
        if (!$this->getSession()->has('message')) {

            return null;
        }
        return $this->getSession()->get('message');
    }

 }




 ?>
