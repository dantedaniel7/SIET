<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}
$nombre = $_SESSION['nombre'];
$tipo_usuario = $_SESSION['tipo_usuario'];
$email = $_SESSION['email'];


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

$sql = "SELECT * FROM  usuarios $where";
$resultado = $conn->query($sql);

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

                            <a class="nav-link" href="#">
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
                    <h3>Administración de Usuarios</h3>

                    <div class="card"></div><br>

                    <!-- Button trigger modal -->
                    <div class="card">
                        <div class="card-body">
                          <div class="row align-items-center">
                              <div class="col-10">
                                Agregue usuarios, actualice sus datos o eliminelos del sistema.
                              </div>

                              <div class="col-2 d-grid gap-2 mx-auto">
                              <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#users">
                                 <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div> Añadir Usuario
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
                                    <h5 class="modal-title" id="exampleModalLabel">Añadir de Usuario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form action="register.php" method="POST" class="needs-validation" novalidate>

                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label class="form-label">Usuario</label>
                                            <input name="usuario" type="text" class="form-control" id="validationCustom02" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese un usuario valido.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                                            <input name="password" type="password" class="form-control" id="validationCustom02" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese una clave.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nombre</label>
                                            <input name="nombre" type="text" class="form-control" id="validationCustom02" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese su nombre y apellido.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input name="email" type="text" class="form-control" id="validationCustom02" required>
                                            <div class="invalid-feedback">
                                                Por favor ingrese su Email
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tipo de Usuario <div id="emailHelp" class="form-text">1 para Administrador, 2 para usuario</div></label>

                                            <select name="tipo_usuario" class="form-select" aria-label="Default select example" id="validationCustom02" required>
                                            <option selected disabled value="">-- Selecione el nivel--</option>
                                                <option>1</option>
                                                <option>2</option>

                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor selecione el tipo de usuario.
                                            </div>
                                            
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" name="insertUser" class="btn btn-primary">Guardar</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- Tables users -->

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Usuarios Registrados
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Contraseña</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Tipo de usuario</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Contraseña</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Tipo de usuario</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php while ($row = $resultado->fetch_assoc()) {   ?>

                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['usuario']; ?></td>
                                            <td><?php echo $row['password']; ?></td>
                                            <td><?php echo $row['nombre']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['tipo_usuario']; ?></td>
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

        <!-- Modal editar-->
        <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Datos del Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="update.php" method="POST" class="needs-validation" novalidate>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Usuario</label>
                                <input type="hidden" name="update_id" value="update_id" id="update_id">
                                <input name="usuarioU" type="text" class="form-control" id="usuarioU" required>
                                <div class="invalid-feedback">
                                    Por favor ingrese un usuario valido.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                                <input name="passwordU" type="password" class="form-control" id="passwordU" required>
                                <div class="invalid-feedback">
                                    Por favor ingrese una clave.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input name="nombreU" type="text" class="form-control" id="nombreU" required>
                                <div class="invalid-feedback">
                                    Por favor ingrese su nombre y apellido.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Correo</label>
                                <input name="emailU" type="text" class="form-control" id="emailU" required>
                                <div class="invalid-feedback">
                                    Por favor ingrese su Correo
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tipo de Usuario</label>
                                <input name="tipo_usuarioU" type="text" class="form-control" id="tipo_usuarioU" required>
                                <div class="invalid-feedback">
                                    Por favor selecione el tipo de usuario.
                                </div>
                                <div class="form-text">1 para Administrador, 2 para usuario</div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="updateUser" class="btn btn-primary">Guardar</button>
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
                        <button type="submit" name="deleteidU" class="btn btn-primary">Eliminar</button>
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
                $('#usuarioU').val(data[1]);
                $('#passwordU').val(data[2]);
                $('#nombreU').val(data[3]);
                $('#emailU').val(data[4]);
                $('#tipo_usuarioU').val(data[5]);

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