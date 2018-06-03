<?php
class Products extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('product_model');
    $this->load->library('session');
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->helper('html');

  }

  /* 後臺商品列表*/
  public function show_list() {
    if( isset($_SESSION['admin_user']) ) {

      $data['jsfile'] = 'products';
      $data['cssfile'] = 'admin';
      $data['admin_user'] = $_SESSION['admin_user'];
      
      $products = $this->product_model->show_all_products();
      $data['products'] = $products;
      $this->load->view('admin/header', $data);
      $this->load->view('admin/side_menu', $data);
      $this->load->view('admin/products_list', $data);
      $this->load->view('admin/footer');

    } else redirect( base_url('admin/login') ); //如果未登入，跳回管理者登入頁
  }

  /* 後臺個別商品 */
  public function show_detail( $product_id ) {
    if( isset($_SESSION['admin_user']) ) {

      $data['jsfile'] = 'productDetail';
      $data['cssfile'] = 'admin';
      $data['admin_user'] = $_SESSION['admin_user'];

      $product = $this->product_model->show_product_detail( $product_id );
      $data['product'] = $product;
      $this->load->view('admin/header', $data);
      $this->load->view('admin/side_menu', $data);
      $this->load->view('admin/product_detail', $data);
      $this->load->view('admin/footer');

    } else redirect( base_url('admin/login') ); //如果未登入，跳回管理者登入頁
  }

  /* 一般新增商品處理 */
  public function handle_create() {
    if( isset($_SESSION['admin_user']) ){ 
      //上傳的文字資料
      $name = $this->input->post('name');
      $price = $this->input->post('price');
      $intro = $this->input->post('intro');

      //圖片上傳設定
      $config['upload_path']          = './public/img/';
      $config['allowed_types']        = 'gif|jpg|png';
      $config['max_size']             = 1024;
      $config['max_width']            = 1000;
      $config['max_height']           = 1000;
      $this->load->library('upload', $config);

      if ( $this->upload->do_upload('userfile') ) {
        $img = base_url( 'public/img/'. $this->upload->data('file_name') );
        $result = $this->product_model->insert_product($name, $price, $img, $intro);
        if( $result ) {
          redirect( base_url('admin/products/') ); //修改成功，跳回商品列表
        }
      }
    } else redirect( base_url('admin/login') ); //如果未登入，跳回管理者登入頁
  }

  /* 新增商品 使用預設圖片 */
  public function create_with_default_img() {
    if( isset($_SESSION['admin_user']) ){
      //上傳的文字資料
      $name = $this->input->post('name');
      $price = $this->input->post('price');
      $intro = $this->input->post('intro');
      $img = base_url('public/img/default_beans_600x600.jpg');

      $result = $this->product_model->insert_product($name, $price, $img, $intro);
      if( $result ) {
        echo 'ok';
      }

    } else redirect( base_url('admin/login') ); //如果未登入，跳回管理者登入頁
  }

  public function handle_modify() {
    if( isset($_SESSION['admin_user']) ){
      //上傳的文字資料
      $product_id = $this->input->post('product_id');
      $name = $this->input->post('name');
      $price = $this->input->post('price');
      $selling = $this->input->post('selling');
      $intro = $this->input->post('intro');
      //圖片上傳設定
      $config['upload_path']          = './public/img/';
      $config['allowed_types']        = 'gif|jpg|png';
      $config['max_size']             = 1024;
      $config['max_width']            = 1000;
      $config['max_height']           = 1000;
      $this->load->library('upload', $config);

      if ( $this->upload->do_upload('userfile') ) {

        
        $img = base_url( 'public/img/'. $this->upload->data('file_name') );

        $result = $this->product_model->modify_product($product_id, $name, $price, $img, $selling, $intro);
      
        var_dump($result);
        if( $result ) {
          redirect( base_url('admin/products/' . $product_id) );
        }
      } else var_dump($this->upload->display_errors('<p>', '</p>'));

    } else redirect( base_url('admin/login') ); //如果未登入，跳回管理者登入頁
  }

  public function handle_modify_without_img() {
    if( isset($_SESSION['admin_user']) ){
      //上傳的文字資料
      $product_id = $this->input->post('product_id');
      $name = $this->input->post('name');
      $price = $this->input->post('price');
      $selling = $this->input->post('selling');
      $intro = $this->input->post('intro');
    
      $result = $this->product_model->modify_product_without_img($product_id, $name, $price, $selling, $intro);


      if( $result) echo 'ok';
      else echo $result;

    } else redirect( base_url('admin/login') ); //如果未登入，跳回管理者登入頁
  }
}