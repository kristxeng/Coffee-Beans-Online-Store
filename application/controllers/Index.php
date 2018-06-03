<?php
class Index extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('html');
    $this->load->helper('form');
    $this->load->library('session');
    $this->load->model('featured_model');
    $this->load->model('message_model');
  }

  public function index() {

    $data['jsfile'] = 'index';
    $data['cssfile'] = 'index';

    $data['featured'] = $this->featured_model->show_featured_set();

    $this->load->view('header', $data);
    $this->load->view('index', $data);
    $this->load->view('footer');

  }

  public function about() {
    $data['jsfile'] = '';
    $data['cssfile'] = 'about';

    $this->load->view('header', $data);
    $this->load->view('about');
    $this->load->view('footer');
  }

  public function contact() {
    $data['jsfile'] = 'contact';
    $data['cssfile'] = 'contact';

    $name = $this->input->post('name');
    $tel = $this->input->post('tel');
    $email = $this->input->post('email');
    $message = $this->input->post('message');

    if($name){
      $result = $this->message_model->insert_message( $name, $tel, $email, $message );
      if( $result ) echo 'ok';

    } else {
      $this->load->view('header', $data);
      $this->load->view('contact');
      $this->load->view('footer');
    }
  }
}