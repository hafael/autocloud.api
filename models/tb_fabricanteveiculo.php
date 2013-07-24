<?php 

	class TB_FabricanteVeiculo extends CI_Model {

		

		/* Campos */
		var $id;
		var $TipoVeiculo;
		var $nome;

		var $nome_tabela;
		var $data_base_object;
		var $config_database;

		function TB_FabricanteVeiculo($config_database = "autocloudv2"){
	    	
	        parent::__construct();

	        
	        $this->nome_tabela = "TB_FabricanteVeiculo";
	        $this->data_base_object = null;
	        $this->config_database = $config_database;
	        
	        
	    }

	    function define($id, $retornaObjetoDeDados = false){

	    	if(is_array($id)){
				
				$this->id = $id['id'];
				$this->TipoVeiculo = $id['TipoVeiculo'];
				$this->nome = $id['Nome'];
								
				return true;
				
			}else if(is_object($id)){
				
				$this->id = $id->id;
				$this->TipoVeiculo = $id->TipoVeiculo;
				$this->nome = $id->Nome;
							
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
						$this->TipoVeiculo = $row->TipoVeiculo;
					    $this->nome = $row->Nome;
				    
					}
				}
						
				return true;
			}

			return false;

	    }
	    

	    # VERIFICA SE O USUÁRIO ESTÁ LOGADO
	    function lista($tipo_veiculo) {
	        //load database
			$this->data_base_object = $this->load->database($this->config_database,true);

			//cria consulta
			$this->data_base_object->where('TipoVeiculo = ', $tipo_veiculo);

			//executa query
			$query = $this->data_base_object->get_where($this->nome_tabela); 

			foreach ($query->result() as $row){
				$array_objetos[] = $row;
			}
			return $array_objetos;
	    }



	    
		

	}

?>