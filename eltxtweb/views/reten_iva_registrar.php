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
				echo form_label('Fecha de Operación', $islrDateOfTransaction);
				echo br();
				echo form_input(array('name'=>$islrDateOfTransaction, 'id'=>$islrDateOfTransaction, 'type'=>'date', 'class'=>'w-100', 'required') );
			echo div_close();
			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Numero de comprobante:', $islrVoucherNumber);
				echo br();
				echo form_input(array('name'=>$islrVoucherNumber, 'id'=>$islrVoucherNumber, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();
		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Nombre o razón social del agente de retención', $islrNameOrBusiness);
				echo br();
				echo form_input(array('name'=>$islrNameOrBusiness, 'id'=>$islrNameOrBusiness, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
			
			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Registro de información fiscal del agente de retención:', $islrAgentRecordOfTaxInformation);
				echo br();
				echo form_input(array('name'=>$islrAgentRecordOfTaxInformation, 'id'=>$islrAgentRecordOfTaxInformation, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();
		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Nombre o razón social del sujeto retenido', $islrNameOrSubject);
				echo br();
				echo form_input(array('name'=>$islrNameOrSubject, 'id'=>$islrNameOrSubject, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Registro de información fiscal del sujeto de retenido (R.I.F):', $islrSubjectRecordOfTaxInformation);
				echo br();
				echo form_input(array('name'=>$islrSubjectRecordOfTaxInformation, 'id'=>$islrSubjectRecordOfTaxInformation, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();
		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group contain-group me-3 justify-content-between d-flex"');
				echo form_label('Fecha de la factura:', $islrInvoiceNumber);
				echo br();
				echo form_input(array('name'=>$islrInvoiceNumber, 'id'=>$islrInvoiceNumber, 'type'=>'date', 'class'=>'w-100', 'placeholder'=>'', 'required') );
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
				echo form_label('Numero Ctrol de factura', $islrNumCtrolInvoice);
				echo br();
				echo form_input(array('name'=>$islrNumCtrolInvoice, 'id'=>$islrNumCtrolInvoice, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
			
			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Total compras:', $islrInvoiceDate);
				echo br();
				echo form_input(array('name'=>$islrInvoiceDate, 'id'=>$islrInvoiceDate, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();
		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Sin derecho a credito fiscal;', $isrlAmountPaid);
				echo br();
				echo form_input(array('name'=>$isrlAmountPaid, 'id'=>$isrlAmountPaid, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
		echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Cantidad de Objeto de retención:', $islrAmountOfHoldObject);
				echo br();
				echo form_input(array('name'=>$islrAmountOfHoldObject, 'id'=>$islrAmountOfHoldObject, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();
		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Tasa:', $islrRate);
				echo br();
				echo form_input(array('name'=>$islrRate, 'id'=>$islrRate, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Impuesto IVA:', $isrlDetained);
				echo br();
				echo form_input(array('name'=>$isrlDetained, 'id'=>$isrlDetained, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();		
		echo br();
		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Cantidad de objeto de retención Acumulada;', $islrAmountObjectAccumulatedWithholding);
				echo br();
				echo form_input(array('name'=>$islrAmountObjectAccumulatedWithholding, 'id'=>$islrAmountObjectAccumulatedWithholding, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('IVA retenido:', $islrAccumulatedWithholdingTax);
				echo br();
				echo form_input(array('name'=>$islrAccumulatedWithholdingTax, 'id'=>$islrAccumulatedWithholdingTax, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();
		echo form_submit('makelogin', 'Get me in' , array('class'=>'btn btn-outline-warning w-100'));
	echo form_close();
echo div_close();
echo div_close();
?>

