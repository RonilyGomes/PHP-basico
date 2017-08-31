<?php 

//inclui a arquivo de controle do formulario
include_once '../controller/validateUsuario.php';

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
	<div class="container" style="margin-top: 120px;">
	<div class="msg" style="
		display:<?php if(isset($msg)){echo "block;";}else{echo "none;";}?> 
		background:<?php if(isset($msg)) echo "rgba(217, 83, 79,.7);";?>">
		<?php if(isset($msg)) echo $msg; ?>
	</div>

		<h1><?php echo $title;?></h1>
		<form action="form_usuario.php" method="post">

			<label class="label" for="nome">Nome: </label> 
				<input class="input" type="text" name="nome" id="nome" value="<?php if(isset($usuario) && isset($_GET['cod_usuario'])) echo $usuario->getNome(); ?>"/>
			<label class="label" for="senha">Senha: </label>
				<input class="input" type="password" name="senha" id="senha" value="<?php if(isset($usuario) && isset($_GET['cod_usuario'])) echo $usuario->getSenha(); ?>"/>
			<label class="label" for="refresh">Senha Novamente: </label>
				<input class="input" type="password" name="refresh" id="refresh" value="<?php if(isset($usuario) && isset($_GET['cod_usuario'])) echo $usuario->getSenha(); ?>"/>
				
			<label class="label">Nivel: </label> 
				<input type="radio" name="nivel" id="padrao" value="1" <?php if(isset($usuario) && $usuario->getNivel() == 1) echo "checked";?>/>
				<label class="label-radio" for="padrao">padrão</label>
				<input type="radio" name="nivel" id="admin" value="2" <?php if(isset($usuario) && $usuario->getNivel() == 2) echo "checked";?>/>
				<label class="label-radio"for="admin">Admin</label>
			<?php if($submitAcao == "atualizarUsuario"){?>
			<label class="label">Status: </label> 
				<input type="radio" name="status" id="ativo" value="2" <?php if(isset($usuario) && $usuario->getStatus() == 2) echo "checked";?>/>
				<label class="label-radio" for="ativo">Ativo</label>
				<input type="radio" name="status" id="bloqueado" value="1" <?php if(isset($usuario) && $usuario->getStatus() == 1) echo "checked";?>/>
				<label class="label-radio"for="bloqueado">Bloqueado</label>
			<?php }?>	
			<?php if(isset($_GET['cod_usuario']) && $_GET['cod_usuario']){ ?>
				<input type="hidden" name="cod_usuario" value="<?php echo $_GET['cod_usuario'];?>" /> 
			<?php } ?>
			<input type="hidden" name="acao" value="<?php echo $submitAcao;?>" /> 
			<input class="botao" type="submit" value="<?php echo $submitView;?>" />

		</form>
		<a class="link" href="usuario.php">Voltar</a>
	</div>
</body>
</html>