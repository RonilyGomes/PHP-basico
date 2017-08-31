<?php 

//inlcui o arquivo de validação do formulario
include_once 'controller/validateUsuario.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/login.css" />
<title>Area Restrita</title>
</head>
<body>
	<div class="container">
		<div class="msg" style="
		display:<?php if(isset($msg)){echo "block;";}else{echo "none;";}?> 
		background:<?php if(isset($msg)) echo "rgba(217, 83, 79,.7);";?>">
		<?php if(isset($msg)) echo $msg;?>
		</div>
		<h1>Login | CRUD</h1>
		<form action="" method="post">

			<label for="nome">Nome: </label> <input class="input" type="text" name="nome" id="nome"/>
			<label for="senha">Senha: </label> <input class="input" type="password" name="senha" id="senha"/>
			<input type="hidden" name="acao" value="logar"/> 
			<input class="botao" type="submit" value="Entrar" />

		</form>
		<a class="link" href="view/form_usuario.php">Cadastre-se</a>
	</div>
</body>
</html>

