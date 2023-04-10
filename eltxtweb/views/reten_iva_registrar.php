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
 * Convertxml Class
 *
 * @package    CodeIgniter
 * @subpackage Libraries
 * @category   Files
 * @version    1.0.0-dev
 * @author     Angel Gonzalez Gmail:ag5193407@gmail.com , Gitlab 1:@Radioactive99
 * @link       https://gitlab.com/codeigniterpower/codeigniter-eltxt/-/blob/master/assets/xmlcreate/convertXml.php
 */

echo div_open('class="contain"');
echo div_open('class="contain-form mx-auto px-3 py-3"');
	echo form_open('por/definir/metodo/controller', array('method'=> 'post', 'class' => ''));
			echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Fecha de Operación', $islrFechaDeTransacción);
				echo br();
				echo form_input(array('name'=>$islrFechaDeTransacción, 'id'=>$islrFechaDeTransacción, 'type'=>'date', 'class'=>'w-100', 'required') );
			echo div_close();
			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Numero de comprobante:', $islrNumeroComprobante);
				echo br();
				echo form_input(array('name'=>$islrNumeroComprobante, 'id'=>$islrNumeroComprobante, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();
		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Nombre o razón social del agente de retención', $islrNombreONegocio);
				echo br();
				echo form_input(array('name'=>$islrNombreONegocio, 'id'=>$islrNombreONegocio, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
			
			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Registro de información fiscal del agente de retención:', $islrRegistroDeInformaciónFiscalDelAgente);
				echo br();
				echo form_input(array('name'=>$islrRegistroDeInformaciónFiscalDelAgente, 'id'=>$islrRegistroDeInformaciónFiscalDelAgente, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();
		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Nombre o razón social del sujeto retenido', $islrNombreOAsunto);
				echo br();
				echo form_input(array('name'=>$islrNombreOAsunto, 'id'=>$islrNombreOAsunto, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Registro de información fiscal del sujeto de retenido (R.I.F):', $islrAsuntoRegistroDeInformaciónFiscal);
				echo br();
				echo form_input(array('name'=>$islrAsuntoRegistroDeInformaciónFiscal, 'id'=>$islrAsuntoRegistroDeInformaciónFiscal, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();
		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group contain-group me-3 justify-content-between d-flex"');
				echo form_label('Fecha de la factura:', $islrNúmeroDeFactura);
				echo br();
				echo form_input(array('name'=>$islrNúmeroDeFactura, 'id'=>$islrNúmeroDeFactura, 'type'=>'date', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
			echo div_open('class="form-group   contain-group  justify-content-between d-flex"');
				echo form_label('Numero de factura', $isrlAgentFiscal);
				echo br();
				echo form_input(array('name'=>$isrlAgentFiscal, 'id'=>$isrlAgentFiscal, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
		echo div_close();
		echo br();
		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Numero Ctrol de factura', $islrNumControlFactura);
				echo br();
				echo form_input(array('name'=>$islrNumControlFactura, 'id'=>$islrNumControlFactura, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
			
			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Total compras:', $islrFechaDeFactura);
				echo br();
				echo form_input(array('name'=>$islrFechaDeFactura, 'id'=>$islrFechaDeFactura, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();
		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Sin derecho a credito fiscal;', $islrCantidadPagada);
				echo br();
				echo form_input(array('name'=>$islrCantidadPagada, 'id'=>$islrCantidadPagada, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
		echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Cantidad de Objeto de retención:', $islrCantidadDeObjetoDeRetención);
				echo br();
				echo form_input(array('name'=>$islrCantidadDeObjetoDeRetención, 'id'=>$islrCantidadDeObjetoDeRetención, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();
		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Tasa:', $islrTasa);
				echo br();
				echo form_input(array('name'=>$islrTasa, 'id'=>$islrTasa, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Impuesto IVA:', $isrlDetenido);
				echo br();
				echo form_input(array('name'=>$isrlDetenido, 'id'=>$isrlDetenido, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();		
		echo br();
		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Cantidad de objeto de retención Acumulada;', $islrCantidadObjetoRetencionAcumulada);
				echo br();
				echo form_input(array('name'=>$islrCantidadObjetoRetencionAcumulada, 'id'=>$islrCantidadObjetoRetencionAcumulada, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('IVA retenido:', $islrImpuestoRetenidoAcumulado);
				echo br();
				echo form_input(array('name'=>$islrImpuestoRetenidoAcumulado, 'id'=>$islrImpuestoRetenidoAcumulado, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();
		echo form_submit('makelogin', 'Get me in' , array('class'=>'btn btn-outline-warning w-100'));
	echo form_close();
echo div_close();
echo div_close();
?>

