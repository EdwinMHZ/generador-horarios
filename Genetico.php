<?php

// Autor: Arriaga Martinez Alan Edurado

require "Cromosoma.php";
require "Clase.php";
require "DB.php";

class Genetico {
	# Variables
	private $soluciones;
	private $noMaxSoluciones;
	private $tamPoblacion;
	private $tamPobElim;
	#######################
	private $claveMaterias;
	private $noMaterias;
	private $noOpcXmateria;
	private $opcXmateria;
	# Metodos
	function __construct($claveMaterias) {
		$this->noMaxSoluciones = 3;
		$this->tamPobAcep = 1000;
		$this->tamPobElim = 300;
		$this->tamPoblacion = $this->tamPobAcep+$this->tamPobElim;
		$this->soluciones = array();
		$this->claveMaterias = $claveMaterias;
		$this->noMaterias = count($claveMaterias);
		$this->opcXmateria = array();
		for($m=0; $m<$this->noMaterias; $m++) {
			$clase = new Clase($claveMaterias[$m]);
			//$clase->imprimirClase();
			$this->noOpcXmateria[$m] = $clase->getNoOpciones();
			array_push($this->opcXmateria, $clase);
		}
	}
	private function imprimirArreglo($arreglo) {
		for($i=0; $i<count($arreglo); $i++) {
			echo $arreglo[$i];
			echo ",";
		}
	}
	private function generarPoblacion($n) {
		$poblacion = array();
		for($i=0; $i<$n; $i++){
			$c = new Cromosoma($this->noMaterias, $this->noOpcXmateria, $this->opcXmateria);
			$c->generarCromosoma();
			array_push($poblacion, $c);
		}
		return $poblacion;
	}
	private function generarIndivuduo() {
		$c = new Cromosoma($this->noMaterias, $this->noOpcXmateria, $this->opcXmateria);
		$c->generarCromosoma();
		return $c;
	}
	private function ordenarPoblacion($poblacion) {
		foreach ($poblacion as $i => $p)
			$aux[$i] = $p->getFitness();
		array_multisort($aux, SORT_ASC, $poblacion);
		return $poblacion;
	}
	private function interpretarSolucion($cromosoma) {
		$horario = array();
		for($i=0; $i<$this->noMaterias; $i++) {
			$clave = $this->claveMaterias[$i];
			$clase = $this->opcXmateria[$i];
			$opciones = $clase->getOpciones();
			$opc = $opciones[$cromosoma[$i]];
			$grupo = $opc[5];
			$materia[0] = $clave;
			$materia[1] = $grupo;
			array_push($horario, $materia);
		}
		return $horario;
	}
	private function imprimirPoblacion($poblacion) {
		foreach ($poblacion as $p)
			echo $p->mostrarCromosoma();
		echo "<br>";
	}
	private function agregarSolucion($s) {
		$agregar = True;
		foreach ($this->soluciones as $ss) {
			if($ss == $s)
				$agregar = False;
		}
		if($agregar == True)
			array_push($this->soluciones, $s);
	}
	private function run() {
		$numGeneracion = 1;
		$nuevaGeneracion = True;
		$poblacion = $this->generarPoblacion($this->tamPoblacion);
		while($nuevaGeneracion == True) {
			//echo "Generacion: ".$numGeneracion;
			//$this->imprimirPoblacion($poblacion);
			// Agrega
			for($i=0; $i<$this->tamPobAcep; $i++) {
				if($poblacion[$i]->getFitness()!=100) {	// No apto
					// Condicion de paro
					if($this->noMaxSoluciones == count($this->soluciones)) {
						$nuevaGeneracion = False;
						break;
					}
					else {
						$this->agregarSolucion($poblacion[$i]->getContenido());
						$poblacion[$i] = $this->generarIndivuduo();
					}
				}
				else
					break;
			}
			// Continua
			$cruce = $poblacion[rand(0, $this->tamPoblacion-1)]->cruzar($poblacion[rand(0, $this->tamPoblacion-1)]);
			$poblacion = array_merge($poblacion, $cruce);
			$ordenado = $this->ordenarPoblacion($poblacion);
			$pasantes = array_slice($ordenado, 0, $this->tamPobAcep);
			$nuevos = $this->generarPoblacion($this->tamPobElim);
			$poblacion = array_merge($pasantes, $nuevos);
			$numGeneracion++;
		}
	}
	public function getHorarios() {
		$horarios = array();
		$this->run();
		foreach ($this->soluciones as $sol) {
			$horario = $this->interpretarSolucion($sol);
			array_push($horarios, $horario);
		}
		return $horarios;
	}
}

?>