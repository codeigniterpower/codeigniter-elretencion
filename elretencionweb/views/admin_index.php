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
	echo form_open('por/definir/metodo/controller', array('method'=> 'post', 'class' => ''));

		echo br();
		echo div_open('class="contain d-flex"');
		    echo div_open('class="form-group contain-group me-3 justify-content-between d-flex"');
	            echo form_label('Nombre o razón social:', $nombreOrazonSocialDeLagenteDeRetención);
		        echo br();
	            echo form_input(array('name'=>$nombreOrazonSocialDeLagenteDeRetención, 'id'=>$nombreOrazonSocialDeLagenteDeRetención, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
	        echo div_close();
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Registro de información fiscal:', $registroDeInformacionFiscalDelAgenteDeRetencion);
				echo br();
				echo form_input(array('name'=>$registroDeInformacionFiscalDelAgenteDeRetencion, 'id'=>$registroDeInformacionFiscalDelAgenteDeRetencion, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
		echo div_close();

		echo br();
		echo div_open('class="contain d-flex"');
		    echo div_open('class="form-group contain-group me-3 justify-content-between d-flex"');
	            echo form_label('Dirección comercial:', $direccionComercial);
		        echo br();
	            echo form_input(array('name'=>$direccionComercial, 'id'=>$direccionComercial, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
	        echo div_close();
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Nombre legal:', $nombreLegal);
				echo br();
				echo form_input(array('name'=>$nombreLegal, 'id'=>$nombreLegal, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
		echo div_close();
        echo br();


		echo div_open('class="contain d-flex"');
		    echo div_open('class="form-group contain-group me-3 justify-content-between d-flex"');
	            echo form_label('nombre comercial:', $nombreComercial);
		        echo br();
	            echo form_input(array('name'=>$nombreComercial, 'id'=>$nombreComercial, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
	        echo div_close();
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Tipo de denominación.:', $codDenominacion);
				echo br();
				echo form_input(array('name'=>$codDenominacion, 'id'=>$codDenominacion, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
		echo div_close();

        echo br();
		echo div_open('class="contain d-flex"');
		    echo div_open('class="form-group contain-group me-3 d-flex w-100"');
	            echo form_label('Tipo de registro:', $nombreOrazonSocialDeLagenteDeRetención);
		        echo br();
                echo form_dropdown($tipoDeRegistro, ['Jurídica','Natural','Gubernamental'], 'large');
                echo div_close();
		echo div_close();
        echo br();

		echo form_submit('makelogin', 'Get me in' , array('class'=>'btn btn-outline-warning w-100'));
	echo form_close();
echo div_close();
echo div_close();

?>

