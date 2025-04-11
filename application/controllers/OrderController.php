<?php
class OrderController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Cart_model'); 
        $this->load->model('Order_model');
      
    }

    public function place_order() {
        $user_id = 1; // Hardcoded for this example
        $this->load->model('Cart_model');
        $this->load->model('Order_model');

        $cart_items = $this->Cart_model->get_cart_items($user_id);
        if (empty($cart_items['items'])) {
            echo json_encode(['error' => 'Cart is empty.']);
            return;
        }

        $order_id = $this->Order_model->create_order($user_id, $cart_items);
        if ($order_id) {
            $this->Cart_model->clear_cart($user_id);
            echo json_encode(['message' => 'Order placed successfully.', 'order_id' => $order_id]);
        } else {
            echo json_encode(['error' => 'Failed to place order.']);
        }
    }
}
