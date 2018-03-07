<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends CI_Controller {

	public function message( $to = 'World')
	{
        echo "Hello {$to}!".PHP_EOL;
	}
	public function test(){
        $this->load->model('Usermenu_model');

        $usermenu_m = new Usermenu_model();
        var_dump($usermenu_m->usermenulist(8));

    }
}
