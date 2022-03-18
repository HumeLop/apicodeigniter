<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Users extends RestController
{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function user_put()
  {
    $data = $this->put();

    $this->load->library('form_validation');
    $this->form_validation->set_data($data);


    if ($this->form_validation->run('user_put')) {


      $query = $this->db->get_where('users', array('username' => $data['username']));
      $user_username = $query->row();

      if (isset ($user_username)) {
        # code...
        $respuesta = array(
          'err'=>TRUE,
          'mensaje' => 'El usuario ya esta registrado'
        );
        $this->response($respuesta, RestController::HTTP_BAD_REQUEST);
        return;
      }
     $res = $this->db->insert('users', $data);
     if ($res) {
      
      $respuesta = array(
        'err'=>FALSe,
        'mensaje' => 'Registro insertado correctamente',
        'user_id' => $this->db->insert_id()
      );

      $this->response($respuesta, RestController::HTTP_OK);
      

     }else{
       $respuesta = array(
         'err'=>TRUE,
         'mensaje' => 'Error al insertar',
         'error'=> $this->db->error_message(),
         'error_num' => $this->db->_error_num(),
       );
       $this->response($respuesta, RestController::HTTP_INTERNAL_SERVER_ERROR);
     }


    } else {

      $respuesta = array(
        'err' => TRUE,
        'mensaje' => 'Hay errores en el envio de la información',
        'errores' => $this->form_validation->get_errores_arreglo()
      );
    }

    $this->response($respuesta, RestController::HTTP_BAD_REQUEST);
  }

  // public function loginUser(){
  //   $data = $this->put();

  //   $this->load->library('form_validation');
  //   $this->form_validation->set_data($data);
  //   if ($this->form_validation->run('login-user') === FALSE) {
  //     $respuesta = array(
  //       'err'=>TRUE,
  //       'mensaje' => 'No a Iniciado sesión'
  //     );
  //     $this->response($respuesta, RestController::HTTP_BAD_REQUEST);
  //     return;
  //   } else {
  //     $u = $this->login->get_user_cardential($data);
  //               if($u) {
  //              		foreach($u as $user){
  //              			$this->session->set_userdata('username', $user['username']);
  //              			$this->session->set_userdata('password', $user['password']);
               		  
  //              		}
  //              }
  //              else
  //              {
  //              	$this->session->set_flashdata('msg',"Error! Your cardential is incorrect!");

  //              }
      
  //   }
  // }
}
