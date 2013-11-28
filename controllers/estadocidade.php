<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EstadoCidade extends CI_Controller {

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

		
		
	}

	public function index(){
		
        

	}
	public function estados(){
		
        $this->load->model('TB_Estados','estados');

		$data = $this->estados->lista();

		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode($data));

	}
	public function cidades($param){
		
        $this->load->model('TB_Cidades','cidades');

		$data = $this->cidades->lista($param);

		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode($data));

	}

	
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */