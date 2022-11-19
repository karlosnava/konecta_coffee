<?php

class Helpers
{
		public function dateLatam($fecha) {
		$fecha = substr($fecha, 0, 10);
		$numeroDia = date('d', strtotime($fecha));
		$dia = date('l', strtotime($fecha));
		$mes = date('F', strtotime($fecha));
		$anio = date('Y', strtotime($fecha));
		$dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
		$dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
		$nombredia = str_replace($dias_EN, $dias_ES, $dia);
		$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		$meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		$nombreMes = str_replace($meses_EN, $meses_ES, $mes);
		return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
	}

	public function time_passed($get_timestamp)
	{
	   $timestamp = strtotime($get_timestamp);
	   $strTime = array("segundo", "minuto", "hora", "día", "mes", "año");
	   $length = array("60","60","24","30","12","10");

	   $currentTime = time();
	    if($currentTime >= $timestamp) {
			$diff = time() - $timestamp;
			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
				$diff = $diff / $length[$i];
			}
			$diff = round($diff);
			if ($diff == 1) { return "Hace " .$diff . " " . $strTime[$i]; }
			else{ return "Hace " .$diff . " " . $strTime[$i] . "s"; }
	    }
	}
}