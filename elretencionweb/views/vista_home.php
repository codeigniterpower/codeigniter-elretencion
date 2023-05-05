	<h1>Welcome/Bienvenido</h1>
	<?php

		echo br().PHP_EOL;  // genera neuva linea en codigo html al navegador
		echo form_fieldset('Modulo de retenciones y generacion de TXT/XML, su estado y permisologia',array('class'=>'containerin ') );
		echo '<div class="row"><div class="col-sm-4 col-sm-offset-4">';
			echo '<spawn class="btn btn-danger">Usuario</spawn>: '.$username.br();
			echo '<spawn class="btn btn-danger">Estado</spawn>: '.$userstatus.br();
		echo '</div></div>';
		echo form_fieldset_close() . PHP_EOL;
	?>
