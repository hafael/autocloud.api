<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	/**
	 * Funções de conversão monetária
	 * @autor Rafael Villa-Verde
	 * @since 18-07-2013
	 * @version 1.0
	 * */
	class MOEDAS{
		
		
		function bra2eua($valor){
			$valor = str_replace(".", "", "$valor");
			$valor = str_replace(",", ".", "$valor");
			return $valor;
		}

		function eua2bra($valor){
			$valor = number_format($valor, 2, ',', '.');
			return $valor;
		}


	}

	
	
?>