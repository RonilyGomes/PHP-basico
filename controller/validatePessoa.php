<?php 

// Condição para definir a acao
if (isset ( $_GET ['cod_pessoa'] ) && !empty($_GET['cod_pessoa'])) {
	
	include_once '../model/Dao/PessoaDAO.php';

	$submitAcao = "atualizarPessoa";
	$submitView = "Atualizar";
	$title = "Atualizar Pessoa";

	$pessoaDao = new PessoaDAO ();
	$pessoa = $pessoaDao->buscaByCodigo ( $_GET ['cod_pessoa'] );	
	
}else {	
	
	$submitAcao = "cadastrarPessoa";
	$submitView = "Cadastrar";
	$title = "Cadastro Pessoa";
}

/**
 * Validação básica no cadastramento de Pessoas
 * @author Ronily
 */

if (isset ( $_POST ['acao'] ) && $_POST ['acao'] == 'cadastrarPessoa') {
	
	include_once '../model/Entity/Pessoa.php';
	include_once '../model/Dao/PessoaDAO.php';

	if(empty($_POST['nome'])||empty($_POST['dataNasc'])||empty($_POST['rg'])||empty($_POST['cpf'])||empty($_POST['tel'])||empty($_POST['email'])){
		$msg = "<p class='p'>Preencha todos os campos</p>";
	}elseif (!trim($_POST['nome'])){
		$msg = "<p class='p'>Preencha o nome corretamente</p>";
	}elseif (date('Y') < $_POST['dataNasc']){
		$msg = "<p class='p'>Preencha a data corretamente</p>";
	}elseif (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
		$msg = "<p class='p'>Preencha o E-mail corretamente</p>";
	}else{

		$pessoa = new Pessoa ( $_POST ['nome'], $_POST ['dataNasc'], $_POST ['rg'], $_POST ['cpf'], $_POST ['tel'], $_POST ['email'] );
		$pessoaDao = new PessoaDAO();
		$acao = $pessoaDao->inserir ( $pessoa );

		// Escreve na tela a acao occrrida
		if ($acao) {
			header("Location: home.php?mensagem=insert");
		} else {
			echo "Desculpe, houve uma falha no cadastro...";
		}
	}
}

/**
 * Validação básica na Atualização de Pessoas
 * @author Ronily
 */

if (isset ( $_POST ['acao'] ) && $_POST ['acao'] == 'atualizarPessoa') {
	
	include_once '../model/Entity/Pessoa.php';
	include_once '../model/Dao/PessoaDAO.php';

	if(empty($_POST['cod_pessoa'])|| empty($_POST['nome'])||empty($_POST['dataNasc'])||empty($_POST['rg'])||empty($_POST['cpf'])||empty($_POST['tel'])||empty($_POST['email'])){
		$msg = "<p class='p'>Preencha todos os campos</p>";
	}elseif (!trim($_POST['nome'])){
		$msg = "<p class='p'>Preencha o nome corretamente</p>";
	}elseif (date('Y') < $_POST['dataNasc']){
		$msg = "<p class='p'>Preencha a data corretamente</p>";
	}elseif (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
		$msg = "<p class='p'>Preencha o E-mail corretamente</p>";
	}else{

		$pessoa = new Pessoa ( $_POST ['nome'], $_POST ['dataNasc'], $_POST ['rg'], $_POST ['cpf'], $_POST ['tel'], $_POST ['email'] );
		$pessoa->setCodigo($_POST['cod_pessoa']);
		$pessoaDao = new PessoaDAO();
		$acao = $pessoaDao->atualizar( $pessoa );

		// Escreve na tela a acao occrrida
		if ($acao) {
			header("Location: home.php?mensagem=update");
		} 
	}
}
?>