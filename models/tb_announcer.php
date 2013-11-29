<?php 

	class Tb_announcer extends CI_Model {

		

		/* Campos */
		var $id;
		var $TipoAnunciante;
		var $Email;
		var $TB_Estado_id;
		var $TB_Estado_Nome;
		var $TB_Cidade_id;
		var $TB_Cidade_Nome;

		var $nome_tabela;
		var $data_base_object;
		var $config_database;
		var $array_objetos;

		function Tb_announcer($config_database = "autocloudv2"){
	    	
	        parent::__construct();

	        
	        $this->nome_tabela = "TB_Anunciante";
	        $this->data_base_object = null;
	        $this->config_database = $config_database;
	        
	        
	    }

	    function get_user_by_email($email){

	    	//load database
			$this->data_base_object = $this->load->database($this->config_database,true);
			
			//cria consulta
			$this->data_base_object->where('Email = ', $email);
			$this->data_base_object->limit(1);
			
			//executa query
			$query = $this->data_base_object->get_where($this->nome_tabela); 

			if($query->num_rows()==1){
				foreach ($query->result() as $row){
					$array_objetos['id'] = (int)$row->id;
					$array_objetos['type'] = (int)$row->TipoAnunciante;
					$array_objetos['email'] = $row->Email;
				}
				return $array_objetos;
			}else{
				return false;
			}

	    }

	    function get_user_by_id($id){

	    	//load database
			$this->data_base_object = $this->load->database($this->config_database,true);
			
			//cria consulta
			$this->data_base_object->where('id = ', $id);
			$this->data_base_object->limit(1);
			
			//executa query
			$query = $this->data_base_object->get_where($this->nome_tabela); 

			if($query->num_rows()==1){
				foreach ($query->result() as $row){
					$array_objetos['id'] = (int)$row->id;
					$array_objetos['type'] = (int)$row->TipoAnunciante;
					$array_objetos['email'] = $row->Email;
				}
				return $array_objetos;
			}else{
				return false;
			}

	    }

	}

?>