<?php
/**
 * 
 */
class Controller_Admin extends Controller_Core_Action
{
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

	public function gridAction()
	{
		$sql= "SELECT * FROM `admin`;";	
		$admins=Ccc::getModel('admin_row')->fetchAll($sql);
		$view= Ccc::getModel('Core_View');
		
		$view->setTemplate('admin/grid.phtml')->setData(['admins'=>$admins])->render();
	}

	public function addAction()
	{
		

		$view= Ccc::getModel('Core_View');
		$view->setTemplate('admin/add.phtml');
		$view->render();

		

	}


	public function editAction()
	{
		if(!($id=$this->getRequest()->getParams('id'))){
			throw new Exception("Error Processing Request", 1);
		}
		$admin=Ccc::getModel('Admin_Row');
		$admin->load($id);
		$view= Ccc::getModel('Core_View');
		$view->setTemplate('admin/edit.phtml')->setData(['admin'=>$admin])->render();
	}

	public function deleteAction()
	{
		if(!($id=$this->getRequest()->getParams('id'))){
			throw new Exception("Error Processing Request", 1);
		}
		$admin=Ccc::getModel('Admin_Row');
		$admin->load($id);
		$admin->delete();
		$this->redirect('admin','grid');

	}

	public function updateAction()
	{
		try
		{
		// $message=new Model_Core_Message();
		$message=Ccc::getModel('Core_Message');
		$request = $this->getRequest();
		if (!$request->isPost()) {
			throw new Exception("Invalid Request.", 1);
		}
		$id =(int) $request->getparams('id');
		if (!$id) 
		{
			throw new Exception("No ID found", 1);
		}
		$adminClass=Ccc::getModel('Admin_Row');
		$admin = $request->getPost('admin');
		
		$adminClass->setData($admin);
		
		$adminClass->save();
		
		$message->addMessage('Product Updated Successfully',Model_Core_Message::SUCCESS);
		}
		catch(Exception $e)
		{
			$message->addMessage('Product is Not Updated',Model_Core_Message::FAILURE);
		}
		$this->redirect('admin','grid');
	}
}


 ?>