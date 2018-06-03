<?php
class Products extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('html');
    $this->load->model('product_model');
    $this->load->library('session');
  }

  public function index() {

    $data['jsfile'] = 'products';
    $data['cssfile'] = 'products';

    $data['products'] = $this->product_model->show_all_products();

    $this->load->view('header', $data);
    $this->load->view('products', $data);
    $this->load->view('footer');
  }

  public function get_detail() {
    $product_id = $this->input->post('product_id');

    $product = $this->product_model->show_product_detail( $product_id );

    echo json_encode($product);
  }
}