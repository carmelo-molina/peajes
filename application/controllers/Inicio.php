<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

  public function index()
  {
    if(isLogin())
    {
      $this->load->model('empleado_model');
      $data['empleado'] = $this->empleado_model->get_empleado($this->session->userdata('id_empleado'));
      $data['main_content'] = 'inicio/success_view';
      $data['title'] = 'Bienvenido';
      $this->load->view('template/template_view', $data);
    }
    else
    {
      $data['main_content'] = 'inicio/index_view';
      $data['title'] = 'Inicio';
      $this->load->view('template/template_view', $data);
    }
  }
  public function login()
  {
    $this->load->model('empleado_model');
    if($this->input->post())
    {
      $nombre_usuario = $this->input->post('usuario');
      $password = $this->input->post('password');
      $usuario = $this->empleado_model->login($nombre_usuario, md5($password));
      if(count($usuario)!=0)
      {
        $session = array(
          'id_empleado' => $usuario['id_empleado'],
          'usuario' => $usuario['usuario'],
          'nivel' => $usuario['nivel'],
          'estado' => $usuario['estado']
        );
        $this->session->set_userdata($session);
        echo 'true';
      }
      else
        echo "false uss:".$nombre_usuario." pass:".$password;
    }
  }

  public function logout($csrf_hash)
  {
    if($csrf_hash==$this->security->get_csrf_hash())
    {
      $this->session->sess_destroy();
      redirect(base_url());
    }
    redirect(base_url());
  }

  public function registro()
  {
    $this->load->model('empleado_model');
    $this->load->model('empleado_model');
    $id_persona = $this->empleado_model->current_num();
    $data_persona = array();
    $data_persona['id_persona'] = $id_persona;
    $data_persona['nombres'] = trim($this->input->post('nombres'));
    $data_persona['paterno'] = trim($this->input->post('paterno'));
    $data_persona['materno'] = trim($this->input->post('materno'));
    $data_persona['ci'] = trim($this->input->post('ci'));
    $data_persona['domicilio'] = trim($this->input->post('domicilio'));
    $data_persona['telefono'] = trim($this->input->post('telefono'));
    $data_persona['email'] = strtolower(trim($this->input->post('email')));

    $data_usuario['id_persona'] = $id_persona;
    $data_usuario['usuario'] = trim($this->input->post('email'));
    $data_usuario['password'] = md5(trim($this->input->post('registro_clave')));
    $data_usuario['estado'] = '0';
    $data_usuario['nivel'] = '1';
    if($this->empleado_model->buscar_email($data_persona['email']))
    {
      $this->empleado_model->insertar($data_persona);
      $this->empleado_model->insertar_usuario($data_usuario);
    }
    else
    {
      $usuario_actual = $this->empleado_model->get_persona_email(strtolower(trim($this->input->post('email'))));
      $id_persona = $usuario_actual['id_persona'];
    }

    $this->load->library('email');
    $config['protocol'] = 'smtp';
    $config["smtp_host"] = $this->config->item('smtp_host');
    $config["smtp_user"] = $this->config->item('smtp_user');
    $config["smtp_pass"] = $this->config->item('smtp_pass');
    $config["smtp_port"] = $this->config->item('smtp_port');
    $config["mailtype"] = 'html';
    $config['charset'] = 'utf-8';
    $config['wordwrap'] = true;
    $config['validate'] = true;
    $config['newline'] = "\r\n";

    $this->email->initialize($config);
    $this->email->from($this->config->item('smtp_user'), $this->config->item('producto'));
    $this->email->to($this->input->post('email'));
    $this->email->subject('Confirmación de registro');
    $this->email->message('
      <p><img src="'.base_url().'public/img/headerMail.jpg"></p>
      Gracias por registrarse <strong>'.$data_persona['nombres'].' </strong> , haga click en el siguiente enlace para activar su cuenta <a href="'.base_url().'inicio/activacion/'.$id_persona.'/'.md5($data_persona['email']).'">Confirmar</a>
      <br><p>Atentamente:</p>
      <p>IDTGB EN LÍNEA</p>
      ');
    $this->email->send();
    redirect(base_url().'inicio/registro_info/'.str_replace('@', 'arroba', $data_persona['email']));
  }//fin registro

  public function registro_info($email)
  {
    $data['email'] = str_replace('arroba', '@', $email);
    $data['main_content'] = 'inicio/registro_info_view';
    $data['title'] = 'Registro';
    $this->load->view('template/template_view', $data);
  }

  public function activacion($id_persona, $hash)
  {
    $this->load->model('empleado_model');
    $usuario = $this->empleado_model->get_usuario($id_persona);//sacamos los datos de la tabla usuario
    if(md5($usuario['usuario']) == $hash)
    {
      $data['estado'] = '1';
      $this->empleado_model->actualizar_usuario($id_persona, $data);//actualizamos la tabla habilitando al usuario
      $usuario = $this->empleado_model->get_usuario($id_persona);//nuevamente sacamos los datos de la tabla usuario
      $session = array(
          'id_persona' => $usuario['id_persona'],
          'usuario' => $usuario['usuario'],
          'nivel' => $usuario['nivel'],
          'estado' => $usuario['estado']
        );
      $this->session->set_userdata($session);//asignamos sesion
      redirect(base_url());
     }
    else
      echo "error de registro";
  }//fin funcion

  public function tutorial_idtgb()
  {
    $data['main_content'] = 'inicio/tutorial_idtgb_enlinea_view';
    $data['title'] = 'Tutorial';
    $this->load->view('template/template_view', $data);
  }

  public function tutorial_idtgb2()
  {
    $data['main_content'] = 'inicio/tutorial_idtgb_enlinea2_view';
    $data['title'] = 'Tutorial';
    $this->load->view('template/template_view', $data);
  }
  public function tutorial_idtgb3()
  {
    $data['main_content'] = 'inicio/tutorial_idtgb_enlinea3_view';
    $data['title'] = 'Tutorial';
    $this->load->view('template/template_view', $data);
  }


  public function actualizar_password()
  {
    if(isLogin())
    {
      $this->load->model('empleado_model');
      $usuario = $this->empleado_model->get_usuario($this->session->userdata('id_persona'));
      if($usuario['password']==md5($this->input->post('pass_viejo')))
        {
          $data_update['password']=md5($this->input->post('password2'));
          $this->empleado_model->actualizar_usuario($this->session->userdata('id_persona'), $data_update);
          echo '<p>Contraseña actualizada correctamente.</p>';
        }
      else
          echo '<p>La actual contraseña no es valida.</p>';

    }
    else
    {
      $data['main_content'] = 'inicio/index_view';
      $data['title'] = 'Inicio';
      $this->load->view('template/template_view', $data);
    }
  }//fin funcion

  public function forgot()
  {
    $this->load->model('empleado_model');
    //$persona = $this->empleado_model->buscar_email($email)==
    if($this->empleado_model->buscar_email($this->input->post('email_forgot')) )
    {
      $this->load->library('email');
      $config['protocol'] = 'smtp';
      $config["smtp_host"] = $this->config->item('smtp_host');
      $config["smtp_user"] = $this->config->item('smtp_user');
      $config["smtp_pass"] = $this->config->item('smtp_pass');
      $config["smtp_port"] = $this->config->item('smtp_port');
      $config["mailtype"] = 'html';
      $config['charset'] = 'utf-8';
      $config['wordwrap'] = true;
      $config['validate'] = true;
      $config['newline'] = "\r\n";

      $this->email->initialize($config);
      $this->email->from($this->config->item('smtp_user'), $this->config->item('producto'));
      $this->email->to($this->input->post('email_forgot'));
      $this->email->subject('Restablecer contraseña');
      $this->email->message('Haga click en el siguiente enlace para establecer una contraseña nueva: <a href="'.base_url().'inicio/restablecer/'.$this->security->get_csrf_hash().'/'.md5($this->input->post('email_forgot')).'">Nueva contraseña</a>');
      $this->email->send();
      redirect(base_url().'inicio/registro_info/'.str_replace('@', 'arroba', $this->input->post('email_forgot')));
    }
    else
      echo "no existe";
    //$this->empleado_model->insertar_usuario($data_usuario);
  }//fin registro

  public function restablecer($hash, $hash_mail)
  {
    if($hash==$this->security->get_csrf_hash())
    {
      $data['hash_mail'] = $hash_mail;
      $data['main_content'] = 'inicio/restablecer_view';
      $data['title'] = 'Restablecer contraseña';
      $this->load->view('template/template_view', $data);
    }
    else
      echo "error";
  }

  public function actualizar_restablecer($hash_mail)
  {
    $this->load->model('empleado_model');
    $usuario = $this->empleado_model->buscar_hash_mail($hash_mail);
    $data['password'] = md5($this->input->post('password'));
    $this->empleado_model->actualizar_usuario($usuario['id_persona'], $data);

    $session = array(
        'id_persona' => $usuario['id_persona'],
        'usuario' => $usuario['usuario'],
        'nivel' => $usuario['nivel'],
        'estado' => $usuario['estado']
      );
    $this->session->set_userdata($session);
    redirect(base_url());
  }
}//fin class
