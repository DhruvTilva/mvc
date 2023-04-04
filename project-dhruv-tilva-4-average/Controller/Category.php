 <?php

 class Controller_Category extends Controller_Core_Action
 {



    public function gridAction()
    {
        
        $sql = "SELECT * FROM `category` WHERE `category_id` > 1 ORDER BY `path` ASC";
        $row = Ccc::getModel('Category_Row');
        $categorys = $row->fetchAll($sql);
        if(!$categorys){
            throw new Exception("Category not found.", 1);
        }

        $this->getView()
            ->setTemplate('category/grid.phtml')
            ->setData(['category'=>$categorys]);
        $this->render();
      
    } 


    public function addAction()
    {
        try 
        {
            $sql = "SELECT * FROM `category`;";
            $category = Ccc::getModel('Category_Row');
            if(!$category){
                throw new Exception("Category not found.", 1);
            }

            $this->getView()
                ->setTemplate('category/edit.phtml')
                ->setData(['category'=>$category]);
            $this->render();
        }
        catch (Exception $e) 
        {
            $this->getMessageObject()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
            $this->redirect('grid');
        }

    }

    public function editAction()
    {   $message=Ccc::getModel('Core_Message');

        try 
        {
            if(!$id = (int) $this->getRequest()->getParams('id')){
                throw new Exception("Invalid ID.", 1);
            }

            $sql = "SELECT * FROM `category` WHERE `category_id` = '{$id}'";
            $category = Ccc::getModel('Category_Row')->fetchRow($sql);
            if(!$category){
                throw new Exception("Category not found.", 1);
            }

            $this->getView()
                ->setData(['category'=>$category])
                ->setTemplate('category/edit.phtml');
            $this->render();
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
            $this->redirect('category','grid');
        }
	}





    public function saveAction()
    {
        try{
            $request = Ccc::getModel('Core_Request');
            if(!$request->isPost()){
                throw new Exception("Error Request");
            }
            $data = $request->getPost('category');
            // print_r($data);die();
            if (!$data) {
                throw new Exception("no data posted");
            }
            $categoryId=$this->getRequest()->getParams('cid');
            $category=Ccc::getModel('Category_Row')->load($categoryId);
            if (!$category) {
                $category=Ccc::getModel('Category_Row');

            }
            
            else{
                $category->created_at = date('Y-m-d H:i:s');
            }
            $category->setData($data);
            if (!$category->Save()) {
                throw new Exception("Error Processing Request", 1);
            }
            $category->updatePath();
            $message=Ccc::getModel('Core_Message');
            $message->addMessage('Category saved successfully.', Model_Core_Message::SUCCESS);
            $this->redirect('category','grid');
        }
        catch(Exception $e){
            $message=Ccc::getModel('Core_Message');
            $message->addMessage('Category not saved.', Model_Core_Message::FAILURE);
            $this->redirect('category','grid');
        }
    }


  


    public function deleteAction()
    {
        $message=new Model_Core_Message();
        try
        {
        $request = $this->getRequest();
        $id = $request->getParams('id');
        if(!$id){
            throw new Exception("Invalid ID.", 1);
        }
        $categoryModelRow = new Model_Category_Row();
        $categoryModelRow->load($id);
        $categoryResult = $categoryModelRow->delete();
            $message->addMessage('Category Deleted Successfully.',Model_Core_Message::SUCCESS);
        }
        catch(Exception $e)
        {
            $message->addMessage('Category is Not Deleted Properly.',Model_Core_Message::FAILURE);
        } 
        $this->redirect('category','grid');

    }
 }

?>
 