<?php
class Order_model extends CI_Model {
    public function create_order($user_id, $cart_items) {
        $this->db->trans_start();

        $order_data = [
            'user_id' => $user_id,
            'total_amount' => $cart_items['total_amount']
        ];
        $this->db->insert('orders', $order_data);
        $order_id = $this->db->insert_id();

        foreach ($cart_items['items'] as $item) {
            $order_item_data = [
                'order_id' => $order_id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price
            ];
            $this->db->insert('order_items', $order_item_data);
        }

        $this->db->trans_complete();

        return $this->db->trans_status() ? $order_id : false;
    }
}

class Cart_model extends CI_Model {
    public function clear_cart($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->delete('cart');
    }
}
