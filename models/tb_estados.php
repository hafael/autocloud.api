<?php 

	class TB_Estados extends CI_Model {

		

		/* Campos */
		var $id;
		var $Uf;
		var $Nome;

		var $nome_tabela;
		var $data_base_object;
		var $config_database;
		var $array_objetos;

		function TB_Estados($config_database = "autocloudv2"){
	    	
	        parent::__construct();

	        
	        $this->nome_tabela = "TB_Estados";
	        $this->data_base_object = null;
	        $this->config_database = $config_database;
	        
	        
	    }

	    function define($id, $retornaObjetoDeDados = false){

	    	if(is_array($id)){
				
				$this->id = $id['id'];
				$this->Uf = $id['Uf'];
				$this->Nome = $id['Nome'];
								
				return true;
				
			}else if(is_object($id)){
				
				$this->id = $id->id;
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
					    $this->Uf = $row->Uf;
					    $this->Nome = $row->Nome;
				    
					}
				}
						
				return true;
			}

			return false;

	    }


	    function lista() {
	        //load database
			$this->data_base_object = $this->load->database($this->config_database,true);

			//executa query
			$query = $this->data_base_object->get($this->nome_tabela);

			foreach ($query->result() as $row){
				$array_objetos[] = $row;
			}
			return $array_objetos;
	    }
		

	}

?>