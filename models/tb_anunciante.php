<?php 

	class TB_Anunciante extends CI_Model {

		

		/* Campos */
		var $id;
		var $TipoAnunciante;
		var $Email;
		var $Password;
		var $TB_Estado_id;
		var $TB_Estado_Nome;
		var $TB_Cidade_id;
		var $TB_Cidade_Nome;

		var $nome_tabela;
		var $data_base_object;
		var $config_database;
		var $array_objetos;

		function TB_Anunciante($config_database = "autocloudv2"){
	    	
	        parent::__construct();

	        
	        $this->nome_tabela = "TB_Anunciante";
	        $this->data_base_object = null;
	        $this->config_database = $config_database;
	        
	        
	    }

	    function define($id, $retornaObjetoDeDados = false){

	    	if(is_array($id)){
				
				$this->id = $id['id'];
				$this->TipoAnunciante = $id['TipoAnunciante'];
				$this->Email = $id['Email'];
				$this->Password = $id['Password'];
				$this->TB_Estado_id = $id['TB_Estado_id'];
				$this->TB_Estado_Nome = $id['TB_Estado_Nome'];
				$this->TB_Cidade_id = $id['TB_Cidade_id'];
				$this->TB_Cidade_Nome = $id['TB_Cidade_Nome'];
								
				return true;
				
			}else if(is_object($id)){
				
				$this->id = $id->id;
				$this->TipoAnunciante = $id->TipoAnunciante;
				$this->Email = $id->Email;
				$this->Password = $id->Password;
				$this->TB_Estado_id = $id->TB_Estado_id;
				$this->TB_Estado_Nome = $id->TB_Estado_Nome;
				$this->TB_Cidade_id = $id->TB_Cidade_id;
				$this->TB_Cidade_Nome = $id->TB_Cidade_Nome;
							
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
					    $this->TipoAnunciante = $row->TipoAnunciante;
					    $this->Email = $row->Email;
					    $this->Password = $row->Password;
					    $this->TB_Estado_id = $row->TB_Estado_id;
					    $this->TB_Estado_Nome = $row->TB_Estado_Nome;
					    $this->TB_Cidade_id = $row->TB_Cidade_id;
					    $this->TB_Cidade_Nome = $row->TB_Cidade_Nome;
				    
					}
				}
						
				return true;
			}

			return false;

	    }

	    function verificaEmail($email){

	    	/*
	    	$array_objetos = array();
	    	$array_objetos['status'] = 500;
			$this->load->database();
		    $query = $this->db->query("SELECT id, TipoAnunciante, Email  FROM TB_Anunciante WHERE Email = '".$email."' LIMIT 1");
		    if($query->num_rows() > 0){
		    	foreach ($query->result() as $row){
					$array_objetos['result'] = $row['id'];
					$array_objetos['result'] = $row;
					$array_objetos['status'] = 200;
				}
		    }else{
		    	$array_objetos['status'] = 400;
		    }

		    
			return $array_objetos;


			*/
			/*******************************************************/

			//load database
			$this->data_base_object = $this->load->database($this->config_database,true);
			
			//cria consulta
			$this->data_base_object->where('Email = ', $email);
			$this->data_base_object->limit(1);
			
			//executa query
			$query = $this->data_base_object->get_where($this->nome_tabela); 

			if($query->num_rows()==1){
				return true;
			}else{
				return false;
			}

	    }

	    function _adiciona($array_dados){		
			
			//load database
			//$this->data_base_object = $this->load->database($this->config_database,true);
			
			//cria consulta
			//$this->data_base_object->insert($this->nome_tabela, $array_dados);
	    	

	    	$arrayTB_Anunciante = array(
	    		'TipoAnunciante' => $array_dados['TipoAnunciante'],
	    		'Email' => $array_dados['Email'],
	    		'Password' => $array_dados['Password']
	    	);
	    	
	    	$this->load->database();
	    	$this->db->insert('TB_Anunciante', $arrayTB_Anunciante);

	    	$arrayTB_PessoaFisica = array(
	    		'NomeAnunciante' => $array_dados['NomeAnunciante'],
	    		'TB_Anunciante_id' => $this->db->insert_id()
	    	);

	    	$this->db->insert('TB_AnunciantePessoaFisica', $arrayTB_PessoaFisica);

				    	
	    }

	    function autentica_login($login, $senha){
    		//load database
			$this->data_base_object = $this->load->database($this->config_database,true);
			
			//cria consulta
			$this->data_base_object->where('Email = ', $login);
			$this->data_base_object->where('Password = ', md5($senha));
			
			//executa query
			$query = $this->data_base_object->get_where($this->nome_tabela); 
			//$query = $this->db->get($this->nome_tabela);
			
			foreach ($query->result() as $row)
			{
				$this->define($row->id);
				return true;
			}
			
			return false;
	
	    }

	    function verifica_password($login, $senha){
    		//load database
			$this->data_base_object = $this->load->database($this->config_database,true);
			
			//cria consulta
			$this->data_base_object->where('Email = ', $login);
			$this->data_base_object->where('Password = ', md5($senha));
			$this->data_base_object->limit(1);
			
			//executa query
			$query = $this->data_base_object->get_where($this->nome_tabela); 

			if($query->num_rows()==1){
				return true;
			}else{
				return false;
			}
	
	    }

	    # VERIFICA SE O USUÁRIO ESTÁ LOGADO
	    function logged() {
	        $logged = $this->session->userdata('logged');

	        if (!isset($logged) || $logged != true) {
	            return false;
	        }else{
	        	return true;
	        }
	    }

	    function nova_senha($id_anunciante, $password){

	    	$array_dados = array(
				'Password' => md5($password)
			);

    		//load database
			$this->data_base_object = $this->load->database($this->config_database,true);
			
			//cria consulta
			$this->data_base_object->where('id', (int)$id_anunciante);
			$this->data_base_object->update($this->nome_tabela, $array_dados);

			//$this->data_base_object->update($this->nome_tabela, $array_dados);
			
			//Define o objeto com o last id do banco	
			$this->define((int)$id_anunciante);
			
			return (int)$id_anunciante;
	
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

	    function edita($id_anunciante, $array_dados){
    		//load database
			$this->data_base_object = $this->load->database($this->config_database,true);
			
			//cria consulta
			$this->data_base_object->where('id', (int)$id_anunciante);
			$this->data_base_object->update($this->nome_tabela, $array_dados);

			//$this->data_base_object->update($this->nome_tabela, $array_dados);
			
			//Define o objeto com o last id do banco	
			$this->define((int)$id_anunciante);
			
			return (int)$id_anunciante;
	
	    }

	    function ativa($id_anunciante){
    		//load database
			$this->data_base_object = $this->load->database($this->config_database,true);
			
			//cria consulta
			$this->data_base_object->where('id', (int)$id_anunciante);
			$this->data_base_object->update($this->nome_tabela, array('Status' => true));
	
			$this->define((int)$id_anunciante);
			
			return true;
	
	    }
	    function desativa($id_anunciante){
    		//load database
			$this->data_base_object = $this->load->database($this->config_database,true);
			
			//cria consulta
			$this->data_base_object->where('id', (int)$id_anunciante);
			$this->data_base_object->update($this->nome_tabela, array('Status' => false));
	
			$this->define((int)$id_anunciante);
			
			return true;
	
	    }
	    function remove($id_anunciante){
    		//load database
			$this->data_base_object = $this->load->database($this->config_database,true);
			
			//cria consulta
			$this->data_base_object->where('id', (int)$id_anunciante);
			$this->data_base_object->update($this->nome_tabela, array('Deletado' => true));
	
			$this->define((int)$id_anunciante);
			
			return true;
	
	    }
		

	}

?>