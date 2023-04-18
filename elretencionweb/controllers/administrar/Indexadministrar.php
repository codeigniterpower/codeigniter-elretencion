<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Indexadministrar eltxt Controller Class index de administracion
 * @package     contabal
 * @author      Lenz McKAY PICCORO @mckaygerhard
 */
class Indexadministrar extends YA_Controller {

	/** data array for variables send to the view output */
	public $data = NULL;

	function __construct()
	{
		parent::__construct();
		$this->checksession();
		$this->load->helper(array('form', 'url','html'));
		$data['menu'] = $this->genmenu();
		$data['menusub'] = $this->genmenu('administrar');
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
		$this->render('admin_index',$data);
	}
}

/* End of file Indexadministrar.php */
/* Location: ./eltxtweb/controllers/administrar/Indexadministrar.php */
