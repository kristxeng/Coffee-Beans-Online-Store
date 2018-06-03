<?php
Class Message_model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }

  public function insert_message( $name, $tel, $email, $message ) {
    $sql = 'INSERT INTO messages (name, tel, email, message) VALUES (?,?,?,?)';
    $result = $this->db->query( $sql, [ $name, $tel, $email, $message ] );
    return $result;
  }

  public function show_all() {
    $sql = 'SELECT id, name, message, created_by, has_replied FROM messages ORDER BY created_by DESC';
    $query = $this->db->query( $sql );
    return $query->result_array();
  }

  public function get_detail( $message_id ) {
    $sql = 'SELECT * FROM messages WHERE id=?';
    $query = $this->db->query( $sql, $message_id );
    return $query->row_array();
  }

  public function modify_replied( $has_replied, $message_id ) {
    $sql = 'UPDATE messages SET has_replied = ? WHERE id = ?';
    $result = $this->db->query( $sql, [$has_replied, $message_id] );
    return $result;
  }
}