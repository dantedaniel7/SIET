<?php
	require ('../conexion.php');
	
	$cod_direc = $_POST['cod_direc'];
	
	$queryD = "SELECT cod_depar, nombre_depar FROM departamento WHERE cod_direc = '$cod_direc' ORDER BY nombre_depar";
	$resultadoD = $conn->query($queryD);
	
	$html = "<option value='0'>Seleccionar Departamento</option>";
	
	while($rowD = $resultadoD->fetch_assoc())
	{
		$html.= "<option value='".$rowD['cod_depar']."'>".$rowD['nombre_depar']."</option>";
	}
	
	echo $html;
?>