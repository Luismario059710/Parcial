<?php 

class Vehiculo
{
    private $id;
    private $Marca;
    private $Modelo;
    private $Año;
    private $Color;
    private $Precio;

    public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }
}

require_once 'Vehiculo.php';
require_once 'Vehiculo.php';


$alm = new Vehiculo();
$model = new VehiculoModel();

if(isset($_REQUEST['action']))
{
    switch($_REQUEST['action'])
    {
        case 'actualizar':
            $alm->__SET('id',              $_REQUEST['id']);
            $alm->__SET('Marca',          $_REQUEST['Marca']);
            $alm->__SET('Modelo',        $_REQUEST['Modelo']);
            $alm->__SET('Año',            $_REQUEST['Año']);
            $alm->__SET('Color', $_REQUEST['Color']);
            $alm->__SET('Precio',          $_REQUEST['Precio']);

            $model->Actualizar($alm);
            header('Location: index.php');
            break;

        case 'registrar':
            $alm->__SET('id',              $_REQUEST['id']);
            $alm->__SET('Marca',          $_REQUEST['Marca']);
            $alm->__SET('Modelo',        $_REQUEST['Modelo']);
            $alm->__SET('Año',            $_REQUEST['Año']);
            $alm->__SET('Color',           $_REQUEST['Color']);
            $alm->__SET('Precio',          $_REQUEST['Precio']);

            $model->Registrar($alm);
            header('Location: index.php');
            break;

        case 'eliminar':
            $model->Eliminar($_REQUEST['id']);
            header('Location: index.php');
            break;

        case 'editar':
            $alm = $model->Obtener($_REQUEST['id']);
            break;
    }
}

class Vehiculomodel
{
    private $pdo;

    public function __CONSTRUCT()
    {
        try
        {
            $this->pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function Listar()
    {
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM vehiculo");
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Vehichulo();

                $alm->__SET('id', $r->id);
                $alm->__SET('Marca', $r->Marca);
                $alm->__SET('Modelo', $r->Modelo);
                $alm->__SET('Año', $r->Año);
                $alm->__SET('Color', $r->Color);
                $alm->__SET('Precio', $r->Precio);
           
           
           
           

                $result[] = $alm;
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function Obtener($id)
    {
        try 
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM alumnos WHERE id = ?");

            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            $alm = new Vehiculo();

            $alm->__SET('id', $r->id);
            $alm->__SET('Marca', $r->Marca);
            $alm->__SET('Modelo', $r->Modelo);
            $alm->__SET('Año', $r->Año);
            $alm->__SET('Color', $r->Color);
            $alm->__SET('Precio', $r->Precio);
       

            return $alm;
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function Eliminar($id)
    {
        try 
        {
            $stm = $this->pdo
                      ->prepare("DELETE FROM vehiculo WHERE id = ?");                      

            $stm->execute(array($id));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function Actualizar(Vehivulo $data)
    {
        try 
        {
            $sql = "UPDATE vehiculo SET 
                        Marca          = ?, 
                        Modelo        = ?,
                        Año            = ?, 
                        Color           = ?
                        Precio         =?
                    WHERE id = ?";

            $this->pdo->prepare($sql)
                 ->execute(
                array(
                    $data->__GET('Marca'), 
                    $data->__GET('Modelo'), 
                    $data->__GET('Año'),
                    $data->__GET('Color'),
                    $data->__GET('Precio'),
                    $data->__GET('id')
                    )
                );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function Registrar(Vehiculo $data)
    {
        try 
        {
        $sql = "INSERT INTO vehiculo (Marca,Modelo,Año,Color,Precio) 
                VALUES (?, ?, ?, ?)";

            $this->pdo->prepare($sql)
        ->execute(
    array(
   $data->__GET('Marca'), 
   $data->__GET('Modelo'), 
   $data->__GET('Año'),
   $data->__GET('Color'),
   $data->__GET('Precio'),
   $data->__GET('id')
   )
);  
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>CRUD Registrar vehiculo </title>
        
    </head>
    <body >

        <div class="pure-g">
            <div class="pure-u-1-12">

                <form action="?action=<?php echo $alm->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" >
                    <input type="hidden" name="id" value="<?php echo $alm->__GET('id'); ?>" />

                    <table >
                        <tr>
                            <th >Marca</th>
                            <td><input type="text" name="Marca" value="<?php echo $alm->__GET('Marca'); ?>"  /></td>
                        </tr>
                        <tr>
                            <th >Modelo</th>
                            <td><input type="text" name="Modelo" value="<?php echo $alm->__GET('Modelo'); ?>"  /></td>
                        </tr>
                        <tr>
                            <th >Año</th>
                            <td><input type="text" name="Año" value="<?php echo $alm->__GET('Año'); ?>"  /></td>
                        </tr>
                        <tr>
                            <th >Color</th>
                            <td><input type="text" name="Color" value="<?php echo $alm->__GET('Color'); ?>"  /></td>
                        </tr>

                        <tr>
                            <th >Precio</th>
                            <td><input type="text" name="Precio" value="<?php echo $alm->__GET('Precio'); ?>"  /></td>
                        </tr>
                        
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="pure-button pure-button-primary">Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>

                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th >Marca</th>
                            <th >Modelo</th>
                            <th >Año</th>
                            <th >Color</th>
                            <th>Precio</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('Marca'); ?></td>
                            <td><?php echo $r->__GET('Modelo'); ?></td>
                            <td><?php echo $r->__GET('Año'); ?></td>
                            <td><?php echo $r->__GET('Color'); ?></td>
                            <td><?php echo $r->__GET('Precio'); ?></td>
                            
                        
                            
                        
                            <td>
                                <a href="?action=editar&id=<?php echo $r->id; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     

            </div>
        </div>

    </body>
</html>