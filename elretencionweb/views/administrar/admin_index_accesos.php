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

echo div_open('class="contain"');
echo div_open('class="contain-form mx-auto px-3 py-3"');

		echo div_open('class="contain d-flex"');
			echo form_fieldset('Accesos de Usuario');
		    echo div_open('class="form-group contain-group me-3 justify-content-between d-flex"');
				$buton1 = form_submit('makers', 'Registrar' , array('class'=>'btn btn-outline-warning w-100'));
	            echo anchor('administrar/Accesos/registraraccesos',$buton1);
	        echo div_close();
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				$buton2 = form_submit('makerl', 'Listar' , array('class'=>'btn btn-outline-warning w-100'));
	            echo anchor('administrar/Accesos/accesosporid',$buton2);
			echo div_close();
			echo form_fieldset_close();
		echo div_close();

echo div_close();
echo div_close();

?>

