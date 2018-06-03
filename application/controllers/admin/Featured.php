<?php
class Featured extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('featured_model');
    $this->load->model('product_model');
    $this->load->library('session');
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->helper('html');

  }

  public function index() {
    if( isset($_SESSION['admin_user']) ) {
      
      $data['jsfile'] = 'featured';
      $data['cssfile'] = 'admin';
      $data['admin_user'] = $_SESSION['admin_user'];

      $featured = $this->featured_model->find_featured_id();
      $products = $this->product_model->show_all_products();
      $data['featured'] = $featured;
      $data['products'] = $products;
      $this->load->view('admin/header', $data);
      $this->load->view('admin/side_menu', $data);
      $this->load->view('admin/featured', $data);
      $this->load->view('admin/footer');

    } else redirect( base_url('admin/login') ); //如果未登入，跳回管理者登入頁
  }

  public function handle_modify() {
    if( isset($_SESSION['admin_user']) ) {

      $left = $this->input->post('left');
      $middle = $this->input->post('middle');
      $right = $this->input->post('right');

      $result = $this->featured_model->handle_modify( $left, $middle, $right );

      if( $result ) {
        echo 'ok';
      }

    } else redirect( base_url('admin/login') ); //如果未登入，跳回管理者登入頁
  }
}