<?php
	
//inclui a arquivo de controle do formulario
include_once '../controller/validatePessoa.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/cadastro.css" />
<script type="text/javascript" src="../js/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="../js/jquery.maskedinput-1.1.4.pack.js" /></script>
<script type="text/javascript" src="../js/script.js"></script>
<title>Cadastro Pessoas</title>
</head>
<body>
	<div class="container">
	<div class="msg" style="
		display:<?php if(isset($msg)){echo "block;";}else{echo "none;";}?> 
		background:<?php if(isset($msg)) echo "rgba(217, 83, 79,.7);";?>">
		<?php if(isset($msg)) echo $msg; ?>
	</div>
		<h1><?php echo $title;?></h1>
		<form action="form_pessoa.php" method="post">

			<label class="label" for="nome">Nome: </label> 
				<input class="input" type="text" name="nome" id="nome" value="<?php if(isset($pessoa) && isset($_GET['cod_pessoa'])) echo $pessoa->getNome(); ?>" />
			<label class="label" for="dataNasc">Data de Nacimento: </label> 
				<input class="input" type="date" name="dataNasc" id="dataNasc" value="<?php if(isset($pessoa) && isset($_GET['cod_pessoa'])) echo $pessoa->getDataNascimento(); ?>" />
			<label class="label" for="rg">RG: </label> 
				<input class="input" type="text" name="rg" id="rg" value="<?php if(isset($pessoa) && isset($_GET['cod_pessoa'])) echo $pessoa->getRg() ;?>" />
			<label class="label" for="cpf">CPF: </label> 
				<input class="input" type="text" name="cpf" id="cpf" value="<?php if(isset($pessoa) && isset($_GET['cod_pessoa'])) echo $pessoa->getCpf(); ?>" />
			<label class="label" for="tel">Telefone: </label> 
				<input class="input" type="text" name="tel" id="tel" value="<?php if(isset($pessoa) && isset($_GET['cod_pessoa'])) echo $pessoa->getTelefone(); ?>" />
			<label class="label" for="email">E-mail: </label> 
				<input class="input" type="email" name="email" id="email" value="<?php if(isset($pessoa) && isset($_GET['cod_pessoa'])) echo $pessoa->getEmail(); ?>" />
			<?php if(isset($_GET['cod_pessoa']) && $_GET['cod_pessoa']){ ?>
				<input type="hidden" name="cod_pessoa" value="<?php echo $_GET['cod_pessoa'];?>" /> 
			<?php } ?>
			<input type="hidden" name="acao" value="<?php echo $submitAcao;?>" /> 
			<input class="botao" type="submit" value="<?php echo $submitView;?>" />

		</form>
		<a class="link" href="home.php">Voltar</a>
	</div>
</body>
</html>
