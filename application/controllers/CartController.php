<?php
 class CartController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Cart_model'); 
    }


    public function index()
    {
        $data['cart_items'] = $this->Cart_model->get_cart_items(1); // hardcoded user
        $this->load->view('cartlist', $data);
    }


  public function add() {
    header('Content-Type: application/json');
    $user_id = 1; // Hardcoded for this task
    $product_id = $this->input->post('product_id');
    $quantity = $this->input->post('quantity');

    $this->load->model('Cart_model');
    $this->Cart_model->add_to_cart($user_id, $product_id, $quantity);
    echo json_encode(['message' => 'Product added to cart.']);
  }

  public function list() {
    header('Content-Type: application/json');
    $user_id = 1; // Hardcoded
    $this->load->model('Cart_model');
    echo json_encode($this->Cart_model->get_cart_items($user_id));
  }
}