<?php




class Controller_Vendor extends Controller_Core_Action
{
	


	public function gridAction()
	{
        $sql = "SELECT * FROM vendor v INNER JOIN vendor_address d ON v.vendor_id = d.vendor_id;";
		$vendorRow = Ccc::getModel('Vendor_Row'); 
        $vendors = $vendorRow->fetchAll($sql);
		$view= Ccc::getModel('Core_View');
		$view->setTemplate('vendor/grid.phtml')->setData(['vendors'=>$vendors]);
		$view->render();   
	}




	public function addAction()
	{
        $message = Ccc::getModel('Core_Message');
		try 
		{
			$vendor = Ccc::getModel('Vendor_Row');
			if(!$vendor){
				throw new Exception("Invalid request.", 1);
			}
			$this->getView()
				->setTemplate('vendor/edit.phtml')
				->setData(['vendor'=>$vendor]);
			$this->render();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Vendor not Saved.',Model_Core_Message::FAILURE);
			$this->redirect('vendor','grid');
		} 
	}




	public function editAction()
	{
		$message = Ccc::getModel('Core_Message');
		try 
		{
			$id =$this->getRequest()->getParams('id');

			if(!$id){
	    		throw new Exception("Invalid request.", 1);
			}
			$sql = "SELECT * FROM vendor v INNER JOIN vendor_address d ON v.vendor_id = d.vendor_id WHERE v.vendor_id = $id;";

			$vendorRow=Ccc::getModel('Vendor_Row');
	        $vendor = $vendorRow->fetchRow($sql);
			if(!$vendor){
				throw new Exception("Invalid Id.", 1);
			}
			$this->getView()
				->setTemplate('vendor/edit.phtml')
				->setData(['vendor'=>$vendor ]);
			$this->render();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Vendor Not Saved',Model_Core_Message::FAILURE);
			$this->redirect('vendor','grid');
		}

	}



	// public function insertAction()
	// {
	// 	try{

	// 	$message=new Model_Core_Message();
	// 	$request = $this->getRequest();
	// 	if(!$request->isPost()){
	// 		throw new Exception("Data is not inserted.", 1);
	// 	}
    //     $vendor = $request->getPost('vendor');
    //     $address = $request->getPost('address');

	// 	date_default_timezone_set("Asia/Kolkata");
	// 	$createdAt=date("Y-m-d H:i:s");

	// 	// $vendorModel = new Model_Vendor();
	// 	$vendorModelRow = new Model_Vendor_Row();
	// 	$vendorModelRow->setData($vendor);
	// 	$vendorResult = $vendorModelRow->save();
	
	// 	// $sql = "INSERT INTO `vendor_address`(`address_id`, `vendor_id`, `address`, `city`, `state`, `country`, `zipcode`) VALUES ('{$address['address_id']}','{$vendor['vendor_id']}','{$address['address']}','{$address['city']}','{$address['state']}','{$address['country']}','$address[zipcode]')";
	// 	// $vendorResult = $vendorModel->insert($address,$sql);

	// 	$address['vendor_id'] = $vendorResult;
	// 	$vendorAddressModelRow = new Model_VendorAddress_Row();
	// 	$vendorAddressModelRow->setData($address);
	// 	$vendorResult = $vendorAddressModelRow->save();


	// 	$message->addMessage('Vendor Added Successfully',Model_Core_Message::SUCCESS);
	// 	}
		
	// 	catch(Exception $e)
	// 	{
	// 		$message->addMessage('Vendor is Not Addded',Model_Core_Message::FAILURE);
	// 	}
	// 	$this->redirect('vendor','grid');
	
	// }


	// public function updateAction(){

	// 	try{
			
	// 	$message=new Model_Core_Message();
	// 	$request = $this->getRequest();
	// 	if(!$request->isPost()){
	// 		throw new Exception("Data is not inserted.", 1);
	// 	}
    //     $vendor = $request->getPost('vendor');
    //     $address = $request->getPost('address');
	// 	$id = $request->getParams('id');
	// 	if(!$id){
	// 		throw new Exception("Invalid ID.", 1);
			
	// 	}
	// 	date_default_timezone_set('Asia/Kolkata');
	// 	$updateAt = date("Y-m-d H:i:s");

	// 	// $vendorModel = new Model_Vendor();
	// 	$vendorModelRow = new Model_Vendor_Row();
	// 	$vendorModelRow->setData($vendor);
	// 	$vendorResult = $vendorModelRow->save();

	// 	// $sql = "UPDATE `vendor_address` SET `address` = '{$address['address']}', `city` = '{$address['city']}', `state` = '{$address['state']}', `country` = '{$address['country']}', `zipcode` = '{$address['zipcode']}' WHERE `vendor_address`.`vendor_id` = {$id};";
	// 	// $data = $vendorModel->update($address,$id,$sql);

	// 	$vendorAddressModelRow = new Model_VendorAddress_Row();
	// 	$vendorAddressModelRow->setData($address);
	// 	$vendorAddressModelRow->getPrimaryKey();
	// 	$vendorResult = $vendorAddressModelRow->save();


    //     $message->addMessage('Vendor Update Successfully',Model_Core_Message::SUCCESS);
	// 	}
		
	// 	catch(Exception $e)
	// 	{
	// 		$message->addMessage('Vendor is Not Updated',Model_Core_Message::FAILURE);
	// 	}
	// 	$this->redirect('vendor','grid');
	// }

	public function saveAction()
	{
		try{
			$request=Ccc::getModel('Core_Request');
			if(!$request->isPost()){
				throw new Exception("Error Request");
			}
			$vendor = $request->getPost('vendor');
        	$address = $request->getPost('address');

			$id=$request->getParams('id');

				$vendorModelRow = new Model_Vendor_Row();
			if ($id) {
				$vendorModelRow->setData($vendor);
				$vendorModelRow->getData();
				$vendorResult = $vendorModelRow->save();

			
				$vendorAddressModelRow = new Model_VendorAddress_Row();
				$vendorAddressModelRow->setData($address);
				$vendorAddressModelRow->getPrimaryKey();
				$vendorResult = $vendorAddressModelRow->save();
			}
			else{
				// echo 111; die;
				$vendorModelRow = new Model_Vendor_Row();
				$vendorModelRow->setData($vendor);
				$vendorResult = $vendorModelRow->save();
				$address['vendor_id'] = $vendorResult;
				$vendorAddressModelRow = new Model_VendorAddress_Row();
				$vendorAddressModelRow->setData($address);
				$vendorResult = $vendorAddressModelRow->save();

			}
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Vendor saved successfully.', Model_Core_Message::SUCCESS);
			$this->redirect('vendor','grid');
		}
		catch(Exception $e){
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Vendor not saved.', Model_Core_Message::FAILURE);
			$this->redirect('vendor','grid');
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
		$vendorModelRow = Ccc::getModel('Vendor_Row'); 
		$vendorModelRow->load($id);
		$vendorResult = $vendorModelRow->delete();
		if(!$vendorResult)
		{
			throw new Exception("Error Data is Not Deleted", 1);
		}
		$message->addMessage('Vendor Deleted Successfully',Model_Core_Message::SUCCESS);
		}
		catch(Exception $e)
		{
			$message->addMessage('Vendor is Not Deleted',Model_Core_Message::FAILURE);
		}
		$this->redirect('vendor','grid');
	}

}


 ?>