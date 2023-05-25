<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Retenciones Controller Class para revisar las retenciones
 *
 * @package     contabal
 * @author      Lenz McKAY PICCORO @mckaygerhard
 */
class Retenciones extends YA_Controller {

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
		$this->retencionlistado();
	}

	/**
	 * entry point para vista formulario de crear retencion de IVA
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function retencionlistado()
	{
		$data = $this->data;
		$this->load->model('Retencionesmodel','rtm');
		$rs_list_dbarray_total = $this->rtm->readRetenciones();
		$data['totalcount'] = '0';
		$data['rs_list_dbarray_total'] = $rs_list_dbarray_total;
		$data['htmlhistorydatatoshow'] = 'No hay registros en la db aun';
		$this->render($this->directory.'/reten_registro_listados',$data);
	}

	/**
	 * entry point para vista mostrar el comprobante de retencion de IVA
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function retencionporid($idretencion = NULL)
	{
		$data = $this->data;
		
		$this->render($this->directory.'/reten_registro_detalle',$data);
	}

}

/* End of file CrearRetencionIVA.php */
/* Location: ./eltxtweb/controllers/retenciones/CrearRetencionIVA.php */
