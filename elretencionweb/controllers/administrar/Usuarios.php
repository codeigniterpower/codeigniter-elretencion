<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Usuarios Controller Class para crear un acceso de usuario en el sistema
 *
 * @package     contabal
 * @author      Lenz McKAY PICCORO @mckaygerhard
 */
class Usuarios extends YA_Controller {

	/** data array for variables send to the view output */
	public $data = NULL;

	/**
	 * name: constructor
	 * @param
	 * @return
	 */
	function __construct()
	{
		parent::__construct();
		$this->checksession();
		$this->load->helper(array('form', 'url','html'));
		$this->load->library('form_validation');
		
		$this->data['menu'] = $this->genmenu();
		$this->data['menusub'] = $this->genmenu('administrar');	
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
		$this->render('administrar/admin_usuarios_index',$data);
	}

	/**
	 * ruta del controler para registrar usaurio
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function usuariosregistrar()
	{
		$data = $this->data;

		if($this->userstatus != 'ACTIVO')
		{
			redirect('editado_restringido');
			return;
		}

		$this->render('administrar/admin_usuarios_registrar',$data);
	}

	/**
	 * ruta del controller para modificar usuario
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function usuariosmodificar($username = NULL)
	{
		$data = $this->data;

		if($this->userstatus != 'ACTIVO')
		{
			redirect('editado_restringido');
			return;
		}

		$this->load->model('Accessmodel','rsm');
		$rs_list_dbarray_userdeta = $this->rsm->usuarioDetalle($username, 'detail');

		if(is_array($rs_list_dbarray_userdeta))
		{
			foreach($rs_list_dbarray_userdeta[0] as $rowcol => $rowdata)
			{
				$$rowcol = $rowdata;
				$data[$rowcol] = $rowdata;
			}
		}

		$data['list_username'] = $rs_list_dbarray_userdeta;
		$this->render('administrar/admin_usuarios_registrar',$data);
	}

	/**
	 * ruta del controller para borrado de un usuario
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function usuariosborrar($username = NULL)
	{
		$data = $this->data;

		if($this->userstatus != 'ACTIVO')
		{
			redirect('editado_restringido');
			return;
		}

		$this->load->model('Accessmodel','rsm');
		$valid = $this->rsm->accessDelete($username);

		redirect('administrar/'.__CLASS__.'/');
	}

	/**
	 * listado de usuarios en forma server side empleando data tables
	 *
	 * @access	public
	 * @param	string $username si se limita a un usuario
	 * @return	void
	 */
	public function usuarioslistar($username = NULL)
	{

		$data = $this->data;

		if($this->userstatus != 'ACTIVO')
		{
			redirect('editado_restringido');
			return;
		}
	
		$tablejscript = "<script type=\"text/javascript\">
				$(document).ready(function() {
					$('#usuarioslistar').DataTable({
						searching: true, dom: '<\"top\"ifrp>rt<\"bottom\"ifrp><\"clear\">',
						processing: true, serverSide: true, order: [ 0, 'asc'],
    					ajax: { type: 'GET', url: '".site_url('administrar/'.__CLASS__.'/usuarioslistarjson/'.$username)."' },
					});
				});
			</script>";

		$tablehtmlsc = '<table id="usuarioslistar" class="display" style="width:100%">
				<thead><tr><th>Usuario</th><th>Llave</th><th>Estatus</th><th>Usuario Alterado</th><th>Accesos Alterado</th></tr></thead>
				<tfoot><tr><th>Usuario</th><th>Llave</th><th>Estatus</th><th>Usuario Alterado</th><th>Accesos Alterado</th></tr></tfoot>
			</table>';

		$data['tabledatahtml'] = $tablehtmlsc . $tablejscript;
		$this->render('administrar/admin_usuarios_listar',$data);
	}

	public function usuarioslistarjson($username = NULL)
	{
		$datatablerender = $this->input->get_post("draw");
		$datatableinicio = $this->input->get_post("start");
		$datatablelength = $this->input->get_post("length");
		$datatableordena = $this->input->get_post("order");
		$datatablesearch = $this->input->get_post("search");

		$datatablecolin = 0;
		$datatabledirec = 'ASC';
		if(!empty($datatableordena))
		{
			if(!empty($datatableordena[0])) // single shorting column
			{
				$datatablecolin = $datatableordena[0]['column'];
				$datatabledirec = $datatableordena[0]['dir'];
			}
		}

		if($username != NULL)
			$datatablesearch['value'] = $username;
		$datatablefilter = $datatablesearch['value'];

		$this->load->model('Accessmodel','rsm');

		$totalrows = $this->rsm->usuariosTotals();
		$totalfilt = $this->rsm->usuariosTotals($datatablefilter);
		$arrayrows = $this->rsm->usuariosListar($datatablelength, $datatableinicio, $datatablecolin, $datatabledirec, $datatablefilter);

		$datadb = array();	// data debe capsulado con "[" y sin "{"
		$indexdata = 0;
		foreach($arrayrows as $keyrowlineas=>$valuerowfilas)
		{
			$datarow = array(); // cada row debe ser solo UTF8, ademas no tener "{"
			$indexrow = 0;
			foreach($valuerowfilas as $columnname=>$rowvalue)
			{
				$datarow[$indexrow] = mb_convert_encoding($rowvalue, "UTF-8", "Windows-1252");
				$indexrow += 1;
			}
			$datadb[$indexdata] = $datarow;
			$indexdata += 1;
		}

		$datajson = array();
		$datajson['draw']            = intval($datatablerender);
		$datajson['recordsTotal']    = $totalrows;
		$datajson['recordsFiltered'] = $totalfilt;
		$datajson['data']            = $datadb;

		$this->output->enable_profiler(FALSE);
		echo json_encode($datajson, JSON_PRETTY_PRINT);
		return;
	}

	/**
	 * metodo para procesar la respuesta de crear/modificar un usuario
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function procesarusuarios()
	{
		$data = $this->data;

		$paramfilters = array();
		$username = $this->input->get_post('username', FALSE);
		$userkey = $this->input->get_post('userkey', FALSE);
		$userstatus = $this->input->get_post('userstatus', FALSE);
		$sessionflag = $this->input->get_post('sessionflag', FALSE);

		$valid1 = $this->_validate_data_usuario($username);
		$valid2 = $this->_validate_data_usuario($userkey);
		$valid3 = $this->_validate_data_usuario($userstatus);
		$valid4 = $this->_validate_data_usuario($sessionflag);
		
	//	if($valid1 == FALSE OR $valid2 == FALSE OR $valid3 == FALSE OR $valid4 == FALSE)
	//		redirect('administrar/'.__CLASS__.'/registraraccesos/errorinputs');

		$paramfilters['username'] = $username;
		$paramfilters['userkey'] = $userkey;
		$paramfilters['userstatus'] = $userstatus;
		$paramfilters['sessionflag'] = $sessionflag;

		$this->load->model('Accessmodel','rsm');
		$valid = $this->rsm->accessSetup($paramfilters);

		redirect('administrar/'.__CLASS__.'/');		
	}

	/**
	 * verifica si la variable es valida y no tiene caracteres raros
     *
	 * @param mixed $variable value
	 * @return mixed $variable or FALSE on invalid value
	 */
	private function _validate_data_usuario($fielvalue)
	{
		$validfields = preg_match('/^[0-9A-Za-z\s\-\_]+$/', $fielvalue);
		if($validfields == FALSE){
			log_message('error', __METHOD__ .' value : ' . print_r($fielvalue, TRUE) . ' not valid : '.print_r($validfields, TRUE));
			return FALSE;
		}
		return $fielvalue;
	}

}

/* End of file Accesos.php */
/* Location: ./eltxtweb/controllers/retenciones/Accesos.php */
