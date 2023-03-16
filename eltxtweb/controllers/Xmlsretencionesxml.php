<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * clase principal de carga de archivos, inicial
 * 
 * @author      PICCORO Lenz McKAY
 * @copyright Copyright (c) 2023 Angel Gonzalez Instagram:Angel_gonzalez_dev , Gitlab 1:@Radioactive99
 * @version ab - 1.0
 */
class Xmlsretencionesxml extends YA_Controller {

	/**
	 * name: desconocido
	 * @param
	 * @return
	 */
	function __construct()
	{
		parent::__construct();
	$this->load->helper(array('form', 'url','html'));
	$this->output->enable_profiler(ENVIRONMENT !== 'production');

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
		$data = array();
		$data['currentctr'] = $this->currentctr;
		$data['currentinx'] = $this->currentinx;
		$data['currenturl'] = $this->currenturl;
		$this->load->view('header',$data);
		$this->load->view('indexview',$data);
		$this->load->view('footer',$data);
	}

	public function Converttxttoxml()
	{

		$this->load->library('upload');

		$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '100';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';

	}


}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */
