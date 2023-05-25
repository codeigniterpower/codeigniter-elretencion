<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Facturas Controller Class para revisar las retenciones
 *
 * @package     contabal
 * @author      Lenz McKAY PICCORO @mckaygerhard
 */
class Facturas extends YA_Controller {

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
		$this->directory = 'retenciones';
		$data['menu'] = $this->genmenu();
		$data['menusub'] = $this->genmenu($this->directory);
		$data['userurl'] = $this->directory;
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
		$this->facturaslistado();
	}

	/**
	 * entry point para ver todas las facturas listadas
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function facturaslistado()
	{
		$data = $this->data;
		$this->load->model('Admindbcrudmodel','rsm');
		$rs_list_dbarray_total = $this->rsm->readFacturas();
		$data['totalcount'] = '0';
		$data['rs_list_dbarray_total'] = $rs_list_dbarray_total;
		$data['htmlhistorydatatoshow'] = 'No hay registros en la db aun';
		$this->render($this->directory.'/reten_facturas_listados',$data);
	}

	/**
	 * entry point para ver una factura en especifco
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function facturaslistadoid($idretencion = NULL)
	{
		$data = $this->data;
		$this->render($this->directory.'/reten_facturas_detalle',$data);
	}

}

/* End of file Facturas.php */
/* Location: ./eltxtweb/controllers/retenciones/CrearRetencionIVA.php */
