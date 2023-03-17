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
				<h3 class="card-title">CSV to XML</h3>
				<p class="card-text">Carga tu TXT y obten tu XML!! para las retenciones.</p>
			  </div>
			  <div class="card-footer">
				<small class="text-muted">
					<a class="btn btn-default btn-outline-success" href="<?php echo site_url();?>/xmls/"><i class="icon icon-screen-desktop"></i>GenerarXML!</a>
				</small>
			  </div>
			</div>
			<div class="card m-4" style="width: 300px;">
			  <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
			  <div class="card-body">
				<h3 class="card-title">TXT para bancos</h3>
				<p class="card-text">Genera los TXT de algunso bancos nacionales.</p>
			  </div>
			  <div class="card-footer">
				<small class="text-muted">
					<a class="btn btn-default btn-outline-success" href="<?php echo site_url();?>/txts/"><i class="icon icon-screen-desktop"></i>GenerarTXT!</a>
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
