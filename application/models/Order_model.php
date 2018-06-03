<?php
Class Order_model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }

  public function show_all() {
    $sql = 'SELECT * FROM orders ORDER BY created_by DESC';
    $query = $this->db->query( $sql );
    return $query->result_array();
  }

  public function show_buyer_detail( $order_id ) {
    $sql = 'SELECT * FROM orders WHERE id = ?';
    $query = $this->db->query( $sql, $order_id );
    return $query->row_array();
  }

  public function show_contents( $order_id ) {
    $sql = 'SELECT p.id, quantity, name, price FROM order_contents AS o JOIN products AS p ON p.id = product_id WHERE order_id = ?';
    $query = $this->db->query( $sql, $order_id );
    return $query->result_array();
  }

  public function modify_shipping_status( $order_id, $has_shipped ) {
    $sql = 'UPDATE orders SET has_shipped=? WHERE id=?';
    $result = $this->db->query( $sql,[$has_shipped, $order_id] );
    return $result;
  }

  public function insert_order( $sn, $total_price, $buyer, $address, $tel, $email, $pay_method, $has_paid, $query_token, $cart ) {
    $this->db->trans_start();

    // 訂單中非商品相關資料存進資料庫
    $sql = 'INSERT INTO orders (sn, total_price, buyer, address, tel, email, pay_method, has_paid, query_token) VALUES(?,?,?,?,?,?,?,?,?)';
    $this->db->query( $sql, [$sn, $total_price, $buyer, $address, $tel, $email, $pay_method, $has_paid, $query_token] );
    $order_id = $this->db->insert_id();

    // 將訂單中的商品清單存進資料庫
    foreach( $cart as $item ){
      $sql = 'INSERT INTO order_contents (order_id, product_id, quantity) VALUES (?,?,?)';
      $this->db->query( $sql, [$order_id, $item['product_id'], $item['quantity'] ] );
    }

    $this->db->trans_complete();

    return $this->db->trans_status();
  }
}