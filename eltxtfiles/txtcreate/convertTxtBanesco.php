<?php
/*
 * convertTxtBanesco.php
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
 * name: convertCsvToTxt
 * @param string ruta al archivo conv ertir
 * @return N/A : escribe archivo xml
 * 
 */
function convertCsvToTxt($csv_string) {                                                         //|
    $lines =  fopen($csv_string, 'rt');                                                         //|
    echo var_dump($lines);                                                                      //|
    $cont = 0;               
    $txt = fopen("txtCreated.txt", "w+");
    $contLines = 1;
// ------------------------------------///////////////////////------------------------------------
    while(!feof($lines)){                                                                       //|
        $line = fgets($lines);                                                                  //|
        $content = explode('#',$line); 
        $valorcol1 = '';
        if($cont>6){
            if ($cont >7){
                $id =  str_pad($contLines, 8, 0, STR_PAD_LEFT);
                $type    = str_pad(3, 2, 0, STR_PAD_LEFT);
                $idTotal = str_pad($type,  10,$id); 
                $valorcol1 .= completar_codigo($idTotal,32,' ');
            }
            if($cont == 7)
                $valorcol1 .= completar_codigo($content[1], 32, ' ');

            $valorcol1 .= completar_codigo($content[2], 33, ' ');
            $valorcol1 .= completar_codigo($content[3], 48, ' ');
            $valorcol1 .= completar_codigo($content[4], 14, ' ');
            $valorcol1 .= completar_codigo($content[5], 17, ' ');
            $valorcol1 .= completar_codigo($content[6], 70, ' ');
            fwrite($txt,"\n");
            fwrite($txt,$valorcol1);
            $contLines+=1; 
        }

        $cont+=1;
    }            
    fclose($txt);
    // echo $cont;                                                                               //|
// ------------------------------------///////////////////////------------------------------------
}        

/*
* recibe un codigo y rellena con el caracter al inicio de la cadena
* name: completar_codigo
* @param string $incodigo
* @return string
*/
function completar_codigo($incodigo ='', $digitos = 10, $caracter = ' ')
{
    $excodigo=$incodigo;
    $tam=strlen($incodigo);
    if(strlen($incodigo)<$digitos)
    {
        $fin = $digitos - $tam ;
        for ($i= 1; $i<= $fin; $i++ )
            $excodigo= $caracter.$excodigo;
    }
    if(strlen($incodigo)>$digitos)
        $excodigo=substr($incodigo,-1,$digitos);
    return $excodigo;
}//|
convertCsvToTxt("/home/general/Devel/codeigniter-xmlislr/eltxtfiles/txtcreate/DataEntryenBsS1.csv");                              //|