<?php 
// require_once 'Controller/Core/Action.php';
// require_once 'Model/Product.php';
// require_once 'Model/Core/Url.php';
// require_once 'Model/Core/Session.php';
// require_once 'Model/Core/Message.php';
// require_once 'Model/Core/Table/Row.php';
// require_once 'Model/Core/Table.php';
// require_once 'Model/productMedia/Row.php';


class Controller_Product_Media extends Controller_Core_Action

{

	protected $medias = [];
	
	public function setMedias($medias){
		$this->medias = $medias;
		return $this;
	}

	public function getMedias()
	{
		return $this->medias;
	}

	public function gridAction()
	{
		$request = $this->getRequest();
		
		$id = (int) $request->getParams('id');
		if(!$id){
    		throw new Exception("Invalid ID.", 1);
		}
		// $adapter = $this->getAdapter();
		$sql = "SELECT * FROM `product_media` WHERE `product_id` = $id;";
		$productMediaRow = new Model_Product_Media_Row();
		$medias = $productMediaRow->fetchAll($sql);
		// $medias = $adapter->fetchAll($sql);
		$this->setMedias($medias);
		$this->getTemplate('productMedia/grid.phtml');
	
	}



	public function addAction(){
		$this->getTemplate('productMedia/add.phtml');
	}


	public function uploadAction(){
		// $adapter = $this->getAdapter();
		$productMediaRow = new Model_Product_Media_Row();
		$request = $this->getRequest();

		if(!$request->isPost()){
			throw new Exception("Error Processing Request", 1);
		}
		$id = $request->getParams('id');
		date_default_timezone_set('Asia/Kolkata');
		$updatedAt = date("Y-m-d h:i:s");
		$name = $request->getPost('name');
		// $sql = "INSERT INTO `product_media`(`product_id`, `image_id`, `name`, `image`, `thumbnail`, `small`, `base`, `gallery`, `created_at`) VALUES ('{$id}','','{$name}','','','','','','{$updatedAt}');";

		$productMediaRow->name=[
			'product_id'=>$id,
			'name'=>$name,
			'created_at'=>$updatedAt];
		$result=$productMediaRow->save();
		

		$imageId=$productMediaRow->image_id;
		// $result = $adapter->insert($sql);
		$name = $_FILES['image']['name'];
		$ext = explode('.', $name);
		$fileName = $imageId.".".$ext[1];
		$fileLoc = $_FILES['image']['tmp_name'];
		$dest = "View/productMedia/media/".$fileName;
		$uploaded = move_uploaded_file($fileLoc, $dest);
		if(!$uploaded){
			throw new Exception("Image is Not Uploaded", 1);	
		}
		// $sql = "UPDATE `product_media` SET `image`='{$fileName}' WHERE `image_id` = {$imageId}";
		// $result = $adapter->update($sql);
		$productMediaRow->Data=[
			'image'=>$filename,
			'image_id'=>$imageId];
		$result=$productMediaRow->save();


		// $this->redirect('product_media','grid',$id);
	}




	public function insertAction(){
		$productMediaRow = new Model_Product_Media_Row();

		// $adapter = $this->getAdapter();
		$request = $this->getRequest();
		if(!$request->isPost()){
			throw new Exception("Error Processing Request", 1);
		}
		$id = $request->getParams('id');
		$thumb = $request->getPost('thumb');
		$small = $request->getPost('small');
		$base = $request->getPost('base');
		$gallery = $request->getPost('select');
		$del = $request->getPost('del');
		date_default_timezone_set('Asia/Kolkata');
		$updated = date("Y-m-d h:i:s");

		$sql = "UPDATE `product_media` SET `thumbnail` = '0', `small` = '0', `base` = '0', `gallery` = '0' WHERE `product_id` = {$id};";
		// $result = $adapter->update($sql);
		$productModelRow->setData($id);
		$productModelRow->setData($thumb);
		$productModelRow->setData($small);
		$productModelRow->setData($base);
		$productModelRow->setData($gallery);
		$productModelRow->setData($del);

		$result = $productModelRow->save();


		$sql = "UPDATE `product_media` SET `thumbnail` = '1' WHERE `product_media`.`image_id` = $thumb;";
		// $result = $adapter->update($sql);
		$result = $productModelRow->save();


		$sql = "UPDATE `product_media` SET `small` = '1' WHERE `product_media`.`image_id` = $small;";
		// $result = $adapter->update($sql);
		$result = $productModelRow->save();


		$sql = "UPDATE `product_media` SET `base` = '1' WHERE `product_media`.`image_id` = $base;";
		// $result = $adapter->update($sql);
		$result = $productModelRow->save();


		$sql = "UPDATE `product_media` SET `created_at` = '{$updated}' WHERE `product_media`.`image_id` IN ($thumb,$small,$base) ;";
		// $result = $adapter->update($sql);
		$result = $productModelRow->save();


		$sql = "UPDATE `product_media` SET `gallery` = '1' WHERE `image_id` IN ($thumb,$small,$base);";
		// $result = $adapter->update($sql);
		$result = $productModelRow->save();


		foreach($del as $key=>$value){
			if($value == "A"){
				$sql = "DELETE FROM product_media WHERE `product_media`.`image_id` = {$key};";
				// $adapter->delete($sql);
				$productModelRow->delete($sql);

			}
		}
		$this->redirect('product_media','grid',$id);
	}
}


?>