<?php

	$titleini = 'Razones sociales';
	$titlesub = 'tanto para Agente retenido como Retenedor ';

	if($errormsg == 'borrado') $errormsg = 'Borrado el rif exitosamente';
	else if($errormsg == 'borrado_error') $errormsg = 'No se pudo eliminar de la base de datos, revisar data del rif o notificar soporte';
	else if($errormsg == 'borrado_restringido') $errormsg = 'No tiene permisos para eliminar datos';
	else if($errormsg == 'editado_error') $errormsg = 'No se pudo modificar los datos de la base de datos, revisar data del rif o notificar soporte';
	else if($errormsg == 'editado_restringido') $errormsg = 'Ud no tiene permisos para alterar datos';
	else $errormsg = NULL;

	echo div_open('class="col py-3"');
		echo '<section>';
			echo div_open('id="liveAlertPlaceholder"');
				if($errormsg != NULL) echo '<h2>'.$errormsg.'</h2>';
			echo div_close();
		echo '</section>';
		echo div_open('class="contain-table"');
			echo heading($titleini,2,'');
			echo heading($titlesub.' '.$totalcount,3,'');
				if(is_array($rs_list_dbarray_total))
				{
					if(count($rs_list_dbarray_total))
					{
						$this->table->clear();
						$this->table->set_template( array( 
							'table_open' => '<table id="table_id">',
							'heading_row_start'     => '<tr style="background-color:#ffffff00;">',
							'heading_row_end'       => '</tr>',
							'heading_cell_start' => '<th style="border-bottom:0">',
							'heading_cell_end'      => '</th>',
							'tbody_open'            => '<tbody>',
							'tbody_close'           => '</tbody>',
							'row_start'             => '<tr style="background-color:#ffffff00;border-radius: 0px;">',
							'row_end'               => '</tr>',
							'cell_start'            => '<td style="background-color:#ffffff00;border-radius: 0px;">',
							'cell_end'              => '</td>',
							
							)
					);
						$this->table->set_heading(array_keys($rs_list_dbarray_total[0]));
						$htmlhistorydata = $this->table->generate($rs_list_dbarray_total);
					}
					else
						$htmlhistorydata = 'No hay razones sociales registradas, el registro esta borrado del codigo o no DB conectada';
				}
				echo $htmlhistorydata;
		echo div_close();
	echo div_close();
	$srcscript1 = "
		$(document).ready ( 
			function () {
				table1 = $('#table_id').DataTable (
					{
						order: [0], paging:true, searching:true,
						/*columnDefs: [ {visible:false,targets:5},{visible:false,targets:6},{visible:false,targets:7},{title:'code',targets:0},{title:'base',targets:1},{title:'rate',targets:2},{title:'currency',targets:3} ]*/
					}
				);
			}
		)
	";
	echo src_scrip($srcscript1);
	?>
	
