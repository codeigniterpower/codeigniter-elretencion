<br>
<br>
<ul class="list-group list-group-horizontal-lg justify-content-center">
  <li class="list-group-item"><?php echo anchor('administrar/Usuarios/usuariosregistrar','Registrar Usuario'); ?></li>
  <li class="list-group-item"><?php echo anchor('administrar/Usuarios/usuarioslistar','Listar los Usuarios'); ?></li>
  <li class="list-group-item" onclick="openPopForm('inputuser')" >Editar/Borrar Usuario</li>
</ul>

<div class="alert alert-light" id="inputuser" style="display: none; z-index: 9">
    <label for="username"><b>Usuario:</b></label>
    <input name="username" id="username" type="text" required>
    <button type="button" class="btn btn-sucess" onclick="sendPopForm('usuariosmodificar')" >Modificar</button>
    <button type="button" class="btn btn-sucess" onclick="sendPopForm('usuariosborrar')" >Borrar</button>
    <button type="button" class="btn btn-cancel" onclick="closePopForm('inputuser')">Cancelar</button>
</div>

<script>
function openPopForm(id) {
  document.getElementById(id).style.display = "block";
}

function closePopForm(id) {
  document.getElementById(id).style.display = "none";
}

function sendPopForm(id) {
  location.href='<?=site_url('administrar/Usuarios/');?>'+id+'/'+document.getElementById('username').value;
}

</script>
