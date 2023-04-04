<?php

//create product conroller class
class Controller_Product extends Controller_Core_Action
{	
	public function render()
	{
		return $this->getView()->render();
	}



	public function gridAction()
	{
		$sql = "SELECT * FROM `product`";
		$productRow = Ccc::getModel('Product_Row'); 
		$products = $productRow->fetchAll($sql);
		if(!$products)
		{
			throw new Exception("Data Not Found.", 1);
		}
		$view= Ccc::getModel('Core_View');
		$view->setTemplate('product/grid.phtml')->setData(['products'=>$products]);
		$view->render();
	}



	public function addAction()
	{
		$message = Ccc::getModel('Core_Message');

		try 
		{
			$product = Ccc::getModel('Product_Row');
			if(!$product){
				throw new Exception("Invalid request.", 1);
			}

			$this->getView()
				->setTemplate('product/edit.phtml')
				->setData(['product'=>$product]);
			$this->render();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Product not Saved.',Model_Core_Message::FAILURE);
			$this->redirect('product','grid');
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
			$product = Ccc::getModel('Product_Row')->load($id);
			// print_r($product);
			// die();
			if(!$product){
				throw new Exception("Invalid Id.", 1);
			}
			$this->getView()
				->setTemplate('product/edit.phtml')
				->setData(['product'=>$product]);
			$this->render();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Product Not Saved',Model_Core_Message::FAILURE);
			$this->redirect('product','grid');
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
		$productModelRow = Ccc::getModel('Product_Row'); 
		$productModelRow->load($id);
		$productResult = $productModelRow->delete();
		if(!$productResult)
		{
			throw new Exception("Error Data is Not Deleted", 1);
		}
		$message->addMessage('Product Deleted Successfully',Model_Core_Message::SUCCESS);
		}
		catch(Exception $e)
		{
			$message->addMessage('Product is Not Deleted',Model_Core_Message::FAILURE);
		}
		$this->redirect('product','grid');
	}






//save action combine insert + update actions combine.......


	public function saveAction()
	{
		try{
			$request=Ccc::getModel('Core_Request');
			if(!$request->isPost()){
				throw new Exception("Error Request");
			}
			$data = $request->getPost('product');
			if (!$data) {
				throw new Exception("no data posted");
			}
			$id=$request->getParams('id');
			if ($id) {
				$product=Ccc::getModel('Product_Row');
				date_default_timezone_set('Asia/Kolkata');
				$product->updated_at=date('Y-m-d H:i:s');
				// echo"<pre>";
				// print_r($product); die();
			}
			else{
				$product= Ccc::getModel('Product_Row');
				date_default_timezone_set('Asia/Kolkata');
				$product->created_at = date("Y-m-d h:i:s");

			}
			// echo"<pre>";
			$product->setData($data);
			$product->save();
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Product saved successfully.', Model_Core_Message::SUCCESS);
			$this->redirect('product','grid');
		}
		catch(Exception $e){
			$message=Ccc::getModel('Core_Message');
			$message->addMessage('Product not saved.', Model_Core_Message::FAILURE);
			$this->redirect('product','grid');
		}
	}


}

?>