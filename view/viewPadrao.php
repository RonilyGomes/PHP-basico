<?php

//logout
include_once '../controller/logout.php';

//inclui a classe PessoaDAO responsavel para acessar o bd
include_once '../model/Dao/PessoaDAO.php';
$pessoaDAO = new PessoaDAO ();

//deleta
if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'){

	$pessoaDAO->deletar( $_GET['cod_pessoa'] );
}

//filtra as Pessoas
$nome = null;
	if (isset ( $_POST ['nome'] ))
	$nome = $_POST ['nome'];

	$arrayPessoas = $pessoaDAO->consultar ( $nome );

//inclui a classe que formata visualmente os dados
include_once '../util/ConvUtil.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<link href="../css/style.css" rel=" stylesheet" />
<title>Gerenciameto | Pessoas</title>
</head>
<body>
	<div class="container">
	
		<div class="header">
			
			<div class="title">
				<h1 class="">Sistema | CRUD</h1>
			</div>
			<div class="session">
				<div class="session-txt">
					<span><?php echo $_SESSION['nome'] . " | ";?></span>
					<span>Usuario Padrao</span>
					<a href="home.php?acao=logout">Sair</a>
				</div>
			</div>	<!-- fim da div.session -->	
		</div> <!-- fimda div.header -->
		
		<div class="content">
		
			<div class="link">
				<a href="form_pessoa.php">Cadastrar Pessoa</a>
			</div>
		
			<form action="" method="post">
				<div class="busca">
					<input class="search" type="search" name="nome" value="<?php echo $nome; ?>" />
					<button class="btn">Buscar</button>
				</div>
			</form>
			
			<div class="info-table">
				<h2>Pessoas</h2>
			</div>
			
			<div class="msg">
				<?php
					
					if($nome)
						echo "<p class='p-info'>Resultados encontrados para: " . $nome . "</ br>";
					
					if(isset($_GET['mensagem']) && $_GET['mensagem'] == 'insert')
						echo "<p class='p-sucess'>Salvo com sucesso</p>";
					
					if(isset($_GET['mensagem']) && $_GET['mensagem'] == 'update')
						echo "<p class='p-sucess'>Editado com sucesso</p>";
					
					if(isset($_GET['acao']) && $_GET['acao'] == 'deletar')
						echo "<p class='p-sucess'>Excluido com sucesso</p>";
				?>
			</div>

		</div> <!-- div.content -->
		

		<div class="content-pessoa">
			<ul class="row">
				<li class="coluns-sm indice">Codigo</li>
				<li class="coluns indice">Nome</li>
				<li class="coluns indice">CPF</li>
				<li class="coluns indice">RG</li>
				<li class="coluns indice">Nascimento</li>
				<li class="coluns indice">Telefone</li>
				<li class="coluns-lg indice">E-mail</li>
				<li class="coluns-md indice">A&ccedil;&atilde;o</li>
			</ul>
					
			<?php
				foreach($arrayPessoas as $row) {
					echo "<ul class='row'>";
					echo "<li class='coluns-sm'>" . $row ['nu_seq_pessoa'] . "</li>";
					echo "<li class='coluns'>" . $row ['nome'] . "</li>";
					echo "<li class='coluns'>" . ConvUtil::formataCpf($row ['cpf']) . "</li>";
					echo "<li class='coluns'>" . $row ['rg'] . "</li>";
					echo "<li class='coluns'>" . ConvUtil::dateToData($row ['dataNascimento'])  . "</li>";
					echo "<li class='coluns'>" . $row ['telefone'] . "</li>";
					echo "<li class='coluns-lg'>" . $row ['email'] . "</li>";
					echo "<a class='acao' href='form_pessoa.php?cod_pessoa=".$row['nu_seq_pessoa']."'>Editar</a>";
					echo "<a class='acao' href='home.php?cod_pessoa=".$row['nu_seq_pessoa']."&acao=deletar'>Deletar</a>";
					echo "</ul>";
				}
			?>
				
		</div> <!-- fim da div.content-pessoa -->		
		
	</div> <!-- div.conatiner -->
</body>
</html>