<?php 

	class TB_ImagensAnuncio extends CI_Model {

		

		/* Campos */
		var $id;
		var $TB_Anunciante_id;
		var $TB_Anuncio_id;
		var $IndexList;
		var $ImageSRC;

		var $nome_tabela;
		var $data_base_object;
		var $config_database;
		var $array_objetos;

		function TB_ImagensAnuncio($config_database = "autocloudv2"){
	    	
	        parent::__construct();

	        
	        $this->nome_tabela = "TB_ImagensAnuncio";
	        $this->data_base_object = null;
	        $this->config_database = $config_database;
	        
	        
	    }

	    function define($id, $retornaObjetoDeDados = false){

	    	if(is_array($id)){
				
				$this->id = $id['id'];
				$this->TB_Anunciante_id = $id['TB_Anunciante_id'];
				$this->TB_Anuncio_id = $id['TB_Anuncio_id'];
				$this->IndexList = $id['IndexList'];
				$this->ImageSRC = $id['ImageSRC'];
								
				return true;
				
			}else if(is_object($id)){
				
				$this->id = $id->id;
				$this->TB_Anunciante_id = $id->TB_Anunciante_id;
				$this->TB_Anuncio_id = $id->TB_Anuncio_id;
				$this->IndexList = $id->IndexList;
				$this->ImageSRC = $id->ImageSRC;
							
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
					    $this->TB_Anunciante_id = $row->TB_Anunciante_id;
					    $this->TB_Anuncio_id = $row->TB_Anuncio_id;
					    $this->IndexList = $row->IndexList;
					    $this->ImageSRC = $row->ImageSRC;
				    
					}
				}
						
				return true;
			}

			return false;

	    }


	    function lista($id_anunciante, $id_anuncio) {
	        //load database
			$this->data_base_object = $this->load->database($this->config_database,true);

			//cria consulta
			$this->data_base_object->where('TB_Anunciante_id', $id_anunciante);
			$this->data_base_object->where('TB_Anuncio_id', $id_anuncio);
			$this->data_base_object->order_by('id', 'desc');
			$this->data_base_object->order_by('IndexList', 'desc');
			$this->data_base_object->limit(6);


			//executa query
			$query = $this->data_base_object->get_where($this->nome_tabela);

			foreach ($query->result() as $row){
				$array_objetos[] = $row;
			}

			if($query->num_rows()<1){
				return false;
			}else{
				return $array_objetos;
			}
			
	    }

	    function mostra($id_anunciante, $id_anuncio, $indexlist) {
	        //load database
			$this->data_base_object = $this->load->database($this->config_database,true);

			//cria consulta
			$this->data_base_object->where('TB_Anunciante_id', $id_anunciante);
			$this->data_base_object->where('TB_Anuncio_id', $id_anuncio);
			$this->data_base_object->where('IndexList', $indexlist);
			$this->data_base_object->limit(1);


			//executa query
			$query = $this->data_base_object->get_where($this->nome_tabela);

			foreach ($query->result() as $row){
				//$array_objetos[] = $row;
				echo $row->ImageSRC;
			}
			return $query;
	    }

	    function adiciona($array_dados){
    		//load database
			$this->data_base_object = $this->load->database($this->config_database,true);
			
			//cria consulta
			$this->data_base_object->insert($this->nome_tabela, $array_dados);
			
			//Define o objeto com o last id do banco	
			$this->define((int)$this->data_base_object->insert_id());
			
			return (int)$this->data_base_object->insert_id();
	
	    }
		

	}

?>