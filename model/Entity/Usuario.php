<?php

	class Usuario{
		
		private $_codigo;
		private $_nome;
		private $_senha;
		private $_nivel;
		private $_status;
		
		function __construct($nome,$senha,$nivel){
			$this->_nome = $nome;
			$this->_senha = $senha;
			$this->_nivel = $nivel;
			//$this->_status = $status;
		}
		
		public function getNome(){
			return $this->_nome;
		}
		
		public function getSenha(){
			return $this->_senha;
		}
		
		public function getNivel(){
			return $this->_nivel;
		}
		
		public function setStatus($status){
			$this->_status = $status;
		}
		public function getStatus(){
			return $this->_status;
		}
		public function setCodigo($codigo){
			$this->_codigo = $codigo;
		}
		
		public function getCodigo(){
			return $this->_codigo;
		}
		
	}
?>