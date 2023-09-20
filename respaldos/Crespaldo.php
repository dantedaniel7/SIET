
<?php 
$message = '';
if(isset($_POST["import"]))
{
 if($_FILES["database"]["name"] != '')
 {
  $array = explode(".", $_FILES["database"]["name"]);
  $extension = end($array);
  if($extension == 'sql')
  {
   $connect = mysqli_connect('localhost', 'root', '1997', 'SIET');
   $output = '';
   $count = 0;
   $file_data = file($_FILES["database"]["tmp_name"]);
   foreach($file_data as $row)
   {
    $start_character = substr(trim($row), 0, 2);
    if($start_character != '--' || $start_character != '/*' || $start_character != '//' || $row != '')
    {
     $output = $output . $row;
     $end_character = substr(trim($row), -1, 1);
     if($end_character == ';')
     {
      if(!mysqli_query($connect, $output))
      {
       $count++;
      }
      $output = '';
     }
    }
   }
   if($count > 0)
   {
        echo
        "<script>
            alert('Archivo SQL ya existe'); 
            window.history.back();
        </script>";
   }
   else
   {
        echo
        "<script>
            alert('Base de Datos importado exitosamente'); 
            window.history.back();
        </script>";
   }
  }
  else
  {
        echo
        "<script>
            alert('Archivo incompatible'); 
            window.history.back();
        </script>";
  }
 }
 else
 {
        echo
        "<script>
            alert('Por favor selecione un archivo SQL'); 
            window.history.back();
        </script>";
 }
}
?>
