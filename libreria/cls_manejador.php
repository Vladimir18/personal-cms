<?php
error_reporting(0);
session_start();
class pagina{
    public $id;
    public $titulo;
    public $contenido;
    public $id_usuario;
    public $fecha_creacion;
    public $fecha_modificacion;
    public $estado;

    function guardar(){
        $sql = "INSERT INTO pagina(titulo, contenido, id_usuario, fecha_creacion, fecha_modificacion, estado)VALUES('{$this->titulo}', '{$this->contenido}', '{$this->id_usuario}', {$this->fecha_creacion}, {$this->fecha_modificacion},'{$this->estado}')";
//        var_dump($sql);
        $con = conexion::get();
        mysqli_query($con, $sql);
//        var_dump(mysqli_query($con, $sql));
    }
}

class comentario{
    public $id;
    public $nombre;
    public $email;
    public $comentario;
    public $fecha_creacion;
    public $id_articulo;

    function guardar(){
        $sql = "INSERT INTO comentario(nombre, email, comentario, fecha_creacion, id_articulo)VALUES('{$this->nombre}', '{$this->email}', '{$this->comentario}', '{$this->fecha_creacion}', {$this->id_articulo})";
        $con = conexion::get();
        var_dump($sql);
        mysqli_query($con, $sql);
        $this->id = mysqli_insert_id($con);
    }
}

class articulo{
    public $id;
    public $titulo;
    public $contenido;
    public $id_usuario;
    public $fecha_creacion;
    public $fecha_modificacion;
    public $estado;
}