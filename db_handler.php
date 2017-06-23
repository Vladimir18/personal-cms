<?php
error_reporting(0);
include_once('libreria/configuracion.php');

class ResultadoMysqli {
    public $error_num;
    public $error_mensaje;
    public $resultado;
    public $datos;

    public function  __construct(){

    }
    public function  __construct1($error_num, $error_mensaje){
        $this->error_num = $error_num;
        $this->error_mensaje = $error_mensaje;
    }
}

class DBHandler {
    private $db;

    function __construct() {
    }

    function openDB() {
        $this->db = new mysqli(
            DB_HOST,DB_USER,DB_PASS,DB_NAME);

        if($this->db->connect_errno) {
            echo "Fallo al contenctar a MySQL: (" . $this->db->connect_errno . ") " . $this->db->connect_error;
        }
    }

    function query ($table, $fields = array(), $where = '', $limit = 0, $order = '') {
        if(!empty($fields)){
            $fields_processed = $this->processFields($fields);
        }else{
            $fields_processed = "*";
        }

        if(!empty($where)) {
            $where = 'WHERE ' . $where;
        }
        $limits = "";
        if($limit>0){
            $limits .= " LIMIT ".$limit;
        }

        $this->openDB();
//        var_dump("SELECT {$fields_processed} FROM {$table} {$where} {$order} {$limits}");
//        die;

        $resultado = new ResultadoMysqli();
        if($results = $this->db->query("SELECT {$fields_processed} FROM {$table} {$where} {$order} {$limits}")) {
            if($results->num_rows > 0) {
                $resultado->datos = $this->generateArrayOfObjectsFromResultset($results);
            }
        }
        $resultado->error_num = $this->db->errno;
        $resultado->error_mensaje = $this->db->error;
        $resultado->resultado = $results;

        $this->closeDB();

        return $resultado;
    }

    function insert($tabla, $camposValores) {
        $campos = implode(',', array_keys($camposValores));
        $valores = implode(',', array_values($camposValores));
        $this->openDB();

//        echo "INSERT INTO {$tabla} ({$campos}) VALUES({$valores})";
//        die;

        $results = $this->db->query("INSERT INTO {$tabla} ({$campos}) VALUES({$valores})");

        $resultado = new ResultadoMysqli();
        $resultado->error_num = $this->db->errno;
        $resultado->error_mensaje = $this->db->error;
        $resultado->resultado = $results;
        if($resultado->error_num == 0) {
            $resultado->datos = $this->db->insert_id;
        }

        $this->closeDB();

        return $resultado;
    }

    function update($table, $fieldsValues, $where) {
        $valuesToUpdate = array();

        foreach($fieldsValues as $field=>$value) {
            $valuesToUpdate[] = "$field=$value";
        }

        $valuesToUpdate = implode(',',$valuesToUpdate);

        $this->openDB();
//                echo "UPDATE {$table} SET $valuesToUpdate WHERE $where; ";
//                die;
        $result = $this->db->query("UPDATE {$table} SET $valuesToUpdate WHERE $where");
        $resultado = new ResultadoMysqli();
        $resultado->error_num = $this->db->errno;
        $resultado->error_mensaje = $this->db->error;
        $resultado->resultado = $result;
        $this->closeDB();
        return $resultado;
    }
    private function generateArrayOfObjectsFromResultSet($results) {
        $arrayOfResults = array();
        while($result = $results->fetch_object()) {
            array_push($arrayOfResults, $result);
        }
        return $arrayOfResults;
    }

    function closeDB() {
        return $this->db->close();
    }

    function delete($table , $where){
        $this->openDB();
//        echo "DELETE from {$table} WHERE $where "; die;
        $result = $this->db->query("DELETE from {$table} WHERE $where");
        $resultado = new ResultadoMysqli();
        $resultado->error_num = $this->db->errno;
        $resultado->error_mensaje = $this->db->error;
        $resultado->resultado = $result;
        return $resultado;
    }
}
