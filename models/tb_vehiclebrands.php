<?php 

	class Tb_vehiclebrands extends CI_Model {

		

		/* Campos */
		var $id;
		var $TipoVeiculo;
		var $Chave;
		var $Nome;

		var $nome_tabela;
		var $data_base_object;
		var $config_database;

		function Tb_vehiclebrands($config_database = "autocloudv2"){
	    	
	        parent::__construct();

	        
	        $this->nome_tabela = "TB_FabricanteVeiculo";
	        $this->data_base_object = null;
	        $this->config_database = $config_database;
	        
	        
	    }
	    
	    function getBrandsByType($tipo_veiculo) {
	        //load database
			$this->data_base_object = $this->load->database($this->config_database,true);

			//cria consulta
			$this->data_base_object->where('TipoVeiculo = ', $tipo_veiculo);

			//executa query
			$query = $this->data_base_object->get_where($this->nome_tabela); 

			foreach ($query->result() as $row){
				
				$array_objetos['id'] = (int)$row->Chave;
				$array_objetos['brandtype'] = (int)$row->TipoVeiculo;
				$array_objetos['name'] = $row->Nome;

				$object[] = $array_objetos;

			}
			return $object;
	    }



	    
		

	}

?>