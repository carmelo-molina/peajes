<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('menu'))
{
	function menu()
	{
    $salida='';
    $CI =& get_instance();

    if($CI->session->userdata('nivel')==1)
    {
      $salida.='
      ';
    }

    if($CI->session->userdata('nivel')==2)
    {
      $salida.='
        <li class="pure-menu-item"><a href="'.base_url().'admin/" class="pure-menu-link" type="submit">ADMIN</a></li>
      ';
    }

		if(($CI->session->userdata('nivel')!=null) &&  ($CI->session->userdata('estado')!=0) )
    {
      $salida.='
        <li class="pure-menu-item"><a href="'.base_url().'inicio/logout/'.$CI->security->get_csrf_hash().'" class="pure-menu-link" type="submit">SALIR</a></li>
      ';
    }

    $salida.='
    ';
      echo $salida;
	}
}
// ------------------------------------------------------------------------
if (!function_exists('isLogin'))
{
  function isLogin()
  {
    $CI =& get_instance();
    if(($CI->session->userdata('nivel')!=null) &&  ($CI->session->userdata('estado')!=0) )
      return true;
  }
}
// ------------------------------------------------------------------------
if ( ! function_exists('isAdmin'))
{
  function isAdmin()
  {
    $CI =& get_instance();
    if($CI->session->userdata('nivel')==2)
      return true;
  }
}
// ------------------------------------------------------------------------
