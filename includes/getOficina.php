<?php
	require ('../conexion.php');
	
	$cod_depar = $_POST['cod_depar'];
	
	$queryO = "SELECT cod_ofi, nombre_ofi FROM oficina WHERE cod_depar = '$cod_depar' ORDER BY nombre_ofi";
	$resultadoO = $conn->query($queryO);

	$html = "<option value='0'>Seleccionar Oficina</option>";
	
	while($rowO = $resultadoO->fetch_assoc())
	{
		$html.= "<option value='".$rowO['cod_ofi']."'>".$rowO['nombre_ofi']."</option>";
	}

	echo $html;
?>