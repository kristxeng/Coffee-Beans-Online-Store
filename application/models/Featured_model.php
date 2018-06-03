<?php
Class Featured_model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }

  public function find_featured_id() {
    $sql = 'SELECT id, product_id FROM featured_set ORDER BY id';
    $query = $this->db->query( $sql );
    return $query->result_array();
  }

  public function handle_modify( $left, $middle, $right ) {
    $this->db->trans_start();

    $sql1 = 'UPDATE featured_set SET product_id=? WHERE id=1';
    $sql2 = 'UPDATE featured_set SET product_id=? WHERE id=2';
    $sql3 = 'UPDATE featured_set SET product_id=? WHERE id=3';
    $this->db->query( $sql1, $left );
    $this->db->query( $sql2, $middle );
    $this->db->query( $sql3, $right );
    
    $this->db->trans_complete();

    return $this->db->trans_status();
  }

  public function show_featured_set() {
    $sql = 'SELECT product_id, name, price, img FROM featured_set JOIN products AS p ON p.id = product_id';
    $query = $this->db->query( $sql );
    return $query->result_array();
  }
}