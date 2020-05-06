<?php

// Autor: Arriaga Martinez Alan Edurado

class Clase {
	# Variables
	private $clave;
	private $opciones;
	# Metodos
	function __construct($clave) {
		$this->clave = $clave;
		$this->opciones = array();
		$this->setOpciones();

	}
	private function getValorHora($hora) {
		switch ($hora) {
			case "07:00-08:30": return 1;
			case "08:30-10:00": return 2;
			case "10:30-12:00": return 3;
			case "12:00-13:30": return 4;
			case "13:30-15:00": return 5;
			case "15:00-16:30": return 6;
			case "16:30-18:00": return 7;
			case "18:30-20:00": return 8;
			case "20:00-21:30": return 9;
			default: return 0;
		}
	}
	private function getValorDia($dia) {
		switch ($dia) {
			case "Lun": return 0;
			case "Mar": return 1;
			case "Mie": return 2;
			case "Jue": return 3;
			case "Vie": return 4;
		}
	}
	private function setOpciones() {
		$db = new DB();
		$db->conectar();
		$noRes = $db->getNoOpcMateria($this->clave);
		/*echo "<br>Materia ", $this->clave;
		echo "<br>No opcs: ", $noRes;
		echo "<br>";*/
		$res = array();
		$clase = array("x","x","x","x","x");
		$res = $db->getHorarioMateria($this->clave);
		for($opc=0; $opc<$noRes-1; $opc++) {
			$dia = $this->getValorDia($res[$opc]["Dia"]);
			$hora = $this->getValorHora($res[$opc]["Hora"]);
			$clase[$dia] = $hora;
			/*echo "<br>", $opc, ") ";
			echo $res[$opc]["Grupo"]." ".$res[$opc]["Dia"]." ".$res[$opc]["Hora"];*/
			if($res[$opc]["Grupo"] != $res[$opc+1]["Grupo"]) {
				array_push($clase, $res[$opc]["Grupo"]);
				array_push($this->opciones, $clase);
				//echo "agrega ";
				$clase = array("x","x","x","x","x");
			}
		}
		array_push($clase, $res[$opc]["Grupo"]);
		array_push($this->opciones, $clase);
	}
	public function getOpciones() {
		return $this->opciones;
	}
	public function imprimirClase() {
		echo "Clave de materia: ".$this->clave;
		for($i=0; $i<count($this->opciones); $i++) {
			$aux = $this->opciones[$i];
			echo "<br>".$i.") ";
			for($j=0; $j<6; $j++)
				echo $aux[$j].", ";
		}
		echo "<br>";
	}
	public function getNoOpciones() {
		return count($this->opciones);
	}
	public function getClave() {
		return $this->clave;
	}
}

?>