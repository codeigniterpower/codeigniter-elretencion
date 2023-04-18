<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Indexconvertidores eltxt Controller Class index de generacion de txts
 *
 * @package     contabal
 * @author      Lenz McKAY PICCORO @mckaygerhard
 */
class Indexconvertidores extends YA_Controller {

	/** data array for variables send to the view output */
	public $data = NULL;

	function __construct()
	{
		parent::__construct();
		$this->checksession();
		$this->load->helper(array('form', 'url','html'));
		$data['menu'] = $this->genmenu();
		$data['menusub'] = $this->genmenu('convertidores');
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
		$this->render('conver_index',$data);
	}
}

/* End of file Indexconvertidores.php */
/* Location: ./eltxtweb/controllers/convertidores/Indexconvertidores.php */
