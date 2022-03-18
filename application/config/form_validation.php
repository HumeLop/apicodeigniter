<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
  'user_put' => array(
    array('field' => 'nombre', 'label' => 'nombre', 'rules' => 'trim|required|min_length[2]|max_length[255]'),
    array('field' => 'username', 'label' => 'username', 'rules' => 'trim|required|min_length[4]|max_length[20]'),
    array('field' => 'password', 'label' => 'password', 'rules' => 'trim|required|min_length[8]|max_length[16]'),
    array('field' => 'passconf', 'label' => 'passconf', 'rules' => 'trim|required|min_length[8]|max_length[16]|matches[password]'),
  ),
  array(
    'login-user' => array('field' => 'username', 'label' => 'username', 'rules' => 'trim|required|min_length[4]|max_length[20]'),
    array('field' => 'password', 'label' => 'password', 'rules' => 'trim|required|min_length[8]|max_length[16]')
  )
);
