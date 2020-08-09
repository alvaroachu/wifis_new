<?php 
 if (isset($_POST['namebd']) && !empty ($_POST['namebd']) &&
     isset($_POST['nameu']) && !empty ($_POST['nameu']) &&
     isset($_POST['password']) &&
     isset($_POST['servname']) && !empty ($_POST['servname']) ) 
    {
    error_reporting(0);
     $bd = $_POST['namebd'];
     $nu = $_POST['nameu'];
     $pw = $_POST['password'];
     $sn = $_POST['servname'];
        $conex = mysqli_connect ($sn,$nu,$pw,$bd) or die ('Datos Incorrectos, revisar los campos ingresados');
         session_start();
        $_SESSION['bd'] = $bd;
        $_SESSION['nu'] = $nu;
        $_SESSION['pw'] = $pw;
        $_SESSION['sn'] = $sn;
        //echo 'todo ok';
        echo '<script>window.location = "guardar.php";</script>';
                        
    } 
        else 
            {

                echo '<script>alert("Ingresar datos en los campos vacios");</script>';  
                echo '<script>window.location = "index.html";</script>';
            }
?>

<?php 
//$conex = mysqli_connect ('127.0.0.1','root','Admin@14','proywork') or die ("Estamos en mantenimiento preventivo");
?>
