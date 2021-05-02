
<?php 
   $sql_query = "SELECT id, CodigoProducto, Nombre, Existencia, Precio FROM libroProductos";
   $resultset = mysqli_query($conn, $sql_query) or die("error base de datos:". mysqli_error($conn));?>
   



<div class="container home">    
    <h2>Productos</h2>      
    <table id="data_table" class="table table-striped">
        <thead>
            <tr>
                <th>CodigoProducto</th>
                <th>Nombre</th>
                <th>Existencia</th>
                <th>Precio</th>   
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql_query = "SELECT CodigoProducto ,Nombre,Existencia, Precio FROM libroProductos";
            $resultset = mysqli_query($conn, $sql_query) or die("error base de datos:". mysqli_error($conn));
            while( $libro = mysqli_fetch_assoc($resultset) ) {
            ?>
               <tr id="<?php echo $libroProductos ['id']; ?>">
               <td><?php echo $libroProductos ['CodigoProducto']; ?></td>
               <td><?php echo $libroProductos ['Nombre']; ?></td>
               <td><?php echo $libroProductos ['Existencia']; ?></td>
               <td><?php echo $libroProductos ['Precio']; ?></td>   

           


              
               </tr>
            <?php } ?>
        </tbody>
    </table>    
</div>
<?php 

include_once("db_connect.php");
$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {   
    $update_field='';
    if(isset($input['CodigoProducto'])) {
        $update_field.= "CodigoProducto='".$input['CodigoProducto']."'";
    } else if(isset($input['Nombre'])) {
        $update_field.= "Nombrer='".$input['Nombre']."'";
    } else if(isset($input['Existencia'])) {
        $update_field.= "Existencia='".$input['Existencia']."'";
    } else if(isset($input['Precio'])) {
        $update_field.= "Precio='".$input['Precio']."'";
    }   
    if($update_field && $input['id']) {
        $sql_query = "UPDATE libroProductos SET $update_field WHERE id='" . $input['id'] . "'";  
        mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));     
    }
}

?>