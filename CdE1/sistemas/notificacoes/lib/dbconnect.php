<?php
	$host = 'localhost';
	$usuario = 'root';
	$senha = '';
	$banco = 'notifi';

	$con = new mysqli($host, $usuario, $senha, $banco);

	if(mysqli_connect_errno()){
		exit("Erro ao conectar-se ao banco: ".mysqli_connect_error());
	}
?>