<?php
class Admin extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('admin_model');
    $this->load->helper('form');
    $this->load->library('session');
    $this->load->helper('url');
  }

  public function login() {

    $data['jsfile'] = 'login';
    $data['cssfile'] = 'login';

    $username = $this->input->post('username') ;
    $password = $this->input->post('password') ;

    if( $_SERVER['REQUEST_METHOD'] == 'GET' ){

      $this->load->view('admin/header', $data);
      $this->load->view('admin/login', $data);
      $this->load->view('admin/footer');

    }elseif ($_SERVER['REQUEST_METHOD'] == 'POST'){

      if( $username && $password ) {
        $result = $this->admin_model->check_admin( $username, $password );

        if( $result ) {
            $this->session->set_userdata( ['admin_user' => 'admin'] );
            echo 'ok';
        }else echo 'error';
      }
    }
  }

  public function logout() {
    $this->session->sess_destroy();
    redirect(base_url('admin/login'));
  }
}