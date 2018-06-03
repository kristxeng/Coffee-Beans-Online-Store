<?php
class Cart extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('product_model');
    $this->load->library('session');
    $this->load->helper('url');
    $this->load->helper('form');
  }

  public function index() {
    $data['jsfile'] = 'cart';
    $data['cssfile'] = 'cart';

    $cart = $this->session->userdata('cart');
    //計算購物車中商品價格總和
    $total_price = 0;
    if( $cart ) {
      foreach( $cart as $item ){
        $total_price += $item['price']*$item['quantity'];
      }
    }

    $this->session->set_userdata('total_price', $total_price);

    $this->load->view('header', $data);
    $this->load->view('cart', $data);
    $this->load->view('footer');
  }

  public function add_to_cart() {
    $product_id = $this->input->post('product_id'); 
    // 初始化 cart session
    if( !$this->session->userdata('cart') ) $_SESSION['cart'] = [];
    // 如果要加入的商品沒有在購物車中，則 push 進購物車陣列中
    if( !$this->_item_exist( $product_id ) ) {
      // 基於來自 client 的資料可能被竄改， price 等資料從資料庫中撈
      $product = $this->product_model->show_product_detail( $product_id );
      array_push( $_SESSION['cart'], [ 'product_id' => $product_id,
                                       'name' => $product['name'],
                                       'price' => $product['price'],
                                       'quantity' => 1 ]);
    }
    // echo json_encode( $this->session->all_userdata() );
  }

  // 如果要加入的商品已在購物車中，則數量 +1，並回傳true
  private function _item_exist( $product_id ) {
    foreach( $this->session->userdata('cart') as $key=>$value ) {
      if( $value['product_id'] == $product_id ) {
        ++$_SESSION['cart'][$key]['quantity'];
        return true;
      }
    }
    return false;
  }

  // 刪除購物車內商品處理
  public function delete_item() {
    $key = $this->input->post('key');
    unset( $_SESSION['cart'][$key] );
  }

  // 將使用者上傳的資料存在 session 中，並轉址進行結帳程序
  public function pre_checkout() {
    $buyer = $this->input->post('buyer');
    $tel = $this->input->post('tel');
    $email = $this->input->post('email');
    $address = $this->input->post('address');
    $pay_method = $this->input->post('pay_method');
    $user_info = array( 'buyer' => $buyer,
                        'tel' => $tel,
                        'email' => $email,
                        'address' => $address,
                        'pay_method' => $pay_method );
    $this->session->set_userdata( 'user_info', $user_info );
    echo 'ok';
  }

  public function quantity_modify() {
    $key = $this->input->post('key');
    $quantity = $this->input->post('quantity');
    $_SESSION['cart'][$key]['quantity'] = $quantity;
    echo 'ok';
  }

  // 浮動購物車按鈕 badge 的商品數量查詢
  public function get_quantity() {
    // 初始化 cart session
    if( !$this->session->userdata('cart') ) $_SESSION['cart'] = [];
    // 抽出購物車 session 中 quantity 欄位，在計算總和
    $total_quantity = array_sum( array_column($_SESSION['cart'], 'quantity') );
    echo $total_quantity;
  }
}