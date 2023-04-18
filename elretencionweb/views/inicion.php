	<?php
	if( !isset($message) ) 
        $message = 'Interfaz preparada, ingrese credenciales';
		$inputStyle=['class'=>'position-absolute', 'width'=>'21px', 'style'=>'right: 9px; bottom:33%'];
		$formopen = form_open("Indexauth/auth/login", array('method'=> 'post', 'class' => 'needs-validation w-75 mx-auto my-auto'));
		echo br().PHP_EOL;  // genera neuva linea en codigo html al navegador
		echo '<div>';
		echo form_fieldset('Ingrese un correo que pertenezca a '.$sitename,array('class'=>'containerin text-center mt-2','style'=>'min-height: 80vh; max-height: 100%;') );
		echo '<div >
		<div class="col-sm-4 col-sm-offset-4 mx-auto alert alert-danger text-center" style="margin-top:20px;">
			'.$message.'
		</div>
		<div class="col-sm-4 col-sm-offset-4 mt-3 pb-3 pt-3 text-center mx-auto rounded-2" style="background-color: #dbe1f6 !important;>'.
				img('elretencionfiles/icons/box-arrow-in-right.svg',false,['width'=>"35px;"] ).'
				<div class="login-panel mt-3 panel panel-primary">
					<div class="panel-body">
						'.$formopen.'
							<fieldset>
								<div class="form-group position-relative d-flex" style="border-bottom: inset;">
									'.img('elretencionfiles/icons/person-fill.svg',false , $inputStyle).'
									<input class="form-control" placeholder="Email" type="input" name="username" style="background-color: transparent;"	required>
								</div>
								'.br(1).
								'
								<div class="form-group  position-relative d-flex"  style="border-bottom: inset;">
									'.img('elretencionfiles/icons/Social icon-2.svg',false,$inputStyle).'
									<input class="form-control" placeholder="Password" type="password" name="userclave"  style="background-color: transparent;" required>
								</div>'
								.br(1).'
								<div class="col-2">
								<button type="submit" class=" btn btn-primary rounded-2" ><span class="glyphicon glyphicon-log-in"></span> Login</button>
								<div>
							</fieldset>
						</form>
					</div>
				</div>
				</div>

				</div>
				';
		echo form_fieldset_close() . PHP_EOL;
	?>
