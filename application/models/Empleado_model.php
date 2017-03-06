<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empleado_model extends CI_Model
{
  function login($user, $pass)
  {
    $query = $this->db->query('SELECT * FROM empleado WHERE usuario=? AND password=?', array($user,$pass));
    return $query->row_array();
  }
  function get_all()
  {
    $query = $this->db->query('SELECT * FROM empleado');
    return $query->result_array();
  }
  function get_empleado($id_empleado)
  {
    $query = $this->db->query('SELECT * FROM empleado WHERE id_empleado=?',array($id_empleado));
    return $query->row_array();
  }


  function get_all_all()
  {
    $query = $this->db->query('SELECT * FROM empleado, persona WHERE usuario.id_persona=persona.id_persona');
    return $query->result_array();
  }
  function get_usuario($id_persona)
  {
    $query = $this->db->query('SELECT * FROM empleado WHERE id_persona=?', array($id_persona));
    return $query->row_array();
  }
  function get_persona($id_persona)
  {
    $query = $this->db->query('SELECT * FROM persona WHERE id_persona=?', array($id_persona));
    return $query->row_array();
  }
  function current_num()
  {
    $query = $this->db->query('SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA=DATABASE() AND   TABLE_NAME="persona" ');
    $resultado= $query->row_array();
    return $resultado['AUTO_INCREMENT'];
  }
  function insertar_persona($data)
  {
    $this->db->insert('persona',$data);
  }
  function insertar_usuario($data)
  {
    $this->db->insert('usuario',$data);
  }
  function actualizar_persona($id_persona, $data)
  {
    $this->db->where('id_persona', $id_persona);
    $this->db->update('persona', $data);
  }
  function actualizar_usuario($id_persona, $data)
  {
    $this->db->where('id_persona', $id_persona);
    $this->db->update('usuario', $data);
  }
  function eliminar($id_persona)
  {
    $this->db->where('id_persona', $id_persona);
    $this->db->delete('persona');
  }
  function buscar_id_persona($id_persona)
  {
    $query = $this->db->query('SELECT * FROM empleado WHERE id_persona=?', array($id_persona));
    $resultado = $query->result_array();
    if(count($resultado)==0)
    return false;
          else
    return true;
  }
  function buscar_email($email)
  {
    $query = $this->db->query('SELECT * FROM persona WHERE email=?', array($email));
    $resultado = $query->result_array();
    if(count($resultado)==0)
    return false;
          else
    return true;
  }

  function buscar_hash_mail($hash_mail)
  {
    $query = $this->db->query('SELECT * FROM persona, usuario WHERE usuario.id_persona=persona.id_persona AND MD5(email)=?',array($hash_mail));
    return $query->row_array();
  }

}
