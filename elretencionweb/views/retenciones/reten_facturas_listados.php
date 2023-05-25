<?php


	if( !isset($titleini) ) $titleini='Facturas registradas';
	if( !isset($titlesub) ) $titlesub='';
	if( !isset($htmlhistorydatatoshow) ) $htmlhistorydatatoshow = 'No hay facturas registradas, el registro esta borrado del codigo o no DB conectada';
	if( !isset($rs_list_dbarray_total) ) $rs_list_dbarray_total = array(''=>NULL);


	echo div_open('class="col py-3"');
		echo div_open('id="dataheadingtitle"');
			echo heading($titleini,2,'');
			echo heading($titlesub.' '.$totalcount,3,'');
		echo div_close();
		echo div_open('id="dataalertmessage"');
			echo $titlesub;
		echo div_close();
		echo div_open('id="datatableshowrows" class="contain-table"');
				if(is_array($rs_list_dbarray_total))
				{
					if(count($rs_list_dbarray_total))
					{
						$this->table->clear();
						$this->table->set_template( array( 
								'table_open' => '<table id="datatableid">',
								)
							);
						$this->table->set_heading(array_keys($rs_list_dbarray_total[0]));
						$htmlhistorydatatoshow = $this->table->generate($rs_list_dbarray_total);
					}
				}
				echo $htmlhistorydatatoshow;
		echo div_close();
	echo div_close();
	$srcscript1 = "
		$(document).ready ( 
			function () {
				table1 = $('#datatableid').DataTable (
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
	
