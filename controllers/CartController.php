<?php
require_once 'controllers/BaseController.php';
require_once 'models/CartModel.php';

class CartController extends BaseController
{
    private $cartModel;

    public function __construct()
    {
        parent::__construct();
        $this->cartModel = new CartModel();
    }

    public function viewCart()
    {
        $cart = $this->cartModel->getCart();
        $total = $this->cartModel->calculateTotal();
        $cartCount = $this->cartModel->getCartCount();

        $this->render('cart', [
            'cart' => $cart,
            'total' => $total,
            'cartCount' => $cartCount
        ]);
    }

    public function removeFromCart($id)
    {
        $this->cartModel->removeFromCart($id);

        header('Location: index.php?page=cart');
        exit();
    }

    public function updateCart()
    {
        if (isset($_POST['quantity'])) {
            $this->cartModel->updateCart($_POST['quantity']);
        }

        header('Location: index.php?page=cart');
        exit();
    }
}
