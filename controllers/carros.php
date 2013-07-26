<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carros extends CI_Controller {

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
	public function montadoras($tipo_veiculo){
		
        $this->load->model('TB_FabricanteVeiculo','fabricante');

		header('Content-Type: application/x-json; charset=utf-8');

		echo json_encode($this->fabricante->lista($tipo_veiculo));

	}
	public function modelos($tipo_veiculo, $id_fabricante){
		
        $this->load->model('TB_ModeloVeiculo','modelo');

		header('Content-Type: application/x-json; charset=utf-8');

		echo json_encode($this->modelo->lista($tipo_veiculo, $id_fabricante));

	}
	/*
	public function anofabricacao($param){
		
        $this->load->model('TB_AnoFabricacaoVeiculo','anoFab');

		header('Content-Type: application/x-json; charset=utf-8');

		echo json_encode($this->anoFab->lista($param));

	}
	public function anomodelo($param){
		
        $this->load->model('TB_AnoModeloVeiculo','anoMod');

		header('Content-Type: application/x-json; charset=utf-8');

		echo json_encode($this->anoMod->lista($param));

	}
	public function versao($param){
		
        $this->load->model('TB_VersaoVeiculo','versao');

		header('Content-Type: application/x-json; charset=utf-8');

		echo json_encode($this->versao->lista($param));

	}
	*/

	
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */