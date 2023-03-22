<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Indexretenciones eltxt Controller Class index de registro de retenciones
 *
 * @package     contabal
 * @author      Lenz McKAY PICCORO @mckaygerhard
 */
class Indexretenciones extends YA_Controller {

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
		$this->render('reten_index',$data);
	}
}

/* End of file Indexretenciones.php */
/* Location: ./eltxtweb/controllers/retenciones/Indexretenciones.php */
