<?php 
    // Encabezado para que PHP reconozca que se van a intercambiar archivos JSON
    header('Content-Type: application/json');
    
    // Este archivo será el controlador del API REST, aquí se van a realizar
    // las operaciones del CRUD
    // Create, Read, Update, Delete
    require_once "../config/conexion.php";
    require_once "../models/Productos.php";

    // Para recibir solicitudes de la URI
    $body = json_decode(file_get_contents("php://input"),true);

    // instanciar el objeto producto
    // se ocupará para realizar las acciones del API
    $producto = new Producto(); 

    // Crear el webservice que realice las acciones del CRUD por medio 
    // de la API REST, el switch será el encargado de atender las peticiones
    switch($_GET["opcion"]) {
        // Este caso, recupera todos los datos de la tabla productos
        // la información es traída del archivo
        // models->Productos.php-> método get_producto()
        case "getAll" :
            $datos = $producto->get_producto();
            // una vez recuperados los datos, se les da formato json
            echo json_encode($datos);
            break;
        // Para recuperar un registro se ocupa get, que tiene el id del producto
        case "get":
            $datos = $producto->get_producto_id($body["id"]); //  id de la tabla a consultar
            echo json_encode($datos);
            break;
        
        // Para insertar un registro se deben mandar los campos en el json
        case "insert":
            // datos a insertar en la tabla
            $datos = $producto->insert_producto($body["nombre"], $body["marca"], $body["descripcion"], $body["precio"]); 
            echo json_encode("Producto Insertado");
            break;
        
        // Para actualizar un registro se deben mandar los campos en el json
        case "update":
            // datos a actualizar en la tabla
            $datos = $producto->update_producto($body["id"], $body["nombre"], $body["marca"], $body["descripcion"], $body["precio"]); 
            echo json_encode("Producto Actualizado");
            break;
        
        // Para hacer un borrrado lógico de un registro 
        case "delete":
            // solo el id del producto
            $datos = $producto->delete_producto($body["id"]); 
            echo json_encode("Producto Eliminado");
            break;
        
        case "kill":
            // solo el id del producto
            $datos = $producto->kill_producto($body["id"]); 
            echo json_encode("Producto Eliminado Definitivamente");
            break;
        
        case "getSucursales" :
            $datos = $producto->get_sucursales();
            echo json_encode($datos); // Devuelve el json con las sucursales
            break;   
        
    }

?>