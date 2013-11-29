<?php 

	class Tb_states extends CI_Model {

		/* Campos */
		var $id;
		var $Uf;
		var $Nome;

		var $nome_tabela;
		var $data_base_object;
		var $config_database;
		var $array_objetos;

		function Tb_states($config_database = "autocloudv2"){
	    	
	        parent::__construct();

	        
	        $this->nome_tabela = "TB_Estados";
	        $this->data_base_object = null;
	        $this->config_database = $config_database;
	        
	        
	    }

	    function getStates() {
	        //load database
			$this->data_base_object = $this->load->database($this->config_database,true);

			//executa query
			$query = $this->data_base_object->get($this->nome_tabela);

			foreach ($query->result() as $row){

				$array_objetos['id'] = (int)$row->id;
				$array_objetos['name'] = $row->Nome;
				$array_objetos['acronym'] = $row->Uf;
				$array_objetos['country'] = 'Brasil';

				$object[] = $array_objetos;

			}
			return $object;
	    }

	    function get_state_by_id($id) {
	        //load database
			$this->data_base_object = $this->load->database($this->config_database,true);

			//cria consulta
			$this->data_base_object->where('id = ', $id);
			$this->data_base_object->order_by('Nome', 'asc');

			//executa query
			$query = $this->data_base_object->get_where($this->nome_tabela);

			foreach ($query->result() as $row){
				$array_objetos['id'] = (int)$row->id;
				$array_objetos['name'] = $row->Nome;
				$array_objetos['acronym'] = $row->Uf;
				$array_objetos['country'] = 'Brasil';
			}
			return $array_objetos;
	    }
		

	}

?>