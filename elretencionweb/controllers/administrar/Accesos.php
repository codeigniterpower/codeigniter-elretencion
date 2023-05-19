<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Accesos eltxt Controller Class para crear un acceso (usuario) en el sistema
 *
 * @package     contabal
 * @author      Lenz McKAY PICCORO @mckaygerhard
 */
class Accesos extends YA_Controller {

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
		$data['indexview'] = 'accesos';
		$this->render('admin_index_accesos',$data);
	}

	/**
	 * entry point para vista formulario de crear accesos (usuarios)
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function registraraccesos()
	{
		$data = $this->data;

		if($this->userstatus != 'ACTIVO')
		{
			redirect('administrar/'.__CLASS__.'/accesosporid/editado_restringido');
			return;
		}

		$this->render('admin_accesos_registrar',$data);
	}

	/**
	 * entry point para vista formulario de modificar acceso (usuario)
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function modificaraccesos($username = NULL)
	{
		$data = $this->data;
		$paramfilters = array();

		$valid = $this->_validate_data_usuario($username);
		if($valid == FALSE)
			$username = $this->input->get_post('rs_username', FALSE);
		$valid = $this->_validate_data_usuario($username);
		if($valid == FALSE)
		{
			redirect('administrar/'.__CLASS__.'/accesosporid/'.$username.'/error');
			return;
		}

		if($this->userstatus != 'ACTIVO')
		{
			redirect('administrar/'.__CLASS__.'/accesosporid/editado_restringido');
			return;
		}

		$paramfilters['username'] = $username;
		log_message('debug', __METHOD__ .' array data : ' . print_r($paramfilters, TRUE) );
		$this->load->model('Accesscrudmodel','rsm');
		$rs_list_dbarray_total = $this->rsm->readAccessos($paramfilters);

		if(is_array($rs_list_dbarray_total))
		{
			if(count($rs_list_dbarray_total) > 1 )
			{
				redirect('administrar/'.__CLASS__.'/accesosporid/editado_error');
				return;
			}
			foreach($rs_list_dbarray_total[0] as $rownum => $rowdata)
			{
				$$rownum = $rowdata;
				$data[$rownum] = $rowdata;
			}
		}
		else
		{
			redirect('administrar/'.__CLASS__.'/accesosporid/editado_error');
			return;
		}
		$this->render('admin_accesos_registrar',$data);
	}

	/**
	 * entry point para procesar el borrar usuarios de accesos
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function borraraccesos($username = NULL)
	{
		$data = $this->data;
		$paramfilters = array();

		$valid = $this->_validate_data_usuario($username);
		if($valid == FALSE)
			$username = $this->input->get_post('username', FALSE);
		$valid = $this->_validate_data_usuario($username);
		if($valid == FALSE)
		{
			redirect('administrar/'.__CLASS__.'/accesosporid/'.$username.'/error');
			return;
		}

		if($this->userstatus != 'ACTIVO')
		{
			redirect('administrar/'.__CLASS__.'/accesosporid/borrado_restringido');
			return;
		}

		$paramfilters['username'] = $username;
		log_message('debug', __METHOD__ .' array data : ' . print_r($paramfilters, TRUE) );
		$this->load->model('Accesscrudmodel','rsm');
		$valid = $this->rsm->deleteAcceso($paramfilters);

		if($valid == FALSE)
		{
			redirect('administrar/'.__CLASS__.'/accesosporid/borrado_error');
			return;
		}
		else
		{
			redirect('administrar/'.__CLASS__.'/accesosporid/borrado');
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
	public function accesosporid($username = NULL)
	{

		$data = $this->data;
		$paramfilters = NULL;
		$errormsg = $username;
		$validcod = $this->form_validation->required($username);
		$validval = preg_match('/^[a-zA-Z0-9\-]{3,}+$/i', $username);
		if( $validval != FALSE AND $validcod != FALSE) $paramfilters = array('username'=>$username);

		$rs_list_dbarray_total = array();
		$rs_list_dbarray_count = array();
		$this->load->model('Accesscrudmodel','rsm');
		$rs_list_dbarray_total = $this->rsm->readAccessos($paramfilters);
		$totalcount = 0;
		if(is_array($rs_list_dbarray_total))
		{
			$totalcount = count($rs_list_dbarray_total);
			if($this->userstatus == 'ACTIVO')
			{
				$newrowsdata = array();
				foreach($rs_list_dbarray_total as $rownum => $rowdata)
				{
					$editar = anchor('administrar/'.__CLASS__.'/modificaraccesos/'.$rowdata['username'], 'Editar', array('class' => 'btn btn-info btn-sm'));
					$borrar = anchor('administrar/'.__CLASS__.'/borraraccesos/'.$rowdata['username'], 'Borrar', array('class' => 'btn btn-danger btn-sm'));
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
		$this->render('admin_accesos_listar',$data);
	}

	/**
	 * entry point para procesar el crear/modificar razon social
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function procesaaccesos()
	{
		$data = $this->data;

		$paramfilters = array();
		$username = $this->input->get_post('username', FALSE);
		$userkey = $this->input->get_post('userkey', FALSE);
		$userstatus = $this->input->get_post('userstatus', FALSE);
		$modulostring = $this->input->get_post('modulostring', FALSE);

		$valid1 = $this->_validate_data_usuario($username);
		$valid2 = $this->_validate_data_usuario($userkey);
		$valid3 = $this->_validate_data_usuario($userstatus);
		$valid4 = $this->_validate_data_usuario($modulostring);
		
		if($valid1 == FALSE OR $valid2 == FALSE OR $valid3 == FALSE OR $valid4 == FALSE)
			redirect('administrar/'.__CLASS__.'/registraraccesos/errorinputs');
		
		$paramfilters['username'] = $username;
		$paramfilters['userkey'] = $userkey;
		$paramfilters['userstatus'] = $userstatus;
		$paramfilters['modulostring'] = $modulostring;
		log_message('debug', __METHOD__ .' array data : ' . print_r($paramfilters, TRUE) );
		$this->load->model('Accesscrudmodel','rsm');
		$valid = $this->rsm->setupAccessos($paramfilters);

		if($valid == FALSE)
			redirect('administrar/'.__CLASS__.'/registraraccesos/errordb');
		else
			redirect('administrar/'.__CLASS__.'/accesosporid/'.$username);		
	}

	private function _validate_data_usuario($fielvalue)
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

/* End of file Accesos.php */
/* Location: ./eltxtweb/controllers/retenciones/Accesos.php */
