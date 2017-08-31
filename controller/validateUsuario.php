<?php

/**
 * Validação básica ao Logar no sistema
 * @author Ronily
 */
if(isset($_POST['acao']) && $_POST['acao'] == "logar"){

	include_once 'model/Dao/UsuarioDAO.php';

	

	if(empty($_POST['nome']) || empty($_POST['senha'])){
		$msg = "<p class='p'>Preencha todos os campos</p>";
	}else{
		
		$nome = $_POST['nome'];
		$senha = $_POST['senha'];
		
		$usuarioDAO = new UsuarioDAO();
		$acao = $usuarioDAO->validateUser($nome, $senha);

		if($acao['0']['status'] == 2){
			session_start();
			foreach ($acao as $listar){
				$_SESSION['nome'] = $listar['nome'];
				$_SESSION['senha'] = $listar['senha'];
				$_SESSION['nivel'] = $listar['nivel'];
				$_SESSION['status'] = $listar['status'];
				header("location:view/home.php");
			}	
		}elseif ($acao['0']['status'] == 1){
			$msg = "<p class='p'>Voce foi boqueado...</p>";
		}else{
			$msg = "<p class='p'>Digite seu email e senha corretamente</p>";
		}		
	}
}

// Condição para definir a acao
if (isset ( $_GET ['cod_usuario'] ) && !empty($_GET['cod_usuario'])) {

	include_once '../model/Dao/UsuarioDAO.php';
	include_once '../model/Entity/Usuario.php';

	$submitAcao = "atualizarUsuario";
	$submitView = "Atualizar";
	$title = "Atualizar Usuario";

	$usuarioDAO = new UsuarioDAO();
	$usuario = $usuarioDAO->buscaByCodigo ( $_GET ['cod_usuario'] );

}else {

	$submitAcao = "cadastrarUsuario";
	$submitView = "Cadastrar";
	$title = "Cadastro de Usuarios";
}

/**
 * Validação básica no cadastramento de usuarios
 * @author Ronily
 */
if(isset($_POST['acao']) && $_POST['acao'] == "cadastrarUsuario"){

	include_once '../model/DAO/UsuarioDAO.php';
	include_once '../model/entity/Usuario.php';

	if(empty($_POST['nome']) || empty($_POST['senha']) || empty($_POST['refresh']) || empty($_POST['nivel'])){
		$msg = "<p class='p'>Preencha todos os campos</p>";
	}elseif(!trim($_POST['nome'])){
		$msg = "<p class='p'>Preencha o nome corretamente</p>";
	}elseif(strlen($_POST['senha']) < 6){
		$msg = "<p class='p'>As senhas devem ter no minimo seis caracteres</p>";
	}elseif($_POST['senha'] != $_POST['refresh']){
		$msg = "<p class='p'>As senhas são diferentes</p>";
	}else{
		
		$nome = addslashes($_POST['nome']);
		$senha = addslashes($_POST['senha']);
		$refresh = addslashes($_POST['refresh']);
		$nivel = addslashes($_POST['nivel']);
		
		$usuario = new Usuario($nome,$senha,$nivel);
		$usuarioDAO = new UsuarioDAO();
		$acao = $usuarioDAO->cadastrar($usuario);
			
		if($acao){
			header("location: usuario.php?mensagem=insert");
		}else {
			$msg = "<p class='p'>Já existe um usuario com esse nome em nosso sistema</p>";
		}
	}
}

/**
 * Validação básica na Atualização de Pessoas
 * @author Ronily
 */

if (isset ( $_POST ['acao'] ) && $_POST ['acao'] == 'atualizarUsuario') {

	include_once '../model/Entity/Usuario.php';
	include_once '../model/Dao/UsuarioDAO.php';

	
	if(empty($_POST['nome']) || empty($_POST['senha']) || empty($_POST['refresh']) || empty($_POST['nivel']) || empty($_POST['status'])){
		$msg = "<p class='p'>Preencha todos os campos</p>";
	}elseif(!trim($_POST['nome'])){
		$msg = "<p class='p'>Preencha o nome corretamente</p>";
	}elseif(strlen($_POST['senha']) < 6){
		$msg = "<p class='p'>As senhas devem ter no minimo seis caracteres</p>";
	}elseif($_POST['senha'] != $_POST['refresh']){
		$msg = "<p class='p'>As senhas não conferem</p>";
	}else{
		
		$nome = $_POST['nome'];
		$senha = $_POST['senha'];
		$refresh = $_POST['refresh'];
		$nivel = $_POST['nivel'];
		$status = $_POST['status'];

		$usuario = new Usuario($nome,$senha,$nivel);
		$usuario->setStatus($status);
		$usuario->setCodigo($_POST['cod_usuario']);
			
		$usuarioDAO = new UsuarioDAO();
		$acao = $usuarioDAO->atualizar($usuario);
			
		if($acao){
			header("location: usuario.php?mensagem=update");
		}
	}
}



?>