<?php
include "conexion.php";


    if(isset($_POST['updatedata']))
    {   
        //$cod_ofi = $_POST['cbx_ofic'];
        $id = $_POST['up_id'];
        $codi = $_POST['update_id'];
        $serie= $_POST['serie'];      
        $nameI = $_POST['nombreI'];
        $marc = $_POST['marca'];
        $model_i = $_POST['model'];
        $encarg = $_POST['encar'];
        $detal = $_POST['detalle'];
        $obser = $_POST['observacion'];

        $query = "UPDATE `insumo` SET `serie`='$serie', `nombre_insu`='$nameI',`marca`='$marc', `modelo`='$model_i',
        `encargado`='$encarg',`detalle`='$detal', `observacion`='$obser' WHERE `id`=$id ";

        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            echo '<script> alert("Actualizado"); </script>';
            header("Location:insumos.php");
            
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
            echo $query;
            
        }
    }elseif (isset($_POST['updateUser'])) {
       
        $id = $_POST['update_id'];
        $pass = $_POST['passwordU'];
       
        $sql="SELECT `password` FROM `usuarios` WHERE `id`='$id' ";

        $result= mysqli_query($conn,$sql);

        while ($row = mysqli_fetch_array($result)) {
            $passB = $row['password'];
        }

       if ($passB==$pass) {

        $id = $_POST['update_id'];
        $userU = $_POST['usuarioU'];
        $nameU = $_POST['nombreU'];
        $emailU = $_POST['emailU'];
        $tipoU = $_POST['tipo_usuarioU'];

        $query = "UPDATE `usuarios` SET `usuario`='$userU',
        `nombre`='$nameU',`email`='$emailU',`tipo_usuario`='$tipoU' WHERE `id`='$id' ";
        
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:users.php");
            
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
       } else {
           
        $id = $_POST['update_id'];
        $userU = $_POST['usuarioU'];
        $nameU = $_POST['nombreU'];
        $emailU = $_POST['emailU'];

        $password = $_POST['passwordU'];
        $pass_encry = sha1($password);

        $tipoU = $_POST['tipo_usuarioU'];

        $query = "UPDATE `usuarios` SET `usuario`='$userU',`password`='$pass_encry',
        `nombre`='$nameU',`email`='$emailU', `tipo_usuario`='$tipoU' WHERE `id`='$id' ";
        
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:users.php");
            
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
       }
       
        
    }
    
    
    elseif(isset($_POST['updatedireccion']))
    {   
        $cod_direc = $_POST['update_id'];
        $nombre_direcU = $_POST['nombre_direcU'];      

        $query = "UPDATE `direccion` SET `nombre_direc`='$nombre_direcU' WHERE `cod_direc`='$cod_direc' ";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            echo '<script> alert("Actualizado"); </script>';
            header("Location:direcciones.php");
            
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
            echo $query;
            
        }
    }
    
    
    
    elseif(isset($_POST['updatedepartamento']))
    {   
        $cod_depar = $_POST['update_id'];
        $nombre_deparU = $_POST['nombre_deparU'];      

        $query = "UPDATE `departamento` SET `nombre_depar`='$nombre_deparU' WHERE `cod_depar`='$cod_depar' ";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            echo '<script> alert("Actualizado"); </script>';
            header("Location:departamentos.php");
            
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
            echo $query;
            
        }
    }elseif(isset($_POST['updateoficina']))
    {   
        $cod_ofi = $_POST['update_id'];
        $nombre_ofiU = $_POST['nombre_ofiU'];      

        $query = "UPDATE `oficina` SET `nombre_ofi`='$nombre_ofiU' WHERE `cod_ofi`='$cod_ofi' ";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            echo '<script> alert("Actualizado"); </script>';
            header("Location:oficinas.php");
            
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
            echo $query;
            
        }
    }
?>