<?php
class Orders extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('order_model');
    $this->load->library('session');
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->helper('html');
  }

  public function show_list() {
    if( isset($_SESSION['admin_user']) ) {

      $data['jsfile'] = 'admin';
      $data['cssfile'] = 'admin';

      $data['admin_user'] = $_SESSION['admin_user'];
      
      $orders = $this->order_model->show_all();
      $data['orders'] = $orders;
      $this->load->view('admin/header', $data);
      $this->load->view('admin/side_menu', $data);
      $this->load->view('admin/orders_list', $data);
      $this->load->view('admin/footer');

    } else redirect( base_url('admin/login') ); //如果未登入，跳回管理者登入頁
  }

  public function show_detail( $order_id = 0 ) {
    if( isset($_SESSION['admin_user']) ) {

      $data['jsfile'] = 'admin';
      $data['cssfile'] = 'admin';
      $data['admin_user'] = $_SESSION['admin_user'];

      $order = $this->order_model->show_buyer_detail( $order_id );
      $order_contents = $this->order_model->show_contents( $order_id );
      $data['order'] = $order;
      $data['order_contents'] = $order_contents;
      $this->load->view('admin/header', $data);
      $this->load->view('admin/side_menu', $data);
      $this->load->view('admin/order_detail', $data);
      $this->load->view('admin/footer');

    } else redirect( base_url('admin/login') ); //如果未登入，跳回管理者登入頁
  }

  public function handle_modify( ) {
    if( isset($_SESSION['admin_user']) ){
      $order_id = $this->input->post( 'order_id' );
      $has_shipped = $this->input->post( 'has_shipped' );
      $result = $this->order_model->modify_shipping_status( (int)$order_id, $has_shipped );
      if( $result ) {
        redirect( base_url('admin/orders/show_list') ); //修改成功，跳回商品列表
      }
    } else redirect( base_url('admin/login') ); //如果未登入，跳回管理者登入頁
  }

}