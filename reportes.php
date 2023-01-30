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
    <link href="calendar/calendar.css" type="text/css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="#">Sistema de Inventario</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <?php echo $nombre . " "; ?><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <!--  <li><a class="dropdown-item" href="#">Editar Perfil</a></li> -->
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>
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
                    <h3>Consultas y Reportes</h3>
                    <div class="card"></div><br> 

                    <div class="card">
                        <div class="container">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <form action="buscarIn.php" method="get">
                                            <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
                                            <input type="submit" value="Buscar" class="btn btn-primary btn-sm">
                                        </form>
                                    </div>

                                    <div class="col">
                                        <form action="impri.php" method="post" target="_blank">
                                            <label>Obtener reporte Completo</label>
                                            <select name="tipo_reporte" required>
                                            <option selected disabled value="">-- Selecione un formato--</option>
                                                <option>EXCEL</option>
                                                <option>PDF</option>
                                            </select>
                                            <input type="submit" value="Exportar" name="reporte_completo" class="btn btn-secondary btn-sm">
                                        </form>
                                    </div>
                                    
                                </div>


                            </div>
                        </div>
                    </div>

                    <br>

                    <table class="table table-striped table-hover table-bordered">
                        <tr>
                            <th>Encargado</th>
                            <th>COD.OLY</th>
                            <th>Serie</th>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Detalle</th>
                            <th>Dirección</th>
                            <th>Departamento</th>
                            <th>Oficina</th>
                            <th>Observación</th>
                        </tr>

                        <?php
                        $query = mysqli_query($conn,"SELECT `id`,`encargado`,`cod`,`serie`,`nombre_insu`,`marca`,`modelo`,`detalle`,direccion.`nombre_direc`,departamento.`nombre_depar`,oficina.`nombre_ofi`,`observacion`, `fecha`  from `insumo` inner join `oficina` on insumo.`cod_ofi`=oficina.`cod_ofi` inner join `departamento` on oficina.`cod_depar`=departamento.`cod_depar` inner join `direccion` on departamento.`cod_direc`=direccion.`cod_direc`" );
                        $resul = mysqli_num_rows($query);

                        if ($resul > 0) {
                            while ($data = mysqli_fetch_array($query)) {

                        ?>
                                <tr>
                                    <td><?php echo $data['encargado']; ?></td>
                                    <td><?php echo $data['cod']; ?></td>
                                    <td><?php echo $data['serie']; ?></td>
                                    <td><?php echo $data['nombre_insu']; ?></td>
                                    <td><?php echo $data['marca']; ?></td>
                                    <td><?php echo $data['modelo']; ?></td>                                    
                                    <td><?php echo $data['detalle']; ?></td>
                                    <td><?php echo $data['nombre_direc']; ?></td>
                                    <td><?php echo $data['nombre_depar']; ?></td>
                                    <td><?php echo $data['nombre_ofi']; ?></td>
                                    <td><?php echo $data['observacion']; ?></td>

                                </tr>
                        <?php
                            }
                        }

                        ?>
                    </table>



                </div>
                <br>
            </main>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="assets/demo/chart-pie-demo.js"></script>

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