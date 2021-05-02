
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div class="form-group">
    <label for="">Codigo</label>
    <input type="text" class="form-control" name="Codigo" required>
    <span>
      <?php echo $error_Codigo; ?>
    </span>
  </div>
  <div class="form-group">
    <label for="">Nombre</label>
    <input type="text" class="form-control" name="nombre" required>
    <span>
      <?php echo $error_nombre; ?>
    </span>
  </div>
  <div class="form-group">
    <label for="">Direccion</label>
    <input type="text" class="form-control" name="Direccion" required>
    <span>
      <?php echo $error_Direccion; ?>
    </span>
  </div>
  <div class="form-group">
    <label for="">Teléfono</label>
    <input type="text" class="form-control" name="telefono" required>
    <span>
      <?php echo $error_telefono; ?>
    </span>
  </div>
  
  <div class="form-group">
    <label for="">Correo</label>
    <input type="mail" class="form-control" name="correo" required>
    <span>
      <?php echo $error_correo; ?>
    </span>
  </div>
  
  <input type="submit" class="btn btn-primary" value="Enviar">
</form>

<?php $error_Codigo = $error_Nombre = $error_Direccion = $error_telefono = $error_correo = '';
if( isset($_POST['submit']) ) { 

}
function test_input($data) {
    
    $data = trim($data);

    $data = stripslashes($data);
    
    return $data;
  }

  if (empty($_POST['Codigo'])) 
$error_Codigo = "Este campo no puede estar vacío";
else
$Codigo = test_input($_POST['Codigo']); 
if (!preg_match('/^[A-ZÁÉÍÓÚ][a-záéíóú]*$/', $Codigo))
$error_Codigo = "";

if (empty($_POST['nombre'])) 
$error_nombre = "Este campo no puede estar vacío";
else
$nombre = test_input($_POST['nombre']); 
if (!preg_match('/^[A-ZÁÉÍÓÚ][a-záéíóú]*$/', $nombre))
$error_nombre = "El nombre empieza por mayúscula";

if (empty($_POST['Direccion'])) 
$error_Direccion = "Este campo no puede estar vacío";
else
$Direccion = test_input($_POST['Direccion']); 
if (!preg_match('/^[A-ZÁÉÍÓÚ][a-záéíóú]*$/', $Direccion))
$error_Direccion = "";

if (empty($_POST['telefono'])) 
$error_telefono = "Este campo no puede estar vacío";
else
$telefono = test_input($_POST['telefono']);
if (!preg_match('/^[967]\d{8}$/', $telefono)) 
$error_telefono = "El teléfono tiene 8 cifras y empieza por ";

if (empty($_POST['correo'])) 
$error_correo = "Este campo no puede estar vacío";
else
$correo = test_input($_POST['correo']);
if (!preg_match('/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/', $correo)) 
$error_correo = "El formato del correo electrónico es nombre@dominio.extension"; 
if($error_nombre=="" && $error_telefono=="" && $error_correo=="") {
echo "todo ok"; 
header("Location:index.php"); 
}
?>
