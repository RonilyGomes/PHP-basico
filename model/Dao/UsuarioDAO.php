<?php

include_once 'DAO.php';

	class UsuarioDAO extends DAO{
		
		/**
		 * Loga o usuario no sistema
		 *
		 * @name validateUser
		 * @param $nome,$senha
		 */
		public function validateUser($nome,$senha){
			
			$conectar = $this->_conexao;
			$query = "SELECT * FROM s_usuario WHERE nome='".$nome."' AND senha='".$senha."'";
			$result = $conectar->prepare($query);
			$result->execute();
			if($result->rowCount() == 1){
				$query.= "AND status=2";
				if($result->rowCount() == 1){	
					$row = $result->fetchAll(PDO::FETCH_ASSOC);
					return $row;
				}else{
					$row = $result->fetchAll(PDO::FETCH_ASSOC);
					return $row;
				}
			}else {
				return false;
			}
		}
		
		/**
		 * Consulta um registro no banco de dados
		 *
		 * @name consultar
		 * @param Pessoa $pessoa
		 */
		public function consultar($nome = null) {
			
			$conectar = $this->_conexao;
			$query = "SELECT * FROM s_usuario";
			if ($nome)
				$query .= " WHERE nome LIKE '%" . $nome . "%'";
				$query .= " ORDER BY nome";
				$result = $conectar->prepare($query);
				$result->execute();
				$arrRetorno = array();
				while ($row = $result->fetch(PDO::FETCH_ASSOC)){
					$arrRetorno [] = $row;
				}
				return  $arrRetorno;
		}
		
		/**
		 * insere um registro no banco de dados
		 *
		 * @name cadastrar
		 * @param Usuario $usuario
		 */
		public function cadastrar($usuario){
			
			
			$conectar = $this->_conexao;
			$query = "INSERT INTO s_usuario(nome,senha,nivel,status) VALUES(:nome ,:senha ,:nivel ,:status)";
			//prepara os dados
			$result = $conectar->prepare($query);
			$result->bindValue(":nome", $usuario->getNome());
			$result->bindValue(":senha", $usuario->getSenha());
			$result->bindValue(":nivel", $usuario->getNivel(),PDO::PARAM_INT);
			$result->bindValue(":status", 2, PDO::PARAM_INT);
			
			//valida os valores
			$query = "SELECT * FROM s_usuario WHERE nome=':nome";
			$validar = $conectar->prepare($query);
			$validar->bindValue(":nome", $usuario->getNome());
			$validar->execute();
			if($validar->rowCount() == 0){
				$result->execute();
				return $result->rowCount();
			}else{
				return false;
			}
		}
		
		/**
		 * Atualiza um registro no banco de dados
		 *
		 * @name atualizar
		 * @param Usuario $usuario
		 */
		public function atualizar( $usuario ) {
			
			$conectar = $this->_conexao;
			$query = "UPDATE s_usuario SET nome=:nome, senha=:senha, nivel =:nivel, status =:status WHERE ID=:pk";
			$result = $conectar->prepare($query);
			$result->bindValue(":nome", $usuario->getNome());
			$result->bindValue(":senha", $usuario->getSenha());
			$result->bindValue(":nivel", $usuario->getNivel());
			$result->bindValue(":status", $usuario->getStatus());
			$result->bindValue(":pk", $usuario->getCodigo());
			$result->execute();
			
			return $result->rowCount(); 
		}
		
		/**
		 * Deleta um registro no banco de dados
		 *
		 * @name deletar
		 * @param Usuario $codigo
		 */
		public function deletar( $codigo ) {
			$conectar = $this->_conexao;
			$query = "DELETE FROM s_usuario WHERE ID =:pk";
			$result = $conectar->prepare($query);
			$result->bindValue(":pk", $codigo);
			$result->execute();
		}
		
		
		/**
		 * filtra um usuario pelo código da pk
		 * @param $codUsuario
		 * @return Usuario $codUsuario
		 */
		public function buscaByCodigo( $codUsuario ){
			
			include_once '../model/Entity/Usuario.php';
			
			$conectar = $this->_conexao;			
			$query = "SELECT * FROM s_usuario WHERE ID =:pk";
			$result = $conectar->prepare($query);
			$result->bindValue(":pk", $codUsuario);
			$result->execute();
			
			if($result->rowCount() == 1){
				$array = $result->fetch(PDO::FETCH_ASSOC);
				$usuario = new Usuario($array['nome'], $array['senha'], $array['nivel']);
				$usuario->setStatus($array['status']);
				return $usuario;
			}
			return false;
		}
		
	}	
?>