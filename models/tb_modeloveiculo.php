<?php 

	class TB_ModeloVeiculo extends CI_Model {

		

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

		function TB_ModeloVeiculo($config_database = "autocloudv2"){
	    	
	        parent::__construct();

	        
	        $this->nome_tabela = "TB_ModeloVeiculo";
	        $this->data_base_object = null;
	        $this->config_database = $config_database;
	        
	        
	    }

	    function define($id, $retornaObjetoDeDados = false){

	    	if(is_array($id)){
				
				$this->id = $id['id'];
				$this->TipoVeiculo = $id['TipoVeiculo'];
				$this->TB_FabricanteVeiculo_Chave = $id['TB_FabricanteVeiculo_Chave'];
				$this->Chave = $id['Chave'];
				$this->TB_FabricanteVeiculo_Nome = $id['TB_FabricanteVeiculo_Nome'];
				$this->nome = $id['Nome'];
								
				return true;
				
			}else if(is_object($id)){
				
				$this->id = $id->id;
				$this->TipoVeiculo = $id->TipoVeiculo;
				$this->TB_FabricanteVeiculo_Chave = $id->TB_FabricanteVeiculo_Chave;
				$this->Chave = $id->Chave;
				$this->TB_FabricanteVeiculo_Nome = $id->TB_FabricanteVeiculo_Nome;
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
					    $this->nome = $row->Nome;
				    
					}
				}
						
				return true;
			}

			return false;

	    }


	    # VERIFICA SE O USUÁRIO ESTÁ LOGADO
	    function lista($tipo_veiculo, $id_fabricante) {
	        //load database
			$this->data_base_object = $this->load->database($this->config_database,true);

			//cria consulta
			$this->data_base_object->where('TipoVeiculo = ', $tipo_veiculo);
			$this->data_base_object->where('TB_FabricanteVeiculo_Chave = ', $id_fabricante);

			//executa query
			$query = $this->data_base_object->get_where($this->nome_tabela);

			foreach ($query->result() as $row){
				$array_objetos[] = $row;
			}
			return $array_objetos;
	    }



	}

?>