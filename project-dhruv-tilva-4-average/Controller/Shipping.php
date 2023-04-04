<?php



class Controller_Shipping extends Controller_Core_Action
{

     public function render()
    {
        return $this->getView()->render();
    }

    public function gridAction()
    {
        $sql = "SELECT * FROM `shipping`";

        // $shippingModel = new Model_Shipping();
        // $shippings = $shippingModel->fetchAll($sql);
        $shippingRow = new Model_Shipping_Row();
        $shippings = $shippingRow->fetchAll($sql);
        
        if(!$shippings){
            throw new Exception("Data Not Found.", 1);
        }

        $view= Ccc::getModel('Core_View');
        $view->setTemplate('shipping/grid.phtml')->setData(['shippings'=>$shippings]);
        $view->render();
    }

    public function addAction()
    {
        $message = Ccc::getModel('Core_Message');

        try 
        {
            $shipping = Ccc::getModel('Shipping_Row');
            if(!$shipping){
                throw new Exception("Invalid request.", 1);
            }

            $this->getView()
                ->setTemplate('shipping/edit.phtml')
                ->setData(['shipping'=>$shipping]);
            $this->render();    
        } 
        catch (Exception $e) 
        {
            $message->addMessage('Shipping not Saved.',Model_Core_Message::FAILURE);
            $this->redirect('shipping','grid');
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
            $shipping = Ccc::getModel('Shipping_Row')->load($id);
            // print_r($product);
            // die();
            if(!$shipping){
                throw new Exception("Invalid Id.", 1);
            }
            $this->getView()
                ->setTemplate('shipping/edit.phtml')
                ->setData(['shipping'=>$shipping]);
            $this->render();    
        } 
        catch (Exception $e) 
        {
            $message->addMessage('Shipping Not Saved',Model_Core_Message::FAILURE);
            $this->redirect('shipping','grid');
        }
    }


    // public function insertAction()
    // {
    //     try{
    //     $message=new Model_Core_Message();
    //     $request = $this->getRequest();

    //     if(!$request->isPost()){
    //         throw new Exception("Data is not inserted.", 1);
    //     }

    //     $shipping = $request->getPost('shipping');
    //     $shippingModelRow = new Model_Shipping_Row();
    //     $shippingModelRow->setData($shipping);
    //     $shippingResult = $shippingModelRow->save();


    //     if(!$shippingResult){
    //         throw new Exception("Data is Not Inserted.", 1);
    //     }
    //     $message->addMessage('Shipping Added Successfully',Model_Core_Message::SUCCESS);
    //     }
        
    //     catch(Exception $e)
    //     {
    //         $message->addMessage('Shipping is Not Addded',Model_Core_Message::FAILURE);
    //     }

    //     $this->redirect('shipping','grid');

    // }

    // public function updateAction()
    // {
    //     try{
    //     $message=new Model_Core_Message();
    //     $request = $this->getRequest();
        
    //     $shipping = $request->getPost('shipping');
    //     $id = (int) $request->getParams('id');
       
        
    //     if(!$request->isPost()){
    //         throw new Exception("Invalid Request", 1);
    //     }
     
    //     $shippingModelRow = new Model_Product_Row();
    //     $shippingModelRow->setData($shipping);
    //     $shippingResult = $shippingModelRow->save();

    //     if(!$shippingResult){
    //         throw new Exception("Data is Not Updated.", 1);
    //     }
    //     $message->addMessage('Shipping Updated Successfully',Model_Core_Message::SUCCESS);

    // }
    //     catch(Exception $e){
    //         $message->addMessage('Shipping is Not Updated',Model_Core_Message::FAILURE);


    //     }

    //     $this->redirect('shipping','grid');

    // }

    public function saveAction()
    {
        try{
            $request=Ccc::getModel('Core_Request');
            if(!$request->isPost()){
                throw new Exception("Error Request");
            }
            $data = $request->getPost('shipping');
            if (!$data) {
                throw new Exception("no data posted");
            }
            $id=$request->getParams('id');
            if ($id) {
                $shipping=Ccc::getModel('Shipping_Row');
                date_default_timezone_set('Asia/Kolkata');
                $shipping->updated_at=date('Y-m-d H:i:s');
                // echo"<pre>";
                // print_r($product); die();
            }
            else{
                $shipping= Ccc::getModel('Shipping_Row');
                date_default_timezone_set('Asia/Kolkata');
                $shipping->created_at = date("Y-m-d h:i:s");

            }
            // echo"<pre>";
            $shipping->setData($data);
            $shipping->save();
            $message=Ccc::getModel('Core_Message');
            $message->addMessage('Shipping saved successfully.', Model_Core_Message::SUCCESS);
            $this->redirect('shipping','grid');
        }
        catch(Exception $e){
            $message=Ccc::getModel('Core_Message');
            $message->addMessage('Shipping not saved.', Model_Core_Message::FAILURE);
            $this->redirect('shipping','grid');
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
        $shippingModelRow = Ccc::getModel('Shipping_Row'); 
        $shippingModelRow->load($id);
        $shippingResult = $shippingModelRow->delete();
        if(!$shippingResult)
        {
            throw new Exception("Error Data is Not Deleted", 1);
        }
        $message->addMessage('Shipping Deleted Successfully',Model_Core_Message::SUCCESS);
        }
        catch(Exception $e)
        {
            $message->addMessage('Shipping is Not Deleted',Model_Core_Message::FAILURE);
        }
        $this->redirect('shipping','grid');

    }
}

?>
