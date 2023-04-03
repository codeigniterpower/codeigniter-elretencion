<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Crearagentederetencion eltxt Controller Class para crear un agente de retenciones
 *
 * @package     contabal
 * @author      Lenz McKAY PICCORO @mckaygerhard
 */
class Crearagentederetencion extends YA_Controller {

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
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$data["nombreOrazonSocialDeLagenteDeRetención"] = "nombreOrazonSocialDeLagenteDeRetención";						//			
		$data["registroDeInformacionFiscalDelAgenteDeRetencion"]="registroDeInformacionFiscalDelAgenteDeRetencion";		//		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$data["direccionComercial"] = "direccionComercial";																//								
		$data["nombreLegal"]="nombreLegal";																				//
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$data["nombreComercial"] ="nombreComercial";																	//
		$data["codDenominacion"] = "codDenominacion";																	//
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$data["tipoDeRegistro"]="tipoDeRegistro";																		//		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$data['menu'] = $this->genmenu();
		$data['menusub'] = $this->genmenu('retenciones');	
		$this->var = $data;
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
		$data = $this->var;

		$data['menu'] = $this->genmenu();
		$data['menusub'] = $this->genmenu('administrar');
		$this->render('admin_index',$data);
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
		$data['menusub'] = $this->genmenu('administrar');
		$this->render('admin_agenteretencion_registrar',$data);
	}

}

/* End of file Crearagentederetencion.php */
/* Location: ./eltxtweb/controllers/retenciones/Crearagentederetencion.php */
