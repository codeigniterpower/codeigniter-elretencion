<?php 
/**
 * Copyright 2023 Angel Gonzalez Gmail:ag5193407@gmail.com , Gitlab 1:@Radioactive99
 * Copyright 2023 PICCORO Lenz McKAY mckaygerhard
 * 
 * Usted es libre de:
 * - Compartir — copiar y redistribuir el material en cualquier medio o formato
 * - Adaptar — remezclar, transformar y crear a partir del material
 * 
 * El licenciador no puede revocar estas libertades mientras cumpla con los términos de la licencia.
 * Bajo las condiciones siguientes:
 * 
 * - Reconocimiento — Debe reconocer adecuadamente la autoría, proporcionar un enlace a la licencia e indicar si se han realizado cambios<. Puede hacerlo de cualquier manera razonable, pero no de una manera que sugiera que tiene el apoyo del licenciador o lo recibe por el uso que hace.
 * - NoComercial — No puede utilizar el material para una finalidad comercial.
 * - CompartirIgual — Si remezcla, transforma o crea a partir del material, deberá difundir sus contribuciones bajo la misma licencia que el original.
 * 
 * No hay restricciones adicionales — No puede aplicar términos legales o medidas tecnológicas que legalmente restrinjan realizar aquello que la licencia permite.
 */


/**
 * Accessmodel.php
 * 
 * abstraction DB para manejar data de acessos con soporte datatables, aparte de la clase/model auth
 *
 * @copyright Copyright 2023
 * @package    CodeIgniter
 * @category   Files
 * @version    1.0.0-dev
 * @author     PICCORO Lenz McKAY
 */
class Accessmodel extends CI_Model 
{

	public $dba;
	private $CI; // CodeIgniter object

	public function __construct() 
	{
		parent::__construct();
		$this->dba = $this->load->database('elretenciondb', TRUE);
		$this->CI =& get_instance();
		$this->CI->load->library('form_validation');
	}

	/**
	 * numero total de usuarios registrados segun filtrado
	 *
	 * @access	public
	 * @param	string $username string de filtrado por usuario
	 * @return	integer $cuantos cantidad de registros en la tabla dependiendo de filtros
	 */
	public function usuariosTotals($username = NULL)
	{
		$cuantos = 0;
		$cuantosrs = array();
		$sqlquery = "
			SELECT count(username) as cuantos FROM elretenciondb.reten_usuarios WHERE 1=1 AND username LIKE '%".$username."%' 
			";
		
		$sqlrs = $this->dba->query($sqlquery);
		if($sqlrs == FALSE OR $sqlrs == NULL) return 0;
		$cuantosrs = $sqlrs->result_array();
		$cuantos = $cuantosrs[0]['cuantos'];
		return $cuantos;
	}

	/**
	 * lista de usuarios del sistema desde reten_usuarios y reten_usuarios_modulos en forma server side
	 *
	 * @access	public
	 * @param	integer $length cuantos registros por pagina
	 * @param	integer $iniciar desde que indice de los registros inicia la pagina actual
	 * @param	integer $columdir indice de la columna por la cual se ordena y tambien filtrar
	 * @param	string $orderdir metodo de ordenamiento si ascendente (ASC) o descendente (desc)
	 * @param	string $username palabra por la cual se va filtrar el ordenamiento
	 * @return	mixed FALSE on errors, array with matrix of rows x columns values
	 */
	public function usuariosListar($length = 50, $iniciar = 0, $columdir = 0, $orderdir = 'ASC', $username = NULL)
	{
		$sqlcolumns1 = "username, userkey, userstatus, sessionflag, sessionficha";
		$columnsarr = explode(',',trim($sqlcolumns1));
		$columnsdir = $columnsarr[$columdir];

		$sqlquery1 = "
			SELECT      ".$sqlcolumns1."
			FROM        elretenciondb.reten_usuarios
			WHERE 1=1 AND ".$columnsdir." LIKE '%".$username."%' 
			ORDER BY ".$columnsdir." ".$orderdir." 
			LIMIT ".$length." 
			OFFSET ".$iniciar."
			";

		$sqlrs = $this->dba->query($sqlquery1);
		if($sqlrs == FALSE)
			return FALSE;
		$arreglo_data = $sqlrs->result_array();

		// TODO: on each query user .. loop each module and return list comma separated

		return $arreglo_data;
	}

	/**
	 * Detalles de un usuarios o varios segun el formato, empleado para obtener todos los datos o haces una lista para select boxes
	 *
	 * @access	public
	 * @param	string $username el id del usuario especifico , si nulo trae todos en arreglo
	 * @param	string $format (detail|select) si es para llenar una lista de datos o un select box de pares
	 * @return	mixed FALSE on errors, array with matrix of rows x columns values
	 */
	public function usuarioDetalle($username = NULL)
	{
		$sqlcolumns1 = "username, userkey, userstatus, sessionflag, sessionficha";
		$columnsarr = explode(',',trim($sqlcolumns1));

		$sqlquery1 = "
			SELECT     ".$sqlcolumns1."
			FROM       elretenciondb.reten_usuarios
			WHERE 1=1 AND username = '".$username."'
			";

		$sqlrs = $this->dba->query($sqlquery1);
		if($sqlrs == FALSE)
			return FALSE;
		$arreglo_data = $sqlrs->result_array();

		return $arreglo_data;
	}

	/**
	 * Detalles de listado de modulos permitidos por el usuario segun el formato, empleado para obtener todos los datos o haces una lista para select boxes
	 *
	 * @access	public
	 * @param	string $username el id del usuario especifico , si nulo trae todos en arreglo
	 * @return	mixed FALSE on errors, array with matrix of rows x columns values
	 */
	public function usuarioModulos($username = NULL)
	{
		$sqlcolumns1 = "username, modulo_string, sessionflag, sessionficha";
		$columnsarr = explode(',',trim($sqlcolumns1));

		$sqlquery1 = "
			SELECT     ".$sqlcolumns1."
			FROM       elretenciondb.reten_usuarios_modulos
			WHERE 1=1 /*AND username = '".$username."'*/
			";

		$sqlrs = $this->dba->query($sqlquery1);
		if($sqlrs == FALSE)
			return FALSE;
		$arreglo_data = $sqlrs->result_array();

		return $arreglo_data;
	}

	/**
	 * guarda un nuevo acceso en la tabla de reten_usuarios
	 *
	 * @access	public
	 * @param	array  $parameters ( username=>xxx,  nombre=>nombre  .. )
	 * @return	boolean FALSE on errors
	 */
	public function accessSetup($parameters = NULL)
	{
		log_message('debug', __METHOD__ .' try to update DB with new razon social username for today...');

		if( is_array($parameters) )
		{
			if( count($parameters) < 2) 
			{
				log_message('error', __METHOD__ .' no tengo el minimo de parametros ( username=>xxx,  nombre=>nombre  .. ');
				return FALSE;
			}
			if( ! array_key_exists('username', $parameters) )
			{
				log_message('error', __METHOD__ .' no tengo el rif de los parametros ( username=>xxx, .. ');
				return FALSE;
			}
		}
		if( !is_array($parameters) )
		{
			log_message('error', __METHOD__ .' parametros no son en arreglo ( username=>xxx,  nombre=>nombre  .. ');
			return FALSE;
		}

		$columns1 = 'username, userkey, userstatus, sessionflag, sessionficha';
		$paramnames1 =  explode(',',preg_replace('/\s+/', '', $columns1));
		$sqlfilter1 = '';
		$datatabla1 = array();
		log_message('debug', __METHOD__ .' verificando parametros : '.var_export($paramnames1,TRUE).' valor '.var_export($parameters,TRUE));
		foreach ($paramnames1 as $indicecolumnas=>$namecolum)
		{
			if( array_key_exists($namecolum, $parameters) )
			{
				$$namecolum = $parameters[$namecolum];
				log_message('info', __METHOD__ .' verificando para columna : '.var_export($namecolum,TRUE).' valor '.$$namecolum);
				// DB security https://gitlab.com/codeigniterpower/codeigniter-currencylib/-/issues/5#note_1274873229
				$validvalue = preg_match('/^[0-9A-Za-z\s\-\_]+$/', $$namecolum);
				$validnonze = $this->form_validation->required($$namecolum);
				if( $validvalue == FALSE OR $validnonze == FALSE)
				{
					log_message('info', __METHOD__ .' detectado un dato no permitido o intento de ataque: '.var_export($validvalue,TRUE).' for '.$$namecolum);
					return FALSE;
				}
				$datatabla1[$namecolum]=$$namecolum;
			}
			else
				log_message('info', __METHOD__ .' fallo para columna : '.var_export($namecolum,TRUE).' valor no existe o no vino el parametro');
		}

		$sqlinserttofil1 = ' 1=1 ';
		$sqlinserttorun1 = '';
		$rowcheck = $this->usuarioDetalle($username);
		if(is_array($rowcheck))
		{
			log_message('debug', __METHOD__ .' verificado en la DB ' . print_r($rowcheck, TRUE));
			$wehave = count($rowcheck);
			if( $wehave > 0 )
			{
				log_message('debug', __METHOD__ .' este usuario ya existe ' . print_r($username, TRUE));
				$sqlinserttofil1 .= ' AND username="'.$username.'"';
				$datatabla1['sessionflag']=date('YmdHis');
				$sqlinserttorun1 = $this->dba->update_string('reten_usuarios',$datatabla1,$sqlinserttofil1);
			}
			else
			{
				log_message('debug', __METHOD__ .' este usuario es nuevo ' . print_r($username, TRUE));
				$datatabla1['sessionficha']=date('YmdHis');
				$sqlinserttorun1 = $this->dba->insert_string('reten_usuarios',$datatabla1);
			}
		}
		log_message('debug', __METHOD__ .' SQL: ' . print_r($sqlinserttorun1, TRUE));

		$this->dba->trans_start();
			$this->dba->query($sqlinserttorun1);
		$this->dba->trans_complete();

		if ($this->dba->trans_status() === FALSE)
		{
			$error = $this->dba->error();
			$qu = $this->dba->last_query();
			log_message('error', __METHOD__ .' DB problem : ' . print_r($error, TRUE) . ' why: '.print_r($qu, TRUE));
			$resultdbstatus = FALSE;
		}
		else
		{
			log_message('info', __METHOD__ .' DB registro ya puesto en la DB admindb ');
			$resultdbstatus = TRUE;
		}

		return $resultdbstatus;
	}



	/**
	 * elimina un acceso en la tabla de reten_usuarios y de reten_usuarios_modulos
	 *
	 * @access	public
	 * @param	string  $username
	 * @return	boolean FALSE on errors TRUE on sucess
	 */
	public function accessDelete($username = NULL)
	{
		log_message('debug', __METHOD__ .' try to update DB with new razon social username for today...');

		$validvalue = preg_match('/^[0-9A-Za-z\s\-]+$/', $username);
		$validnonze = $this->form_validation->required($username);
		if( $validvalue == FALSE OR $validnonze == FALSE)
		{
			log_message('info', __METHOD__ .' detectado un dato no permitido o intento de ataque: '.var_export($validvalue,TRUE).' for '.$$namecolum);
			return FALSE;
		}

		$sqlinserttofil = ' 1=1 ';
		$sqlinserttorun1 = 'DELETE FROM reten_usuarios_modulos WHERE username="'.$username.'"';
		$sqlinserttorun2 = 'DELETE FROM reten_usuarios WHERE username="'.$username.'"';

		$this->dba->trans_start();
			$this->dba->query($sqlinserttorun1);
			$this->dba->query($sqlinserttorun2);
		$this->dba->trans_complete();

		if ($this->dba->trans_status() === FALSE)
		{
			$error = $this->dba->error();
			$qu = $this->dba->last_query();
			log_message('error', __METHOD__ .' DB problem : ' . print_r($error, TRUE) . ' why: '.print_r($qu, TRUE));
			$resultdbstatus = FALSE;
		}
		else
		{
			log_message('info', __METHOD__ .' DB registro ya eliminado en la DB admindb ');
			$resultdbstatus = TRUE;
		}

		return $resultdbstatus;
	}


}
