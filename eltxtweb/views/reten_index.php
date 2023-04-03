<?php 
	$userurl = $this->input->get_post('userurl');
	echo form_fieldset('Retenciones ISLR e IVA ERP купить 1.0') . PHP_EOL;
		?>
<!-- PROMOTION CURRENCYMANAGER BLOCK-->
	<div class="contain-image">
		<div class="card-deck d-flex justify-content-around  flex-wrap">
			<div class="card m-4" style="width: 300px;">
				<!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
			<div class="card-body">
				<h3 class="card-title"><a href="<?php echo site_url();?>/retenciones/crearretencionislr/registrarislr">Registrar ISLR</a></h3>
				<p class="card-text">Registrar una retencion de ISLR</p>
			</div>
			<div class="card-footer">
				<small class="text-muted">
					<a class="btn btn-default btn-outline-success" href="<?php echo site_url();?>/retenciones/crearretencionislr/registrarislr"><i class="icon icon-screen-desktop"></i>Registrar ISLR!</a>
				</small>
			</div>
		</div>
		<div class="card m-4" style="width: 300px;">
			<!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
			<div class="card-body">
				<h3 class="card-title"><a href="<?php echo site_url();?>/retenciones/crearretencioniva/registrariva">Registrar IVA</a></h3>
				<p class="card-text">Registrar una retencian de IVA.</p>
			</div>
			<div class="card-footer">
				<small class="text-muted">
				<a class="btn btn-default btn-outline-success" href="<?php echo site_url();?>/retenciones/crearretencioniva/registrariva"><i class="icon icon-screen-desktop"></i>Registrar IVA</a>
				</small>
			</div>
		</div>
		<div class="card m-4" style="width: 300px;">
			<!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
			<div class="card-body">
				<h3 class="card-title"><a href="<?php echo site_url();?>/retenciones/registrosretenciones/retencionlistado">Retenciones!</a></h3>
				<p class="card-text">Para editar o corregir los registros.</p>
			</div>
			<div class="card-footer">
				<small class="text-muted">
					<a class="btn btn-default btn-outline-success" href="<?php echo site_url();?>/retenciones/registrosretenciones/retencionlistado"><i class="icon icon-screen-desktop"></i>Retenciones!</a>
				</small>
			</div>
		</div>
		<div class="card m-4" style="width: 300px;">
			<!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
			<div class="card-body">
				<h3 class="card-title">Reservado</h3>
				<p class="card-text">Este es un proyecto licenciado en CC-BY-NC-SA.</p>
			</div>
			<div class="card-footer">
				<small class="text-muted">
					<a class="btn btn-default btn-outline-success" href="https://gitlab.com/codeigniterpower/codeigniter-codeigniter-eltxt/tree/main/docs"><i class="icon icon-screen-desktop"></i>Licencia!</a>
				</small>
			</div>
		</div>
	</div>
<?php
    echo form_fieldset_close() . PHP_EOL;
