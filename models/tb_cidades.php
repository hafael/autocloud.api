<?php 

	class TB_Cidades extends CI_Model {

		

		/* Campos */
		var $id;
		var $TB_Estado_id;
		var $Uf;
		var $Nome;

		var $nome_tabela;
		var $data_base_object;
		var $config_database;
		var $array_objetos;

		function TB_Cidades($config_database = "autocloudv2"){
	    	
	        parent::__construct();

	        
	        $this->nome_tabela = "TB_Cidades";
	        $this->data_base_object = null;
	        $this->config_database = $config_database;
	        
	        
	    }

	    function define($id, $retornaObjetoDeDados = false){

	    	if(is_array($id)){
				
				$this->id = $id['id'];
				$this->TB_Estado_id = $id['TB_Estado_id'];
				$this->Uf = $id['Uf'];
				$this->Nome = $id['Nome'];
								
				return true;
				
			}else if(is_object($id)){
				
				$this->id = $id->id;
				$this->TB_Estado_id = $id->TB_Estado_id;
				$this->Uf = $id->Uf;
				$this->Nome = $id->Nome;
							
				return true;

			}else{
				
				//load database
				$this->data_base_object = $this->load->database($this->config_database,true);
				
				//cria consultas
				$query = $this->data_base_object->get_where($this->nome_tabela, array('id' => $id));
				
				foreach ($query->result() as $row){
				    
					if($retornaObjetoDeDados === true){
						
						return $row;
						
					}else{
					
						$this->id = $row->id;
					    $this->TB_Estado_id = $row->TB_Estado_id;
					    $this->Uf = $row->Uf;
					    $this->Nome = $row->Nome;
				    
					}
				}
						
				return true;
			}

			return false;

	    }


	    function lista($id_estado) {
	        //load database
			$this->data_base_object = $this->load->database($this->config_database,true);

			//cria consulta
			$this->data_base_object->where('TB_Estado_id = ', $id_estado);
			$this->data_base_object->order_by('Nome', 'asc');

			//executa query
			$query = $this->data_base_object->get_where($this->nome_tabela);

			foreach ($query->result() as $row){
				$array_objetos[] = $row;
			}
			return $array_objetos;
	    }
		

	}

?>