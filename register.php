<?php 
    include "conexion.php";
    session_start();
    if (isset($_POST['insertUser'])) {

        $user = $_POST['usuario'];
        $password = $_POST['password'];
        $pass_encry = sha1($password);
        $email = $_POST['email'];
        $nombre = $_POST['nombre'];
        $tipousuario = $_POST['tipo_usuario'];

            $consulta= "INSERT INTO `usuarios`(`id`,`usuario`, `password`, `nombre`,`email`, `tipo_usuario`) VALUES (NULL,'$user','$pass_encry','$nombre','$email','$tipousuario')";

            $resultado = mysqli_query($conn, $consulta);
            
            
            if ($resultado) {
                header('Location: users.php');
                echo '<script> alert("Data saved"); </script>';
                
            
            }else {
            
                echo '<script> alert("Data not saved"); </script>';
                
            
            }
    } elseif (isset($_POST['insertDirec'])) {
      
        $cod_direc = $_POST['cod_direc'];
        $direccion = $_POST['direccion'];
        
            $consulta= "INSERT INTO `direccion`(`cod_direc`,`nombre_direc`) VALUES ('$cod_direc','$direccion')";

            $resultado = mysqli_query($conn, $consulta);
            
            if ($resultado) {
                header('Location: direcciones.php');
                echo '<script> alert("Data saved"); </script>';
            }else {
                echo '<script> alert("Data not saved"); </script>';
            }

    } elseif (isset($_POST['insertDepar'])) {
        
        $cod_direc = $_POST['cod_direc'];
        $cod_depar = $_POST['cod_depar'];
        $departamento = $_POST['departamento'];
            
            $consulta= "INSERT INTO `departamento`(`cod_direc`,`cod_depar`,`nombre_depar`) VALUES ('$cod_direc','$cod_depar','$departamento')";

            $resultado = mysqli_query($conn, $consulta);
            
            if ($resultado) {
                header('Location: departamentos.php');
                echo '<script> alert("Datos guardados"); </script>';

            }else {
                echo '<script> alert("ID ya registrado"); </script>';
            }
    }elseif (isset($_POST['insertOfic'])) {
        
        $cod_depar = $_POST['cod_depar'];
        $cod_ofi = $_POST['cod_ofi'];
        $oficina = $_POST['oficina'];
            
            $consulta= "INSERT INTO `oficina`(`cod_depar`,`cod_ofi`,`nombre_ofi`) VALUES ('$cod_depar','$cod_ofi','$oficina')";

            $resultado = mysqli_query($conn, $consulta);
            
            if ($resultado) {
                header('Location: oficinas.php');
                echo '<script> alert("Datos guardados"); </script>';

            }else {
                echo '<script> alert("ID ya registrado"); </script>';
            }
    }elseif (isset($_POST['insertInsu'])) {

        $cod_ofi = $_POST['cbx_ofic'];
        $cod_i = $_POST['cod'];
        $encargado = $_POST['encar'];
        $serie = $_POST['serie'];
        $nombreIn = $_POST['nombreI'];
        $marca = $_POST['marca'];
        $model_i = $_POST['modelo'];
        $detalle = $_POST['detalle'];
        $obser = $_POST['obser'];
        

        $consulta= "INSERT INTO `insumo`(`cod_ofi`,`id`, `encargado`,`cod`,`serie`,`nombre_insu`, `marca`, `modelo`, `detalle`,`observacion`, `fecha`) VALUES ('$cod_ofi',NULL,'$encargado','$cod_i','$serie','$nombreIn','$marca','$model_i','$detalle','$obser',NOW())";
        $resultado = mysqli_query($conn, $consulta);

        if ($resultado) {
        
            echo '<script> alert("Data saved"); </script>';
            header('Location: insumos.php');

        
        }else {
        
            echo '<script> alert("Data not saved"); </script>';
            echo "error grave";
            
        }

    }

?>