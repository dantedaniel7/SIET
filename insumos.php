<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}
$nombre = $_SESSION['nombre'];
$tipo_usuario = $_SESSION['tipo_usuario'];


include "conexion.php";

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}
$id = $_SESSION['id'];



if ($tipo_usuario == 1) {

    $where = "";
} else if ($tipo_usuraio == 2) {
    $where = "WHERE id=$id";
}

/*$sql = "SELECT * FROM  direccion $where";
$resultados = $conn->query($sql);

$sql = "SELECT * FROM  departamento $where";
$resultados1 = $conn->query($sql);

$sql = "SELECT * FROM  oficina $where";
$resultados2 = $conn->query($sql);
*/

$querydirec=mysqli_query($conn, "SELECT cod_direc, nombre_direc FROM direccion");
$querydepar=mysqli_query($conn, "SELECT cod_depar, nombre_depar FROM departamento");
$queryofi=mysqli_query($conn, "SELECT cod_ofi, nombre_ofi FROM oficina");

?>

<?php
    $queryDi = "SELECT cod_direc, nombre_direc FROM direccion ORDER BY nombre_direc";
    $resultadoDi = $conn->query($queryDi);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SIET</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/estilo.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

    <link href="calendar/calendar.css" type="text/css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    
    <!--Scripts selects dependientes-->
    <script language="javascript" src="js/jquery-3.3.1.min.js"></script>
	<script language="javascript">
		$(document).ready(function(){
            $("#cbx_direc").change(function () {

				$('#cbx_ofic').find('option').remove().end().append('<option value="0"></option>').val('0');
					
				$("#cbx_direc option:selected").each(function() {
					cod_direc = $(this).val();
				    $.post("includes/getDepartamento.php", { cod_direc: cod_direc }, function(data){
						$("#cbx_depar").html(data);
					});            
				});
		    })
		});
        $(document).ready(function(){
			$("#cbx_depar").change(function () {
				$("#cbx_depar option:selected").each(function () {
					cod_depar = $(this).val();
					$.post("includes/getOficina.php", { cod_depar: cod_depar }, function(data){
						$("#cbx_ofic").html(data);
					});            
				});
			})
		});
	</script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="principal.php">Sistema de Inventario</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <?php echo $nombre . " "; ?><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                 <!--   <li><a class="dropdown-item" href="#">Editar Perfil</a></li> -->
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Cerrar Sesi&oacute;n</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">

                    <div class="nav">

                        <div class="sb-sidenav-menu-heading">Inicio</div>
                        <a class="nav-link" href="principal.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Dashboard
                        </a>

                        <div class="sb-sidenav-menu-heading">Inventario</div>

                        <a class="nav-link" href="insumos.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                            Insumos
                        </a>

                        <a class="nav-link" href="reportes.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-search"></i></div>
                            Consultas/Reportes
                        </a>

                        <a class="nav-link" href="respaldos.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                            Respaldos
                        </a>

                        <?php if ($tipo_usuario == 1) { ?>
                            <div class="sb-sidenav-menu-heading">Administración</div>

                            <a class="nav-link" href="users.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-address-book"></i></div>
                                Usuarios
                            </a>
                            <div class="dropdown">
                                <button type="button"class="btn btn-primary dropdown-toggle"id="darkButton" data-bs-toggle="dropdown"aria-expanded="false"><i class="fas fa-map-marker-alt"></i>                                    
                                Gestión de Ubicaciones
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark" >
                                        <li><a href="direcciones.php" class="dropdown-item"> Dirección </a></li>
                                        <li><a href="departamentos.php" class="dropdown-item"> Departamento </a></li>
                                        <li><a href="oficinas.php" class="dropdown-item"> Oficina </a></li>
                                    </ul>
                            </div>    
                        <?php } ?>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Conectado:</div>
                    <?php echo $nombre; ?>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <br>
                <div class="container-fluid px-4">
                    <h3>Insumos Tecnológicos</h3>
                    <!-- Button trigger modal -->

                    <div class="card">

                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-10">

                                        Agregue insumos, actualice sus datos o eliminelos del registro general.

                                    </div>

                                    <div class="col-2 d-grid gap-2 mx-auto">
                                        <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <div class="sb-nav-link-icon"><i class="fas fa-inbox"></i></div>Agregar Insumo
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <br>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Agregar Insumo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <form action="register.php" method="POST" class="needs-validation" novalidate>

                                <div class="modal-body">

                                    <!-- fila 1-->
                                    <div class="sb-sidenav-menu-heading  mb-2 text-muted">Asignación</div>

                                    <div class="container">
                                        <div class="row">

                                            <div class="col-md-4">

                                                <div class="mb-3">
                                                    <label class="form-label">COD.OLY</label>
                                                    <input name="cod" type="text" class="form-control" id="validationCustom02" required>
                                                    <div class="invalid-feedback">
                                                        Se requiere un código válido.
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="mb-3">
                                                    <label class="form-label">Serie</label>
                                                    <input name="serie" type="text" class="form-control" id="validationCustom02" required>
                                                    <div class="invalid-feedback">
                                                        Se requiere un código válido.
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="mb-3">
                                                    <label class="form-label">Encargado</label>
                                                    <input name="encar" type="text" class="form-control" id="validationCustom02" required>
                                                    <div class="invalid-feedback">
                                                        Por favor ingrese un encargado válido.
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    </div>


                                    <!-- fial 2-->
                                    <div class="sb-sidenav-menu-heading  mb-2 text-muted">Ubicación</div>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col">
                                                
                                                <div class="mb-3">
                                                    <div>Direccion: <select name="cbx_direc" id="cbx_direc">
				                                        <option value="0">Seleccionar Direccion</option>
				                                        <?php while($row = $resultadoDi->fetch_assoc()) { ?>
					                                        <option value="<?php echo $row['cod_direc']; ?>"><?php echo $row['nombre_direc']; ?></option>
				                                        <?php } ?>
			                                        </select></div>
                                                </div>

                                                <div class="mb-3">
                                                    <div>Departamento: <select name="cbx_depar" id="cbx_depar"></select></div> 
                                                </div>

                                                <div class="mb-3">
                                                    <div>Oficina: <select name="cbx_ofic" id="cbx_ofic"></select></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <!-- fial 3-->
                                    <div class="sb-sidenav-menu-heading  mb-2 text-muted">Información del Insumo</div>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-4">

                                                <div class="mb-3">
                                                    <label class="form-label">Nombre</label>
                                                    <input name="nombreI" type="text" class="form-control" id="validationCustom02" required>
                                                    <div class="invalid-feedback">
                                                        Por favor ingrese un nombre válido.
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-4">

                                                <div class="mb-3">
                                                    <label class="form-label">Marca</label>
                                                    <input name="marca" type="text" class="form-control" id="validationCustom02">
                                                    <div class="invalid-feedback">
                                                        Por favor ingrese una marca válido.
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="mb-3">
                                                    <label class="form-label">Modelo</label>
                                                    <input name="modelo" type="text" class="form-control" id="validationCustom02">
                                                    <div class="invalid-feedback">
                                                        Por favor ingrese un modelo válido.
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-6">

                                                <div class="mb-3">
                                                    <label class="form-label">Detalle</label>
                                                    <input name="detalle" type="text" class="form-control">
                                                </div>

                                            </div>

                                            <div class="col-md-6">

                                                <div class="mb-3">
                                                    <label class="form-label">Observación</label>
                                                    <input name="obser" type="text" class="form-control">
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <!-- footer-->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" name="insertInsu" class="btn btn-primary">Guardar</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>


                <!-- Tables users -->
                <div class="container-fluid px-4 fs-6 ">
                    <div></div>
                    <div></div>
                    <table class="table table-bordered fs-6">
                        <thead class="table-dark">
                            <tr>
                                <th>Encargado</th>
                                <th>COD.OLY</th>
                                <th>Serie</th>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Detalle</th>
                                <th>Observación</th>
                                <th>Dirección</th>
                                <th>Departamento</th>
                                <th>Oficina</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>

                        <?php
                        
                        $sql = "SELECT `id`,`encargado`,`cod`,`serie`,`nombre_insu`,`marca`,`modelo`,`detalle`,`observacion`,direccion.`nombre_direc`,departamento.`nombre_depar`,oficina.`nombre_ofi` from `insumo` inner join `oficina` on insumo.`cod_ofi`=oficina.`cod_ofi` inner join `departamento` on oficina.`cod_depar`=departamento.`cod_depar` inner join `direccion` on departamento.`cod_direc`=direccion.`cod_direc` ORDER BY id DESC ";
                       
                        $Insu = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                       // $id = $row['id'];
                        ?>

                        <?php
                        if ($Insu) {
                            foreach ($Insu as $row) {

                        ?>
                                <tbody>
                                    <tr>
                                        <td style="Display:none;"> <?php echo $row['id']; ?> </td>
                                        <td> <?php echo $row['encargado']; ?> </td>
                                        <td> <?php echo $row['cod']; ?> </td>
                                        <td> <?php echo $row['serie']; ?> </td>
                                        <td> <?php echo $row['nombre_insu']; ?> </td>
                                        <td> <?php echo $row['marca']; ?> </td>
                                        <td> <?php echo $row['modelo']; ?> </td>
                                        <td> <?php echo $row['detalle']; ?> </td>
                                        <td> <?php echo $row['observacion']; ?> </td>
                                        <td> <?php echo $row['nombre_direc']; ?> </td>
                                        <td> <?php echo $row['nombre_depar']; ?> </td>
                                        <td> <?php echo $row['nombre_ofi']; ?> </td>
                                        <td>
                                            <button type="button" class="btn btn-success editbtn"> Editar </button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger deletebtn"> Borrar </button>
                                        </td>

                                    </tr>
                                </tbody>
                        <?php
                            }
                        } else {
                            echo "No Record Found";
                        }
                        ?>

                        <tfoot>
                            <tr>
                                <th>Encargado</th>
                                <th>COD.OLY</th>
                                <th>Serie</th>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Detalle</th>
                                <th>Observacion</th>
                                <th>Dirección</th>
                                <th>Departamento</th>
                                <th>Oficina</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </tfoot>

                    </table>

                </div>
        </div>

        <!-- Modal update-->

        <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar insumo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="update.php" method="POST" class="needs-validation" novalidate>

                        <div class="modal-body">
                            <!-- fial 1-->
                            <div class="sb-sidenav-menu-heading  mb-2 text-muted">Asignación</div>
                            <div class="container">
                                <div class="row">

                                    <div class="col-md-4">

                                        <div class="mb-3">
                                            <label class="form-label">COD.OLY</label>
                                            <input name="update_id" id="update_id" class="form-control" type="text" value="update_id" aria-label="readonly input example" required>
                                            <div class="invalid-feedback">
                                                Se requiere su código OLY.
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="mb-3">
                                            <label class="form-label">Serie</label>
                                            <input name="serie" type="text" class="form-control" id="serie" required>
                                            <div class="invalid-feedback">
                                                Se requiere su serie
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="mb-3">
                                            <label class="form-label">Encargado</label>
                                            <input name="encar" type="text" class="form-control" id="encar" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese un encargado válido.
                                            </div>
                                        </div>
                                        <input type="hidden" name="up_id" id="up_id">
                                    </div>

                                </div>
                            </div>

                            <!-- fial 2-->
                            <div class="sb-sidenav-menu-heading  mb-2 text-muted">Ubicación</div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Dirección</label>
                                            <input name="direccion" type="text" class="form-control" id="direccion" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Departamento</label>
                                            <input name="departamento" type="text" class="form-control" id="departamento" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Oficina</label>
                                            <input name="oficina" type="text" class="form-control" id="oficina" disabled>
                                        </div>
                                    </div>
                                   
                                    
                                </div>
                            </div>

                            <!-- fila 3-->
                            <div class="sb-sidenav-menu-heading  mb-2 text-muted">Información del Insumo</div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4">

                                        <div class="mb-3">
                                            <label class="form-label">Nombre</label>
                                            <input name="nombreI" type="text" class="form-control" id="nombreI" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese un nombre valido.
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4">

                                        <div class="mb-3">
                                            <label class="form-label">Marca</label>
                                            <input name="marca" type="text" class="form-control" id="marca" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese una marca valida.
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="mb-3">
                                            <label class="form-label">Modelo</label>
                                            <input name="model" type="text" class="form-control" id="model" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese una marca valida.
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="mb-3">
                                            <label class="form-label">Detalle</label>
                                            <input name="detalle" type="text" class="form-control" id="detalle">

                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="mb-3">
                                            <label class="form-label">Observacion</label>
                                            <input name="observacion" type="text" class="form-control" id="observacion">

                                        </div>

                                    </div>
                                </div>
                            </div>


                            <!-- footer-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="updatedata" class="btn btn-primary">Actualizar</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <!-- Modal borrar-->
        <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Advertencia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="delete.php" method="get">

                        <div class="modal-body">
                            Se borrara el contenido seleccionado ¿Desea continuar?
                            <input type="hidden" name="delete_id" id="delete_id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="deleteid" class="btn btn-primary">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        </main>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/scripts.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="assets/demo/chart-pie-demo.js"></script>

    <script>
        $(document).ready(function() {

            $('.editbtn').on('click', function() {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);
                
                $('#up_id').val(data[0]);
                $('#encar').val(data[1]);
                $('#update_id').val(data[2]);
                $('#serie').val(data[3]);
                $('#nombreI').val(data[4]);
                $('#marca').val(data[5]);
                $('#model').val(data[6]);
                $('#detalle').val(data[7]);
                $('#observacion').val(data[8]);
                $('#direccion').val(data[9]);
                $('#departamento').val(data[10]);
                $('#oficina').val(data[11]);
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $('.deletebtn').on('click', function() {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#datatableid').DataTable()
        });
    </script>

    <!-- Validacion -->

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>

</body>

</html>