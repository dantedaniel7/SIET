<?php

require "conexion.php";
session_start();

if ($_POST) {
    $usuario = $_POST['user'];
    $password = $_POST['password'];

    $sql ="SELECT `id`, `nombre`, `usuario`, `password`, `email`, `tipo_usuario` FROM `usuarios` WHERE usuario= '$usuario'";
    $resultado = $conn->query($sql);
    $num = $resultado->num_rows;

    if ($num > 0) {
        $row = $resultado->fetch_assoc();
        $password_bd = $row['password'];

        $pass_c = sha1($password);

        if ($password_bd == $pass_c) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['tipo_usuario'] = $row['tipo_usuario'];

            header("Location: principal.php");
        } else {
            echo '<script language="javascript">';
            echo 'alert("No coincide la contraseña")';
            echo '</script>';
        }
    } else {
        echo '<script language="javascript">';
        echo '<script> Error("El usuario no existe"); </script>';
        echo '</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - SIET</title>
    <link href="css/estilo.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

</head>

<body>
    <?php
        include('msjs.php');
    ?>
    <div>

        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main><br><br><br>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Sistema de Autenticaci&oacute;n</h3>
                                        <img src="assets/img/logo.png" alt="Logo de GAD" class="card-header-img">
                                    </div>
                                    <div class="card-body">
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="text" placeholder="name@example.com" name="user" />
                                            <label for="inputEmail">Usuario</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="password" />
                                            <label for="inputPassword">Contraseña</label>
                                        </div>
                                        <div class="text-center py-3">
                                            <button type="submit" class="btn btn-primary">Acceder</button>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            
                                            <br><br>    
                                        </div>
                                        <div class="text-center py-3">
                                            <a class="medium" href="btnrecoverpass.php" id="olvidar">¿Olvidaste tu contraseña?</a> 
                                        </div>
                                        </form>
                                    </div>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                </main>
            </div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </div>

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
        var toastTrigger = document.getElementById('liveToastBtn')
        var toastLiveExample = document.getElementById('liveToast')
        if (toastTrigger) {
            toastTrigger.addEventListener('click', function() {
                var toast = new bootstrap.Toast(toastLiveExample)

                toast.show()
            })
        }
    </script>
    <script>
        var toastTrigger = document.getElementById('liveToastBtn2')
        var toastLiveExample = document.getElementById('liveToast')
        if (toastTrigger) {
            toastTrigger.addEventListener('click', function() {
                var toast = new bootstrap.Toast(toastLiveExample)

                toast.show()
            })
        }
    </script>

<script src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
 $('#recuperarclave').hide(); 

$('#olvidar').on('click', function() {
    $('#signup').hide(); //para ocultar
    $("#recuperarclave").fadeIn("slow"); //mostrar
});

$('#volver').on('click', function() {
    $('#recuperarclave').hide(); //para ocultar
    $("#signup").fadeIn("slow"); //mostrar
});
</script>
</body>

</html>