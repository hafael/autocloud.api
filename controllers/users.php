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

class Users extends REST_Controller
{
    function user_get(){
        $this->load->model('tb_announcer','announcer');

        if(!$this->get('email')){
            $this->response(NULL, 400);
        }else{
            $result = array('user' => $this->announcer->get_user_by_email( $this->get('email') ) );    
        }

        if($result){
            $this->response($result, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }
}