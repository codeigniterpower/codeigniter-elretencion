<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CrearRetencionIVA eltxt Controller Class para crear un comprobante de IVA
 *
 * @package     contabal
 * @author      Lenz McKAY PICCORO @mckaygerhard
 */
class Crearretencioniva extends YA_Controller {

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
		$this->load->helper(array('form', 'url','html'));
		$this->output->enable_profiler(ENVIRONMENT !== 'production');
		//////////////////////////////////////////////////////////////////////////////////////////
		$data["islrDateOfTransaction"] = "islrDateOfTransaction";								//
		$data["islrVoucherNumber"] = "islrVoucherNumber";										//
		//////////////////////////////////////////////////////////////////////////////////////////
		$data["islrNameOrBusiness"] = "islrNameOrBusiness";										//
		$data["islrAgentRecordOfTaxInformation"]="islrAgentRecordOfTaxInformation";				//
		//////////////////////////////////////////////////////////////////////////////////////////
		$data["islrNameOrSubject"] = "islrNameOrSubject";										//
		$data["islrSubjectRecordOfTaxInformation"] ="islrSubjectRecordOfTaxInformation";		//
		//////////////////////////////////////////////////////////////////////////////////////////
		$data["isrlAgentFiscal"] = "isrlAgentFiscal";											//
		$data["islrInvoiceNumber"]="islrInvoiceNumber";											//
		//////////////////////////////////////////////////////////////////////////////////////////
		$data["islrNumCtrolInvoice"] = "islrNumCtrolInvoice";									//
		$data["islrInvoiceDate"] = "islrInvoiceDate";											//
		//////////////////////////////////////////////////////////////////////////////////////////
		$data["isrlAmountPaid"] = "isrlAmountPaid"; 											//
		$data["islrAmountOfHoldObject"] ="islrAmountOfHoldObject";								//
		//////////////////////////////////////////////////////////////////////////////////////////
		$data["islrRate"] = "islrRate";														  	//			
		$data["isrlDetained"] = "isrlDetained";													//
		//////////////////////////////////////////////////////////////////////////////////////////////
		$data["islrAmountObjectAccumulatedWithholding"] ="islrAmountObjectAccumulatedWithholding";	//
		$data["islrAccumulatedWithholdingTax"] = "islrCcumulatedWithholdingTax";					//
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
	 * entry point para vista formulario de crear retencion de IVA
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function registrariva()
	{

		$data = $this->data;
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

		$data = $this->data;
		$this->render('reten_iva_comprobante',$data);
	}

}

/* End of file CrearRetencionIVA.php */
/* Location: ./eltxtweb/controllers/retenciones/CrearRetencionIVA.php */
