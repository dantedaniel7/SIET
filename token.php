<?php
require "conexion.php";
$token = $_POST['token'];
$queryusuario1 = mysqli_query($conn, "SELECT * FROM usuarios WHERE token = '$token'");
$nrr = mysqli_num_rows($queryusuario1);
$mostrar = $queryusuario1->fetch_array();
if($nrr == 1) {
    $vtoken = mysqli_real_escape_string($conn, $_POST['token']);
    if($vtoken == $token){
        echo
            "<script>
                alert('TOKEN CORRECTO'); 
                window.location = 'btnnewpass.php'; 
            </script>";
    }else{
        echo
            "<script>
                alert('TOKEN INCORRECTO'); 
                window.location = 'btntoken.php'; 
            </script>";
    }

}else{
    echo
            "<script>
                alert('ERROR - Token Incorrecto 2DO IF'); 
                window.location = 'btntoken.php'; 
            </script>";
}
    /*
    if(isset($_POST['token'])&&isset($_POST['email'])){
        $vtoken = mysqli_real_escape_string($conn, $_POST['token']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $user = "SELECT * FROM usuarios WHERE email = '$email'";
        $code_res = mysqli_query($conn, $user);

        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $token = $fetch_data['token'];
            if($token!==$vtoken){
                echo "<script>alert('TOKEN INCORRECTO IF 1');</script>";
                //header("Location: newpass.php");
                exit();
            }else{
                header("Location: newpass.php");
            }
        }else{
            echo "<script>alert('TOKEN INCORRECTO IF 2');</script>";
            header("Location: index.php");
            exit();
        }
    }else{
        header("Location: index.php");
        exit();
    }*/


//$token = $_POST['token'];
    /*if(isset($_POST['validar'])){
        $_SESSION['info'] = "";
        $token = mysqli_real_escape_string($conn, $_POST['token']);
        $check_token = "SELECT * FROM usuarios WHERE token = '$token'";
        $code_res = mysqli_query($conn, $check_token);
        if(mysqli_num_rows($code_res) > 0){*/
            /*$fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "CREA UNA CONTRASEÑA";
            $_SESSION['info'] = $info;*/
            /*header('location: newpass.php');
            exit();
        }else{
            echo "<script>alert('TOKEN INCORRECTO');</script>";
            header('location: token.php');
        }
    }*/


    /*$email = $_POST['email'];
$queryusuario = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '$email'");
$nr = mysqli_num_rows($queryusuario);
$mostrar = $queryusuario->fetch_array();
if($email == true){
    header("Location: index.php");
}*/

    
    /*if ($_row['token'] == $token){
        //header('Location: newpass.php');
        echo "<script>alert('TOKEN CORRECTO');</script>";
    }else{
        echo "<script>alert('TOKEN INCORRECTO');</script>";
    }*/

    /*NO VALIO
    if(isset($_POST['validar'])){
        $otp_token = mysqli_real_escape_string($conn, $_POST['token']);
        $check_token = "SELECT * FROM usuarios WHERE token = '$otp_token'";
        $code_res = mysqli_query($conn, $check_token);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_token = $fetch_data['token'];
            $email = $fetch_data['email'];
            $token = 0;
            $update_otp = "UPDATE usuarios SET token = $token WHERE token = $fetch_token";
            $update_res = mysqli_query($conn, $update_otp);
            if($update_res){
                echo "<script>alert('TOKEN CORRECTO');</script>";
            }else{
                echo "<script>alert(Fallo al momento de actualizar el Token');</script>";
            }
        }
        
    }else{
        echo "<script>alert('TOKEN INCORRECTO');</script>";
    }*/                             
/*
if($_POST){
    $token = $_POST['token'];
    $sql = "SELECT token FROM usuarios WHERE email = '$email'";
    $resultado = $conn->query($sql);
    $num = $resultado->num_rows;
    if(['token'] == '$token'){
        header("Location: newpass.php");
    }

}else{
    echo "ERROR";
}*/

?>

