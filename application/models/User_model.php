<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

  public $id;
  public $nombre;
  public $username;
  public $password;
  public $pass_confirmed;

  public function get_user($id){
    $this->id = intval($id);
    $this->nombre ='Humberto';
    $this->username ='marcelo';

    return $this;
  }
}