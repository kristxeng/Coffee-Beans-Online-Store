<?php
class Messages extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('message_model');
    $this->load->library('session');
    $this->load->helper('url');
    $this->load->helper('html');
  }

  public function show_list() {
    if( isset($_SESSION['admin_user']) ) {
      $data['jsfile'] = 'messages';
      $data['cssfile'] = 'admin';
      $data['admin_user'] = $_SESSION['admin_user'];
      $data['messages'] = $this->message_model->show_all();

      $this->load->view('admin/header', $data);
      $this->load->view('admin/side_menu', $data);
      $this->load->view('admin/message', $data);
      $this->load->view('admin/footer');

    } else redirect( base_url('admin/login') ); //如果未登入，跳回管理者登入頁
  }

  public function get_detail() {
    if( isset($_SESSION['admin_user']) ) {
      $message_id = $this->input->post('message_id');
      $row = $this->message_model->get_detail( $message_id );
      echo json_encode( $row );

    } else redirect( base_url('admin/login') ); //如果未登入，跳回管理者登入頁
  }

  public function modify_replied() {
    if( isset($_SESSION['admin_user']) ) {
      $message_id = $this->input->post('message_id');
      $has_replied = $this->input->post('has_replied');
      $result = $this->message_model->modify_replied( $has_replied, $message_id );
      if($result) echo 'ok';
    
    } else redirect( base_url('admin/login') ); //如果未登入，跳回管理者登入頁
  }
}