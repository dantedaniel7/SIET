<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}
$nombre = $_SESSION['nombre'];
$tipo_usuario = $_SESSION['tipo_usuario'];
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
        <a class="navbar-brand ps-3" href="#">Sistema de inventario</a>
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
                    <h3>Respaldos</h3>
                    <div class="card"></div><br>

                    <div class="card">
                        <div class="container">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row align-items-center">
                                        <div class="col-10">

                                            Obtenga un respaldo actualizado de la base de datos

                                        </div>

                                        <div class="col-2 d-grid gap-2 mx-auto">
                                            <a class="btn btn-outline-success btn-sm" href="respaldos/Grespaldo.php">
                                                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>Descargar Respaldo
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="card">
                        <div class="container">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row align-items-center">
                                        <div class="col-10">

                                            Cargar un respado de la base de datos

                                        </div>
                                        <div class="col-2 d-grid gap-2 mx-auto">
                                        <button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <div class="sb-nav-link-icon"><i class="fa fa-book" aria-hidden="true"></i></div> Cargar Respaldo
                                        </button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Cargar respaldo-->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Recuperar Datos</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                <form action="respaldos/Crespaldo.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>

                                    <div class="mb-3">

                                        <label for="formFile" class="form-label">Seleccione el archivo SQL para cargar los datos</label>
                                        <input class="form-control" type="file" name="database" id="formFile">
                                    
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" name= "import" class="btn btn-primary">Cargar Archivo</button>
                                </div>
                                
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </main>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="assets/demo/chart-pie-demo.js"></script>
</body>

</html>