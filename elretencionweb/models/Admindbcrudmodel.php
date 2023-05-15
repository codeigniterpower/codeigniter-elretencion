<?php 
/**
 * Admindbcrudmodel.php
 * 
 * abstraction DB para manejar tablas crudas en admindb
 *
 * @author  PICCORO Lenz McKAY <mckaygerhard@gmail.com>
 * @copyright Copyright 2017
 * @version ab - 1.0
 * 
 * This program is free software; BUT you can redistribute it and/or modify
 * it under the terms of the CC-BY-NC-SA License
 * 
 */
class Admindbcrudmodel extends CI_Model 
{

	private $tabledb;
	private $tablepk;
	private $CI; // CodeIgniter object

	public function __construct() 
	{
		parent::__construct();
		$this->dba = $this->load->database('eladmindb', TRUE);
		$this->tabledb = 'adm_juridico';
		$this->tablepk = 'cod_juridico';
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
	 * obtiene todas las razones sociales listadas desde la DB de eladmindb, usando la tabla amd_juridico
	 *
	 * @access	public
	 * @param	array  $filters (0[col1, value], 1[col2, value]), valid cols: check table reference `cur_moneda`
	 * @return	boolean FALSE on errors
	 */
	public function readRazonesSociales($paramfilters = NULL)
	{
		$columns = 'cod_juridico, cod_denominacion, nombre_legal, direccion_comercial, nombre_comercial, tipo_juridico, ficha, sessionficha, sessionflag';
		return $this->crudReadTable('adm_juridico', $paramfilters, $columns, 'cod_juridico');
	}

	/**
	 * metodo completo para 
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
	 * guarda una nueva Razon Social en la tabla de razones sociales o actualiza si el filtro cod_juridico es valido
	 *
	 * @access	public
	 * @param	array  $parameters ( cod_juridico=>xxx,  nombre=>nombre  .. )
	 * @return	boolean FALSE on errors
	 */
	public function setupRazonSocial($parameters = NULL)
	{
		log_message('debug', __METHOD__ .' try to update DB with new razon social cod_juridico for today...');

		if( is_array($parameters) )
		{
			if( count($parameters) < 2) 
			{
				log_message('error', __METHOD__ .' no tengo el minimo de parametros ( cod_juridico=>xxx,  nombre=>nombre  .. ');
				return FALSE;
			}
			if( ! array_key_exists('cod_juridico', $parameters) )
			{
				log_message('error', __METHOD__ .' no tengo el rif de los parametros ( cod_juridico=>xxx, .. ');
				return FALSE;
			}
		}
		if( !is_array($parameters) )
		{
			log_message('error', __METHOD__ .' parametros no son en arreglo ( cod_juridico=>xxx,  nombre=>nombre  .. ');
			return FALSE;
		}

		$columns = 'cod_juridico, cod_denominacion, nombre_legal, direccion_comercial, nombre_comercial, tipo_juridico, ficha';
		$paramnames =  explode(',',preg_replace('/\s+/', '', $columns));
		$sqlfilter = '';
		$datatabla = array();
		log_message('debug', __METHOD__ .' verificando parametros : '.var_export($paramnames,TRUE).' valor '.var_export($parameters,TRUE));
		foreach ($paramnames as $indicecolumnas=>$namecolum)
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
				$datatabla[$namecolum]=$$namecolum;
			}
			else
				log_message('info', __METHOD__ .' fallo para columna : '.var_export($namecolum,TRUE).' valor no existe o no vino el parametro');
		}

		$sqlinserttofil = ' 1=1 ';
		$sqlinserttorun = $this->dba->insert_string('adm_juridico',$datatabla);
		$rowcheck = $this->readRazonesSociales(array('cod_juridico'=>$cod_juridico));
		if(is_array($rowcheck))
		{
			log_message('debug', __METHOD__ .' verificado en la DB ' . print_r($rowcheck, TRUE));
			$wehave = count($rowcheck);
			if( $wehave > 0 )
			{
				log_message('debug', __METHOD__ .' este rif ya existe ' . print_r($cod_juridico, TRUE));
				//$this->closedb();
				//return FALSE;
				$sqlinserttofil .= ' AND cod_juridico="'.$cod_juridico.'"';
				$sqlinserttorun = $this->dba->update_string('adm_juridico',$datatabla,$sqlinserttofil);
			}
		}
		log_message('debug', __METHOD__ .' SQL: ' . print_r($sqlinserttorun, TRUE));

		$this->dba->trans_start();
		// ideal code for bulk inserts, but this app is for no so many people using.. administrative one
		//foreach ($strsqli as $sqlinserttorunbulk)
			$this->dba->query($sqlinserttorun);
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
	 * elimina una existente Razon Social en la tabla de razones sociales o actualiza si el filtro cod_juridico es valido
	 *
	 * @access	public
	 * @param	array  $parameters ( cod_juridico=>xxx,  nombre=>nombre  .. )
	 * @return	boolean FALSE on errors
	 */
	public function deletRazonSocial($parameters = NULL)
	{
		log_message('debug', __METHOD__ .' try to update DB with new razon social cod_juridico for today...');

		if( is_array($parameters) )
		{
			if( count($parameters) < 1) 
			{
				log_message('error', __METHOD__ .' no tengo el minimo de parametros ( cod_juridico=>xxx,  nombre=>nombre  .. ');
				return FALSE;
			}
			if( ! array_key_exists('cod_juridico', $parameters) )
			{
				log_message('error', __METHOD__ .' no tengo el rif de los parametros ( cod_juridico=>xxx, .. ');
				return FALSE;
			}
		}
		if( !is_array($parameters) )
		{
			log_message('error', __METHOD__ .' parametros no son en arreglo ( cod_juridico=>xxx,  nombre=>nombre  .. ');
			return FALSE;
		}

		$cod_juridico = $parameters['cod_juridico'];
		$validvalue = preg_match('/^[0-9A-Za-z\s\-]+$/', $cod_juridico);
		$validnonze = $this->form_validation->required($cod_juridico);
		if( $validvalue == FALSE OR $validnonze == FALSE)
		{
			log_message('info', __METHOD__ .' detectado un dato no permitido o intento de ataque: '.var_export($validvalue,TRUE).' for '.$$namecolum);
			return FALSE;
		}
		

		$sqlinserttofil = ' 1=1 ';
		$sqlinserttorun = 'DELETE FROM adm_juridico WHERE cod_juridico="'.$cod_juridico.'"';

		$this->dba->trans_start();
		// ideal code for bulk inserts, but this app is for no so many people using.. administrative one
		//foreach ($strsqli as $sqlinserttorunbulk)
			$this->dba->query($sqlinserttorun);
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