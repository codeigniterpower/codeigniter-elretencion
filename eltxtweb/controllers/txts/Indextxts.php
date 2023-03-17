<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Indextxts eltxt Controller Class index de generacion de txts
 *
 * @package     contabal
 * @author      Lenz McKAY PICCORO @mckaygerhard
 */
class Indextxts extends YA_Controller {

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
		$this->render('txts_index',$data);
	}
}

/* End of file Indextxts.php */
/* Location: ./eltxtweb/controllers/Indextxts.php */
