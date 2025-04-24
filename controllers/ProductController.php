<?php
require_once 'controllers/BaseController.php';
require_once 'models/ProductModel.php';

class ProductController extends BaseController
{
    private $productModel;
    private $cartModel;

    public function __construct($conn = null)
    {
        parent::__construct();
        // Create ProductModel with a valid connection
        $this->productModel = new ProductModel($this->conn);

        // Also load cart model for add to cart functionality
        require_once 'models/CartModel.php';
        $this->cartModel = new CartModel();
    }

    public function index()
    {
        $products = $this->productModel->getAllProducts();
        $cart = $this->cartModel->getCart();
        $cartCount = $this->cartModel->getCartCount();

        $this->render('home', [
            'products' => $products,
            'cart' => $cart,
            'cartCount' => $cartCount
        ]);
    }

    public function viewProduct($id)
    {
        $product = $this->productModel->getProductById($id);
        
        if (!$product) {
            return $this->renderError("Product not found", "index.php");
        }
        
        $cart = $this->cartModel->getCart();
        $cartCount = $this->cartModel->getCartCount();
        
        $this->render('product', [
            'product' => $product,
            'cart' => $cart,
            'cartCount' => $cartCount
        ]);
    }

    public function addToCart($id)
    {
        $product = $this->productModel->getProductById($id);

        if ($product) {
            $this->cartModel->addToCart($product);
        }

        header('Location: index.php?page=cart');
        exit();
    }
}
