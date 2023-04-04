<?php


class Controller_Salesman extends Controller_Core_Action
{

    public function render()
	{
		return $this->getView()->render();
	}
	
	public function gridAction(){
		$sql = "SELECT * FROM salesman s INNER JOIN salesman_address d ON s.salesman_id = d.salesman_id;";

		// print_r($sql); die;
		$salesmanRow = Ccc::getModel('Salesman_Row'); 
        $salesmans = $salesmanRow->fetchAll($sql);
		$view= Ccc::getModel('Core_View');
		$view->setTemplate('salesman/grid.phtml')->setData(['salesmans'=>$salesmans]);
		$view->render();   

	}
	 
	public function addAction(){
		$message = Ccc::getModel('Core_Message');
		try 
		{
			$salesman = Ccc::getModel('Salesman_Row');
			if(!$salesman){
				throw new Exception("Invalid request.", 1);
			}
			$this->getView()
				->setTemplate('salesman/edit.phtml')
				->setData(['salesman'=>$salesman]);
			$this->render();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Salesman not Saved.',Model_Core_Message::FAILURE);
			$this->redirect('salesman','grid');
		}   

	}

	public function editAction(){
		try 
		{
			$id =$this->getRequest()->getParams('id');

			if(!$id){
	    		throw new Exception("Invalid request.", 1);
			}
			$sql = "SELECT * FROM salesman s INNER JOIN salesman_address d ON s.salesman_id = d.salesman_id WHERE s.salesman_id = $id;";

			$salesmanRow=Ccc::getModel('Salesman_Row');
	        $salesman = $salesmanRow->fetchRow($sql);
			if(!$salesman){
				throw new Exception("Invalid Id.", 1);
			}
			$this->getView()
				->setTemplate('salesman/edit.phtml')
				->setData(['salesman'=>$salesman ]);
			$this->render();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Salesman Not Saved',Model_Core_Message::FAILURE);
			$this->redirect('salesman','grid');
		}
		
	}

	// public function insertAction(){
	// 	try
	// 	{
	// 	$message=new Model_Core_Message();
	// 	$request = $this->getRequest();
	// 	if(!$request->isPost()){
	// 		throw new Exception("Data is not inserted.", 1);
	// 	}
    //     $salesman = $request->getPost('salesman');
    //     $address = $request->getPost('address');

	// 	date_default_timezone_set("Asia/Kolkata");
	// 	$createdAt = date("Y-m-d H:i:s");

	// 	$salesmanModelRow = new Model_Salesman_Row();
	// 	$salesmanModelRow->setData($salesman);
	// 	$salesmanResult = $salesmanModelRow->save();
	
	// 	// $sql = "INSERT INTO `salesman_address`(`address_id`, `salesman_id`, `address`, `city`, `state`, `country`, `zipcode`) VALUES ('{$address['address_id']}','{$salesman['salesman_id']}','{$address['address']}','{$address['city']}','{$address['state']}','{$address['country']}','{$address['zipcode']}')";
	// 	// $salesmanResult = $salesmanModel->insert($address,$sql);

	// 	$address['salesman_id'] = $salesmanResult;
	// 	$salesmanAddressModelRow = new Model_SalesmanAddress_Row();
	// 	$salesmanAddressModelRow->setData($address);
	// 	$salsmanResult = $salesmanAddressModelRow->save();

	// 	$message->addMessage('Salesman Added Successfully',Model_Core_Message::SUCCESS);
	// 	}
		
	// 	catch(Exception $e)
	// 	{
	// 		$message->addMessage('Salesman is Not Addded',Model_Core_Message::FAILURE);
	// 	}
	// 	$this->redirect('salesman','grid');
	// }


	// public function updateAction(){
	// 	try
	// 	{
	// 	$message=new Model_Core_Message();
	// 	$request = $this->getRequest();
	// 	if(!$request->isPost()){
	// 		throw new Exception("Data is not inserted.", 1);
	// 	}
    //     $address = $request->getPost('address');
    //     $salesman = $request->getPost('salesman');
	// 	$id = (int) $request->getParams('id');
	// 	if(!$id){
	// 		throw new Exception("Invalid ID.", 1);
	// 	}
	// 	$salesmanModel = new Model_Salesman();
	// 	$salesmanModelRow = new Model_Salesman_Row();
	// 	$salesmanModelRow->setData($salesman);
	// 	$salesmanResult = $salesmanModelRow->save();

    //     date_default_timezone_set('Asia/Kolkata');
    //     $updatedAt = date("Y-m-d H:i:s");

	// 	// $sql = "UPDATE `salesman_address` SET `address` = '{$address['address']}', `city` = '{$address['city']}', `state` = '{$address['state']}', `country` = '{$address['country']}', `zipcode` = '{$address['zipcode']}' WHERE `salesman_address`.`salesman_id` = {$id};";
	// 	// $data = $salesmanModel->update($address,$id,$sql);

	// 	$salesmanAddressModelRow = new Model_SalesmanAddress_Row();
	// 	$salesmanAddressModelRow->setData($address);
	// 	// $salesmanAddressModelRow->setPrimaryKey('salesman_id');
	// 	$salesmanAddressModelRow->getPrimaryKey();
	// 	$salesmanResult = $salesmanAddressModelRow->save();

	// 	$message->addMessage('Salesman updated Successfully',Model_Core_Message::SUCCESS);
	// 	}
	// 	catch(Exception $e)
	// 	{
	// 		$message->addMessage('Salesman is Not Updated',Model_Core_Message::FAILURE);
	// 	}
	// 	$this->redirect('salesman','grid');
    // }

	public function saveAction()
	{
		try{
			$request=Ccc::getModel('Core_Request');
			if(!$request->isPost()){
				throw new Exception("Error Request");
			}
			$salesman = $request->getPost('salesman');
			// print_r($customer); die;
        	$address = $request->getPost('address');

			$id=$request->getParams('id');

				$salesmanModelRow = new Model_Salesman_Row();
			if ($id) {
				// $customer=Ccc::getModel('Customer_Row');
				$salesmanModelRow->setData($salesman);
				$salesmanModelRow->getData();
				
				$salesmanResult = $salesmanModelRow->save();

			
				$salesmanAddressModelRow = new Model_SalesmanAddress_Row();
				$salesmanAddressModelRow->setData($address);
				$salesmanAddressModelRow->getPrimaryKey();
				$salesmanResult = $salesmanAddressModelRow->save();
			}
			else{
				// echo 111; die;
				$salesmanModelRow = new Model_Salesman_Row();
				$salesmanModelRow->setData($salesman);
				$salesmanResult = $salesmanModelRow->save();
				$address['salesman_id'] = $salesmanResult;
				$salesmanAddressModelRow = new Model_SalesmanAddress_Row();
				$salesmanAddressModelRow->setData($address);
				$salesmanResult = $salesmanAddressModelRow->save();

			}
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Salesman saved successfully.', Model_Core_Message::SUCCESS);
			$this->redirect('salesman','grid');
		}
		catch(Exception $e){
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Salesman not saved.', Model_Core_Message::FAILURE);
			$this->redirect('salesman','grid');
		}
	}


    public function deleteAction(){
    	try
		{
		$message=Ccc::getModel('Core_Message');
		$request=$this->getRequest();
		$id = (int) $request->getParams('id');
		if(!$id){
			throw new Exception("Invalid ID.", 1);
		}
		$salesmanModelRow = Ccc::getModel('Salesman_Row'); 
		$salesmanModelRow->load($id);
		$salesmanResult = $salesmanModelRow->delete();
		if(!$salesmanResult)
		{
			throw new Exception("Error Data is Not Deleted", 1);
		}
		$message->addMessage('Salesman Deleted Successfully',Model_Core_Message::SUCCESS);
		}
		catch(Exception $e)
		{
			$message->addMessage('Salesman is Not Deleted',Model_Core_Message::FAILURE);
		}
		$this->redirect('salesman','grid');
}


}
?>