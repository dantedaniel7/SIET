<?php
require "conexion.php";
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
<div>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main><br><br><br>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div id="recuperarclave">
                                <h3 class="text-center font-weight-light my-4">NUEVA CONTRASEÑA</h3>
                                <div></div>
                                <div class="card-body">
                                    <form action="newpass.php" method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="spassword" type="password" placeholder="Nueva Contraseña" name="spassword" />
                                            <label for="spassword">Nueva Contraseña</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="cpassword" type="password" placeholder="Confirmar Contraseña" name="cpassword" />
                                            <label for="cpassword">Confirmar Contraseña</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="enviar" class="btn btn-primary">Guardar</button>
                                        </div>
                                        <br><br>
                                    </form>
                                    </div> 
                                </div>
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </main>
        </div> 
    </div> 
</div> 
</body>
</html>