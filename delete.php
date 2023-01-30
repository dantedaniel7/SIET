<?php 

include 'conexion.php';
if (isset($_GET['deleteid'])) {
    $id=$_GET['delete_id'];

    $sql= "delete from insumo where id=$id";
    $result= mysqli_query($conn, $sql);
    if ($result) {
        header('Location:insumos.php');
    }else {
        echo "error";
    }
}elseif (isset($_GET['deleteidU'])) {
    $id=$_GET['delete_id'];

    $sql= "delete from usuarios where id=$id";
    $result= mysqli_query($conn, $sql);
    if ($result) {
        header('Location:users.php');
    }else {
        echo "error";
    }
    
}


elseif (isset($_GET['deleteidD'])) {
    $cod_direc=$_GET['delete_id'];

    $sql= "delete from direccion where cod_direc=$cod_direc";
    $result= mysqli_query($conn, $sql);
    if ($result) {
        header('Location:direcciones.php');
    }else {
        echo
                "<script>
                    alert('No se puede eliminar este campo porque esta asociado a otras tablas'); 
                    window.location = 'direcciones.php'; 
                </script>";
    }
    
}



elseif (isset($_GET['deleteidDe'])) {
    $cod_depar=$_GET['delete_id'];

    $sql= "delete from departamento where cod_depar=$cod_depar";
    $result= mysqli_query($conn, $sql);
    if ($result) {
        header('Location:departamentos.php');
    }else {
        echo
        "<script>
            alert('No se puede eliminar este campo porque esta asociado a otras tablas'); 
            window.location = 'direcciones.php'; 
        </script>";
    }
    
}elseif (isset($_GET['deleteidOfi'])) {
    $cod_ofi=$_GET['delete_id'];

    $sql= "delete from oficina where cod_ofi=$cod_ofi";
    $result= mysqli_query($conn, $sql);
    if ($result) {
        header('Location:oficinas.php');
    }else {
        echo
        "<script>
            alert('No se puede eliminar este campo porque esta asociado a otras tablas'); 
            window.location = 'direcciones.php'; 
        </script>";
    }
    
}
?>


