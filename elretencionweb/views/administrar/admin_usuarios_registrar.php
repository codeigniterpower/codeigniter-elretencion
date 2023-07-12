<?php 
/**
 * view usuarios editar
 *
 */

	$usernew = '';
	if( isset($username) ) $usernew = 'readonly';
	if( !isset($username) ) $username = '';
	if( !isset($userkey) ) $userkey = '';
	if( !isset($userstatus) ) $userstatus = '';
	if( !isset($list_userstatus) ) $list_userstatus = array('INACTIVO'=>'INACTIVO', 'ACTIVO'=>'ACTIVO');
	if( !isset($sessionflag) ) $sessionflag = date('YmdHis');

echo div_open('class="container-fluid position-sticky mx-auto px-3 py-3"');
	echo form_open('administrar/Usuarios/procesarusuarios', array('method'=> 'post', 'class' => ''));

		echo br();

		echo div_open('class="contain d-flex"');
		    echo div_open('class="form-group contain-group me-3 justify-content-between d-flex"');
	            echo form_label('Nombre de usuario:', 'username');
		        echo form_input(array('name'=>'username', 'id'=>'username', 'type'=>'text', 'value'=>$username, 'class'=>'w-100', 'required'=>'required', $usernew=>$usernew) );
	        echo div_close();
			echo div_open('class="form-group contain-group me-3 justify-content-between d-flex"');
				echo form_label('Clave:', 'userkey');
				echo form_input(array('name'=>'userkey', 'id'=>'userkey', 'type'=>'password', 'value'=>$userkey, 'class'=>'w-100', 'required') );
			echo div_close();
		    echo div_open('class="form-group contain-group me-3 justify-content-between d-flex"');
	            echo form_label('Estado:', 'userstatus');
		        echo form_dropdown('userstatus', $list_userstatus, $userstatus);
            echo div_close();
		echo div_close();

		echo form_hidden('sessionflag',$sessionflag);
		echo form_hidden('sessionficha',$sessionficha);
		echo form_submit('makesave', 'Guardar' , array('class'=>'btn btn-outline-warning w-100'));
	echo form_close();
echo div_close();
