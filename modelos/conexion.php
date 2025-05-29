<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=epicosie_chapinero",
			            "epicosie_acplasticos2",
			            "T7D*,LnFPZ}d");

		$link->exec("set names utf8");

		return $link;

	}

}