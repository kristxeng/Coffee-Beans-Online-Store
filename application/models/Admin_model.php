<?php
Class Admin_model extends CI_Model {

  public function __construct() {

    $this->load->database();
  }

  public function check_admin( $username, $password ) {
    $sql = 'SELECT password FROM admin WHERE username = ?';
    $query = $this->db->query( $sql, $username);
    $row = $query->row_array();
      
    return password_verify($password, $row['password']) ? TRUE : FALSE;
  }
}