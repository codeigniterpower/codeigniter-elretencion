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
 * Retencionesmodel Class de abstraccion para la db "elretenciondb"
 *
 * @package    CodeIgniter
 * @category   Files
 * @version    1.0.0-dev
 * @author     PICCORO Lenz McKAY
 * @link       https://gitlab.com/codeigniterpower/codeigniter-elretencion
 */
class Retencionesmodel extends CI_Model 
{
	private $tabledb;
	private $tablepk;
	private $CI; // CodeIgniter object

	public function __construct() 
	{
		parent::__construct();
		$this->dba = $this->load->database('elretenciondb', TRUE);
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
	 * obtiene todas las reteciones como listado de registros
	 *
	 * @access	public
	 * @param	array  $paramnames ('columname'=>'value'[,'columname'=>'value',..])
	 * @param	string  $sqllimit cuantos registros devuelve en esta consulta
	 * @param	string  $sqloffset a partir de cual indice o registro se lista el resultado
	 * @param	string  $ordercol nombre de la columna que ordena los registros
	 * @param	string  $sorting ordenacion que usara DESC o ASC
	 * @return	mixed FALSE on errors
	 */
	public function readRetenciones($parameters = NULL, $sqllimit = NULL, $sqloffset = NULL, $ordercol = NULL, $sorting = NULL, $countall = NULL)
	{
		$table = 'reten_retenciones_registros';
		$tablepk = 'cod_retencion';
		$columns = 'cod_retencion, num_comprobante, fecha_operacion_retencion, fecha_periodo_fiscal, cod_juridico_retencion, cod_juridico_retenido, mon_objeto_retencion, num_porcentaje_tasa, mon_retenido_iva_o_islr, mon_retencion_acumulada, mon_retenido_iva_o_acumulado, tipo_retencion, sessionflag, sessionficha';
		$limiters = array();
		$limiters['sqllimit'] = $sqllimit; // limit
		$limiters['sqloffset'] = $sqloffset; // offset
		$limiters['ordercol'] = $ordercol; // colum
		$limiters['sorting'] = $sorting; // order
		$arraydata = $this->crudReadTable($table, $parameters, $columns, $tablepk, $limiters);
		log_message('debug', __METHOD__ .' data from DB received for history');
		return $arraydata;
	}

	/**
	 * obtiene listado de la tabla en crudo
	 *
	 * @access	public
	 * @param	string  $tabla nombre de la talba a consultar con simple select
	 * @param	array   $parametros  (0[col1, value], 1[col2, value]), optional pueden ser varios en arreglo
	 * @param	string  $columnas nombre de las columnas separadas por coma
	 * @param	string  $tablepk nombre de las clumna con pk
	 * @param	array   $limiters ( [sqllimit, value], [sqloffset, value] [ordercol, value], [sorting, value], [countall, T/F])
	 * @return	mixed FALSE on errors
	 */
	public function crudReadTable($tablename, $paramfilters = NULL, $columns = NULL, $tablepk = NULL, $limiters = NULL)
	{
		// table detection
		$tablename = trim($tablename);
		$validtn = preg_match('/^[0-9A-Za-z\s\-_,]+$/', $tablename);
		if($validtn == FALSE)
		{
			log_message('error', __METHOD__ .' invalid table name or DB error for ');
			return FALSE;
		}
		$this->tabledb = $tablename;
		// table pk detection
		$validpk = preg_match('/^[0-9A-Za-z\s\-_,]+$/', $tablepk);
		if($validtn == FALSE)
		{
			$tablepk = 'cod_'.trim($tablename);
			$this->tablepk = $tablepk;
			log_message('debug', __METHOD__ .' invalid table pk name, set to default as '.$tablepk);
		}
		else
		{
			$tablepk = trim($tablepk);
			$this->tablepk = $tablepk;
			log_message('debug', __METHOD__ .' valid table pk name, set to default as '.$tablepk);
		}
		// valid table and/or valid data of table detection
		log_message('debug', __METHOD__ .' parameters  t:'.print_r($tablename,TRUE).' f:' . var_export($paramfilters, TRUE) );
		$querysql1 = "SELECT * FROM ".$tablename;
		$sqlrs = $this->dba->query($querysql1);
		if($sqlrs == FALSE)
		{
			log_message('error', __METHOD__ .' invalid data, table invalid or DB error for '. print_r($tablename,TRUE));
			return FALSE;
		}
		$sqldata = $sqlrs->result_array();
		// table cloumns detection
		$validcn = preg_match('/^[0-9A-Za-z\s\-_,]+$/', $columns);
		if( $validcn == FALSE or $columns == NULL)
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
		$columns = preg_replace("/\s+/", "", $columns);
		// amount of results and offset sql detection
		$queryfiltro = ' ORDER BY '.$tablepk . ' DESC';
		if(is_array($limiters) )
		{
			if( array_key_exists('countall', $limiters) )
			{
				$countall = $limiters['countall'];
				if( is_null($countall) !== TRUE AND empty($countall) !== TRUE ) // no need to spaced, we just detect if present
				$columnssql = 'count('.$tablepk.') as '.$tablepk;
			}
			if( array_key_exists('ordercol', $limiters) )
			{
				$ordercol = $limiters['ordercol'];
				$validvalue = preg_match('/^[a-zA-Z0-9\-_,]{1,40}+$/i', $ordercol);
				if( $validvalue == FALSE)
					$ordercol = $tablepk;
				$queryfiltro .= ' ORDER BY '.$ordercol;

				if( array_key_exists('sorting', $limiters) )
				{
					$sorting = $limiters['sorting'];
					$validvalue = preg_match('/^[a-zA-Z0-9\-_,]{1,40}+$/i', $sorting);
					if( $validvalue == FALSE)
						$sorting = ' DESC';
					$queryfiltro .= ' '.$sorting;
				}
				else
					$queryfiltro .= ' DESC';
			}
			else
				$queryfiltro .= ' ORDER BY '.$tablepk.' DESC';
			if( array_key_exists('sqllimit', $limiters) )
			{
				$howmany = $limiters['sqllimit'];
				$validvalue = preg_match('/^[0-9]{1,}+$/i', $howmany);
				if( $validvalue )
				{
					if( array_key_exists('sqloffset', $limiters) )
					{
						$iniciar = $limiters['sqloffset'];
						$validvalue = preg_match('/^[0-9]{1,}+$/i', $iniciar);
						if( $validvalue == FALSE )
							$iniciar = 0;
						if($iniciar < $howmany)
							$howmany = 50;
					}
					$queryfiltro .= ' LIMIT '.$howmany;
					$queryfiltro .= ' OFFSET '.$iniciar;
				}
			}
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
		$querysql1 = "SELECT ".$columns." FROM ".$tablename." WHERE 1=1 ".$sqlfilter.$queryfiltro;
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


}
