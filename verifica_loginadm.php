<?php
include ('conexao.php');

if(!$_SESSION['usuario'] && !$_SESSION['senha']) {
	header('Location: index.php');
	exit();
}
