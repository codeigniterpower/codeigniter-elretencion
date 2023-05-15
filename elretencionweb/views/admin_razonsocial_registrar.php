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
/**
 * Convertxml Class
 *
 * @package    CodeIgniter
 * @subpackage Libraries
 * @category   Files
 * @version    1.0.0-dev
 * @author     Angel Gonzalez Gmail:ag5193407@gmail.com  , Gitlab 1:@Radioactive99
 * @link       https://gitlab.com/codeigniterpower/codeigniter-eltxt/-/blob/master/assets/xmlcreate/convertXml.php
 */

	if( !isset($rs_nombre_comercial) ) $rs_nombre_comercial = '';
	if( !isset($rs_nombre_legal) ) $rs_nombre_legal = '';
	if( !isset($rs_cod_juridico) ) $rs_cod_juridico = ''; // RIF registro inf fiscal
	if( !isset($rs_direccion_comercial) ) $rs_direccion_comercial = '';
	if( !isset($rs_cod_denominacion) ) $rs_cod_denominacion = '';
	if( !isset($rs_list_cod_denominacion) ) $rs_list_cod_denominacion = array(''=>'', 'sujetiva'=>'sujetiva', 'objetiva'=>'objetiva');
	if( !isset($rs_tipo_juridico) ) $rs_tipo_juridico = '';
	if( !isset($rs_list_tiporegistro) ) $rs_list_tiporegistro = array(''=>'', 'NATURAL'=>'NATURAL', 'JURIDICA'=>'JURIDICA');

	$errormsg = '';
	if($rs_cod_juridico == 'errordb') $errormsg = 'No se pudo guardar en la base de datos, revisar el proceso o notificar soporte';
	if($rs_cod_juridico == 'errorinputs') $errormsg = 'Uno de los campos tiene caracteres invalidos, corriga por favor';
	if($rs_cod_juridico == 'error') $errormsg = 'Ocurrio un error al procesar la data, revisar el proceso o notificar a soporte';

echo div_open('class="contain"');
echo div_open('class="contain-form mx-auto px-3 py-3"');
	echo form_open('administrar/Razonsocial/procesarazonsocial', array('method'=> 'post', 'class' => ''));

		echo br();
		echo div_open('class="contain d-flex"');
		    echo div_open('class="form-group contain-group me-3 justify-content-between d-flex"');
	            echo form_label('Nombre de razón social:', 'rs_nombre_comercial');
		        echo form_input(array('name'=>'rs_nombre_comercial', 'id'=>'rs_nombre_comercial', 'type'=>'text', 'value'=>$rs_nombre_comercial, 'class'=>'w-100', 'required') );
	        echo div_close();
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Registro de información fiscal:', 'rs_cod_juridico');
				echo form_input(array('name'=>'rs_cod_juridico', 'id'=>'rs_cod_juridico', 'type'=>'text', 'value'=>$rs_cod_juridico, 'class'=>'w-100', 'required') );
			echo div_close();
		echo div_close();

		echo br();
		echo div_open('class="contain d-flex"');
		    echo div_open('class="form-group contain-group me-3 justify-content-between d-flex"');
	            echo form_label('Registro de informacion fiscal RIF:', 'rs_cod_juridico');
		        echo form_input(array('name'=>'rs_cod_juridico', 'id'=>'rs_cod_juridico', 'type'=>'text', 'value'=>$rs_cod_juridico, 'class'=>'w-100', 'placeholder'=>'', 'required') );
	        echo div_close();
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
	            echo form_label('Nombre fiscal o legal:', 'rs_nombre_legal');
		        echo form_input(array('name'=>'rs_nombre_legal', 'id'=>'rs_nombre_legal', 'type'=>'text', 'value'=>$rs_nombre_legal, 'class'=>'w-100', 'required') );
			echo div_close();
		echo div_close();
        echo br();


		echo div_open('class="contain d-flex"');
		    echo div_open('class="form-group contain-group me-3 justify-content-between d-flex"');
	            echo form_label('Tipo de registro:', 'rs_tipo_juridico');
		        echo form_dropdown('rs_tipo_juridico', $rs_list_tiporegistro, $rs_tipo_juridico);
            echo div_close();
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Tipo de denominación.:', 'rs_cod_denominacion');
		        echo form_dropdown('rs_cod_denominacion', $rs_list_cod_denominacion, $rs_cod_denominacion);
			echo div_close();
		echo div_close();

        echo br();
		echo div_open('class="contain d-flex"');
		    echo div_open('class="form-group contain-group me-3 d-flex w-100"');
	            echo form_label('Dirección comercial:', 'rs_direccion_comercial');
		        echo form_input(array('name'=>'rs_direccion_comercial', 'id'=>'rs_direccion_comercial', 'type'=>'text', 'value'=>$rs_direccion_comercial,'class'=>'w-100', 'placeholder'=>'', 'required') );
	        echo div_close();
		echo div_close();
        echo br();

		echo form_submit('makesave', 'Guardar' , array('class'=>'btn btn-outline-warning w-100'));
	echo form_close();
echo div_close();
echo div_close();

?>

