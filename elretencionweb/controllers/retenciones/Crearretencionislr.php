<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CrearRetencionISLR eltxt Controller Class para crear un de registro de retenciones
 *
 * @package     contabal
 * @author      Lenz McKAY PICCORO @mckaygerhard
 */
class Crearretencionislr extends YA_Controller {

	/** data array for variables send to the view output */
	public $data = NULL;

	/**
	 * name: desconocido
	 * @param
	 * @return
	 */
	function __construct()
	{
		parent::__construct();
		$this->checksession();
		$this->load->helper(array('form', 'url','html'));
		$this->output->enable_profiler(ENVIRONMENT !== 'production');
		//////////////////////////////////////////////////////////////////////////////////////////
		$data["islrFechaDeTransacción"] = "islrFechaDeTransacción";								//
		$data["islrNumeroComprobante"] = "islrNumeroComprobante";										//
		//////////////////////////////////////////////////////////////////////////////////////////////////
		$data["islrNombreONegocio"] = "islrNombreONegocio";												//
		$data["islrRegistroDeInformaciónFiscalDelAgente"]="islrRegistroDeInformaciónFiscalDelAgente";	//			
		//////////////////////////////////////////////////////////////////////////////////////////////////
		$data["islrNombreOAsunto"] = "islrNombreOAsunto";											//
		$data["islrAsuntoRegistroDeInformaciónFiscal"] ="islrAsuntoRegistroDeInformaciónFiscal";	//	
		//////////////////////////////////////////////////////////////////////////////////////////////
		$data["islrNúmeroDeFactura"]="islrNúmeroDeFactura";											//
		$data["isrlAgenteFiscal"] = "isrlAgenteFiscal";												//
		//////////////////////////////////////////////////////////////////////////////////////////////
		$data["islrNumControlFactura"] = "islrNumControlFactura";									//
		$data["islrFechaDeFactura"] = "islrFechaDeFactura";											//
		//////////////////////////////////////////////////////////////////////////////////////////////
		$data["islrCantidadPagada"] = "islrCantidadPagada"; 										//	
		$data["islrCantidadDeObjetoDeRetención"] ="islrCantidadDeObjetoDeRetención";				//				
		//////////////////////////////////////////////////////////////////////////////////////////////
		$data["islrTasa"] = "islrTasa";														  		//		
		$data["isrlDetenido"] = "isrlDetenido";														//
		//////////////////////////////////////////////////////////////////////////////////////////////
		$data["islrCantidadObjetoRetencionAcumulada"] ="islrCantidadObjetoRetencionAcumulada";		//
		$data["islrImpuestoRetenidoAcumulado"] = "islrImpuestoRetenidoAcumulado";					//
		//////////////////////////////////////////////////////////////////////////////////////////////
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

	/**
	 * entry point para vista formulario de crear retencion de ISLR
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function registrarislr()
	{
		$data = $this->data;
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

		$data = $this->data;
		$this->render('reten_islr_comprobante',$data);
	}


}

/* End of file CrearRetencionISLR.php */
/* Location: ./eltxtweb/controllers/retenciones/CrearRetencionISLR.php */
