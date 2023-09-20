<?php

require "conexion.php";
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//$permitted_chars = '0123456789';

function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}
    $email = $_POST['email'];
    // Almacenamiento de cookie para utilizar en otro archivo
    setcookie('email', $email, time()+604800);
    
    $queryusuario = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '$email'");
    // var_dump($queryusuario->fetch_array());die;
    $nr = mysqli_num_rows($queryusuario);
    // $nr=$queryusuario->num_rows();
    $mostrar = $queryusuario->fetch_array(); // mysqli_fecth_array($queryusuario);
    // && (password_verify($password, $mostrar['password'])
    if ($nr == 1){
        $token = generate_string($permitted_chars, 6);
        $query = "UPDATE usuarios SET token = '$token' WHERE email = '$email'";
        $query_run = mysqli_query($conn, $query);
        //$token = md5($token);
        
        //echo $enviarpass = "http://localhost:8090/SIET/newpass.php?token=$token&email=$email";
        //die;
        $enviarpass = $token;
        

        $para = $email;
        $titulo = "SISTEMA DE INVENTARIO (SIET)";
        $mensaje = "Tu Token es: ".$enviarpass;
        $correoadmin = "From: sistemasibtec@outlook.com";
        
        if(mail($para, $titulo, $mensaje, $correoadmin)) {
            //echo "<script>alert('Token enviado al correo registrado...');</script>";
            //header("Location: token.php");
            echo 
                "<script>
                    alert('Token enviado al correo registrado...'); 
                    window.location = 'btntoken.php'; 
                </script>";
        }else{
            //echo "<script>alert('ERROR AL MOMENTO DE ENVIAR EL TOKEN');</script>";
            //header("Location: index.php");
            echo
                "<script>
                    alert('ERROR AL MOMENTO DE ENVIAR EL TOKEN'); 
                    window.location = 'index.php'; 
                </script>";
        }
    }else{
        //echo "<script>alert('Este correo no se encuentra registrado');</script>";
        //header("Location: recoverpass.php");
        //exit();
        echo
            "<script>
                alert('Este correo no se encuentra registrado'); 
                window.location = 'btnrecoverpass.php'; 
            </script>";
    }

?>
