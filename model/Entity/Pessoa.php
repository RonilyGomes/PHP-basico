<?php
include_once '../util/ConvUtil.php';
/**
 * Cria a classe Pessoa
 * @author Ronily
 */
class Pessoa{

	private $_codigo;
	
	private $_nome;
	
	private $_dataNascimento;
	
	private $_rg;
	
	private $_cpf;
	
	private $_telefone;
	
	private $_email;
	
	//Método que inicia as propriedades
	function __construct($nome, $dataNascimento, $rg, $cpf, $telefone, $email){
		$this->_nome = $nome;
		$this->_dataNascimento = $dataNascimento;
		$this->_rg = $rg; 
		$this->_cpf = ConvUtil::limpaCpf($cpf);
		$this->_telefone = $telefone;
		$this->_email = $email;
	}
	
	//Métodos para obter dados
	public function getNome(){
		return $this->_nome; 
	}
	
	public function getDataNascimento(){
		return $this->_dataNascimento; 
	}
	
	public function getRg(){
		return $this->_rg;
	}
	
	public function getCpf(){
		return $this->_cpf;
	}
	
	public function getTelefone(){
		return $this->_telefone;
	}
	
	public function getEmail(){
		return $this->_email;
	}
	
	public function setCodigo($codigo){
		$this->_codigo = $codigo;
	}
	
	public function getCodigo(){
		return $this->_codigo;
	}
	
}
?>