<?php 

include 'conexion.php';

 $export = null;

if (isset($_POST['reporteE'])) {

$busqueda = $_POST['variable1'];

    $tipoC = $_POST['tipo_reporteC'];

    if ($tipoC=="EXCEL") {

 $query = "SELECT `id`,`encargado`,`cod`,`serie`,`nombre_insu`,`marca`,`modelo`,`detalle`,direccion.`nombre_direc`,departamento.`nombre_depar`,oficina.`nombre_ofi`,`observacion`, `fecha`  from `insumo` inner join `oficina` on insumo.`cod_ofi`=oficina.`cod_ofi` inner join `departamento` on oficina.`cod_depar`=departamento.`cod_depar` inner join `direccion` on departamento.`cod_direc`=direccion.`cod_direc` WHERE
        (
                                                id LIKE '%$busqueda%' OR
                                                cod LIKE '%$busqueda%' OR
                                                serie LIKE '%$busqueda%' OR
                                                nombre_insu LIKE '%$busqueda%' OR
                                                marca LIKE '%$busqueda%' OR
                                                modelo LIKE '%$busqueda%' OR
                                                encargado LIKE '%$busqueda%' OR                                                
                                                nombre_direc LIKE '%$busqueda%' OR
                                                nombre_depar LIKE '%$busqueda%' OR
                                                nombre_ofi LIKE '%$busqueda%' OR
                                                observacion LIKE '%$busqueda%'    
        )";

        $res = mysqli_query($conn, $query);
        if(mysqli_num_rows($res) > 0)
         {
         $export .= '
 <table border=1>

 <tr> 
 <th>Encargado</th>
 <th>COD.OLY</th> 
 <th>Serie</th> 
 <th>Nombre</th> 
 <th>Marca</th> 
 <th>Modelo</th> 
 <th>Detalle</th> 
 <th>Observacion</th> 
 <th>Direccion</th> 
 <th>Departamento</th> 
 <th>Oficina</th> 
 <th>Fecha de Ingreso</th> 
 
 </tr>
 ';
 while($row = mysqli_fetch_array($res))
 {
 $export .= '
 <tr>
 <td>'.$row["encargado"].'</td> 
 <td>'.$row["cod"].'</td>
 <td>'.$row["serie"].'</td>  
 <td>'.$row["nombre_insu"].'</td> 
 <td>'.$row["marca"].'</td> 
 <td>'.$row["modelo"].'</td> 
 <td>'.$row["detalle"].'</td> 
 <td>'.$row["observacion"].'</td> 
 <td>'.$row["nombre_direc"].'</td> 
 <td>'.$row["nombre_depar"].'</td> 
 <td>'.$row["nombre_ofi"].'</td>
 <td>'.$row["fecha"].'</td>  
 
 
 </tr>
 ';
 }
 $export .= '</table>';
 header('Content-Type: application/xls');
 header('Content-Disposition: attachment; filename=Reporte_de_insumos_consultados.xls');
 echo $export;
 }

    } elseif ($tipoC=="PDF") {
        require('fpdf/fpdf.php');
        
        class PDF extends FPDF
{
    // Cabecera de página
    function Header()
{
    // Logo

    // Arial bold 15
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(100,10,'Reportes de Insumos',0,0,'C');
    // Salto de línea
    $this->Ln(10);
    $this->Cell(55, 5,'Bolivar, Guaranda , '. date('d') . ' / '. date('m'). ' / '. date('Y'), 0,1,'C');
    $this->Ln(5);

    $this->Cell(30, 10, 'Encargado', 1, 0, 'C', 0);
    $this->Cell(15, 10, 'COD', 1, 0, 'C', 0);
    $this->Cell(10, 10, 'Serie', 1, 0, 'C', 0); 
    $this->Cell(50, 10, 'Nombre', 1, 0, 'C', 0);
    $this->Cell(20, 10, 'Marca', 1, 0, 'C', 0);
    $this->Cell(35, 10, 'Modelo', 1, 0, 'C', 0);   
    //$this->Cell(50, 10, 'Detalle', 1, 0, 'C', 0);
    $this->Cell(25, 10, 'Observacion', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Direccion', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Departamento', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Oficina', 1, 1, 'C', 0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}
//
$consulta = "SELECT `id`,`encargado`,`cod`,`serie`,`nombre_insu`,`marca`,`modelo`,`detalle`,direccion.`nombre_direc`,departamento.`nombre_depar`,oficina.`nombre_ofi`,`observacion`, `fecha`  from `insumo` inner join `oficina` on insumo.`cod_ofi`=oficina.`cod_ofi` inner join `departamento` on oficina.`cod_depar`=departamento.`cod_depar` inner join `direccion` on departamento.`cod_direc`=direccion.`cod_direc` WHERE
(
                                                id LIKE '%$busqueda%' OR
                                                cod LIKE '%$busqueda%' OR
                                                serie LIKE '%$busqueda%' OR
                                                nombre_insu LIKE '%$busqueda%' OR
                                                marca LIKE '%$busqueda%' OR
                                                modelo LIKE '%$busqueda%' OR
                                                encargado LIKE '%$busqueda%' OR

                                                nombre_direc LIKE '%$busqueda%' OR
                                                nombre_depar LIKE '%$busqueda%' OR
                                                nombre_ofi LIKE '%$busqueda%' OR
                                                observacion LIKE '%$busqueda%'    
)";
$resultado= $conn->query($consulta);
// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L');
$pdf->SetFont('Arial','',10);

while ($row = $resultado->fetch_assoc()) {
    $pdf->Cell(30, 10, $row['encargado'], 1, 0, 'C', 0);
    $pdf->Cell( 15, 10, $row['cod'], 1, 0, 'C', 0);
    $pdf->Cell(10, 10, $row['serie'], 1, 0, 'C', 0);
    $pdf->Cell(50, 10, $row['nombre_insu'], 1, 0, 'C', 0);
    $pdf->Cell(20, 10, $row['marca'], 1, 0, 'C', 0);
    $pdf->Cell(35, 10, $row['modelo'], 1, 0, 'C', 0);    
    //$pdf->Cell(50, 10, $row['detalle'], 1, 0, 'C', 0);
    $pdf->Cell(25, 10, $row['observacion'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['nombre_direc'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['nombre_depar'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['nombre_ofi'], 1, 1, 'C', 0);
    //$pdf->Cell(30, 10, $row['fecha'], 1, 1, 'C', 0);
}

$pdf->Output();
    }
    

} elseif (isset($_POST['reporte_completo'])) {
    $tipo = $_POST['tipo_reporte'];
    if ($tipo=="EXCEL") {

   $query = "SELECT `id`,`encargado`,`cod`,`serie`,`nombre_insu`,`marca`,`modelo`,`detalle`,direccion.`nombre_direc`,departamento.`nombre_depar`,oficina.`nombre_ofi`,`observacion`, `fecha`  from `insumo` inner join `oficina` on insumo.`cod_ofi`=oficina.`cod_ofi` inner join `departamento` on oficina.`cod_depar`=departamento.`cod_depar` inner join `direccion` on departamento.`cod_direc`=direccion.`cod_direc`"; 
        $res = mysqli_query($conn, $query);
        if(mysqli_num_rows($res) > 0)
         {
         $export .= '

 <table border=1>

 <tr> 
 <th>Encargado</th>
 <th>COD.OLY</th> 
 <th>Serie</th> 
 <th>Nombre</th> 
 <th>Marca</th> 
 <th>Modelo</th> 
 <th>Detalle</th> 
 <th>Observacion</th> 
 <th>Direccion</th> 
 <th>Departamento</th> 
 <th>Oficina</th> 
 <th>Fecha de Ingreso</th> 
 
 </tr>
 ';
 while($row = mysqli_fetch_array($res))
 {
 $export .= '
 <tr>
 <td>'.$row["encargado"].'</td> 
 <td>'.$row["cod"].'</td> 
 <td>'.$row["serie"].'</td> 
 <td>'.$row["nombre_insu"].'</td> 
 <td>'.$row["marca"].'</td> 
 <td>'.$row["modelo"].'</td> 
 <td>'.$row["detalle"].'</td> 
 <td>'.$row["observacion"].'</td> 
 <td>'.$row["nombre_direc"].'</td> 
 <td>'.$row["nombre_depar"].'</td> 
 <td>'.$row["nombre_ofi"].'</td>
 <td>'.$row["fecha"].'</td>  
 
 
 </tr>
 ';
 }
 $export .= '</table>';
 header('Content-Type: application/xls');
 header('Content-Disposition: attachment; filename=Reporte_de_insumos.xls');
 echo $export;
 }

    }else if($tipo=="PDF") {
        
        require('fpdf/fpdf.php');
        
        class PDF extends FPDF
{
    // Cabecera de página
    function Header()
{
    // Logo

    // Arial bold 15
    $this->SetFont('Arial','B',8);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(100,10,'Reportes de Insumos',0,0,'C');
    // Salto de línea
    $this->Ln(10);
    $this->Cell(55, 5,'Bolivar, Guaranda , '. date('d') . ' / '. date('m'). ' / '. date('Y'), 0,1,'C');
    $this->Ln(5);

    $this->Cell(30, 10, 'Encargado', 1, 0, 'C', 0);
    $this->Cell(15, 10, 'COD', 1, 0, 'C', 0);
    $this->Cell(15, 10, 'Serie', 1, 0, 'C', 0);  
    $this->Cell(50, 10, 'Nombre', 1, 0, 'C', 0);
    $this->Cell(20, 10, 'Marca', 1, 0, 'C', 0);
    $this->Cell(35, 10, 'Modelo', 1, 0, 'C', 0);  
    //$this->Cell(50, 10, 'Detalle', 1, 0, 'C', 0);
    $this->Cell(25, 10, 'Observacion', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Direccion', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Departamento', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Oficina', 1, 1, 'C', 0);

}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}
//
$consulta = "SELECT `id`,`cod`,`encargado`,`serie`,`nombre_insu`,`marca`,`modelo`,`detalle`,direccion.`nombre_direc`,
departamento.`nombre_depar`,oficina.`nombre_ofi`,`observacion`,
`fecha`  from `insumo` inner join `oficina` on insumo.`cod_ofi`=oficina.`cod_ofi` inner join `departamento` on oficina.`cod_depar`=departamento.`cod_depar` inner join `direccion` on departamento.`cod_direc`=direccion.`cod_direc`";
$resultado= $conn->query($consulta);
// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L');
$pdf->SetFont('Arial','',8);

while ($row = $resultado->fetch_assoc()) {
    $pdf->Cell(30, 10, $row['encargado'], 1, 0, 'C', 0);
    $pdf->Cell(15, 10, $row['cod'], 1, 0, 'C', 0);
    $pdf->Cell(15, 10, $row['serie'], 1, 0, 'C', 0);
    $pdf->Cell(50, 10, $row['nombre_insu'], 1, 0, 'C', 0);
    $pdf->Cell(20, 10, $row['marca'], 1, 0, 'C', 0);
    $pdf->Cell(35, 10, $row['modelo'], 1, 0, 'C', 0);    
    //$pdf->Cell(50, 10,utf8_decode($row['detalle']),1,0,'C',0);
    $pdf->Cell(25, 10, $row['observacion'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['nombre_direc'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['nombre_depar'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['nombre_ofi'], 1, 1, 'C', 0);
}

$pdf->Output();

    }
   
}
?>