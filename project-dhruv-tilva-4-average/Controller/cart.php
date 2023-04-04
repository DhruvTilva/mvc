<?php 
require_once 'Controller/Core/Action.php';
require_once 'Model/Cart.php';
require_once 'Model/Product.php';

class Controller_Cart extends Controller_Core_Action
{

	protected $products = [];
	protected $shipping = [];
	protected $cart = [];
	
	public function setProducts($products)
	{
		$this->products = $products;
		return $this;
	}

	public function getProducts()
	{
		return $this->products;
	}

	public function setShipping($shipping)
	{
		$this->shipping = $shipping;
		return $this;
	}

	public function getShipping()
	{
		return $this->shipping;
	}

	public function setCart($cart)
	{
		$this->cart = $cart;
		return $this;
	}

	public function getCart()
	{
		return $this->cart;
	}

	public function cartAction()
	{

		$sql = "SELECT * FROM `product`";
		$model = new Model_Cart();
		$products = $model->fetchAll($sql);

		if(!$products){
			echo "<h1>Don't Have Any Data.</h1>";
		}

		$this->setProducts($products);

		$sql = "SELECT `name`,`amount` FROM `shipping`";
		$shippings = $model->fetchAll($sql);
		$this->setShipping($shippings);

		$sql = "SELECT p.name, p.sku , c.* FROM `product` p INNER JOIN `cart_item` c WHERE p.`product_id` = c.`product_id`";
		$cartItems = $model->fetchAll($sql);
		$this->setCart($cartItems);
		$this->getTemplate('cart/cart.phtml');

	}
	public function addAction()
	{

		$this->getTemplate('product/add.phtml');

	}
	public function editAction()
	{
		$request = $this->getRequest();

		$id = (int) $request->getParams('id');
		if(!$id){
    		throw new Exception("Invalid ID.", 1);
		}

		// $sql = "SELECT * FROM `product` WHERE `product_id` = '$id';";
		$productModel = new Model_Product();
		$product = $productModel->setTableName('product')->load($id);

		if(!$product){
			throw new Exception("Data Not Found.", 1);
		}

		$this->setProducts($product);
		$this->getTemplate('product/edit.phtml');

	}
	public function insertAction()
	{

		$request = $this->getRequest();

		if(!$request->isPost()){
			throw new Exception("Data is not inserted.", 1);
		}
		
		$cart = $request->getPost('cart');
		$arrayData = explode('=',$cart['item']);
		array_push($arrayData, $cart['quantity']);
		$arrayKeys = ['product_id','cost','price','quantity'];
		$array = array_combine($arrayKeys, $arrayData);

		$cartModel = new Model_Cart();
		$result = $cartModel->insert($array);
		print_r($result);
		die();


		$this->redirect('product','grid');

	}
	public function updateAction()
	{

		$request = $this->getRequest();
		
		$id = (int) $request->getParams('id');
		if(!$id){
    		throw new Exception("Invalid ID.", 1);
		}

		if(!$request->isPost()){
    		throw new Exception("Invalid Request.", 1);
		}

		$product = $request->getPost('product');

		$productModel = new Model_Product();
		$productResult = $productModel->update($product, $id);

		if(!$productResult){
			throw new Exception("Error Data is Not Updated.", 1);
		}

		$this->redirect('product','grid');

	}
	public function deleteAction()
	{

		$request = $this->getRequest();

		$id = (int) $request->getParams('id');
		if(!$id){
    		throw new Exception("Invalid ID.", 1);
		}

		$productModel = new Model_Product();
		$productResult = $productModel->delete($id);

		if(!$productResult){
			throw new Exception("Error Data is Not Deleted.", 1);
		}

		$this->redirect('product','grid');
		
	}
	
}

?>
