<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('datetime_to_mysql'))
{
	function datetime_to_mysql($fecha)
	{
		$salida = substr($fecha, 6,4)."-".substr($fecha, 3,2)."-".substr($fecha, 0,2);
		return $salida;
	}
}

// ------------------------------------------------------------------------
if ( ! function_exists('datetime_to_es'))
{
	//2015-04-25 01:42:46
	function datetime_to_es($fecha)
	{
		$salida = substr($fecha, 8,2)."/".substr($fecha, 5,2)."/".substr($fecha, 0,4)." ".substr($fecha, 11,8);
		return $salida;
	}
}

// ------------------------------------------------------------------------
if ( ! function_exists('ultimas_fechas'))
{
	function ultimas_fechas()
	{
		$CI =& get_instance();
	  $CI->load->model('ufv_model');

		$salida='<script> var fechas = new Array(); ';

		for ($anio=2001;$anio<=Date('Y');$anio++)
		{
			$ultimo_dia_año = new DateTime(($anio-1).'-12');
			$ultimo_dia_año->modify('last day of this month');
			$ufv_ultimo_anio = $CI->ufv_model->get_ufv($ultimo_dia_año->format('Y-m-d'));
			if(!is_null($ufv_ultimo_anio['fecha']))
			{
				$ultimos_ufvs[substr($ufv_ultimo_anio['fecha'],0,4)] = $ufv_ultimo_anio['ufv'];
				$salida.='fechas['.substr($ufv_ultimo_anio['fecha'],0,4).'] = '.$ufv_ultimo_anio['ufv'].';';
			}
		}
		$salida.='</script>';
		return $salida;
	}
}

// ------------------------------------------------------------------------
if ( ! function_exists('dia_habil'))
{
	//2015-04-25 01:42:46
	function dia_habil($feriados, $nuevafecha)
	{
        foreach ($feriados as $key => $value)
        {
          $dia=date('Y').'-'.$value['mes'].'-'.$value['dia'];
          if($dia==$nuevafecha)//esta en feriado
          {
            $nuevafecha = strtotime('+1 day', strtotime($nuevafecha));//+ 1 dia
            $nuevafecha = date('Y-m-d', $nuevafecha );//to date
          }
        }
        //si es sabado
        if(date('w',strtotime($nuevafecha))=='6')
          {
            $nuevafecha = strtotime('+1 day', strtotime($nuevafecha));//+ 1 dia
            $nuevafecha = date('Y-m-d', $nuevafecha );//to date
          }

        $domingo_feriado=false;
        //si es domingo
        if(date('w',strtotime($nuevafecha))=='0')
        {
          foreach ($feriados as $key => $value)
          {
            $dia=date('Y').'-'.$value['mes'].'-'.$value['dia'];
            if($dia==$nuevafecha)//esta en feriado
              $domingo_feriado=true;
          }
          if($domingo_feriado)
          {
            $nuevafecha = strtotime('+2 day', strtotime($nuevafecha));//+ 2 dia
            $nuevafecha = date('Y-m-d', $nuevafecha );//to date
          }
          else
          {
            $nuevafecha = strtotime('+1 day', strtotime($nuevafecha));//+ 1 dia
            $nuevafecha = date('Y-m-d', $nuevafecha );//to date
          }
        }
        return $nuevafecha;
	}
}

// ------------------------------------------------------------------------
