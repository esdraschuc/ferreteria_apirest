<?php 
    // Archivo que contiene los querys necesarios para realizas las transaccioones en las tablas

    // Clase general para los productos
    class Producto extends Conectar {

        // método que recupera TODOS los productos de la tabla Producto
        // donde su estado es 1.
        public function get_producto() {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT id,nombre,marca,descripcion,precio  FROM productos WHERE estado=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        // Recuperar UN sólo registro de la tabla Producto
        public function get_producto_id($id_producto) {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT id,nombre,marca,descripcion,precio FROM productos WHERE estado=1 AND id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id_producto);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        // Insertar un nuevo producto
        public function insert_producto($nombre, $marca, $descripcion, $precio) {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "INSERT INTO productos (id, nombre, marca, descripcion, precio, estado) VALUES (NULL, ?, ?, ?, ?, '1')";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$nombre);
            $sql->bindValue(2,$marca);
            $sql->bindValue(3,$descripcion);
            $sql->bindValue(4,$precio);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        // Actualizar los datos de un producto
        public function update_producto($id, $nombre, $marca, $descripcion, $precio) {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE productos SET nombre = ?, marca = ?, descripcion = ?, precio = ? WHERE id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$nombre);
            $sql->bindValue(2,$marca);
            $sql->bindValue(3,$descripcion);
            $sql->bindValue(4,$precio);
            $sql->bindValue(5,$id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        // Borrar un producto (cambio de estado de 1 a 0)
        // Borrado lógico
        public function delete_producto($id) {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE productos SET estado = 0 WHERE id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        // Borrado físico
        public function kill_producto($id) {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "DELETE FROM productos WHERE id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        // Método que recupera las sucursales
        public function get_sucursales() {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM sucursales";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

    } // class
?>