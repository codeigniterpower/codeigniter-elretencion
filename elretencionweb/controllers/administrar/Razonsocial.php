<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Razonsocial eltxt Controller Class para crear un agente de retenciones
 *
 * @package     contabal
 * @author      Lenz McKAY PICCORO @mckaygerhard
 */
class Razonsocial extends YA_Controller {

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
		$this->load->library('form_validation');
		
		$data['menu'] = $this->genmenu();
		$data['menusub'] = $this->genmenu('administrar');	
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
		$this->render('admin_index',$data);
	}

	/**
	 * entry point para vista formulario de crear razon social
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function registrarrazonsocial()
	{
		$data = $this->data;
		$this->render('admin_razonsocial_registrar',$data);
	}

	/**
	 * entry point para vista formulario de modificar razon social
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function modificarrazonsocial($cod_juridico = NULL)
	{
		$data = $this->data;
		$paramfilters = array();

		$valid = $this->_validate_data_juridico($cod_juridico);
		if($valid == FALSE)
			$cod_juridico = $this->input->get_post('rs_cod_juridico', FALSE);
		$valid = $this->_validate_data_juridico($cod_juridico);
		if($valid == FALSE)
		{
			redirect('administrar/'.__CLASS__.'/razonsocialporid/'.$cod_juridico.'/error');
			return;
		}

		$paramfilters['cod_juridico'] = $cod_juridico;
		log_message('debug', __METHOD__ .' array data : ' . print_r($paramfilters, TRUE) );
		$this->load->model('Admindbcrudmodel','rsm');
		$rs_list_dbarray_total = $this->rsm->readRazonesSociales($paramfilters);

		if(is_array($rs_list_dbarray_total))
		{
			if(count($rs_list_dbarray_total) > 1 )
			{
				redirect('administrar/'.__CLASS__.'/razonsocialporid/editado_error');
				return;
			}
			if($this->userstatus == 'ACTIVO')
			{
				foreach($rs_list_dbarray_total[0] as $rownum => $rowdata)
				{
					$$rownum = $rowdata;
					$data['rs_'.$rownum] = $rowdata;
				}
			}
			else
			{
				redirect('administrar/'.__CLASS__.'/razonsocialporid/editado_restringido');
				return;
			}
		}
		else
		{
			redirect('administrar/'.__CLASS__.'/razonsocialporid/editado_error');
			return;
		}
		$this->render('admin_razonsocial_registrar',$data);
	}

	/**
	 * entry point para procesar el borrar razon social
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function borrarrazonsocial($cod_juridico = NULL)
	{
		$data = $this->data;
		$paramfilters = array();

		$valid = $this->_validate_data_juridico($cod_juridico);
		if($valid == FALSE)
			$cod_juridico = $this->input->get_post('rs_cod_juridico', FALSE);
		$valid = $this->_validate_data_juridico($cod_juridico);
		if($valid == FALSE)
		{
			redirect('administrar/'.__CLASS__.'/razonsocialporid/'.$cod_juridico.'/error');
			return;
		}

		if($this->userstatus == 'ACTIVO')
		{
			redirect('administrar/'.__CLASS__.'/razonsocialporid/borrado_restringido');
			return;
		}

		$paramfilters['cod_juridico'] = $cod_juridico;
		log_message('debug', __METHOD__ .' array data : ' . print_r($paramfilters, TRUE) );
		$this->load->model('Admindbcrudmodel','rsm');
		$valid = $this->rsm->deletRazonSocial($paramfilters);

		if($valid == FALSE)
		{
			redirect('administrar/'.__CLASS__.'/razonsocialporid/borrado_error');
			return;
		}
		else
		{
			redirect('administrar/'.__CLASS__.'/razonsocialporid/borrado');
			return;
		}
	}

	/**
	 * entry point para vista de una o varias razones sociales
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function razonsocialporid($cod_juridico = NULL)
	{

		$data = $this->data;
		$paramfilters = NULL;
		$errormsg = $cod_juridico;
		$validcod = $this->form_validation->required($cod_juridico);
		$validval = preg_match('/^[a-zA-Z0-9\-]{3,}+$/i', $cod_juridico);
		if( $validval != FALSE AND $validcod != FALSE) $paramfilters = array('cod_juridico'=>$cod_juridico);

		$rs_list_dbarray_total = array();
		$rs_list_dbarray_count = array();
		$this->load->model('Admindbcrudmodel','rsm');
		$rs_list_dbarray_total = $this->rsm->readRazonesSociales($paramfilters);
		$totalcount = 0;
		if(is_array($rs_list_dbarray_total))
		{
			$totalcount = count($rs_list_dbarray_total);
			if($this->userstatus == 'ACTIVO')
			{
				$newrowsdata = array();
				foreach($rs_list_dbarray_total as $rownum => $rowdata)
				{
					$editar = anchor('administrar/'.__CLASS__.'/modificarrazonsocial/'.$rowdata['cod_juridico'], 'Editar', array('class' => 'btn btn-info btn-sm'));
					$borrar = anchor('administrar/'.__CLASS__.'/borrarrazonsocial/'.$rowdata['cod_juridico'], 'Borrar', array('class' => 'btn btn-danger btn-sm'));
					$rowdata['Acciones'] = $editar.$borrar;
					$newrowsdata[$rownum] = $rowdata;
				}
				$rs_list_dbarray_total = $newrowsdata;
			}
		}

		$data['totalcount'] = $totalcount;
		$data['rs_list_dbarray_total'] = $rs_list_dbarray_total;
		$data['currenturl'] = $this->currenturl;
		$data['errormsg'] = $errormsg;
		$this->render('admin_razonsocial_listar',$data);
	}

	/**
	 * entry point para procesar el crear/modificar razon social
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function procesarazonsocial()
	{
		$data = $this->data;

		$paramfilters = array();
		$cod_juridico = $this->input->get_post('rs_cod_juridico', FALSE);
		$cod_denominacion = $this->input->get_post('rs_cod_denominacion', FALSE);
		$tipo_juridico = $this->input->get_post('rs_tipo_juridico', FALSE);
		$nombre_legal = $this->input->get_post('rs_nombre_legal', FALSE);
		$nombre_comercial = $this->input->get_post('rs_nombre_comercial', FALSE);
		$direccion_comercial = $this->input->get_post('rs_direccion_comercial', FALSE);

		$valid1 = $this->_validate_data_juridico($cod_juridico);
		$valid2 = $this->_validate_data_juridico($cod_denominacion);
		$valid3 = $this->_validate_data_juridico($tipo_juridico);
		$valid4 = $this->_validate_data_juridico($nombre_legal);
		$valid5 = $this->_validate_data_juridico($nombre_comercial);
		$valid6 = $this->_validate_data_juridico($direccion_comercial);
		
		if($valid1 == FALSE OR $valid2 == FALSE OR $valid3 == FALSE OR $valid4 == FALSE OR $valid5 == FALSE)
			redirect('administrar/'.__CLASS__.'/registrarrazonsocial/errorinputs');
		
		$paramfilters['cod_juridico'] = $cod_juridico;
		$paramfilters['cod_denominacion'] = $cod_denominacion;
		$paramfilters['tipo_juridico'] = $tipo_juridico;
		$paramfilters['nombre_legal'] = $nombre_legal;
		$paramfilters['nombre_comercial'] = $nombre_comercial;
		$paramfilters['direccion_comercial'] = $direccion_comercial;
		log_message('debug', __METHOD__ .' array data : ' . print_r($paramfilters, TRUE) );
		$this->load->model('Admindbcrudmodel','rsm');
		$valid = $this->rsm->setupRazonSocial($paramfilters);

		if($valid == FALSE)
			redirect('administrar/'.__CLASS__.'/registrarrazonsocial/errordb');
		else
			redirect('administrar/'.__CLASS__.'/razonsocialporid/'.$cod_juridico);		
	}

	private function _validate_data_juridico($fielvalue)
	{
		$validfields = $this->form_validation->required($fielvalue);
		$validfields = preg_match('/^[0-9A-Za-z\s\-]+$/', $fielvalue);
		if($validfields == FALSE){
			log_message('error', __METHOD__ .' value : ' . print_r($fielvalue, TRUE) . ' not valid : '.print_r($validfields, TRUE));
			return FALSE;
		}
		return TRUE;
	}

}

/* End of file Razonsocial.php */
/* Location: ./eltxtweb/controllers/retenciones/Razonsocial.php */
