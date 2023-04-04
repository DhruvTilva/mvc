<?php 

require_once 'Controller/Core/Action.php';

class Controller_Sprice extends Controller_Core_Action
{
	protected $products = [];
	protected $salesmen = [];
	protected $selectID = Null;
	
	public function setProducts($products){
		$this->products = $products;
		return $this;
	}

	public function getProducts()
	{
		return $this->products;
	}

	public function setSalesmen($salesmen){
		$this->salesmen = $salesmen;
		return $this;
	}

	public function getSalesmen()
	{
		return $this->salesmen;
	}


	public function gridAction()
	{
		$request = $this->getRequest();

		$sID = (int) $request->getParams('id');


		$adapter = $this->getAdapter();
		$sql = "SELECT * FROM `salesman`;";
		$salesmen = $adapter->fetchAll($sql);
		if(!$salesmen){
			throw new Exception("Data Not Found.", 1);
		}

		$this->setSalesmen($salesmen);

		if(isset($_POST['select'])){
			$select = $request->getPost('select');
			$this->selectID = $select;
			$sql = "SELECT p.* , sp.salesman_price, sp.product_id as s_pID,sp.entity_id FROM `product` p LEFT JOIN `salesman_price` sp ON p.product_id = sp.product_id AND sp.salesman_id = {$select};";
			$products = $adapter->fetchAll($sql);
		}
		else{
			$sql = "SELECT p.* , sp.salesman_price, sp.product_id as s_pID,sp.entity_id FROM `product` p LEFT JOIN `salesman_price` sp ON p.product_id = sp.product_id AND sp.salesman_id = {$sID};";
			$products = $adapter->fetchAll($sql);	
		}

		if(!$products){
			throw new Exception("Data Not Found.", 1);
		}

		$this->setProducts($products);
		$this->getTemplate('salesman/price.phtml');
	}

	public function updateAction()
	{
		$request = $this->getRequest();

		$sID = (int) $request->getParams('id');

		if(!$sID){
			throw new Exception("Invalid ID.", 1);
		}

		if(!$request->isPost()){
			throw new Exception("Invalid Request.", 1);
		}

		$sPrice = $request->getPost('sPrice');

		$adapter = $this->getAdapter();
		foreach ($sPrice as $key => $value) {

			$sql = "SELECT * FROM `salesman_price` WHERE `product_id` = $key AND `salesman_id` = {$sID}";
			$check = $adapter->fetchAll($sql);

			if(!$check){
				$sql = "INSERT INTO `salesman_price`(`entity_id`, `product_id`, `salesman_id`, `salesman_price`) VALUES ('','{$key}','{$sID}','$value')";
				$priceResult = $adapter->insert($sql);
			}
			else{
				$sql = "UPDATE `salesman_price` SET `salesman_price`={$value} WHERE `product_id` = {$key} AND `salesman_id` = {$sID}";
				$priceResult = $adapter->update($sql);
			}
		}
		
		if(!$priceResult){
			throw new Exception("Error Data is Not Inserted", 1);
		}

		$this->redirect('Sprice','grid',$sID);
	}
}

?>