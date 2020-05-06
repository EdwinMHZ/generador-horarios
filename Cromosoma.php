<?php

// Autor: Arriaga Martinez Alan Edurado

class Cromosoma {
	# Variables
	private $contenido;
	private $fitness;
	private $tam;
	private $noOpcXmateria;
	private $opcXmateria;
	# Metodos
	function __construct($tam, $noOpcXmateria, $opcXmateria) {
		$this->tam = $tam;
		$this->noOpcXmateria = $noOpcXmateria;
		$this->opcXmateria = $opcXmateria;
		$this->fitness = 100;	// No apto
	}
	public function getContenido() {
		return $this->contenido;
	}
	public function getFitness() {
		return $this->fitness;
	}
	public function setContenido($contenido) {
		$this->contenido = $contenido;
		$this->evaluarFitness();
		//$this->mostrarCromosoma();
	}
	private function imprimirArreglo($arreglo) {
		for($i=0; $i<count($arreglo); $i++) {
			echo $arreglo[$i];
			echo ",";
		}
	}
	private function evaluarHorario($horario) {
		//echo "<br>Evaluacion<br>";
		$clasesLibres = 0;
		for($dia=0; $dia<5; $dia++) {
			//echo "<br>";
			$cont = 0;
			for($materia=0; $materia<$this->tam; $materia++) {
				$m = $horario[$materia];
				$arreglo[$cont] = $m[$dia];
				$cont++;
			}
			rsort($arreglo);
			//$this->imprimirArreglo($arreglo);
			if($arreglo[0] == "x") {
				//echo " dia libre \o/";
				continue;
			}
			for($i=0; $i<$this->tam-1; $i++) {
				if($arreglo[$i+1] == "x")
					break;
				// Si una clase esta empalmada
				if($arreglo[$i] == $arreglo[$i+1])
					return -1;
				else
					$clasesLibres += $arreglo[$i]-$arreglo[$i+1]-1;
			}
		}
		$this->fitness = $clasesLibres;
		return 0;
	}
	public function generarCromosoma() {
		for($i=0; $i<$this->tam; $i++)
			$this->contenido[$i] = rand(0, $this->noOpcXmateria[$i]-1);
		$this->evaluarFitness();
		//$this->mostrarCromosoma();
	}
	public function evaluarFitness() {
		$horario = array();
		for($materia=0; $materia<$this->tam; $materia++) {
			$opc = $this->contenido[$materia];
			$o = $this->opcXmateria[$materia];
			//echo "<br>Materia: ".$o->getClave()." ,".$opc." ) ";
			$clases = $o->getOpciones();
			$clase = $clases[$opc];
			//$this->imprimirArreglo($clase);
			array_push($horario, $clase);
		}
		$this->evaluarHorario($horario);
		/*if($this->evaluarHorario($horario) == -1)
			echo "<br>NO pasa con fit: ".$this->fitness."<br>";
		else 
			echo "<br>SI pasa con fit: ".$this->fitness."<br>";*/
	}
	public function mutar() {
		$posMutacion = rand(0, $this->tam-1);
		$valMutacion = rand(0, $this->noOpcXmateria[$posMutacion]-1);
		$this->contenido[$posMutacion] = $valMutacion;
		$this->evaluarFitness();
		//$this->mostrarCromosoma();
	}
	public function cruzar($cromosoma2) {
		$res = array();
		$contenido2 = $cromosoma2->getContenido();
		$mitad = $this->tam/2;
		$c11 = array_slice($this->contenido, 0, $mitad);
		$c12 = array_slice($this->contenido, $mitad, $this->tam);
		$c21 = array_slice($contenido2, 0, $mitad);
		$c22 = array_slice($contenido2, $mitad, $this->tam);
		$newcontent1 = array_merge($c11, $c22);
		$newcontent2 = array_merge($c21, $c12);
		$cromosoma1 = new Cromosoma($this->tam, $this->noOpcXmateria, $this->opcXmateria);
		$cromosoma1->setContenido($newcontent1);
		$cromosoma2 = new Cromosoma($this->tam, $this->noOpcXmateria, $this->opcXmateria);
		$cromosoma2->setContenido($newcontent2);
		//echo "<br>Mutacion de 1 Cruce";
		$cromosoma1->mutar();
		array_push($res, $cromosoma1);
		array_push($res, $cromosoma2);
		return $res;
	}
	public function mostrarCromosoma() {
		echo "<br>Cromosoma: [";
		$this->imprimirArreglo($this->contenido);
		echo "], fit: $this->fitness";
	}
}

?>