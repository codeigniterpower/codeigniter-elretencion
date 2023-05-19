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

	if( !isset($username) ) $username = '';
	if( !isset($userkey) ) $userkey = '';
	if( !isset($userstatus) ) $userstatus = ''; // RIF registro inf fiscal
	if( !isset($list_userstatus) ) $list_userstatus = '';
	if( !isset($modulostring) ) $modulostring = '';
	if( !isset($list_modulostring) ) $list_modulostring = array(''=>'', 'administrar'=>'administrar');

	$errormsg = '';
	if($username == 'errordb') $errormsg = 'No se pudo guardar en la base de datos, revisar el proceso o notificar soporte';
	if($username == 'errorinputs') $errormsg = 'Uno de los campos tiene caracteres invalidos, corriga por favor';
	if($username == 'error') $errormsg = 'Ocurrio un error al procesar la data, revisar el proceso o notificar a soporte';

echo div_open('class="contain"');
echo div_open('class="contain-form mx-auto px-3 py-3"');
	echo form_open('administrar/Accesos/procesaaccesos', array('method'=> 'post', 'class' => ''));

		echo br();
		echo div_open('class="contain d-flex"');
		    echo div_open('class="form-group contain-group me-3 justify-content-between d-flex"');
	            echo form_label('Nombre de usuario:', 'username');
		        echo form_input(array('name'=>'username', 'id'=>'username', 'type'=>'text', 'value'=>$username, 'class'=>'w-100', 'required') );
	        echo div_close();
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Clave:', 'userkey');
				echo form_input(array('name'=>'userkey', 'id'=>'userkey', 'type'=>'password', 'value'=>$userkey, 'class'=>'w-100', 'required') );
			echo div_close();
		echo div_close();

		echo div_open('class="contain d-flex"');
		    echo div_open('class="form-group contain-group me-3 justify-content-between d-flex"');
	            echo form_label('Estado:', 'userstatus');
		        echo form_dropdown('userstatus', $list_userstatus, $userstatus);
            echo div_close();
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Accesos.:', 'modulostring');
		        echo form_dropdown('modulostring', $list_modulostring, $modulostring);
			echo div_close();
		echo div_close();

		echo form_submit('makesave', 'Guardar' , array('class'=>'btn btn-outline-warning w-100'));
	echo form_close();
echo div_close();
echo div_close();

?>

