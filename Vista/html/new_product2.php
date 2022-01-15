<?php
include '../../includes/conexion.php';
include '../../includes/header.php';
include '../../includes/nav.php';
include '../../includes/script.php';
echo '<script type="text/javascript" src="../js/functions.js"></script>';
if ($_SESSION['rol'] == 'Administrador' || $_SESSION['rol'] == 'Vendedor') {

    if (!empty($_POST)) {
        
        $alert='';
        if (empty($_POST['proveedor']) || empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['costo']) || $_POST['costo'] <=0 || empty($_POST['precio']) || $_POST['precio']<=0 || empty($_POST['cantidad']) || $_POST['cantidad'] <=0) {
            echo '<script>
            errorData()
            </script>';
        }else{
            $proveedor = $_POST['proveedor'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $costo = $_POST['costo'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $fechaVence = $_POST['fechaVence'];
            

            $foto = $_FILES['foto'];
            $nombre_foto = $foto['name'];
            $type = $foto['type'];
            $url_temp = $foto['tmp_name'];
            $imgProducto = 'img_producto.png';

            if ($nombre_foto != '') {
                $destino = '/opt/lampp/htdocs/sifco_html/Vista/img/uploads/';
                $img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
                $imgProducto = $img_nombre.'.jpg';
                $src = $destino.$imgProducto;
            }
            $sentence2 = "INSERT INTO producto (nombre, descripcion, costo, precio, cantidad, fechaVencimiento, usuario_id, foto) VALUES ( '".$nombre."', '".$descripcion."', '".$costo."', '".$precio."', '".$cantidad."', '".$fechaVence."', '".$usuario_id."', '".$imgProducto."')";
            $conexion->query($sentence2) or die ("Error al crear el producto: ".mysqli_error($conexion));
            
            if($sentence2){
                if ($nombre_foto != '') {
                    move_uploaded_file($url_temp, $src);
                };
                echo'<script>
                addedProduct()       
                </script>'; 
            }else{
                echo'<script>
                errorProduct()       
                </script>'; 
            }
            
            
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agregar Producto</title>
    </head>

    <body>
        <div class="container justify-content-center mt-5">
            <form class="col-auto" action="" method="POST" enctype="multipart/form-data">
                <fieldset>

                    <legend class="text-primary"><i class="bi bi-bag-plus-fill" style="font-size: 2rem; color: cornflowerblue;"></i> AGREGAR PRODUCTO</legend>
                    <div class="mb-4">
                        <label for="proveedor" class="form-label mt-2">Proveedor</label>
                        <!-- query para consultar la lista de proveedores -->
                        <?php

                        $query_proveedor = mysqli_query($conexion, "SELECT codproveedor, proveedor FROM proveedor ORDER BY proveedor");
                        $result_proveedor = mysqli_num_rows($query_proveedor);

                        ?>
                        <select name="proveedor" id="proveedor" class="form-select">
                            
                            
                            <?php

if ($result_proveedor > 0) {
    while ($proveedor = mysqli_fetch_array($query_proveedor)) {
        ?>

<option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor']; ?></option>

<?php
                                }
                            } ?>
                        </select><br>
                        <a href="new_proveedor.php" target="blank">
                            <button type="button" class="btn btn-primary">Nuevo Proveedor</button>
                        </a><br>
                        <label for="nombre" class="form-label mt-3">Nombre</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre del Producto" class="form-control" requiredrequired>

                        <label for="descripcion" class="form-label mt-3">Descripcion</label>
                        <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion del Producto" class="form-control">

                        <label for="costo" class="form-label mt-3">Costo</label>
                        <input type="number" name="costo" id="costo" placeholder="Costo del Producto" class="form-control"required>

                        <label for="precio" class="form-label mt-3">Precio</label>
                        <input type="number" name="precio" id="precio" placeholder="Precio del producto" class="form-control">
                        

                        <label for="cantidad" class="form-label mt-3">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad del producto" class="form-control"required>
                        <label for="fechaVence" class="form-label mt-3">Fecha de Vencimineto</label>
                        <input type="date" name="fechaVence" id="fechaVence" class="form-control">


                        <div class="photo mt-3">
                            <label for="foto">Foto</label>
                            <div class="prevPhoto">
                                <span class="delPhoto notBlock">X</span>
                                <label for="foto"></label>
                            </div>
                            <div class="upimg">
                                <input type="file" name="foto" id="foto">
                            </div>
                            <div id="form_alert"></div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary mt-3 justify-content-center"><i class="bi bi-save-fill" style="font-size: 1rem;"></i> Guardar Producto</button>
                </fieldset>
            </form>
        </div>

    </body>

    </html>
<?php } ?>