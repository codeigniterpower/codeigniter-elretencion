<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Indexretenciones eltxt Controller Class index de registro de retenciones
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
		$data['menu'] = $this->genmenu();
		$data['menusub'] = $this->genmenu('retenciones');
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
		$this->render('reten_index',$data);
	}
}

/* End of file Indexretenciones.php */
/* Location: ./eltxtweb/controllers/retenciones/Indexretenciones.php */
