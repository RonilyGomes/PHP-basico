<?php

require("DAO.php");
require("IDaoCrud.php");

/**
 * Padrão de Projeto DAO
 * DAO - Data Access Object -> Objeto para Acesso aos Dados
 * Classe para fazer as operações de Banco de Dados para Class Pessoa
 */
class PessoaDAO extends DAO implements IDaoCrud {
	
	/**
	 * Insere um registro no banco de dados
	 *
	 * @name inserir
	 * @param Pessoa $pessoa        	
	 */
	public function inserir($pessoa) {
		
		$conectar = $this->_conexao;
		$query = "INSERT INTO s_pessoa(cpf, nome, dataNascimento, rg, telefone, email) VALUES (:cpf, :nome, :dataNasc, :rg, :tel, :email)";
		
		$resultado = $conectar->prepare($query);
		$resultado->bindValue(":cpf",$pessoa->getCpf());
		$resultado->bindValue(":nome",$pessoa->getNome());
		$resultado->bindValue(":dataNasc",$pessoa->getDataNascimento());
		$resultado->bindValue(":rg",$pessoa->getRg());
		$resultado->bindValue(":tel",$pessoa->getTelefone());
		$resultado->bindValue(":email",$pessoa->getEmail());
		$resultado->execute();
		return $resultado->rowCount();
	}
	
	/**
	 * Consulta um registro no banco de dados
	 *
	 * @name consultar
	 * @param Pessoa $pessoa        	
	 */
	public function consultar($nome = null) {
		
		$conectar = $this->_conexao;
		$query = "SELECT * FROM s_pessoa";
		if ($nome)
			$query .= " WHERE nome LIKE '%" . $nome . "%'";
			$query.=" ORDER BY nome";
			$result = $conectar->prepare($query);
			$result->execute();
			$arrRetorno = array();
			while ($row = $result->fetch(PDO::FETCH_ASSOC)){
				$arrRetorno [] = $row;
			}
			return $arrRetorno;
	}
	
	/**
	 * Atualiza um registro no banco de dados
	 *
	 * @name atualizar
	 * @param Pessoa $pessoa        	
	 */
	public function atualizar( $pessoa ) {
		
		$conectar = $this->_conexao;
		$query = "UPDATE s_pessoa SET nome=:nome ,dataNascimento=:dataNasc ,rg=:rg ,cpf=:cpf ,telefone=:tel ,email=:email WHERE nu_seq_pessoa=:pk";
		$result = $conectar->prepare($query);
		$result->bindValue(":nome",$pessoa->getNome());
		$result->bindValue(":dataNasc", $pessoa->getDataNascimento());
		$result->bindValue(":rg", $pessoa->getRg());
		$result->bindValue(":cpf", $pessoa->getCpf());
		$result->bindValue(":tel", $pessoa->getTelefone());
		$result->bindValue(":email", $pessoa->getEmail());
		$result->bindValue(":pk", $pessoa->getCodigo());
		$result->execute();
		return $result->rowCount();
	}
	
	/**
	 * Deleta um registro no banco de dados
	 *
	 * @name deletar
	 * @param Pessoa $pessoa        	
	 */
	public function deletar( $codigo ) {
		
		$conectar = $this->_conexao;
		$query = "DELETE FROM s_pessoa WHERE nu_seq_pessoa = :pk";
		$result = $conectar->prepare($query);
		$result->bindValue(":pk", $codigo);
		$result->execute();
	}
	
	/**
	 * Buscar uma pessoa pelo código de pk
	 * @param $codPessoa
	 * @return Pessoa $pessoa
	 */
	public function buscaByCodigo( $codPessoa ){
		
		include_once '../model/Entity/Pessoa.php';
		
		$conectar = $this->_conexao;
		$query = "SELECT * FROM s_pessoa WHERE nu_seq_pessoa =:pk";
		$result = $conectar->prepare($query);
		$result->bindValue(":pk", $codPessoa, PDO::PARAM_INT);
		$result->execute();
		if($result){
			$array = $result->fetch(PDO::FETCH_ASSOC);
			$pessoa = new Pessoa($array['nome'], $array['dataNascimento'], $array['rg'], $array['cpf'], $array['telefone'], $array['email']);
			return $pessoa;
		}
		return false;
	}
}