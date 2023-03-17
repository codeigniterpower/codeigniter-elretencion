<?php

	$userurl = $this->input->get_post('userurl');
	
	$xmlsfielset = array(
		'for'       => 'xmlsfilename',
		'id'        => 'xmlsfilelabel',
		'maxlength' => '100',
		'size'      => '100',
		'class'     => 'form-group'
	);
	echo form_fieldset('Cargador XML para ERP купить 1.0', $xmlsfielset) . PHP_EOL;
		echo form_open_multipart('retencionesxml/Converttxttoxml');
		
		echo div_open('class="form-group"');
			$xmlsfilelabel = array(
				'name'      => 'xmlsfilename',
				'for'       => 'xmlsfilelabel',
				'maxlength' => '30',
				'size'      => '50',
				'class'     => 'form-label mt-4'
			);
			echo form_label('Archivo con datos', 'xmlsfilelabel', $xmlsfilelabel);
			$xmlsfilename = array(
				'name'      => 'xmlsfilename',
				'id'        => 'xmlsfilename',
				'maxlength' => '30',
				'size'      => '50',
				'class'     => 'form-control'
			);
			echo form_upload($xmlsfilename);
		echo div_close();
		$xmlsbuttsend = array(
			'name'      => 'xmlsbuttsend',
			'id'        => 'xmlsbuttsend',
			'maxlength' => '30',
			'size'      => '50',
			'class'     => 'btn btn-outline-primary'
		);
		echo form_submit('xmlsbuttsend','Convertir',$xmlsbuttsend);
		
    echo form_fieldset_close() . PHP_EOL;
