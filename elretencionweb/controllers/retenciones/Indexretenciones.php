<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Indexretenciones Controller Class index de retenciones
 *
 * @package     contabal
 * @author      Lenz McKAY PICCORO @mckaygerhard
 */
class Indexretenciones extends YA_Controller {

	/** data array for variables send to the view output */
	public $data = NULL;

	function __construct()
	{
		parent::__construct();
		$this->checksession();
		$this->load->helper(array('form', 'url','html'));
		$this->directory = 'retenciones';
		$data['menu'] = $this->genmenu();
		$data['menusub'] = $this->genmenu($this->directory);
		$data['userurl'] = $this->directory;
		$this->data = $data;
	}

	/**
	 * index con menu
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function index()
	{

		$data = $this->data;
		$this->render($this->directory.'/reten_index',$data);
	}
}

/* End of file Indexretenciones.php */
/* Location: ./controllers/retenciones/Indexretenciones.php */
