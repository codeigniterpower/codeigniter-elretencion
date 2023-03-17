<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Indexxmls eltxt Controller Class index de generacion de xmls
 *
 * @package     contabal
 * @author      Lenz McKAY PICCORO @mckaygerhard
 */
class Indexxmls extends YA_Controller {

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
		$data['menusub'] = $this->genmenu('xmls');
		$this->render('xmls_index',$data);
	}
}

/* End of file Indexxmls.php */
/* Location: ./eltxtweb/controllers/Indexxmls.php */
