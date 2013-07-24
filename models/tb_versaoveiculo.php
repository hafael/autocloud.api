<?php 

	class TB_VersaoVeiculo extends CI_Model {

		

		/* Campos */
		var $id;
		var $nome;

		var $nome_tabela;
		var $data_base_object;
		var $config_database;
		var $array_objetos;

		function TB_VersaoVeiculo($config_database = "autocloudv2"){
	    	
	        parent::__construct();

	        
	        $this->nome_tabela = "TB_VersaoVeiculo";
	        $this->data_base_object = null;
	        $this->config_database = $config_database;
	        
	        
	    }

	    function define($id, $retornaObjetoDeDados = false){

	    	if(is_array($id)){
				
				$this->id = $id['id'];
				$this->nome = $id['Nome'];
								
				return true;
				
			}else if(is_object($id)){
				
				$this->id = $id->id;
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
	    function lista($id_ano_mod) {
	        //load database
			$this->data_base_object = $this->load->database($this->config_database,true);

			//cria consulta
			$this->data_base_object->where('TB_AnoModeloVeiculo_id = ', $id_ano_mod);

			//executa query
			$query = $this->data_base_object->get_where($this->nome_tabela);

			foreach ($query->result() as $row){
				$array_objetos[] = $row;
			}
			return $array_objetos;
	    }

	    function adiciona($array_dados){
    		//load database
			$this->data_base_object = $this->load->database($this->config_database,true);
			
			//cria consulta
			$this->data_base_object->insert($this->nome_tabela, $array_dados);
			
			//Define o objeto com o last id do banco	
			$this->define((int)$this->data_base_object->insert_id());
			
			return false;
	
	    }



	    /*
	    function vehicle_brand()
		{
			$array_objetos = array();
			$this->load->database();
		    $query = $this->db->query("SELECT * FROM TB_FabricanteVeiculo ORDER BY Nome");
		    
		    foreach ($query->result() as $row){
				$array_objetos[] = $row;
			}
			return $array_objetos;
		      
		}
		function vehicle_model($car_company_id)
		{
			$array_objetos = array();
			$this->load->database();
		    $query = $this->db->query("SELECT * FROM TB_ModeloVeiculo WHERE TB_FabricanteVeiculo_id = '".$car_company_id."' ORDER BY Nome");
		    
		    foreach ($query->result() as $row){
				$array_objetos[] = $row;
			}
			return $array_objetos;
		      
		}
		function vehicle_years_fabrication($car_model_id)
		{
			$array_objetos = array();
			$this->load->database();
		    $query = $this->db->query("SELECT * FROM TB_AnoFabricacaoVeiculo WHERE TB_ModeloVeiculo_id = '".$car_model_id."' ORDER BY Nome");
		    
		    foreach ($query->result() as $row){
				$array_objetos[] = $row;
			}
			return $array_objetos;
		      
		}
		*/
		

	}

?>