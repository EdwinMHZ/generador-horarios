<?php

// Autor: Arriaga Martinez Alan Edurado

class DB {
	# Variables
	private $host = "localhost";
	private $user = "root";
	private $pass = "";
	private $datab = "SAES";
	private $enlace;
	# Metodos
	function __construct() {
		
	}
	public function conectar() {
		if(!$this->enlace = mysqli_connect($this->host, $this->user, $this->pass)) {
    		echo "No pudo conectarse a mysql".mysql_error();
    		exit;
		}
    	if(!mysqli_select_db($this->enlace,$this->datab)) {
			echo "No se encontro la base de datos";
			exit;
    	}
	}
	public function validarConsulta($res) {
		if(!$res) {
            echo "No se ha podido realizar la consulta";
            exit;
        }
	}
	public function getHorarioMateria($clave) {
		$sql = "SELECT * FROM Clases WHERE Materia_Clave='$clave' ORDER BY Grupo";
		$res = mysqli_query($this->enlace, $sql);
		$this->validarConsulta($res);
        if(mysqli_num_rows($res) > 0) {
        	$opc = array();
        	while($row = mysqli_fetch_assoc($res))
        		array_push($opc, $row);
        	return $opc;
        }
        else {
        	echo "<br>No se encontraron clases para la materia con clave: ".$clave;
        	exit(0);
        }
	}
	public function getNoOpcMateria($clave) {
		$sql = "SELECT COUNT(*) as count FROM Grupo WHERE Materia_Clave='$clave'";
		$res = mysqli_query($this->enlace, $sql);
		$this->validarConsulta($res);
        if(mysqli_num_rows($res) > 0) {
        	$row = mysqli_fetch_assoc($res);
            	return $row['count'];
        }
        else
        	return 0;
	}
}

?>