<?php
class Cart_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    } 
  public function add_to_cart($user_id, $product_id, $quantity) {
    $this->db->insert('cart', [
      'user_id' => $user_id,
      'product_id' => $product_id,
      'quantity' => $quantity
    ]);
  }

  public function get_cart_items()
{
    $this->db->select('cart.id, cart.product_id, cart.quantity, products.name, products.price');
    $this->db->from('cart');
    $this->db->join('products', 'products.id = cart.product_id');
    $this->db->where('cart.user_id', 1);
    return $this->db->get()->result_array();  // returning as array
}
}