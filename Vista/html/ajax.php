<?php
// print_r($_POST);
// exit;
include '../../includes/conexion.php';
session_start();


if (!empty($_POST)) {
    //Extraer datos del producto
    if ($_POST['action'] == 'infoProducto') {
        $producto_id = $_POST['producto'];

        $query = mysqli_query($conexion, "SELECT codproducto, nombre, descripcion, cantidad, precio FROM producto WHERE codproducto = $producto_id AND estatus = 1");

        mysqli_close($conexion);

        $result = mysqli_num_rows($query);
        if ($result > 0) {
            $data = mysqli_fetch_assoc($query);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            exit;
        }
        echo 'error';
        exit;
    }

    //Agregar datos del producto a entrada
    if ($_POST['action'] == 'addProduct') {
        if (!empty($_POST['cantidad']) || !empty($_POST['precio']) || !empty($_POST['producto_id'])) {
            $cantidad = $_POST['cantidad'];
            $precio = $_POST['precio'];
            $producto_id = $_POST['producto_id'];
            $usuario_id = $_SESSION['codUsuario'];

            $query_insert = mysqli_query($conexion, "INSERT INTO entradas(codproducto,cantidad,precio,usuario_id)VALUES($producto_id,$cantidad,$precio,$usuario_id)");

            if ($query_insert) {
                //Ejecutar procedimiento almacenado
                $query_upd = mysqli_query($conexion, "CALL actualizar_precio_producto($cantidad,$precio,$producto_id)");
                $result_pro = mysqli_num_rows($query_upd);

                if ($result_pro > 0) {
                    $data = mysqli_fetch_assoc($query_upd);
                    $data['producto_id'] = $producto_id;
                    echo json_encode($data, JSON_UNESCAPED_UNICODE);
                    exit;
                }
            } else {
                echo 'error en $query_insert';
            }
            mysqli_close($conexion);
        } else {
            echo 'error';
        }
        exit;
    }

    //Buscar cliente
    if ($_POST['action'] == 'searchCliente') {
        if (!empty($_POST['cliente'])) {

            $nit = $_POST['cliente'];

            $query = mysqli_query($conexion, "SELECT * FROM cliente WHERE id LIKE '$nit' ");
            mysqli_close($conexion);
            $result = mysqli_num_rows($query);

            $data = '';
            if ($result > 0) {
                $data = mysqli_fetch_assoc($query);
            } else {
                $data = 0;
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        exit;
    }

    //Agregar producto al detalle temporal
    if ($_POST['action'] == 'add_product_detalle') {
        if (empty($_POST['producto']) || empty($_POST['cantidad'])) {
            echo 'error';
        } else {
            $codproducto = $_POST['producto'];
            $cantidad = $_POST['cantidad'];
            $token = md5($_SESSION['id']);
            
            //Extraer el iva
            $query_iva = mysqli_query($conexion,"SELECT iva FROM configuracion");
            $result_iva = mysqli_num_rows($query_iva);

            //llamara procedimiento almacenado
            $query_detalle_temp = mysqli_query($conexion, "CALL add_detalle_temp($codproducto,$cantidad,'$token')");
            $result = mysqli_num_rows($query_detalle_temp);


            $detalleTabla = '';
            $sub_total = 0;
            $total = 0;
            $iva = 0;
            $arrayData = array();
            

            if ($result > 0) {
                if ($result_iva > 0) {
                    $info_iva = mysqli_fetch_assoc($query_iva);
                    $iva = $info_iva['iva'];
                }

                while ($data = mysqli_fetch_assoc($query_detalle_temp)) {
                    $precio_total = round($data['cantidad'] * $data['precio_venta'], 2);
                    $sub_total = round($sub_total + $precio_total, 2);
                    $total = round($total + $precio_total, 2);

                    $detalleTabla .= '
                    <tr>
                        <td id="data_venta">'.$data['codproducto'].'</td>
                        <td>' . $data['nombre'] . '</td>
                        <td colspan="3">' . $data['descripcion'] . '</td>
                        <td>' . $data['cantidad'] . '</td>
                        <td>' . $data['precio_venta'] . '</td>
                        <td>' . $precio_total . '</td>
                        <td><a href="#" onclick="event.preventDefault();del_product_detalle(' . $data['correlativo'] . ');"><i class="bi bi-trash-fill" style="font-size: 2rem; color: #dc3545;"></i></a></td>
                    </tr>
                ';
                }
                $impuesto = round($sub_total * ($iva / 100), 2);
                $total_sin_iva = round($sub_total - $impuesto, 2);
                $total = round($total_sin_iva + $impuesto, 2);

                $detalleTotales = '
                <tr>
                    <td colspan="7" >Sub Total</td>
                    <td class="text-right">' . $total_sin_iva . '</td>
                </tr>
                <tr>
                    <td colspan="7" >IVA.' . $iva . '%</td>
                    <td class="text-right">' . $impuesto . '</td>
                    
                </tr>
                <tr>
                    <td colspan="7" >TOTAL</td>
                    <td>' . $total . '</td>
                    
                </tr>
            ';
                $arrayData['detalle'] = $detalleTabla;
                $arrayData['totales'] = $detalleTotales;

                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
            } else {
                echo 'error';
            }
            mysqli_close($conexion);
        }
        exit;
    }

    //eliminar producto del detelle temporal
    if ($_POST['action'] == 'delProductoDetalle') {
        if (empty($_POST['id_detalle'])) {
            echo 'error';
        } else {
            
            $id_detalle = $_POST['id_detalle'];
            $token = md5($_SESSION['id']);

            //Extraer el iva
            $query_iva = mysqli_query($conexion,"SELECT iva FROM configuracion");
            $result_iva = mysqli_num_rows($query_iva);

            //query para llamar el procedimiento almacenado
            $query_detalle_temp = mysqli_query($conexion, "CALL del_detalle_temp($id_detalle,'$token')");
            $result = mysqli_num_rows($query_detalle_temp);

            $detalleTabla = '';
            $sub_total = 0;
            $total = 0;
            $iva = 0;
            $arrayData = array();

            if ($result > 0) {
                if ($result_iva > 0) {
                    $info_iva = mysqli_fetch_assoc($query_iva);
                    $iva = $info_iva['iva'];
                }

                while ($data = mysqli_fetch_assoc($query_detalle_temp)) {
                    $precio_total = round($data['cantidad'] * $data['precio_venta'], 2);
                    $sub_total = round($sub_total + $precio_total, 2);
                    $total = round($total + $precio_total, 2);

                    $detalleTabla .= '
                    <tr">
                        <td>'.$data['codproducto'].'</td>
                        <td>' . $data['nombre'] . '</td>
                        <td colspan="3">' . $data['descripcion'] . '</td>
                        <td>' . $data['cantidad'] . '</td>
                        <td>' . $data['precio_venta'] . '</td>
                        <td>' . $precio_total . '</td>
                        <td><a href="#" onclick="event.preventDefault();del_product_detalle(' . $data['correlativo'] . ');"><i class="bi bi-trash-fill" style="font-size: 2rem; color: #dc3545;"></i></a></td>
                    </tr>
                ';  
                }
                $impuesto = round($sub_total * ($iva / 100), 2);
                $total_sin_iva = round($sub_total - $impuesto, 2);
                $total = round($total_sin_iva + $impuesto, 2);

                $detalleTotales = '
                <tr>
                    <td colspan="7" >Sub Total</td>
                    <td class="text-right">' . $total_sin_iva . '</td>
                </tr>
                <tr>
                    <td colspan="7" >IVA.' . $iva . '%</td>
                    <td class="text-right">' . $impuesto . '</td>
                    
                </tr>
                <tr>
                    <td colspan="7" >TOTAL</td>
                    <td>' . $total . '</td>
                    
                </tr>
            ';
                $arrayData['detalle'] = $detalleTabla;
                $arrayData['totales'] = $detalleTotales;

                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
            } else {
                echo 'error';
            }
            mysqli_close($conexion);
        }
        exit;
    }

    //extraer datos al detalle temporal
    if ($_POST['action'] == 'searchForDetalle') {
        if (empty($_POST['user'])) {
            echo 'error';
        } else {
            $token = md5($_SESSION['id']);
            $detalleTabla = '';
            $sub_total = 0;
            $total = 0;
            $arrayData = array();

            //query para extraer los datos de detalle_temp
            $query = mysqli_query($conexion, "SELECT tmp.correlativo, 
                                                    tmp.token_user, 
                                                    tmp.cantidad, 
                                                    tmp.precio_venta, 
                                                    p.codproducto, 
                                                    p.nombre, 
                                                    p.descripcion 
                                                FROM detalle_temp tmp INNER JOIN producto p ON tmp.codproducto = p.codproducto WHERE token_user = '$token' ");
            
            $result = mysqli_num_rows($query);
            
            //Extraer el iva
            $query_iva = mysqli_query($conexion,"SELECT iva FROM configuracion");
            $result_iva = mysqli_num_rows($query_iva);

            $detalleTabla = '';
            $sub_total = 0;
            $total = 0;
            $iva = 0;
            $arrayData = array();

            if ($result > 0) {
                if ($result_iva > 0) {
                    $info_iva = mysqli_fetch_assoc($query_iva);
                    $iva = $info_iva['iva'];
                }


                while ($data = mysqli_fetch_assoc($query)) {
                    $precio_total = round($data['cantidad'] * $data['precio_venta'], 2);
                    $sub_total = round($sub_total + $precio_total, 2);
                    $total = round($total + $precio_total, 2);

                    $detalleTabla .= '
                    <tr id="tr-venta">
                        <td>'.$data['codproducto'].'</td>
                        <td>' . $data['nombre'] . '</td>
                        <td colspan="3">' . $data['descripcion'] . '</td>
                        <td>' . $data['cantidad'] . '</td>
                        <td>' . $data['precio_venta'] . '</td>
                        <td>' . $precio_total . '</td>
                        <td><a href="#" onclick="event.preventDefault();del_product_detalle(' . $data['correlativo'] . ');"><i class="bi bi-trash-fill" style="font-size: 2rem; color: #dc3545;"></i></a></td>
                    </tr>
                ';
                }
                $impuesto = round($sub_total * ($iva / 100), 2);
                $total_sin_iva = round($sub_total - $impuesto, 2);
                $total = round($total_sin_iva + $impuesto, 2);

                $detalleTotales = '
                <tr>
                    <td colspan="7" >Sub Total</td>
                    <td class="text-right">' . $total_sin_iva . '</td>
                </tr>
                <tr>
                    <td colspan="7" >IVA.' . $iva . '%</td>
                    <td class="text-right">' . $impuesto . '</td>
                    
                </tr>
                <tr>
                    <td colspan="7" >TOTAL</td>
                    <td>' . $total . '</td>
                    
                </tr>
            ';
                $arrayData['detalle'] = $detalleTabla;
                $arrayData['totales'] = $detalleTotales;

                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
                
            } else {
                echo $result;
                echo 'error';
            }
            mysqli_close($conexion);
        }
        exit;
    }

    //anular venta
    if ($_POST['action'] == 'anularventa'){
        $token = md5($_SESSION['id']);
        $query_del = mysqli_query($conexion, "DELETE FROM detalle_temp WHERE token_user = '$token' ");
        if ($query_del) {
            echo 'ok';
        }else{
            echo 'error';
        }exit;

    }
    //procesar venta
    if ($_POST['action'] == 'procesarVenta'){
        if (empty($_POST['codcliente'])) {
            $codcliente = 1;
        }else{
            $codcliente = $_POST['codcliente'];
        }
        $token = md5($_SESSION['id']);
        $usuario = $_SESSION['codUsuario'];

        $query = mysqli_query($conexion,"SELECT * FROM detalle_temp WHERE token_user = '$token' ");
        $result = mysqli_num_rows($query);

        if ($result > 0) {
            
            $query_procesar = mysqli_query($conexion,"CALL procesar_venta($usuario,$codcliente,'$token')");
            $result_detalle = mysqli_num_rows($query_procesar);

            if ($result_detalle > 0) {
                $data = mysqli_fetch_assoc($query_procesar);
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }else{
                echo "error";
            }
        }else{
            echo "error";
        }
        mysqli_close($conexion);
        exit;
    }
}
exit;
?>