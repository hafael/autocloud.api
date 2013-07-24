<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	/**
	 * Funções Genéricas Reunidas para diversos Sistemas
	 * @autor Thiago Toledo
	 * @since 12-08-2008
	 * @version 1.0
	 * */
	class FUNCOES{
		
		/**
		 * Estas variáveis guardam dados gerados pelo método exibeData
		 * */
		var $dt_dia;
		var $dt_mes;
		var $dt_ano;
		var $hora;
		var $minutos;
		var $segundos;
		var $classedaVez;
		var $caracterSeparadorData;
		
		var $classeDaVez;
		
		function FUNCOES() {
			
			$this->classedaVez = 1;
			$this->caracterSeparadorData = "/";
			
		}
		/**
		 * Mostra uma data em formato dd/mm/aaaa que vem do banco como aaaa-mm-dd
		 * @author Thiago Toledo
		 * @since 12-08-2008
		 * @param string $stringDeData
		 * @return string
		 * */
		function exibeData($stringDeData){
			
			if($stringDeData != ""){
			
				$array_da_data = array();
				$array_da_data = explode("-",$stringDeData);
				
				$this->dt_dia = $array_da_data[2];
				$this->dt_ano = $array_da_data[0];
				$this->dt_mes = $array_da_data[1];
				
				return $this->dt_dia.$this->caracterSeparadorData.$this->dt_mes.$this->caracterSeparadorData.$this->dt_ano;
				
			}else{
				return "";
			}
		}
		
		/**
		 * Mostra uma data em formato dd/mm/aaaa que vem do banco como aaaa-mm-dd
		 * @author Thiago Toledo
		 * @since 12-08-2008
		 * @param string $stringDeData
		 * @return string
		 * */
		function exibeDataPadraoSemAno($stringDeData){
			
			$array_da_data = array();
			
			if($stringDeData != ""){
			
				$array_da_data = explode("/",$stringDeData);
				
				$this->dt_dia = $array_da_data[0];
				$this->dt_mes = $array_da_data[1];
				
				return $this->dt_dia.$this->caracterSeparadorData.$this->dt_mes;
				
			}else{
				return "";
			}
		}
		
		/**
		 * 
		 *@author  Thiago Toledo
		 * Exibe a data no formato do arquivo de retorno CNAB 400 de cobrança de boletos
		 * para o formato Mysql, possibilitando a importação de dados para o banco
		 *  
		 * */
		
		function exibeDataRetornoBoletoParaMysql($stringDeData){
			
			if($stringDeData != ""){
				
				$this->dt_dia = substr($stringDeData,0,2);
				$this->dt_ano = "20".substr($stringDeData,4,2); // numeração a partir do 2000
				$this->dt_mes = substr($stringDeData,2,2);
				
				return $this->dt_ano."-".$this->dt_mes."-".$this->dt_dia;
				
			}else{
				return "";
			}
		}
		
		function exibeDataHora($stringDeData){
			
			if($stringDeData != ""){
		
				$array_de_pastes = explode(" ",$stringDeData);
				$array_de_horas = explode(":",$array_de_pastes[1]);
				
				$this->hora = $array_de_horas[0];
				$this->minuto = $array_de_horas[1];
				$this->segundos = $array_de_horas[2];
				
				$this->exibeData($array_de_pastes[0]);
				return $this->dt_dia.$this->caracterSeparadorData.$this->dt_mes.$this->caracterSeparadorData.$this->dt_ano." ".$array_de_pastes[1];
			
			}else{
				return "";
			}
		}
		
		
		function exibeValorMoeda($valorMoeda){
			return number_format($valorMoeda, 2, ',', '');
		}
		
		
		/**
		 * 
		 *@author  Thiago Toledo
		 * Exibe o valor no formato do arquivo de retorno CNAB 400 de cobrança de boletos
		 * para o formato Mysql Float ou Varchar (separado por pontos), possibilitando a importação de dados para o banco
		 *  
		 * */
		function exibeValorMoedaRetornoBoletoParaMysql($valorMoeda){
			return (float)substr($valorMoeda,0,11).".".substr($valorMoeda,11,2);
		}
		
		/**
		 * Como no banco tá registrado data em anexo com  a hora e a hora é mostrada totalmente zerada
		 * O "exibeDataSemHora" inibide a hora e mostra somente a data no formato  dd/mm/aaaa
		 * @author Thiago Toledo
		 * @param string $stringDeData
		 * 
		 * */
		function exibeDataSemHora($stringDeData){
			if($stringDeData != ""){
				$array_de_pastes = explode(" ",$stringDeData);
				$this->exibeData($array_de_pastes[0]);
				return $this->dt_dia.$this->caracterSeparadorData.$this->dt_mes.$this->caracterSeparadorData.$this->dt_ano;
			}else{
				return "";
			}
		}
		
		function exibeDataMySQL($stringDeData){
			
			//var_dump($stringDeData);
			
			if($stringDeData != ""){
				
				$array_da_data = array();
				$array_da_data = explode($this->caracterSeparadorData,$stringDeData);
				
				//var_dump($array_da_data);
				
				$this->dt_dia = trim($array_da_data[0]);
				$this->dt_ano = trim($array_da_data[2]);
				$this->dt_mes = trim($array_da_data[1]);
				
				return $this->dt_ano."-".$this->dt_mes."-".$this->dt_dia;
			
			}
			
			return "";
		}
		
		function exibeDataHoraMySQL($stringDeData){
			
			$array_da_data = array();
			$array_da_data_hora = array();
			
			$array_da_data_hora = explode(" ",$stringDeData);
			$array_da_data = explode($this->caracterSeparadorData,$array_da_data_hora[0]);
			
			$this->dt_dia = trim($array_da_data[0]);
			$this->dt_ano = trim($array_da_data[2]);
			$this->dt_mes = trim($array_da_data[1]);
			
			return $this->dt_ano."-".$this->dt_mes."-".$this->dt_dia." ".$array_da_data_hora[1];
			
		}
		
		/**
		 * Limita o número de caracteres
		 * @author Thiago Toledo
		 * @since 12-08-2008
		 * @param string $stringTestada
		 * @param  string $qtdCaracteres
		 * 
		 * */
		function limitaSaidaTexto($stringTestada,$qtdCaracteres){
			
			if(strlen($stringTestada) > $qtdCaracteres){
				return substr($stringTestada,0,$qtdCaracteres)."...";
			}else{
				return $stringTestada;
			}

		}
		
		/**
		 * Elimina as tags "" e ' 
		 *
		 * @param string $stringToolTip
		 * @return string
		 */
		function toolTipTexto($stringToolTip){
			
			$stringToolTip = str_replace("\"","",$stringToolTip);
			$stringToolTip = str_replace("\'","",$stringToolTip);
			return $stringToolTip;
			
		}
		
		/**
		 * Faz a troca das classes dentro de uma div ou tb 
		 * @author Thiago Toledo
		 * @param string $nomeClasseCss1
		 * @param string $nomeClasseCss2  
		 * 
		 * */
		function revezaClasseCss($nomeClasseCss1,$nomeClasseCss2){
			
			if(!isSet($this->classedaVez)){
				$this->classeDaVez = 1;
			}
			
			if($this->classeDaVez == 1){
				$this->classeDaVez = 2;
				return $nomeClasseCss1;
			}else{
				$this->classeDaVez = 1;
				return $nomeClasseCss2;
			}
			
		}
		
		function calculaPorcentagem($num){
			
			$resultado = $num/100;

			return $resultado;
		}
		
		function retornaDataAtual(){
			return date("Y-m-d");
		}
		function retornaDataMesAnterior(){
			$dia = date("d");
			
			$ano = date("Y");
			
			if (date("m") == 1){
				$mes = '12';
			}else {
				$mes = date("m") - 1;
			}
			$data = $ano.'-'.$mes.'-'.$dia ;
			
			return $data;
			
		}
		function mostraEmValor($valor,$casasDecimaisDepoisDaVirgula=false){
			
			$valor_obj = "";
			$valor_obj = strstr($valor,".");
			if ($valor_obj != ""){
				if ($casasDecimaisDepoisDaVirgula !== false){
					$valor = round($valor, $casasDecimaisDepoisDaVirgula);			
				}

				$valor_real = str_replace(".",",",$valor);
				
			}else {
				$valor_real = $valor . ",00";
			}
			
			return $valor_real;
			
		}	
		
		function mostraEmValorBanco($valor,$casasDecimaisDepoisDaVirgula=false){
			
			$valor_obj = "";
			$valor_obj = strstr($valor,",");
			if ($valor_obj != ""){
				if ($casasDecimaisDepoisDaVirgula !== false){
					$valor = round($valor, $casasDecimaisDepoisDaVirgula);			
				}

				$valor_real = str_replace(",",".",$valor);
				return $valor_real;
			}
			
			return $valor;
			
		}		
		
		
		function pesquisaNoArray($array_valores,$valor){
	 
			$sql	= "";
			$cont_array		= sizeof($array_valores);
			$cont	= 1;
			foreach ($array_valores as $valores){
				
				if ($valores == $valor){
					return $valores;		
				}
			}
			
			return $array_valores;
		}
		
		function verificaValorGET($arquivoFisico,$GET,$nome_pagina){
		
			if(isset($GET)){
			
			$verifica = $arquivoFisico->define((int)$GET);
			
				if($verifica === false){
				
					header("Location: ".$nome_pagina.".php");
				}
			}
		}
		
		function diasDoMes($mes, $ano,$meses=false) {
			
			$array_de_meses = array();
			$array_de_semana = array();
				
			for($i=1;$i<=7;$i++){
					
				$array_de_semana[] = date( "N", mktime( 0, 0, 0, $mes, $i, $ano) );
				
				 $primeira_semana = $array_de_semana[0];
			}
			
			for ($i=1;$i<=$primeira_semana;$i++){	
				
				if($primeira_semana < 7){
				 
					$array_de_meses[] = 0;
				}
			 }
			
			for ($i=1;$i<=date( "t", mktime( 0, 0, 0, $mes, 1, $ano) );$i++){
				
					$array_de_meses[] = $i;
			}

			return $array_de_meses;
		}
		
		function nomeDosMeses($mes,$ano){
				
			$meses = array("Janeiro","Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto"
			,"Setembro"
			,"Outubro"
			,"Novembro"
			,"Dezembro");
				
			 date( "n", mktime( 0, 0, 0, $mes, 1, $ano));
					
				$nome_mes = $meses[$mes];
					
				return $nome_mes;
			}
		
		function formaDataMesAbrev($data) {
			
			$meses = array("Jan","Fev","Mar",
						   "Abr","Mai","Jun",
						   "Jul","Ago","Set",
						   "Out","Nov","Dez");
			
			$data_formatada = "<span class='dia'>".date('d',strtotime($data))."</span><span class='mes'>";
			$data_formatada .= $meses[date('n',strtotime($data))-1]."</span>";
			
			return $data_formatada;
			
		}
		
		function formaMesAbrev($mes) {
			
			$meses = array(
			1 => "Jan",
			2 => "Fev",
			3 => "Mar",
			4 => "Abr",
			5 => "Mai",
			6 => "Jun",
			7 => "Jul",
			8 => "Ago",
			9 => "Set",
			10 => "Out",
			11 => "Nov",
			12 => "Dez"
			);
			
			return $meses[(int)$mes];
			
		}
			
		function exibeHorario($string_horario){
			
			$array_de_horario = array();
			$array_de_horario = explode(":",$string_horario);
			
			$this->hora = $array_de_horario[0];
			$this->minutos = $array_de_horario[1];
			$this->segundos = $array_de_horario[2];
			
			return $this->hora.":".$this->minutos.":".$this->segundos;
		}
		
		//Recebe em formato dd/mm/yyyy e retorna a data somada
		
		function SomarData($data, $dias, $meses, $ano){
		   $data = explode("/", $data);
		   $newData = date("d/m/Y", mktime(0, 0, 0, $data[1] + $meses, $data[0] + $dias, $data[2] + $ano) );
		   return $newData;
		}

		
		//Função utilizada para implantação de novos usuários
		function criaSenhaParaLogin($login){
			return substr(strrev(md5($login)),0,6);
		}
	}

	/**
	 * @example 
	 * $funcoes = new FUNCOES();
	 * var_dump($funcoes->exibeData("2001-03-04"));
	 *
	 * */ 
	
?>