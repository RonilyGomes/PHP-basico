<?php 
// logout
if (isset ( $_GET ['acao'] ) && $_GET ['acao'] == "logout") {
	unset ( $_SESSION ['nome'], $_SESSION ['senha'], $_SESSION ['nivel'] );
	header ( "location: ../index.php" );
}
?>