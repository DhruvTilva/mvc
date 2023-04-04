<?php

class Controller_Payment extends Controller_Core_Action
{
	public function render()
	{
		return $this->getView()->render();
	}


	public function gridAction()
	{

        $sql = "SELECT * FROM `payment`";
		$paymentRow = Ccc::getModel('Product_Row'); 
		$payments = $paymentRow->fetchAll($sql);
		if(!$payments){
			throw new Exception("Data Not Found.", 1);
		}

		$view= Ccc::getModel('Core_View');
		$view->setTemplate('payment/grid.phtml')->setData(['payments'=>$payments]);
		$view->render();
	}




	public function addAction()
	{
		$message = Ccc::getModel('Core_Message');

		try 
		{
			$payment = Ccc::getModel('Payment_Row');
			if(!$payment){
				throw new Exception("Invalid request.", 1);
			}

			$this->getView()
				->setTemplate('payment/edit.phtml')
				->setData(['payment'=>$payment]);
			$this->render();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Payment not Saved.',Model_Core_Message::FAILURE);
			$this->redirect('payment','grid');
		}
	}




	public function editAction()
	{
		$message = Ccc::getModel('Core_Message');
		try
		{
		$request = $this->getRequest();
		$id = (int) $request->getParams('id');
		if(!$id){
    		throw new Exception("Invalid ID.", 1);
		}
		$payment = Ccc::getModel('Payment_Row')->load($id);
		if(!$payment){
			throw new Exception("Data Not Found.", 1);
		}
		
			$this->getView()
				->setTemplate('payment/edit.phtml')
				->setData(['payment'=>$payment]);
			$this->render();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Payment Not Saved',Model_Core_Message::FAILURE);
			$this->redirect('payment','grid');
		}
	}





	public function saveAction()
	{
		try{
			$request = Ccc::getModel('Core_Request');
			if(!$request->isPost()){
				throw new Exception("Error Request");
			}
			$data = $request->getPost('payment');
			if (!$data) {
				throw new Exception("no data posted");
			}
			$id=$request->getParams('id');

			if ($id) {
				$payment = Ccc::getModel('Payment_Row');
				date_default_timezone_set('Asia/Kolkata');
				$payment->updated_at = date('Y-m-d H:i:s');
			}
			else{
				$payment = Ccc::getModel('Payment_Row');
				date_default_timezone_set('Asia/Kolkata');
				$payment->created_at = date("Y-m-d h:i:s");
			}
			$payment->setData($data);
			$payment->save();
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Payment saved successfully.', Model_Core_Message::SUCCESS);
			$this->redirect('payment','grid');
		}
		catch(Exception $e){
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Payment not saved.', Model_Core_Message::FAILURE);
			$this->redirect('payment','grid');
		}
	}






	
	public function deleteAction()
	{
		try
		{
		$message=new Model_Core_Message();
		$request = $this->getRequest();
		$id = (int) $request->getParams('id');
		if(!$id){
    		throw new Exception("Invalid ID.", 1);
		}
		$paymentModelRow = Ccc::getModel('Payment_Row');
		$paymentModelRow->load($id);
		$paymentResult = $paymentModelRow->delete();

		if(!$paymentResult){
			throw new Exception("Data is Not Deleted.", 1);
		}
		$message->addMessage('Payment Deleted Successfully.',Model_Core_Message::SUCCESS);
		}
		catch(Exception $e)
		{
			$message->addMessage('Payment is Not Deleted.',Model_Core_Message::FAILURE);
		}

		$this->redirect('payment','grid');
	}
}


?>