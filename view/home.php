<?php

session_start ();

if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
	include_once 'viewPadrao.php';
}elseif(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 2){
	include_once 'viewAdmin.php';
}else{
	header("location: erro.php");
}