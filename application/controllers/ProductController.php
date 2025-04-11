<?php
class ProductController extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->model('Product_model'); 
  
}
 
public function index()
{
    $data['title'] = 'Product List';
    $data['products'] = $this->Product_model->get_all_products();
    $data['content'] = 'admin/products/index'; // View inside content area
    $this->load->view('admin/products/index', $data);
}



  // public function index() {
  //   $this->load->model('Product_model');
  //   $data['products'] = $this->Product_model->get_all_products();
  //   $this->load->view('admin/products/index', $data);
  // }

  public function create() {
    $this->load->view('admin/products/create');
  }

  public function store()
{
   
  $name  = $this->input->post('name');
  $price = $this->input->post('price');

  if (empty($name) || empty($price)) {
      show_error('Name and price are required.');
  }

  $product_data = [
      'name' => $name,
      'price' => $price
  ];

  $product_id = $this->Product_model->insert_product($product_data);

  if (!empty($_FILES['images']['name'][0])) {
      $upload_path = 'uploads/products/';
      if (!is_dir($upload_path)) {
          mkdir($upload_path, 0777, true);
      }

      $files = $_FILES['images'];

      for ($i = 0; $i < count($files['name']); $i++) {
          $_FILES['single_image']['name']     = $files['name'][$i];
          $_FILES['single_image']['type']     = $files['type'][$i];
          $_FILES['single_image']['tmp_name'] = $files['tmp_name'][$i];
          $_FILES['single_image']['error']    = $files['error'][$i];
          $_FILES['single_image']['size']     = $files['size'][$i];

          $config['upload_path']   = $upload_path;
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          $config['file_name']     = uniqid();

          $this->load->library('upload', $config);

          if ($this->upload->do_upload('single_image')) {
              $uploaded = $this->upload->data();
              $image_path = $upload_path . $uploaded['file_name'];

              $this->Product_model->insert_image([
                  'product_id' => $product_id,
                  'image_path' => $image_path
              ]);
          }
      }
  }
  redirect('index.php/ProductController'); // or show success message
}
  
public function edit($id) {
  $data['product'] = $this->Product_model->get_by_id($id);
  $this->load->view('admin/products/edit', $data);
}

public function update($id) {
  $name  = $this->input->post('name');
  $price = $this->input->post('price');

  $updateData = [
      'name'  => $name,
      'price' => $price
  ];

  // Handle image upload
  if (!empty($_FILES['image']['name'])) {
      $config['upload_path']   = './uploads/';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['file_name']     = time().'_'.$_FILES['image']['name'];
      $this->load->library('upload', $config);

      if ($this->upload->do_upload('image')) {
          $uploadData = $this->upload->data();
          $updateData['image'] = 'uploads/' . $uploadData['file_name'];
      }
  }

  $this->Product_model->update($id, $updateData);
  redirect('index.php/ProductController');
}

public function delete($id) {
  
  $this->Product_model->delete($id);
  $this->session->set_flashdata('success', 'Product deleted successfully!');
  redirect('index.php/ProductController');
}
    
  public function api_all_products() {
    header('Content-Type: application/json');
    $this->load->model('Product_model');
    echo json_encode($this->Product_model->get_products_with_images());
  }
}