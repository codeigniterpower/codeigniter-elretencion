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
 * Accesscrudmodel.php
 * 
 * abstraction DB para manejar acessos aparte de la clase de auth de autenticacion
 *
 * @copyright Copyright 2023
 * @package    CodeIgniter
 * @category   Files
 * @version    1.0.0-dev
 * @author     PICCORO Lenz McKAY
 * @link       https://gitlab.com/codeigniterpower/codeigniter-login
 */
class Accesscrudmodel extends CI_Model 
{

	private $tabledb;
	private $tablepk;
	private $CI; // CodeIgniter object

	public function __construct() 
	{
		parent::__construct();
		$this->dba = $this->load->database('elretenciondb', TRUE);
		$this->tabledb = 'reten_usuarios';
		$this->tablepk = 'username';
		$this->CI =& get_instance();
		$this->CI->load->library('form_validation');
	}

	/** auto close db on production */
	private function closedb()
	{
		if( stripos(ENVIRONMENT,'production') > 0 )
		{
			$this->dba->close();
			$this->dba = NULL;
		}
	}

	/**
	 * obtiene todos los usuarios desde la DB de eladmindb, usando la tabla reten_usuarios
	 *
	 * @access	public
	 * @param	array  $filters (0[col1, value], 1[col2, value]), valid cols: check table reference `cur_moneda`
	 * @return	boolean FALSE on errors
	 */
	public function readAccessos($paramfilters = NULL)
	{
		$columns = 'username, userkey, userstatus, sessionflag, sessionficha';
		return $this->crudReadTable('reten_usuarios', $paramfilters, $columns, 'username');
	}

	/**
	 * obtiene todas accesos y permisos desde la DB de eladmindb, usando la tabla reten_usuarios_modulos
	 *
	 * @access	public
	 * @param	array  $filters (0[col1, value], 1[col2, value]), valid cols: check table reference `cur_moneda`
	 * @return	boolean FALSE on errors
	 */
	public function readAccessosModulos($paramfilters = NULL)
	{
		$columns = 'username, modulo_string, sessionflag, sessionficha';
		return $this->crudReadTable('reten_usuarios_modulos', $paramfilters, $columns, 'username');
	}

	/**
	 * metodo completo para obtener data de una tabla segun sus columnas y nombre de tabla
	 * 
	 * @access	public
	 * @param	string  $tablename
	 * @param	array  $paramfilters (0[col1, value], 1[col2, value]), valid cols: check table reference `cur_moneda`
	 * @param	string  $columns [col1, col2, col3] or null or empty
	 * @return	boolean FALSE on errors
	 */
	public function crudReadTable($tablename, $paramfilters = NULL, $columns = NULL, $tablepk = NULL)
	{
		$tablename = trim($tablename);
		$validtn = $this->form_validation->alpha_dash($tablename);
		if($validtn == FALSE)
		{
			log_message('error', __METHOD__ .' invalid table name or DB error for ');
			return FALSE;
		}
		$this->tabledb = $tablename;
		$validpk = $this->form_validation->alpha_dash($tablepk);
		if($validpk) 
		{
			$tablepk = trim($tablepk);
			$this->tablepk = $tablepk;
		}
		log_message('debug', __METHOD__ .' parameters  t:'.print_r($tablename,TRUE).' f:' . var_export($paramfilters, TRUE) );
		$querysql1 = "SELECT * FROM ".$tablename;
		$sqlrs = $this->dba->query($querysql1);
		if($sqlrs == FALSE)
		{
			log_message('error', __METHOD__ .' invalid data or DB error for '. print_r($tablename,TRUE));
			return FALSE;
		}
		$sqldata = $sqlrs->result_array();
		$columns = trim($columns);
		$validcn = $this->form_validation->alpha_dash($columns);
		if( $validcn == FALSE)
		{
			log_message('debug', __METHOD__ .' fetch data, no columns selection from '. print_r($tablename,TRUE));
			if(count($sqldata) < 1)
			{
				log_message('debug', __METHOD__ .' no data in table '. print_r($tablename,TRUE));
				return $sqldata;
			}
			$coluymnsarray = array_keys($sqldata[0]);
			$columns = implode(',',$coluymnsarray);
		}
		if(!is_array($paramfilters) OR $paramfilters == NULL)
		{
			log_message('debug', __METHOD__ .' no filters provided for '. print_r($tablename,TRUE));
			return $sqldata;
		}
		log_message('debug', __METHOD__ .' double query prepare for filtering on '. print_r($tablename,TRUE));
		$paramnames =  explode(',',$columns);
		$sqlfilter = '  ';
		foreach ($paramnames as $indicecolumnas=>$namecolum)
		{
			if( array_key_exists($namecolum, $paramfilters) )
			{
				$$namecolum = $paramfilters[$namecolum];
				// DB security https://gitlab.com/codeigniterpower/codeigniter-currencylib/-/issues/5#note_1274873229
				$validvalue = preg_match('/^[0-9A-Za-z\s\-]+$/', $$namecolum);
				$validnonze = $this->form_validation->required($$namecolum);
				if( $validvalue != FALSE AND $validnonze != FALSE)
					$sqlfilter .= ' AND '.$namecolum.'="'.$$namecolum.'"';
				else
					log_message('info', __METHOD__ .' detected invalid input or injection attack: '.var_export($$namecolum,TRUE).' for '.$namecolum);
			}
		}
		$querysql1 = "SELECT ".$columns." FROM ".$tablename." WHERE 1=1 ".$sqlfilter ;
		$sqlrs = $this->dba->query($querysql1);
		if($sqlrs == FALSE)
		{
			log_message('error', __METHOD__ .' invalid filters, column or DB error for '. print_r($tablename,TRUE));
			return FALSE;
		}
		$arreglo_data = $sqlrs->result_array();
		log_message('debug', __METHOD__ .' return '.$tablename.' data '. print_r($arreglo_data,TRUE));
		$this->closedb();
		return $arreglo_data;
	}

	/**
	 * guarda un nuevo acceso en la tabla de razones sociales o actualiza si el filtro username es valido
	 *
	 * @access	public
	 * @param	array  $parameters ( username=>xxx,  nombre=>nombre  .. )
	 * @return	boolean FALSE on errors
	 */
	public function setupAccessos($parameters = NULL)
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
				$validvalue = preg_match('/^[0-9A-Za-z\s\-]+$/', $$namecolum);
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
		$sqlinserttorun1 = $this->dba->insert_string('reten_usuarios',$datatabla1);
		$rowcheck = $this->readAccessos(array('username'=>$username));
		if(is_array($rowcheck))
		{
			log_message('debug', __METHOD__ .' verificado en la DB ' . print_r($rowcheck, TRUE));
			$wehave = count($rowcheck);
			if( $wehave > 0 )
			{
				log_message('debug', __METHOD__ .' este usuario ya existe ' . print_r($username, TRUE));
				$sqlinserttofil1 .= ' AND username="'.$username.'"';
				$sqlinserttorun1 = $this->dba->update_string('reten_usuarios',$datatabla1,$sqlinserttofil1);
			}
		}
		log_message('debug', __METHOD__ .' SQL: ' . print_r($sqlinserttorun1, TRUE));

		$columns2 = 'username, modulo_string, sessionflag, sessionficha';
		$paramnames2 =  explode(',',preg_replace('/\s+/', '', $columns2));
		$sqlfilter2 = '';
		$datatabla2 = array();
		log_message('debug', __METHOD__ .' verificando parametros : '.var_export($paramnames2,TRUE).' valor '.var_export($parameters,TRUE));
		foreach ($paramnames2 as $indicecolumnas=>$namecolum)
		{
			if( array_key_exists($namecolum, $parameters) )
			{
				$$namecolum = $parameters[$namecolum];
				log_message('info', __METHOD__ .' verificando para columna : '.var_export($namecolum,TRUE).' valor '.$$namecolum);
				// DB security https://gitlab.com/codeigniterpower/codeigniter-currencylib/-/issues/5#note_1274873229
				$validvalue = preg_match('/^[0-9A-Za-z\s\-]+$/', $$namecolum);
				$validnonze = $this->form_validation->required($$namecolum);
				if( $validvalue == FALSE OR $validnonze == FALSE)
				{
					log_message('info', __METHOD__ .' detectado un dato no permitido o intento de ataque: '.var_export($validvalue,TRUE).' for '.$$namecolum);
					return FALSE;
				}
				$datatabla2[$namecolum]=$$namecolum;
			}
			else
				log_message('info', __METHOD__ .' fallo para columna : '.var_export($namecolum,TRUE).' valor no existe o no vino el parametro');
		}

		$sqlinserttofil2 = ' 1=1 ';
		$sqlinserttorun2 = $this->dba->insert_string('reten_usuarios',$datatabla2);
		$rowcheck = $this->readAccessosModulos(array('username'=>$username));
		if(is_array($rowcheck))
		{
			log_message('debug', __METHOD__ .' verificado en la DB ' . print_r($rowcheck, TRUE));
			$wehave = count($rowcheck);
			if( $wehave > 0 )
			{
				log_message('debug', __METHOD__ .' este usuario ya existe ' . print_r($username, TRUE));
				$sqlinserttofil2 .= ' AND username="'.$username.'"';
				$sqlinserttorun2 = $this->dba->update_string('reten_usuarios',$datatabla2,$sqlinserttofil2);
			}
		}
		log_message('debug', __METHOD__ .' SQL: ' . print_r($sqlinserttorun2, TRUE));


		$this->dba->trans_start();
		// ideal code for bulk inserts, but this app is for no so many people using.. administrative one
		//foreach ($strsqli as $sqlinserttorunbulk)
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
			log_message('info', __METHOD__ .' DB registro ya puesto en la DB admindb ');
			$resultdbstatus = TRUE;
		}

		$this->closedb();
		return $resultdbstatus;
	}

	/**
	 * elimina un acceso en la tabla de usuarios y de permisos o actualiza si el filtro username es valido
	 *
	 * @access	public
	 * @param	array  $parameters ( username=>xxx,  nombre=>nombre  .. )
	 * @return	boolean FALSE on errors
	 */
	public function deleteAcceso($parameters = NULL)
	{
		log_message('debug', __METHOD__ .' try to update DB with new razon social username for today...');

		if( is_array($parameters) )
		{
			if( count($parameters) < 1) 
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

		$username = $parameters['username'];
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

		$this->closedb();
		return $resultdbstatus;
	}


}
