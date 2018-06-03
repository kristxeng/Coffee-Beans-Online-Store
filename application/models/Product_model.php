<?php
Class Product_model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }

  public function show_all_products( ) {
    $sql = 'SELECT * FROM products ORDER BY id DESC';
    $query = $this->db->query( $sql );
    return $query->result_array();
  }

  public function show_product_detail( $product_id ) {
    $sql = 'SELECT * FROM products WHERE id = ?';
    $query = $this->db->query( $sql, $product_id );
    return $query->row_array();
  }

  public function insert_product($name, $price, $img, $intro) {
    $sql = 'INSERT INTO products (name, price, img, intro) VALUES (?,?,?,?)';
    $result = $this->db->query( $sql, [$name, $price, $img, $intro] );
    return $result;
  }

  public function modify_product( $product_id, $name, $price, $img, $selling, $intro ) {
    $sql = 'UPDATE products SET name=?, price=?, img=?, selling=?, intro=? WHERE id=?';
    $result = $this->db->query( $sql, [$name, (int)$price, $img, (bool)$selling, $intro, (int)$product_id] );
    return $result;
  }

  public function modify_product_without_img($product_id, $name, $price, $selling, $intro) {
    $sql = 'UPDATE products SET name=?, price=?, selling=?, intro=? WHERE id=?';
    $result = $this->db->query( $sql, [$name, (int)$price, (bool)$selling, $intro, (int)$product_id] );
    return $result;
  }
}