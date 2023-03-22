<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Indexconvertidores eltxt Controller Class index de generacion de txts
 *
 * @package     contabal
 * @author      Lenz McKAY PICCORO @mckaygerhard
 */
class Indexconvertidores extends YA_Controller {

	function __construct()
	{
		parent::__construct();
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

		$data['menu'] = $this->genmenu();
		$data['menusub'] = $this->genmenu('txts');
		$this->render('conver_index',$data);
	}
}

/* End of file Indexconvertidores.php */
/* Location: ./eltxtweb/controllers/convertidores/Indexconvertidores.php */
