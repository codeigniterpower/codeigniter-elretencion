<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CrearRetencionIVA eltxt Controller Class para crear un comprobante de IVA
 *
 * @package     contabal
 * @author      Lenz McKAY PICCORO @mckaygerhard
 */
class Crearretencioniva extends YA_Controller {
	private $var;

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
		//////////////////////////////////////////////////////////////////////////////////////////
		$data["islrFechaDeTransacción"] = "islrFechaDeTransacción";								//
		$data["islrNumeroComprobante"] = "islrNumeroComprobante";								//
		//////////////////////////////////////////////////////////////////////////////////////////
		$data["islrNombreONegocio"] = "islrNombreONegocio";										//////////
		$data["islrRegistroDeInformaciónFiscalDelAgente"]="islrRegistroDeInformaciónFiscalDelAgente"; 	//	
		//////////////////////////////////////////////////////////////////////////////////////////////////
		$data["islrNombreOAsunto"] = "islrNombreOAsunto";											//
		$data["islrRegistroDeSujetoDeInformaciónFiscal"] ="islrRegistroDeSujetoDeInformaciónFiscal";//		
		//////////////////////////////////////////////////////////////////////////////////////////////
		$data["islrNúmeroDeFactura"]="islrNúmeroDeFactura";										//
		$data["isrlAgenteFiscal"] = "isrlAgenteFiscal";											//
		//////////////////////////////////////////////////////////////////////////////////////////
		$data["IslrNumControlFactura"] = "IslrNumControlFactura";								//
		$data["islrFechaDeFactura"] = "islrFechaDeFactura";										//
		//////////////////////////////////////////////////////////////////////////////////////////
		$data["isrlCantidadPagar"] = "isrlCantidadPagar"; 										//
		$data["islrCantidadDeObjetoDeRetención"] ="islrCantidadDeObjetoDeRetención";			//
		//////////////////////////////////////////////////////////////////////////////////////////
		$data["islrTasa"] = "islrTasa";														  	//			
		$data["isrlDetenido"] = "isrlDetenido";													//
		//////////////////////////////////////////////////////////////////////////////////////////////
		$data["islrCantidadObjetoRetencionAcumulada"] ="islrCantidadObjetoRetencionAcumulada";		//
		$data["islrImpuestoRetenidoAcumulado"] = "islrImpuestoRetenidoAcumulado";					//
		//////////////////////////////////////////////////////////////////////////////////////////////
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

		$data['menu'] = $this->genmenu();
		$data['menusub'] = $this->genmenu('retenciones');
		$this->render('txts_index',$data);
	}

	/**
	 * entry point para vista formulario de crear retencion de IVA
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function registrariva()
	{

		$data['menu'] = $this->genmenu();
		$data['menusub'] = $this->genmenu('retenciones');
		$data = $this->var;
		$this->render('reten_iva_registrar',$data);

	}

	/**
	 * entry point para vista mostrar el comprobante de retencion de IVA
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function comprobanteiva($numerocomprobante = NULL)
	{

		$data['menu'] = $this->genmenu();
		$data['menusub'] = $this->genmenu('retenciones');
		$this->render('reten_iva_comprobante',$data);
	}

}

/* End of file CrearRetencionIVA.php */
/* Location: ./eltxtweb/controllers/retenciones/CrearRetencionIVA.php */
