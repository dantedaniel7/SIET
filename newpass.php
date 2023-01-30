<?php
require "conexion.php";
// Declaracion de lo campos que vienen del formulario
$spassword = $_POST['spassword'];
$cpassword = $_POST['cpassword'];
//Llamado al cookie del archivo recoverpass
$cookie_email = $_COOKIE['email'];
// Metodo de encriptación SHA1
if($spassword == $cpassword){ //Comparación de los campos password
    $enc_password = sha1($spassword); //Se encripta la contraseña
    // UPDATE a la contraseña
    $consulta = mysqli_query($conn, "UPDATE usuarios SET password = '$enc_password' WHERE email = '$cookie_email'");
    echo
        "<script>
            alert('CONTRASEÑA CAMBIADA EXITOSAMENTE'); 
            window.location = 'index.php'; 
        </script>";
}else{
    echo
          "<script>
            alert('NO COINCIDEN LAS CONTRASEÑAS'); 
             window.location = 'btnnewpass.php'; 
         </script>";
}
/*if(isset($_GET['token'])&&isset($_GET['email'])){
    $vtoken = mysqli_real_escape_string($conn, $_GET['token']);
    $email = mysqli_real_escape_string($conn, $_GET['email']);
    $user = "SELECT * FROM usuarios WHERE email = '$email'";
    $code_res = mysqli_query($conn, $user);

    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $token = $fetch_data['token'];
        if($token!==$vtoken){
            echo "<script>alert('TOKEN INCORRECTO 1ER IF');</script>";
            //header("Location: index.php");
            //exit();
        }
    }else{
        echo "<script>alert('TOKEN INCORRECTO 2do IF');</script>";
        //header("Location: index.php");
        //exit();
    }
}else{
    echo "<script>alert('TOKEN INCORRECTO 3ER IF'); window.location='index.php'; </script>";
}*/



/*$email = $_POST['email'];
$queryusuario = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '$email'");
$nr = mysqli_num_rows($queryusuario);
$mostrar =$queryusuario->fetch_array();*/
    /*$_SESSION['info'] = "";
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }else{
        $code = 0;
        $email = $_SESSION['email']; //getting this email using session
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE usuarios SET token = $token, password = '$encpass' WHERE email = '$email'";
        $run_query = mysqli_query($conn, $update_pass);
        if($run_query){
            $info = "Your password changed. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            header('Location: index.php');
        }else{
            echo "<script>alert('ERROR AL CAMBIAR LA CONTRA');</script>";
        }
    }*/

/*
?>*/
/*
    if(isset($_GET['email']) AND isset($_GET['token'])){
    require "conexion.php";
    $email = $mysqli->real_escape_string($_GET['email']);
    $token = $mysqli->real_escape_string($_GET['token']);
    $sql = $mysqli->query("SELECT token FROM usuarios WHERE email = '$email'");
    $row = $sql->fetch_array();

    if($row['token'] == $token) { 

?>
<?php
if(isset($_POST['token'])){
    require "conexion.php";
    $password = $mysqli->real_escape_string($_POST['password']);
    $password = hash('sha512',$password);

    $act = $mysqli->query("UPDATE usuarios SET password= '$password', token = '' WHERE email = '$email'");

    if ($act){
        echo <script>alert("Su contraseña se ha actualizado correctamente");</script>;
        header("Refresh: 1; URL=../index.php");
    }else{
        echo "Ha habido un problema a la hora de actualizar la contraseña";
    }
}*/
?>