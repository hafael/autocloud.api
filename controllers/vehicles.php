<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package     CodeIgniter
 * @subpackage  Rest Server
 * @category    Controller
 * @author      Phil Sturgeon
 * @link        http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Vehicles extends REST_Controller
{
    function brands_get(){
        
        $this->load->model('tb_vehiclebrands','vehicleBrands');

        if(!$this->get('type')){
            $this->response(NULL, 400);
        }

        $result = array('brands' => $this->vehicleBrands->getBrandsByType( $this->get('type') ));
        
        if($result){
            $this->response($result, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'Couldn\'t find any vehicle brands!'), 404);
        }

    }
    function models_get(){
        
        $this->load->model('tb_vehiclemodels','vehicleModels');

        if(!$this->get('id') && !$this->get('type')){
            $this->response(NULL, 400);
        }

        $result = array('models' => $this->vehicleModels->getModelsByBrandKey( $this->get('id'), $this->get('type') ));
        
        if($result){
            $this->response($result, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'Couldn\'t find any vehicle models!'), 404);
        }

    }
}