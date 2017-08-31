<?php
/**
 * Padrão de Projeto DAO
 * DAO - Data Access Object -> Objeto para Acesso aos Dados
 * Classe DAO Genérica. Todas as subclasses DAO devem herdar esta classe
 */
class DAO{
	
	protected $_conexao;
	
	function __construct() {
		
		$host = "localhost";
		$user = "root";
		$senha = "";
		$bd = "crud";
		
		$this->_conexao = new PDO("mysql:host=$host;dbname=$bd","$user","$senha");
	}
}
	
	
	

	
	
	
	
	
	
	
	
	
	
	
	
	
?>