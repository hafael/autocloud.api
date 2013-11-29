<?php 

	class Tb_cities extends CI_Model {

		

		/* Campos */
		var $id;
		var $TB_Estado_id;
		var $Uf;
		var $Nome;

		var $nome_tabela;
		var $data_base_object;
		var $config_database;
		var $array_objetos;

		function Tb_cities($config_database = "autocloudv2"){
	    	
	        parent::__construct();

	        
	        $this->nome_tabela = "TB_Cidades";
	        $this->data_base_object = null;
	        $this->config_database = $config_database;
	        
	        
	    }

	    function get_city_by_id($id) {
	        //load database
			$this->data_base_object = $this->load->database($this->config_database,true);

			//cria consulta
			$this->data_base_object->where('TB_Estado_id = ', $id);
			$this->data_base_object->order_by('Nome', 'asc');

			//executa query
			$query = $this->data_base_object->get_where($this->nome_tabela);

			foreach ($query->result() as $row){
				$array_objetos['id'] = (int)$row->id;
				$array_objetos['name'] = $row->Nome;
				$array_objetos['state']['id'] = (int)$row->TB_Estado_id;
				$array_objetos['state']['acronym'] = $row->Uf;
				$array_objetos['country'] = 'Brasil';
			}
			return $array_objetos;
	    }
		

	}

?>