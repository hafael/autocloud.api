<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();
		$data = array();
		$this->load->helper('url');
		$this->load->model('TB_Anunciante','anunciante');
	}

	public function index(){
		
        

	}
	public function email(){
		
		

		if($this->input->get('email')!=''){

			$data = $this->anunciante->verificaEmail($this->input->get('email'));

		}else{

			$data = false;

		}

		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode($data));

	}

	
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */