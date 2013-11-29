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

class States extends REST_Controller
{
    function index_get(){
        $this->load->model('tb_states','states');

        $result = $this->states->getStates();

        $data = array('states' => $result );
        
        if($data){
            $this->response($data, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'Couldn\'t find any states!'), 404);
        }
    }
    function state_get(){
        $this->load->model('tb_states','states');

        if(!$this->get('id')){
            $this->response(NULL, 400);
        }

        $result = array('state' => $this->states->get_state_by_id( $this->get('id') ));
        
        if($result){
            $this->response($result, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'State could not be found'), 404);
        }
    }
}