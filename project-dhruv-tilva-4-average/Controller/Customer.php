<?php

class Controller_Customer extends Controller_Core_Action
{


    public function render()
	{
		return $this->getView()->render();
	}
	

	public function gridAction()
	{
		$sql = "SELECT * FROM customer c INNER JOIN customer_address d ON c.customer_id = d.customer_id;";
		$customerRow = Ccc::getModel('Customer_Row'); 
        $customers = $customerRow->fetchAll($sql);
		$view= Ccc::getModel('Core_View');
		$view->setTemplate('customer/grid.phtml')->setData(['customers'=>$customers]);
		$view->render();	

	}


	public function addAction()
	{
		$message = Ccc::getModel('Core_Message');
		try 
		{
			$customer = Ccc::getModel('Customer_Row');
			if(!$customer){
				throw new Exception("Invalid request.", 1);
			}
			$this->getView()
				->setTemplate('customer/edit.phtml')
				->setData(['customer'=>$customer]);
			$this->render();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Customer not Saved.',Model_Core_Message::FAILURE);
			$this->redirect('customer','grid');
		}
	}



	// public function insertAction()
	// {
	// 	try
	// 	{
	// 	$message=new Model_Core_Message();
	// 	$request=$this->getRequest();
	// 	if(!$request->isPost())
	// 	{
	// 		throw new Exception("Data is not inserted.", 1);
	// 	}
    //     $customer = $request->getPost('customer');
    //     $address = $request->getPost('address');
	// 	date_default_timezone_set('Asia/Kolkata');
	// 	$createdAt=date("Y-m-d H:i:s");

	// 	$customerModelRow = new Model_Customer_Row();
	// 	$customerModelRow->setData($customer);
	// 	$customerResult = $customerModelRow->save();


	// 	$address['customer_id'] = $customerResult;

	// 	$customerAddressModelRow = new Model_CustomerAddress_Row();
	// 	$customerAddressModelRow->setData($address);
	// 	$customerResult = $customerAddressModelRow->save();
	// 	// if(!$customerResult)
	// 	// {
	// 	// 	echo "error customer data not set";
	// 	// }
	//    	$message->addMessage('Customer Added Successfully',Model_Core_Message::SUCCESS);
	// 	}
	// 	catch(Exception $e)
	// 	{
	// 		$message->addMessage('Customer is Not Addded',Model_Core_Message::FAILURE);
	// 	}
	// 	$this->redirect('customer','grid'); 
	// }

	public function editAction()
	{
		$message = Ccc::getModel('Core_Message');
		try 
		{
			$id =$this->getRequest()->getParams('id');

			if(!$id){
	    		throw new Exception("Invalid request.", 1);
			}
			$sql = "SELECT * FROM customer c INNER JOIN customer_address d ON c.customer_id = d.customer_id WHERE c.customer_id = $id;";

			$customerRow=Ccc::getModel('Customer_Row');
	        $customer = $customerRow->fetchRow($sql);
			if(!$customer){
				throw new Exception("Invalid Id.", 1);
			}
			$this->getView()
				->setTemplate('customer/edit.phtml')
				->setData(['customer'=>$customer ]);
			$this->render();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Customer Not Saved',Model_Core_Message::FAILURE);
			$this->redirect('customer','grid');
		}
	}



	public function saveAction()
	{
		try{
			$request=Ccc::getModel('Core_Request');
			if(!$request->isPost()){
				throw new Exception("Error Request");
			}
			$customer = $request->getPost('customer');
			// print_r($customer); die;
        	$address = $request->getPost('address');

			$id=$request->getParams('id');

				$customerModelRow = new Model_Customer_Row();
			if ($id) {
				// $customer=Ccc::getModel('Customer_Row');
				$customerModelRow->setData($customer);
				$customerModelRow->getData();
				
				$customerResult = $customerModelRow->save();

			
				$customerAddressModelRow = new Model_CustomerAddress_Row();
				$customerAddressModelRow->setData($address);
				$customerAddressModelRow->getPrimaryKey();
				$customerResult = $customerAddressModelRow->save();
			}
			else{
				// echo 111; die;
				$customerModelRow = new Model_Customer_Row();
				$customerModelRow->setData($customer);
				$customerResult = $customerModelRow->save();
				$address['customer_id'] = $customerResult;
				$customerAddressModelRow = new Model_CustomerAddress_Row();
				$customerAddressModelRow->setData($address);
				$customerResult = $customerAddressModelRow->save();

			}
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Customer saved successfully.', Model_Core_Message::SUCCESS);
			$this->redirect('customer','grid');
		}
		catch(Exception $e){
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Customer not saved.', Model_Core_Message::FAILURE);
			$this->redirect('customer','grid');
		}
	}

	public function deleteAction()
	{
		try
		{
		$message=Ccc::getModel('Core_Message');
		$request=$this->getRequest();
		$id = (int) $request->getParams('id');
		if(!$id){
			throw new Exception("Invalid ID.", 1);
		}
		$customerModelRow = Ccc::getModel('Customer_Row'); 
		$customerModelRow->load($id);
		$customerResult = $customerModelRow->delete();
		if(!$customerResult)
		{
			throw new Exception("Error Data is Not Deleted", 1);
		}
		$message->addMessage('Customer Deleted Successfully',Model_Core_Message::SUCCESS);
		}
		catch(Exception $e)
		{
			$message->addMessage('Customer is Not Deleted',Model_Core_Message::FAILURE);
		}
		$this->redirect('customer','grid');
}
}

?>