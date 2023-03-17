<?php
/*
 * convertXml.php
 * 
 * Copyright 2023 Angel Gonzalez Instagram:Angel_gonzalez_dev , Gitlab 1:@Radioactive99
 * Copyright 2023 PICCORO Lenz McKAY mckaygerhard
 * 
    ------------------------------------///////////////////////------------------------------------
    /                                                                                           //|
        *Author: Angel Gonzalez                                                                 //|
        *Alias Name: Radioactive99                                                              //|
        *Gitlab 1:@Radioactive99                                                                //|
        *Contact Instagram:Angel_gonzalez_dev                                                   //|
        *                                                                                       //|
    /                                                                                           //|
    ------------------------------------///////////////////////------------------------------------
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
 * 
 * name: convertCsvToXmlString
 * @param string ruta al archivo conv ertir
 * @return N/A : escribe archivo xml
 * 
 */
function convertCsvToXmlString($csv_string) {                                                   //|
    $lines =  fopen($csv_string, 'rt');                                                         //|
    echo var_dump($lines);                                                                      //|
	$dom = new DOMDocument();                                                                   //|
    $dom->encoding = 'utf-8';                                                                   //|
    $dom->xmlVersion = '1.0';                                                                   //|
	$dom->formatOutput = true;                                                                  //|
	$xml_file_name = 'movies_list2.xml';                                                        //|
	$root = $dom->createElement('RelacionRetencionesISLR');                                     //|
	$rifAgente = new DOMAttr('RifAgente', '5467');                                              //|
	$root->setAttributeNode($rifAgente);                                                        //|
	$periodo = new DOMAttr('Periodo', '54');                                                    //|
	$root->setAttributeNode($periodo);                                                          //|
// ------------------------------------///////////////////////------------------------------------
    while(!feof($lines)){                                                                       //|
        $line = fgets($lines);                                                                  //|
        $content = explode('#',$line);                                                          //|
        $detalleRetencion = $dom->createElement('DetalleRetencion');                            //|
        $rifRetenido = $dom->createElement('RifRetenido',$content[0]);                          //|
        $detalleRetencion->appendChild($rifRetenido);                                           //|
        $numeroFactura = $dom->createElement('NumeroFactura', $content[1]);                     //|
        $detalleRetencion->appendChild($numeroFactura);                                         //|
        $numeroControl = $dom->createElement('NumeroControl', $content[2]);                     //|
        $detalleRetencion->appendChild($numeroControl);                                         //|
        $fechaOperacion = $dom->createElement('FechaOperacion',$content[3]);                    //|
        $detalleRetencion->appendChild($fechaOperacion);                                        //|
        $codigoConcepto = $dom->createElement('CodigoConcepto', $content[4]);                   //|
        $detalleRetencion->appendChild($codigoConcepto);                                        //|
        $montoOperacion = $dom->createElement('MontoOperacion', $content[5]);                   //|
        $detalleRetencion->appendChild($montoOperacion);                                        //|
        $porcentajeRetencion = $dom->createElement('PorcentajeRetencion', $content[6]);         //|
        $detalleRetencion->appendChild($porcentajeRetencion);                                   //|
        $root->appendChild($detalleRetencion);                                                  //|
        $dom->appendChild($root);                                                               //|
    }                                                                                           //|
// ------------------------------------///////////////////////------------------------------------
    $dom->save($xml_file_name);                                                                 //|
	echo "$xml_file_name has been successfully created";                                        //|
}                                                                                               //|
convertCsvToXmlString("/home/general/Devel/codeigniter-eltxt/eltxtfiles/xmlcreate/example.csv");                              //|
