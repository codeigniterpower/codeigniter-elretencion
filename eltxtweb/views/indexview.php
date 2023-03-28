<?php

	$userurl = $this->input->get_post('userurl');
	echo form_fieldset('Cargador XML para ERP купить 1.0') . PHP_EOL;
	?>

<!-- PROMOTION CURRENCYMANAGER BLOCK-->
		<div class="contain-image">
		  <div class="card-deck d-flex justify-content-around  flex-wrap">
			<div class="card m-4" style="width: 300px;">
			  <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
			  <div class="card-body">
				<h3 class="card-title">CSV y XML</h3>
				<p class="card-text">General los TXT o XML con los convertidores.</p>
			  </div>
			  <div class="card-footer">
				<small class="text-muted">
					<a class="btn btn-default btn-outline-success" href="<?php echo site_url();?>/convertidores/"><i class="icon icon-screen-desktop"></i>Convertidores!</a>
				</small>
			  </div>
			</div>
			<div class="card m-4" style="width: 300px;">
			  <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
			  <div class="card-body">
				<h3 class="card-title">Retenciones</h3>
				<p class="card-text">Registra las retenciones de IVA y ISLR.</p>
			  </div>
			  <div class="card-footer">
				<small class="text-muted">
					<a class="btn btn-default btn-outline-success" href="<?php echo site_url();?>/retenciones/"><i class="icon icon-screen-desktop"></i>Retenciones!</a>
				</small>
			  </div>
			</div>
			<div class="card m-4" style="width: 300px;">
			  <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
			  <div class="card-body">
				<h3 class="card-title">Codeigniter!</h3>
				<p class="card-text">Este es un proyecto del grupo VenenuX, facil de desarrollar.</p>
			  </div>
			  <div class="card-footer">
				<small class="text-muted">
					<a class="btn btn-default btn-outline-success" href="https://gitlab.com/codeigniterpower"><i class="icon icon-screen-desktop"></i>Repositorio!</a>
				</small>
			  </div>
			</div>
			<div class="card m-4" style="width: 300px;">
			  <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
			  <div class="card-body">
				<h3 class="card-title">Self-hosted!</h3>
				<p class="card-text">Este es un proyecto licenciado en CC-BY-NC-SA.</p>
			  </div>
			  <div class="card-footer">
				<small class="text-muted">
					<a class="btn btn-default btn-outline-success" href="https://gitlab.com/codeigniterpower/codeigniter-codeigniter-eltxt/tree/main/docs"><i class="icon icon-screen-desktop"></i>Licencia!</a>
				</small>
			  </div>
			</div>
		  </div>
		</div>
<?php
    echo form_fieldset_close() . PHP_EOL;
