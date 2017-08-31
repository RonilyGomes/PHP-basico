<?php

//valida o acesso a pagina
session_start();
if(empty($_SESSION['nivel']) || $_SESSION['nivel'] != 2){
	header("location: erro.php");
}

// logout
include_once '../controller/logout.php';

//inclui a classe UsuarioDAO responsavel pelo acesso ao bd
include_once '../model/Dao/UsuarioDAO.php';
$usuarioDAO = new UsuarioDAO();

//deleta 
if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'){

	$usuarioDAO->deletar( $_GET['cod_usuario'] );

}

//filtra os usuarios 
$nome = null;
	if (isset ( $_POST ['nome'] ))
		$nome = $_POST ['nome'];
	
	$arrayUsuarios = $usuarioDAO->consultar ( $nome );


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<link href="../css/usuario.css" rel=" stylesheet" />
<title>Gerenciameto | Usuarios</title>
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
					<span>Usuario Admin</span>
					<a href="usuario.php?acao=logout">Sair</a>
				</div>
			</div>		
		</div>
		
		<div class="content">

			<div class="link">
				<a href="form_usuario.php">Cadastrar Usuario</a>
			</div>
			<div class="link">
				<a href="home.php">Pessoas</a>
			</div>

			<form action="" method="post">
				<div class="busca">
					<input class="search" type="search" name="nome" value="<?php echo $nome; ?>" />
					<button class="btn">Buscar</button>
				</div>
			</form>
			
			<div class="info-table">
				<h2>Usuarios</h2>
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

		<div class="content-usuario">
			<ul class="row">
				<li class="coluns-sm indice">Codigo</li>
				<li class="coluns indice">Nome</li>
				<li class="coluns indice">Nivel</li>
				<li class="coluns indice">Status</li>
				<li class="coluns-md indice">A&ccedil;&atilde;o</li>
			</ul>

			<?php
				foreach($arrayUsuarios as $row) {
					echo "<ul class='row'>";
					echo "<li class='coluns-sm'>" . $row ['ID'] . "</li>";
					echo "<li class='coluns'>" . $row ['nome'] . "</li>";
					if($row['nivel'] == 2) echo "<li class='coluns'>Admin</li>";
					else echo "<li class='coluns'>Padrão</li>";
					if($row['status'] == 2) echo "<li class='coluns'>Ativo</li>";
					else echo "<li class='coluns'>Bloqueado</li>";
					echo "<a class='acao' href='form_usuario.php?cod_usuario=".$row['ID']."'>Editar</a>";
					echo "<a class='acao' href='usuario.php?cod_usuario=".$row['ID']."&acao=deletar'>Deletar</a>";
					echo "</ul>";
				}
			?>	
		</div>
	
	</div> <!-- div.conatiner -->
</body>
</html>
