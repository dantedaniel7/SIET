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

$sql = "SELECT * FROM  direccion $where";
$resultados = $conn->query($sql);

$sql = "SELECT * FROM  departamento $where";
$resultados1 = $conn->query($sql);



$querydi=mysqli_query($conn, "SELECT cod_direc, nombre_direc FROM direccion");

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
        <a class="navbar-brand ps-3" href="principal.php">Sistema de inventario</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <?php echo $nombre . " "; ?><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <!-- <li><a class="dropdown-item" href="#">Editar Perfil</a></li> -->
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
                    <h3>Administración de Departamentos</h3>
                    <div class="card"></div><br>

                    <!-- Button trigger modal -->
                    <div class="card">
                        <div class="card-body">
                          <div class="row align-items-center">
                              <div class="col-10">
                                Agregue departamentos, actualice sus datos o eliminelos del sistema.
                              </div>
                              <div class="col-2 d-grid gap-2 mx-auto">
                              <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#users">
                                 <div class="sb-nav-link-icon"><i class="fas fa-map-marked-alt"></i></div> Añadir Departamento
                              </button>
                              </div>
                          </div>
                        </div>
                    </div>
                    <br>
                    <!-- Modal agregar-->
                    <div class="modal fade" id="users" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Añadir Departamento</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="register.php" method="POST" class="needs-validation" novalidate>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                        <label class="form-label">Dirección</label>
                                            <select name="cod_direc">
                                            <?php
                                            while($datos = mysqli_fetch_array($querydi))
                                            {
	                                            ?>
	                                            <option value="<?php echo $datos["cod_direc"] ?>">
                                                <?php echo $datos["nombre_direc"];?></option>
	                                            <?php
                                            }
                                                ?>
                                            </select>
                                            
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">ID</label>
                                            <input name="cod_depar" type="text" class="form-control" id="validationCustom02" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese un ID válido
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nombre del departamento </label>
                                            <input name="departamento" type="text" class="form-control" id="validationCustom02" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese un departamento válida
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" name="insertDepar" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tables users -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Departamentos Registrados
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php while ($row = $resultados1->fetch_assoc()) {   ?>

                                        <tr>
                                            <td><?php echo $row['cod_depar']; ?></td>
                                            <td><?php echo $row['nombre_depar']; ?></td>
                                            <td><button type="button" class="btn btn-success editbtn">Editar</button> </td>
                                            <td><button type="button" class="btn btn-danger deletebtn"> Borrar </button> </td>


                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


            </div>
        </div>
<!-- Agregar Departamento -->
        
        <!-- Modal editar-->
        <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Datos </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="update.php" method="POST" class="needs-validation" novalidate>

                        <div class="modal-body">

                        <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="hidden" name="update_id" value="update_id" id="update_id">
                                <input name="nombre_deparU" type="text" class="form-control" id="nombre_deparU" required>
                                <div class="invalid-feedback">
                                    Por favor rellene todos los campos
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="updatedepartamento" class="btn btn-primary">Guardar</button>
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
                       Se eliminara al usuario seleccionado, desea continuar? 
                       <input type="hidden" name="delete_id" id="delete_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" name="deleteidDe" class="btn btn-primary">Eliminar</button>
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
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>

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

    <script>
        $(document).ready(function() {

            $('.editbtn').on('click', function() {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);
                
                $('#update_id').val(data[0]);
                $('#nombre_deparU').val(data[1]);
              
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

</body>

</html>