<?php
/**
 * Copyright 2023 Angel Gonzalez Gmail:ag5193407@gmail.com  , Gitlab 1:@Radioactive99
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
defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Convertxml Class
 *
 * @package    CodeIgniter
 * @subpackage Libraries
 * @category   Files
 * @version    1.0.0-dev
 * @author     Angel Gonzalez Gmail:ag5193407@gmail.com , Gitlab 1:@Radioactive99
 * @link       https://gitlab.com/codeigniterpower/codeigniter-eltxt/-/blob/master/assets/xmlcreate/convertXml.php
 */
class Convertxml
{

	public function __construct($params = NULL)
	{
		// Do something with $params
	}

	/**
	 * name: convertCsvToXmlString
	 * @param string ruta al archivo conv ertir
	 * @return N/A : escribe archivo xml misma ruta
	 * 
	 */
	function convertCsvToXmlString($filepath)
	{
		// revision de fichero existe y se accede
		$proceed = is_file($filepath);
		if(! $proceed)
		{
			log_message('error','file access error or no file valid provided '.$filepath);
			$data = array();
			$data['result'] = 'error';
			$data['message'] = 'file access error or no file valid provided';
			$result = json_encode($data);
			return $result;
		}
		// revision de fichero existe y se accede
		$proceed = is_readable($filepath);
		if(! $proceed)
		{
			log_message('error','file read error or no file valid provided '.$filepath);
			$data = array();
			$data['result'] = 'error';
			$data['message'] = 'file read error or no file valid provided';
			$result = json_encode($data);
			return $result;
		}

		log_message('info','procesando '.$filepath);
		$file_path = realpath($filepath);
		$file_name = basename($filepath,'.txt');
		$file_dirn = dirname($filepath);
		$file_xmln = $file_name.'.xml';
		$lines =  fopen($filepath, 'rt');
		$separator = ',';
		log_message('info','archivo '.$file_name.' ruta '.$file_path.' directorio '.$file_dirn);

		$dom = new DOMDocument();
		$dom->encoding = 'utf-8';
		$dom->xmlVersion = '1.0';
		$dom->formatOutput = true;
		$generateroot = FALSE;


		while(!feof($lines))
		{
			$line = fgets($lines);
			log_message('debug','procesing line '.$line);

			$validfileline = strpos($line, $separator);
			if($validfileline == FALSE)
			{
				log_message('error','the line is not inf format.. avoiting '.$line);
				continue;
			}
			
			$content = explode($separator,$line);

			if($generateroot == FALSE)
			{
				$root = $dom->createElement('RelacionRetencionesISLR');
				$rifAgente = new DOMAttr('RifAgente', 'e');
				$root->setAttributeNode($rifAgente);
				$periodo = new DOMAttr('Periodo', $content[1]);
				$root->setAttributeNode($periodo);
				$generateroot = TRUE;
			}

			$detalleRetencion = $dom->createElement('DetalleRetencion');
			$rifRetenido = $dom->createElement('RifRetenido',$content[6]);
			$detalleRetencion->appendChild($rifRetenido);
			$numeroFactura = $dom->createElement('NumeroFactura', $content[7]);
			$detalleRetencion->appendChild($numeroFactura);
			$numeroControl = $dom->createElement('NumeroControl', $content[8]);
			$detalleRetencion->appendChild($numeroControl);
			$fechaOperacion = $dom->createElement('FechaOperacion',$content[3]);
			$detalleRetencion->appendChild($fechaOperacion);
			$codigoConcepto = $dom->createElement('CodigoConcepto', $content[4]);
			$detalleRetencion->appendChild($codigoConcepto);
			$montoOperacion = $dom->createElement('MontoOperacion', $content[9]);
			$detalleRetencion->appendChild($montoOperacion);
			$porcentajeRetencion = $dom->createElement('PorcentajeRetencion', $content[15]);
			$detalleRetencion->appendChild($porcentajeRetencion);
			$root->appendChild($detalleRetencion);
			$dom->appendChild($root);
		}

		$filewrite = $dom->save($file_dirn.'/'.$file_xmln);
		$result = 'success';
		if($filewrite == false)
			$result = 'error';
		$data = array();
		$data['result'] = $result;
		$data['message'] = $filewrite;
		$result = json_encode($data);
		return $result;
	}
}
