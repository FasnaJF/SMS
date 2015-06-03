<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 2/4/2015
 * Time: 8:14 PM
 */

class MY_Controller extends CI_Controller{

    var $data = array();

    public function __construct(){

        parent::__construct();

        $this->data['errors'] = array();
        $this->data['site_name'] = config_item('site_name');

    }

}