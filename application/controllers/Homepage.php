<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends Application
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Homepage for our app
	 */
    public function index(){
        $this->data['pagebody'] = 'homepage';
        $this->data['message'] = '<br>';
        $this->render();
	}
}