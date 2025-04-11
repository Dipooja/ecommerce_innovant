<?php
class Product_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); 
        
    }




    public function insert_product($data)
    {
        $this->db->insert('products', $data);
        return $this->db->insert_id();
    }
    
    public function insert_image($data)
    {
        $this->db->insert('product_images', $data);
    }

  public function upload_images($product_id, $files) {
    $this->load->library('upload');
    $filesCount = count($files['name']);

    for ($i = 0; $i < $filesCount; $i++) {
      $_FILES['file']['name'] = $files['name'][$i];
      $_FILES['file']['type'] = $files['type'][$i];
      $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
      $_FILES['file']['error'] = $files['error'][$i];
      $_FILES['file']['size'] = $files['size'][$i];

      $config['upload_path'] = './uploads/products/';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['file_name'] = time().'_'.$files['name'][$i];

      $this->upload->initialize($config);
      if ($this->upload->do_upload('file')) {
        $uploadData = $this->upload->data();
        $this->db->insert('product_images', [
          'product_id' => $product_id,
          'image_path' => 'uploads/products/'.$uploadData['file_name']
        ]);
      }
    }
  }

  public function get_all_products() {
    $this->db->where('is_deleted', 0);
    return $this->db->get('products')->result();
}

  public function get_products_with_images() {
    $products = $this->db->get('products')->result();
    foreach ($products as &$product) {
      $product->images = $this->db->get_where('product_images', ['product_id' => $product->id])->result();
    }
    return $products;
  }



  public function get_by_id($id) {
    return $this->db->get_where('products', ['id' => $id])->row();
}

public function update($id, $data) {
    $this->db->where('id', $id)->update('products', $data);
}


public function delete($id)
{
    // First delete product images from db and folder
    $images = $this->db->get_where('product_images', ['product_id' => $id])->result();
    
    foreach ($images as $img) {
        $path = FCPATH . 'uploads/products/' . $img->image_path;
        if (file_exists($path)) {
            unlink($path);
        }
        $this->db->delete('product_images', ['id' => $img->id]);
    }

    // Then delete the product itself
    return $this->db->delete('products', ['id' => $id]);
  }
}