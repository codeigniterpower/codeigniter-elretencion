<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * THIS CONTROLLER ONLY LOAD WHEN THE APPLICATION CALLS WITHOUT ENTRY POINT OR SPECIFIC ROUTING
 * remmembered that each controller is a request calll in the web app
 * 
 * @author      PICCORO Lenz McKAY
 * @copyright Copyright (c) 2018, 2019
 * @version ab - 1.0
 */
class Index extends YA_Controller {

	/** data array for variables send to the view output */
	public $data = NULL;

	/**
	 * name: desconocido
	 * @param
	 * @return
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url','html'));
		$data['menu'] = $this->genmenu();
		$data['menusub'] = $this->genmenu('retenciones');
		$this->data = $data;

	}

	/**
	 * index que muestra vista con instrucciones, las instrucciones estan en la vista indexinput
	 * 
	 * @name: index
	 * @param void
	 * @return void
	 */
	public function index()
	{
		$data = $this->data;
		$this->load->view('header',$data);
		$this->load->view('indexview',$data);
		$this->load->view('footer',$data);
	}

	/**
	 * index que muestra vista con instrucciones, las instrucciones estan en la vista indexinput
	 * 
	 * @name: vistainicio
	 * @param void
	 * @return void
	 */
	public function vistainicio()
	{
		$data = array();
		$data['currentctr'] = $this->currentctr;
		$data['currentinx'] = $this->currentinx;
		$data['currenturl'] = $this->currenturl;
		$data['menusub'] = $this->genmenu();
		$this->load->view('header',$data);
		$this->load->view('indexview',$data);
		$this->load->view('footer',$data);
	}

	/**
	 * vistasalida que muestra vista con instrucciones, las instrucciones estan en la vista indexinput
	 * 
	 * @name: vistasalida
	 * @param void
	 * @return void
	 */
	public function vistasalida()
	{
		$data = array();
		$data['currentctr'] = $this->currentctr;
		$data['currentinx'] = $this->currentinx;
		$data['currenturl'] = $this->currenturl;
		$data['menusub'] = $this->genmenu();
		$this->load->view('header',$data);
		$this->load->view('indexview',$data);
		$this->load->view('footer',$data);
	}

}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */
