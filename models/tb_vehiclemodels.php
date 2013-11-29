<?php 

	class Tb_vehiclemodels extends CI_Model {

		

		/* Campos */
		var $id;
		var $TipoVeiculo;
		var $TB_FabricanteVeiculo_Chave;
		var $Chave;
		var $TB_FabricanteVeiculo_Nome;
		var $Nome;

		var $nome_tabela;
		var $data_base_object;
		var $config_database;
		var $array_objetos;

		function Tb_vehiclemodels($config_database = "autocloudv2"){
	    	
	        parent::__construct();

	        
	        $this->nome_tabela = "TB_ModeloVeiculo";
	        $this->data_base_object = null;
	        $this->config_database = $config_database;
	        
	        
	    }

	    function getModelsByBrandKey($id_fabricante, $tipo_veiculo) {
	        //load database
			$this->data_base_object = $this->load->database($this->config_database,true);

			//cria consulta
			$this->data_base_object->where('TipoVeiculo = ', $tipo_veiculo);
			$this->data_base_object->where('TB_FabricanteVeiculo_Chave = ', $id_fabricante);

			//executa query
			$query = $this->data_base_object->get_where($this->nome_tabela);

			foreach ($query->result() as $row){
				
				$array_objetos['id'] = (int)$row->Chave;
				$array_objetos['vehicletype'] = (int)$row->TipoVeiculo;
				$array_objetos['name'] = $row->Nome;
				$array_objetos['brand']['id'] = $row->TB_FabricanteVeiculo_Chave;
				$array_objetos['brand']['name'] = $row->TB_FabricanteVeiculo_Nome;

				$object[] = $array_objetos;

			}
			return $object;
	    }



	}

?>