<?php 
$islrAccumulatedWithholdingTax="islrCcumulatedWithholdingTax";
$islrDateOfTransaction="islrDateOfTransaction";
$voucherNumber="voucherNumber";
$islrNameOrBusiness="islrNameOrBusiness";
$islrRecordOfTaxInformation="islrRecordOfTaxInformation";
$islrDate = 'islrDate';
$isrlRegister = "isrlRegister";
$isrlSubjectFiscal = "isrlSubjectFiscal";
$islrInvoiceDate = "islrInvoiceDate";
$invoiceNumber = 'invoiceNumber';
$islrNumCtrolInvoice = "islrNumCtrolInvoice";
$islrHoldCode = "islrHoldCode";
$isrlAmountPaid = "isrlAmountPaid";
$isrlAmountPaidOriginal = "isrlAmountPaidOriginal";
$islrAmountOfHoldObject ="islrAmountOfHoldObject";
$islrRate = "islrRate";
$isrlDetained = "isrlDetained";
$islrAmountObjectAccumulatedWithholding="islrAmountObjectAccumulatedWithholding";
$islrProofNumber="islrProofNumber";
echo div_open('class="contain"');
echo div_open('class="contain-form mx-auto px-3 py-3"');
	echo form_open('por/definir/metodo/controller', array('method'=> 'post', 'class' => ''));
		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Nombre o razón social del agente de retención', $islrNameOrBusiness);
				echo br();
				echo form_input(array('name'=>$islrNameOrBusiness, 'id'=>$islrNameOrBusiness, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
			
			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Registro de información fiscal del agente de retención:', $islrRecordOfTaxInformation);
				echo br();
				echo form_input(array('name'=>$islrRecordOfTaxInformation, 'id'=>$islrRecordOfTaxInformation, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();



		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Nombre o razón social del sujeto retenido', $islrNameOrBusiness);
				echo br();
				echo form_input(array('name'=>$islrNameOrBusiness, 'id'=>$islrNameOrBusiness, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
			
			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Registro de información fiscal del sujeto de retenido (R.I.F):', $islrRecordOfTaxInformation);
				echo br();
				echo form_input(array('name'=>$islrRecordOfTaxInformation, 'id'=>$islrRecordOfTaxInformation, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();



		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Fecha de Operación', $islrDateOfTransaction);
				echo br();
				echo form_input(array('name'=>$islrDateOfTransaction, 'id'=>$islrDateOfTransaction, 'type'=>'date', 'class'=>'w-100', 'required') );
			echo div_close();
			
			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Numero de comprobante:', $voucherNumber);
				echo br();
				echo form_input(array('name'=>$voucherNumber, 'id'=>$voucherNumber, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();



		
		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Registro de informacion fiscal del sujeto retenido', $isrlSubjectFiscal);
				echo br();
				echo form_input(array('name'=>$isrlSubjectFiscal, 'id'=>$isrlSubjectFiscal, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
			
			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Fecha de la factura:', $islrInvoiceDate);
				echo br();
				echo form_input(array('name'=>$islrInvoiceDate, 'id'=>$islrInvoiceDate, 'type'=>'date', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();
		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Registro de informacion fiscal del sujeto retenido', $isrlSubjectFiscal);
				echo br();
				echo form_input(array('name'=>$isrlSubjectFiscal, 'id'=>$isrlSubjectFiscal, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
			
			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Fecha de la factura:', $islrInvoiceDate);
				echo br();
				echo form_input(array('name'=>$islrInvoiceDate, 'id'=>$islrInvoiceDate, 'type'=>'date', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();

		echo br();

		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Numero de la factura;', $invoiceNumber);
				echo br();
				echo form_input(array('name'=>$invoiceNumber, 'id'=>$invoiceNumber, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();

			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Num.Ctrol De Factura:', $islrNumCtrolInvoice);
				echo br();
				echo form_input(array('name'=>$islrNumCtrolInvoice, 'id'=>$islrNumCtrolInvoice, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();

		echo br();


		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Total compras:', $isrlAmountPaidOriginal);
				echo br();
				echo form_input(array('name'=>$isrlAmountPaidOriginal, 'id'=>$isrlAmountPaidOriginal, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
			
			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Cant. Pagada Retencion:', $isrlAmountPaid);
				echo br();
				echo form_input(array('name'=>$isrlAmountPaid, 'id'=>$isrlAmountPaid, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();

		echo br();


		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('Cantidad de objeto de retención;', $islrAmountOfHoldObject);
				echo br();
				echo form_input(array('name'=>$islrAmountOfHoldObject, 'id'=>$islrAmountOfHoldObject, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();

			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Tasa:', $islrRate);
				echo br();
				echo form_input(array('name'=>$islrRate, 'id'=>$islrRate, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();


		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex"');
				echo form_label('I.S.L.R Retenido;', $isrlDetained);
				echo br();
				echo form_input(array('name'=>$isrlDetained, 'id'=>$isrlDetained, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();

			echo div_open('class="form-group contain-group  justify-content-between d-flex"');
				echo form_label('Cantidad Objeto de Retencion Acumulada:', $islrAmountObjectAccumulatedWithholding);
				echo br();
				echo form_input(array('name'=>$islrAmountObjectAccumulatedWithholding, 'id'=>$islrAmountObjectAccumulatedWithholding, 'type'=>'text', 'class'=>'w-100', 'placeholder'=>'', 'required') );
			echo div_close();
		echo div_close();
		echo br();


		echo div_open('class="contain d-flex"');
			echo div_open('class="form-group me-3  contain-group  justify-content-between d-flex w-100"');
				echo form_label('Impuesto retenido acumulado', $islrAccumulatedWithholdingTax);
				echo br();
				echo form_input(array('name'=>$islrAccumulatedWithholdingTax, 'id'=>$islrAccumulatedWithholdingTax, 'type'=>'text', 'class'=>'w-100', 'required') );
			echo div_close();
		echo div_close();
		echo br();
		echo form_submit('makelogin', 'Get me in' , array('class'=>'btn btn-outline-warning w-100'));
	echo form_close();
echo div_close();

echo div_close();

?>

