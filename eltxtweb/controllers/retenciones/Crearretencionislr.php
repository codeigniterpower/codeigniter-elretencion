<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CrearRetencionISLR eltxt Controller Class para crear un de registro de retenciones
 *
 * @package     contabal
 * @author      Lenz McKAY PICCORO @mckaygerhard
 */
class Crearretencionislr extends YA_Controller {

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
	 * index con menu
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function index()
	{

		$data['menu'] = $this->genmenu();
		$data['menusub'] = $this->genmenu('retenciones');
		$this->render('reten_index',$data);
	}

	/**
	 * entry point para vista formulario de crear retencion de ISLR
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function registrarislr()
	{

		$data['menu'] = $this->genmenu();
		$data['menusub'] = $this->genmenu('retenciones');
		$this->render('reten_islr_registrar',$data);
	}

	/**
	 * entry point para vista mostrar el comprobante de retencion de ISLR
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function comprobanteislr($numerocomprobante = NULL)
	{

		$data['menu'] = $this->genmenu();
		$data['menusub'] = $this->genmenu('tretencionesxts');
		$this->render('reten_islr_comprobante',$data);
	}


}

/* End of file CrearRetencionISLR.php */
/* Location: ./eltxtweb/controllers/retenciones/CrearRetencionISLR.php */
